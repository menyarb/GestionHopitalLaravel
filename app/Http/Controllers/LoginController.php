<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Hash;
class LoginController extends Controller
{
    public function check(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $role = $user->role; // Récupère le rôle de l'utilisateur depuis la base de données

            return response()->json([
                'status' => true,
                'message' => "Success",
                'role' => $role,
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => "Fail",
        ]);
    }
}