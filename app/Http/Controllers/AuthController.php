<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // For Registration
    public function registration()
    {
        return view('auth.registration');
    }

    public function registrationSubmit(Request $request)
    {
        //return $request;
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|numeric|max_digits:11',
            'role' => 'required|in:creator,learner',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'password' => 'required|string|min:4|confirmed',
            'terms' => 'accepted',
        ]);

        $phone = null;
        if ($request->has('phone')) {
            $phone = $request->phone;
        }
        $image_path = 'images/profile_pictures/default_profile_picture';
        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            $file_name = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/profile_pictures'), $file_name);
            $image_path = 'images/profile_pictures/' . $file_name;
        }
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $phone,
            'role' => $request->role,
            'profile_img_path' => $image_path,
            'password' => Hash::make($request->password),
        ]);
        return redirect()->route('auth.login');
    }

    // For Login
    public function login()
    {
        return view('auth.login');
    }

    public function loginAttempt(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = User::select('id', 'name', 'email', 'profile_img_path', 'role')
                ->where('email', $request->email)
                ->first();

            session(['user_id' => $user->id]);
            session(['user_name' => $user->name]);
            session(['user_email' => $user->email]);
            session(['user_profile_picture' => $user->profile_img_path]);
            session(['user_role' => $user->role]);

            if (session('user_role') == 'Admin') {
                return redirect()->route('#');
            } else {
                return redirect()->route('home');
            }
        } else {
            return redirect()->back()->withErrors(['login_error' => 'Invalid email or Password.']);
        }
    }

    public function logout()
    {
        session()->flush();
        return redirect()->route('home');
    }
}
