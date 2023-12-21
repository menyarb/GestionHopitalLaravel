<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller

{
    public function index()
    {
    $user = User::all();
    return $user;
    }
    public function store(Request $request)
    {
       $input = $request->all();

       User::create([
        'name' => $input['name'],
        'email' => $input['email'],
        'password' => Hash::make($input['password'])
      ]);

          return response()->json(['status' => true,
                                    'message' => "Add Admin"   
        
        ]);
    }
    
}
