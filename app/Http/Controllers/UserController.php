<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    // Show list + form (create mode when no $uEdit)
    public function index()
    {
        if (auth()->user()->role === 'Administrator') {
            // Show all users
            $users = User::orderBy('lname')->get();
        } else {
            // Show only Principal and Teacher
            $users = User::whereIn('role', ['Principal', 'Teacher'])
                        ->orderBy('lname')
                        ->get();
        }

        $uEdit = null; // create mode

        return view('users.ulist', compact('users', 'uEdit'));
    }

    // Edit form
    public function edit($id)
    {
        $users = User::whereIn('role', ['Principal', 'Teacher'])
                     ->orderBy('lname')
                     ->get();

        $uEdit = User::findOrFail($id);

        return view('users.ulist', compact('users', 'uEdit'));
    }

    // Handle both Create & Update from the same form
    public function save(Request $request)
    {
        $isUpdate = $request->filled('id');
        $userId   = $request->input('id');

        $rules = [
            'FirstName'  => 'required|string|max:255',
            'MiddleName' => 'required|string|max:255',
            'LastName'   => 'required|string|max:255',
            'Username'   => 'required|string|max:255|unique:users,username' . ($isUpdate ? ','.$userId : ''),
            'Role'       => 'required|in:Administrator,Principal,Teacher',
        ];

        // Password required only on create
        if (!$isUpdate) {
            $rules['Password'] = 'required|min:6';
        } else {
            $rules['Password'] = 'nullable|min:6';
        }

        $validator = Validator::make($request->all(), $rules, [
            'Role.in' => 'Please select a valid role.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                             ->withErrors($validator)
                             ->withInput();
        }

        if ($isUpdate) {
            $user = User::findOrFail($userId);
            $successMessage = 'User updated successfully!';
        } else {
            $user = new User();
            $successMessage = 'User created successfully!';
        }

        // Save data (force uppercase for names – matches your JS oninput)
        $user->fname    = strtoupper($request->FirstName);
        $user->mname    = strtoupper($request->MiddleName);
        $user->lname    = strtoupper($request->LastName);
        $user->username = $request->Username;
        $user->role     = $request->Role;

        // Only update password if provided
        if ($request->filled('Password')) {
            $user->password = Hash::make($request->Password);
        }

        $user->save();

        return redirect()->route('users.index')
                         ->with('success', $successMessage);
    }

    // Delete (AJAX)
    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json([
            'status'  => 200,
            'message' => 'User deleted successfully',
            'uid'     => $id
        ]);
    }

    public function toggleStatus($id)
    {
        $user = User::findOrFail($id);

        // Toggle status: 1 = Active, 0 = Inactive
        $user->status = $user->status == 1 ? 0 : 1;
        $user->save();

        // Return JSON response
        return response()->json(['status' => $user->status]);
    }
}