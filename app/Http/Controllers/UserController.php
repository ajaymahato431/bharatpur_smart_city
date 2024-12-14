<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function userRegistration(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'citizenship_no' => 'required|string|max:50|unique:user_details,citizenship_no',
            'citizenship_front_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'citizenship_back_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'address' => 'required|string|max:255',
            'dob' => 'required|date',
            'gender' => 'required|in:male,female,other',
        ]);

        // Save citizenship images to storage
        $frontImagePath = $request->file('citizenship_front_image')->store('citizenship_images', 'public');
        $backImagePath = $request->file('citizenship_back_image')->store('citizenship_images', 'public');

        $password = rand(11111, 99999);

        // Create user record in `users` table
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($password),
        ]);

        // Create user details record in `user_details` table
        UserDetail::create([
            'user_id' => $user->id,
            'citizenship_no' => $request->citizenship_no,
            'citizenship_front_image' => $frontImagePath,
            'citizenship_back_image' => $backImagePath,
            'address' => $request->address,
            'dob' => $request->dob,
            'gender' => $request->gender,
        ]);

        return redirect()->back()->with('success', 'User registered successfully!');
    }
}
