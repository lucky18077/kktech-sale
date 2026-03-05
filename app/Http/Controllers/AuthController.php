<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
class AuthController extends Controller
{
    /**
     * Show login form
     */
    public function showLogin()
    {
        // check if already logged in via token session
        if (! empty(session('token'))) {
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }

    /**
     * Handle login request
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            session()->flash("error", "Enter email or password");
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        try {
            // Find user by email and password (plain text)
            $user = User::where("email", $request->email)
                        ->where("password", $request->password)
                        ->first();
            if (!empty($user)) {
                // Generate token
                $token = bin2hex(random_bytes(16));
                
                // Update user with token and login info
                $user->update([
                    'token' => $token,
                    'last_ip' => $request->ip(),
                    'last_login' => now(),
                ]);
                
                // Store token and user in session
                session()->put('token', $token);
                session()->put('user', $user);
                
                session()->flash('success', "Login successfully");
                return redirect()->route('dashboard')->with('user', $user);
            } else {
                return redirect()->back()->with('error', "Incorrect Email or Password");
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
    /**
     * Logout user
     */
    public function logout(Request $request)
    {
        // Clear token from database
        $token = session('token');
        if (!empty($token)) {
            User::where('token', $token)->update(['token' => '']);
        }
        // Clear session
        session()->forget(['token', 'user']);
        session()->flush();

        return redirect('/')->with('success', 'Logged out successfully');
    }
}
