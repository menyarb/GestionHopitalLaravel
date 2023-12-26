<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller

{
    public function index()
    {
        // Retrieve only users with the role 'admin'
        $adminUsers = User::where('role', 'admin')->get();
    
        return $adminUsers;
    }
    public function store(Request $request)
    {
        $input = $request->all();
    
        // Vérifier si l'utilisateur existe déjà
        $existingUser = User::where('email', $input['email'])->first();
    
        if ($existingUser) {
            // L'utilisateur existe déjà, vous pouvez choisir de mettre à jour ou afficher un message d'erreur
            return response()->json(['status' => false, 'message' => 'Un utilisateur avec cet e-mail existe déjà.']);
        }
    
        // Ajouter une clé 'role' avec la valeur 'admin' lors de la création d'un admin
        $input['role'] = 'admin';
    
        // Utiliser la méthode create avec les attributs remplis
        User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'phone' => $input['phone'],
            'address' => $input['address'],
            'birth_date' => $input['birth_date'],
            'password' => Hash::make($input['password']),
            'role' => $input['role'],
        ]);
    
        // Retourner une réponse JSON
        return response()->json([
            'status' => true,
            'message' => "Admin ajouté avec succès",
        ]);
    }
    public function update(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'sometimes|required|string|min:8',
            'phone' =>'required|string',
            'address' =>'required|string',
            'birth_date'=>'required|string',
            // Add any other fields you want to update
        ]);

        // Find the user by ID
        $user = User::find($id);

        // Check if the user exists
        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'User not found',
            ], 404);
        }

        // Update the user information
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        // Check if a new password is provided
        if ($request->has('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        // Add other fields you want to update

        // Save the changes
        $user->save();

        return response()->json([
            'status' => true,
            'message' => 'User updated successfully',
            'data' => $user,
        ]);
    }   


    public function show($id)
    {
            // Find the user by ID
            $user = User::find($id);
return response()->json($user);
    }
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
return response()->json('User supprimé !');
    }  
}


