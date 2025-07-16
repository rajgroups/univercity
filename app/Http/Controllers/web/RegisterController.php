<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;


class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('web.index');
    }

    public function register(Request $request)
    {

        try {
            DB::beginTransaction();

            $validator = Validator::make($request->all(), [
                'name'          => 'required|string|max:255',
                'email'         => 'required|email|max:255|unique:users',
                'son_of'        => 'required|string|max:255',
                'door_no'       => 'required|string|max:50',
                'dob'           => 'required|date',
                'blood'         => 'required|string|max:10',
                'street'        => 'required|string|max:255',
                'qualification' => 'required|string|max:255',
                'id_proof'      => 'required|file|mimes:jpeg,png,pdf|max:2048',
                'screen_short'  => 'required|file|mimes:jpeg,png|max:2048',
            ]);

            if ($validator->fails()) {
                Log::error('Registration failed:', ['error' => $validator->errors()]);
                return redirect()->back()->withErrors($validator)->withInput();
            }
            // dd($request);
        if ($request->hasFile('id_proof')) {
            $idProofFile = $request->file('id_proof');
            $idProofName = Str::uuid() . '.' . $idProofFile->getClientOriginalExtension();
            $idProofFile->move(public_path('uploads/id_proofs'), $idProofName);
        }

        if ($request->hasFile('screen_short')) {
            $screenshotFile = $request->file('screen_short');
            $screenshotName = Str::uuid() . '.' . $screenshotFile->getClientOriginalExtension();
            $screenshotFile->move(public_path('uploads/screenshots'), $screenshotName);
        }
            User::create([
                'name'                  => $request->name,
                'email'                 => $request->email,
                'son_of'                => $request->son_of,
                'door_no'               => $request->door_no,
                'dob'                   => $request->dob,
                'blood_group'           => $request->blood,
                'street'                => $request->street,
                'qualification'         => $request->qualification,
                'id_proof'              => $idProofName ?? null,
                'payment_screenshot'    => $screenshotName ?? null,
            ]);

            DB::commit();
            return back()->with('success', 'Registration successful!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Registration failed:', ['error' => $e->getMessage()]);
            return back()->with('error', 'Something went wrong! Please try again.');
        }
    }
}
