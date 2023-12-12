<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        $data['name'] = Auth::user()->name;
        $data['email'] = Auth::user()->email;
        return view('developx.user.profile', compact('data'));
    }

    public function updateprofile(Request $request)
    {
        //Validation
        $request->validate([
            'name' => 'required',
        ]);

        //Update the new name
        User::whereId(auth()->user()->id)->update([
            'name' => $request->name
        ]);

        return back()->with("status", "Name updated successfully!");

    }

    public function updatePassword(Request $request)
    {
        //Validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        //Match The Old Password
        if(!Hash::check($request->old_password, auth()->user()->password)){
            return back()->with("error", "Old Password Doesn't match!");
        }

        //Update the new Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with("status", "Password changed successfully!");
    }
}
