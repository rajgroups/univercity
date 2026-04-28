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
            'phase' => 'required|string',
        ]);

        try {
            // Enforce whole numbers (floor or round? Requirement says "Allow only whole numbers")
            $qty = floor($request->quantity);
            $unitCost = floor($request->unit_cost);
            $totalCost = $qty * $unitCost;

            // Handle File Upload
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $filename = time() . '_' . $file->getClientOriginalName();
                $absolutePath = public_path('estimations/items');
                if (!file_exists($absolutePath)) {
                    mkdir($absolutePath, 0755, true);
                }
                $file->move($absolutePath, $filename);
                $filePath = 'estimations/items/' . $filename;
            }
            
            $data = [
                'estimation_id' => $request->estimation_id,
                'category' => $request->category,
                'item_name' => $request->item_name,
                'quantity' => $qty,
                'unit_cost' => $unitCost,
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
            'amount' => 'required|numeric|min:1',
            'payment_status' => 'required|in:Committed,Partially Received,Received',
            'received_date' => 'required_if:payment_status,Received,Partially Received|nullable|date',
        ]);

        try {
            $donor = ProjectDonor::updateOrCreate(
                ['id' => $request->id],
                [
                    'project_id' => $request->project_id,
                    'name' => $request->name,
                    'amount' => floor($request->amount), // Whole numbers
                    'payment_status' => $request->payment_status,
                    'received_date' => $request->received_date,
                    'show_on_leaderboard' => $request->show_on_leaderboard ?? true,
                ]
            );

            // Update project raised amount
            $this->updateProjectRaisedAmount($request->project_id);

            return response()->json(['success' => true, 'donor' => $donor]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function deleteDonor($id)
    {
        try {
            $donor = ProjectDonor::findOrFail($id);
            $projectId = $donor->project_id;
            $donor->delete();

            $this->updateProjectRaisedAmount($projectId);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    private function updateProjectRaisedAmount($projectId)
    {
        // Amount raised is sum of all donor amounts who have "Received" or "Partially Received" status? 
        // Or all pledged? Requirement says: "Amount Raised = Sum of all donor amounts" 
        // Logic might need to be specific about what "Raised" means. Usually it means actually received.
        // But the requirement says "Amount Raised = Sum of all donor amounts" and "Progress % = (Raised / Target) * 100".
        // Let's sum based on status or all? 
        // Typically Pledged vs Received. Let's sum all donor amounts but differentiate.
        $totalRaised = ProjectDonor::where('project_id', $projectId)
            ->whereIn('payment_status', ['Received', 'Partially Received'])
            ->sum('amount');
        
        Project::where('id', $projectId)->update(['amount_raised' => $totalRaised]);
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
                        'funding_source' => 'CSR', // Default set during import
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
            'funding_source' => 'required|in:CSR,Crowdfunding',
        ]);

        try {
            $actualAmt = floor($request->actual_amount);
            
            // Fund Control Validation
            $available = $this->getAvailableFunds($request->project_id, $request->funding_source);
            
            // When updating, we should exclude the current item's amount from the check or similar logic?
            // Simplified: Current spent from this source + new amount <= total from this source
            $alreadySpent = ProjectUtilization::where('project_id', $request->project_id)
                ->where('funding_source', $request->funding_source)
                ->where('id', '!=', $request->id)
                ->sum('actual_amount');
            
            if (($alreadySpent + $actualAmt) > $available) {
                return response()->json(['success' => false, 'message' => 'Insufficient Funds in ' . $request->funding_source], 422);
            }

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
                'estimated_amount' => $request->estimated_amount ? floor($request->estimated_amount) : 0,
                'actual_amount' => $actualAmt,
                'phase' => $request->phase,
                'funding_source' => $request->funding_source,
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

    private function getAvailableFunds($projectId, $source)
    {
        if ($source === 'Crowdfunding') {
            return ProjectDonor::where('project_id', $projectId)
                ->whereIn('payment_status', ['Received', 'Partially Received'])
                ->sum('amount');
        } else {
            // CSR Funding
            return ProjectFunding::where('project_id', $projectId)
                ->sum('amount');
        }
    }

    public function updateProjectStage(Request $request)
    {
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'stage' => 'required|string',
        ]);

        try {
            Project::where('id', $request->project_id)->update(['stage' => $request->stage]);
            return response()->json(['success' => true, 'message' => 'Project stage updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function toggleCrowdfunding(Request $request)
    {
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'active' => 'required|boolean',
            'target' => 'nullable|numeric|min:0',
        ]);

        try {
            $data = ['crowdfunding_active' => $request->active];
            if ($request->filled('target')) {
                $data['funding_target'] = $request->target;
            }
            Project::where('id', $request->project_id)->update($data);
            return response()->json(['success' => true]);
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
