<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function showProfile(Request $request)
    {
        $user = User::select('id', 'name', 'email', 'phone', 'role', 'profile_img_path')
            ->where('id', $request->userID)
            ->first();
        return view('users.profile', compact('user'));
    }
}
