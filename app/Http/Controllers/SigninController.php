<?php


namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
class SigninController extends Controller
{
    public function view() {
        return view('admin.signin');
    }

    public function login(Request $request){
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            // Authentication successful
            $user = Auth::user();

            $role = $user->roles;
            
            if ($role === 'admin' || $role === 'teacher') {
                // Generate token for authenticated user
                $token = $user->createToken('authToken')->plainTextToken;

                if ($role === 'admin') {
                    $message = "Welcome, Admin " . $user->name . "!";
                    return redirect()->route('dashboard')->with('success', $message);
                } elseif ($role === 'teacher') {
                    $message = "Welcome, Teacher " . $user->name . "!";
                    return redirect()->route('results')->with('success', $message);
                }
            } else {
                return redirect()->route('signin')->with('custom_error', 'Unauthorized access');
            }
        }
        
        return redirect()->route('signin')->with('error', 'Invalid credentials')->withInput($request->only('email'));
    }
    
       

    public function logout(Request $request) {
        $user = $request->user();
        $user->tokens()->delete();
        return redirect()->route('signin')->with('success', 'Logged out successfully');
    }
   
}
