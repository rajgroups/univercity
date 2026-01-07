<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\ProjectEstimation;
use App\Models\EstimationItem;
use App\Models\ProjectDonor;
use App\Models\ProjectFunding;
use App\Models\ProjectUtilization;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProjectEstimatorController extends Controller
{
    public function index($projectId)
    {
        $project = Project::findOrFail($projectId);
        
        // Fetch or create default estimation (Active V1)
        $estimation = ProjectEstimation::firstOrCreate(
            ['project_id' => $projectId, 'status' => 'active'],
            ['version' => 'V1', 'total_amount' => 0]
        );

        $estimation->load('items');
        $donors = ProjectDonor::where('project_id', $projectId)->get();
        $fundings = ProjectFunding::where('project_id', $projectId)->get();
        $utilizations = ProjectUtilization::where('project_id', $projectId)->get();

        return view('admin.project.estmator', compact(
            'project', 
            'estimation', 
            'donors', 
            'fundings', 
            'utilizations'
        ));
    }

    // ================= ESTIMATION ITEMS =================
    public function storeEstimationItem(Request $request)
    {
        $request->validate([
            'estimation_id' => 'required|exists:project_estimations,id',
            'item_name' => 'required|string',
            'quantity' => 'required|numeric|min:0',
            'unit_cost' => 'required|numeric|min:0',
            // other fields like category, phase can be optional
        ]);

        try {
            $totalCost = $request->quantity * $request->unit_cost;

            // Handle File Upload
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('estimations/items', $filename, 'public');
                // Or use move like in ProjectController
                // $file->move(public_path('estimations/items'), $filename);
                // Let's stick to simple store for now or match ProjectController style if preferred.
                // ProjectController used move to public_path. I will do the same for consistency.
                $absolutePath = public_path('estimations/items');
                if (!file_exists($absolutePath)) {
                    mkdir($absolutePath, 0755, true);
                }
                $file->move($absolutePath, $filename);
                $filePath = 'estimations/items/' . $filename;
            } else {
                $filePath = null; // Or keep existing if updating? 
                // If updating and no new file, we should probably keep old one. 
                // But simplified for now: if no file sent, don't update file_path unless explicitly cleared?
                // The updateOrCreate will overwrite if we pass null. 
                // Better logic:
            }
            
            $data = [
                'estimation_id' => $request->estimation_id,
                'category' => $request->category,
                'item_name' => $request->item_name,
                'quantity' => $request->quantity,
                'unit_cost' => $request->unit_cost,
                'total_cost' => $totalCost,
                'phase' => $request->phase,
            ];

            if (isset($filePath)) {
                $data['file_path'] = $filePath;
            }

            $item = EstimationItem::updateOrCreate(
                ['id' => $request->id], 
                $data
            );

            // Update parent estimation total
            $this->updateEstimationTotal($request->estimation_id);

            return response()->json(['success' => true, 'item' => $item, 'message' => 'Item saved successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function deleteEstimationItem($id)
    {
        try {
            $item = EstimationItem::findOrFail($id);
            $estimationId = $item->estimation_id;
            $item->delete();

            $this->updateEstimationTotal($estimationId);

            return response()->json(['success' => true, 'message' => 'Item deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    private function updateEstimationTotal($estimationId)
    {
        $total = EstimationItem::where('estimation_id', $estimationId)->sum('total_cost');
        ProjectEstimation::where('id', $estimationId)->update(['total_amount' => $total]);
    }

    // ================= DONORS =================
    public function storeDonor(Request $request)
    {
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'name' => 'required|string',
            'amount' => 'required|numeric|min:0',
        ]);

        try {
            $donor = ProjectDonor::updateOrCreate(
                ['id' => $request->id],
                [
                    'project_id' => $request->project_id,
                    'name' => $request->name,
                    'amount' => $request->amount,
                    'show_on_leaderboard' => $request->show_on_leaderboard ?? true,
                ]
            );

            return response()->json(['success' => true, 'donor' => $donor]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function deleteDonor($id)
    {
        try {
            ProjectDonor::destroy($id);
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    // ================= FUNDING RECEIVED =================
    public function storeFunding(Request $request)
    {
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'amount' => 'required|numeric|min:0',
            'sanction_amount' => 'nullable|numeric|min:0',
            'source_type' => 'required|string', // Donor Name / Source
            'received_date' => 'required|date',
        ]);

        try {
            $funding = ProjectFunding::updateOrCreate(
                ['id' => $request->id],
                [
                    'project_id' => $request->project_id,
                    'source_type' => $request->source_type,
                    'sanction_amount' => $request->sanction_amount ?? 0,
                    'amount' => $request->amount,
                    'received_date' => $request->received_date,
                    'notes' => $request->notes,
                ]
            );

            return response()->json(['success' => true, 'funding' => $funding]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function deleteFunding($id)
    {
        try {
            ProjectFunding::destroy($id);
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    // ================= UTILIZATION =================
    public function importFromEstimation(Request $request)
    {
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'estimation_id' => 'required|exists:project_estimations,id',
        ]);

        try {
            $estimationItems = EstimationItem::where('estimation_id', $request->estimation_id)->get();
            $count = 0;
            $importedItems = [];

            // Group estimation items by signature (category + item_name + phase)
            $groupedEstimation = $estimationItems->groupBy(function ($item) {
                return $item->category . '|' . $item->item_name . '|' . $item->phase;
            });

            foreach ($groupedEstimation as $signature => $items) {
                $firstItem = $items->first();
                $estCount = $items->count();

                // Count existing items in utilization with same signature
                $utilCount = ProjectUtilization::where('project_id', $request->project_id)
                    ->where('item_name', $firstItem->item_name)
                    ->where('category', $firstItem->category)
                    ->where('phase', $firstItem->phase)
                    ->count();

                // Calculate how many we need to import
                $toImport = max(0, $estCount - $utilCount);

                for ($i = 0; $i < $toImport; $i++) {
                    // Use item details from one of the estimation items
                    $sourceItem = $items[$i] ?? $firstItem; 
                    
                    $newItem = ProjectUtilization::create([
                        'project_id' => $request->project_id,
                        'category' => $sourceItem->category,
                        'item_name' => $sourceItem->item_name,
                        'estimated_amount' => $sourceItem->total_cost,
                        'actual_amount' => 0, 
                        'phase' => $sourceItem->phase,
                    ]);
                    $importedItems[] = $newItem;
                    $count++;
                }
            }

            return response()->json([
                'success' => true, 
                'message' => "Imported {$count} items successfully",
                'items' => $importedItems
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function storeUtilization(Request $request)
    {
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'item_name' => 'required|string',
            'actual_amount' => 'required|numeric|min:0',
        ]);

        try {
            // Handle File Upload
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $filename = time() . '_' . $file->getClientOriginalName();
                $absolutePath = public_path('projects/utilizations');
                if (!file_exists($absolutePath)) {
                    mkdir($absolutePath, 0755, true);
                }
                $file->move($absolutePath, $filename);
                $filePath = 'projects/utilizations/' . $filename;
            }

            $data = [
                'project_id' => $request->project_id,
                'category' => $request->category,
                'item_name' => $request->item_name,
                'estimated_amount' => $request->estimated_amount ?? 0,
                'actual_amount' => $request->actual_amount,
                'phase' => $request->phase,
            ];

            if (isset($filePath)) {
                $data['file_path'] = $filePath;
            }

            $utilization = ProjectUtilization::updateOrCreate(
                ['id' => $request->id],
                $data
            );

            return response()->json(['success' => true, 'utilization' => $utilization]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function deleteUtilization($id)
    {
        try {
            ProjectUtilization::destroy($id);
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
