<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AccountContrroller extends Controller
{
    public function index()
    {
        return view('account.index');
    }

    public function update(Request $req)
    {
        $user = auth()->user();

        // Validate fields
        $req->validate([
            'LastName' => 'required|string|max:255',
            'FirstName' => 'required|string|max:255',
            'Username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'Password' => 'nullable|min:6',
            'Profile' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        // Handle profile image
        if ($req->hasFile('Profile')) {

            // OLD FILE PATH
            $oldFile = public_path('Uploads/profile/' . $user->profile);

            // DELETE OLD IMAGE (SAFE CHECK)
            if (!empty($user->profile) && file_exists($oldFile)) {

                // Try unlink, ignore failure if locked
                @unlink($oldFile);
            }

            // CREATE UNIQUE FILENAME
            $filename = time().rand(1000, 9999) . '.' . $req->Profile->extension();

            // MOVE NEW FILE
            $req->Profile->move(public_path('Uploads/profile'), $filename);

            // SAVE NEW FILENAME
            $user->profile = $filename;
        }

        // Update text fields
        $user->lname = $req->LastName;
        $user->fname = $req->FirstName;
        $user->mname = $req->MiddleName;
        $user->username = $req->Username;

        if ($req->Password) {
            $user->password = bcrypt($req->Password);
        }

        $user->save();

        return back()->with('success', 'Account updated successfully!');
    }

}
