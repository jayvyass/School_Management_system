<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SignupController extends Controller {
    public function view() {
        return view('admin.sign-up');
    }

    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6'],
        ]);
        
    if ($validator->fails()) {
        return redirect()->route('signup')
            ->withErrors($validator)
            ->withInput();
     } 
    // Create user
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]); 

        return redirect()->route('signin')->with('success', 'You have been successfully registered! You can now login.');
    }

}
