<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;

class GoogleauthController extends Controller
{
    public function redirect() {
        return Socialite::driver('google')->redirect();
    }

    public function callback() {
        $googleUser = Socialite::driver('google')->user();
    
        // Check if the user already exists in the database
        $user = User::where('email', $googleUser->email)->first();
    
        if ($user) {
            // User already exists, log them in
            Auth::login($user);
            $token = $user->createToken('authToken')->plainTextToken;
            if($user->roles==='admin'){
            $message = "Welcome, Admin " . $user->name . "!";
            return redirect()->route('dashboard')->with('success', $message);
            }elseif($user->roles==='teacher'){
                $message = "Welcome, Teacher " . $user->name . "!";
                return redirect()->route('results')->with('success', $message);
            }else {
                return redirect()->route('signin')->with('custom_error', 'Unauthorized Access to this page.');
            } 
        
        }else {
            // User does not exist, create a new user record
            $newUser = User::create([
                'name' => $googleUser->name,
                'email' => $googleUser->email,
               
            ]);
            $token = $newUser->createToken('authToken')->plainTextToken;
            // Log in the newly created user
            Auth::login($newUser);
            return redirect()->route('signin')->with('success', 'Your account has been created.');
        }
    }
}
