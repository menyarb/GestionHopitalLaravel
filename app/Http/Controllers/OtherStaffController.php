<?php

namespace App\Http\Controllers;
use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Models\User;;
use App\Models\Staff;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\DB;

class OtherStaffController extends Controller
{
    
   public function index()
   {
       //$staff = Staff::all();
       /*$staff = Staff::orderBy('staff.created_at', 'DESC')
        ->join('users', 'users.id = staff.UserId', 'LEFT')
        ->select('staff.*, users.name')
        ->get();*/
        $users = DB::table('staff')
            ->join('users', 'users.id', '=', 'staff.UserId')
            ->select('staff.*', 'users.name', 'users.email')
            ->get();
       echo '<pre>';
       die(var_dump($users));

       //return view('staff.index', ['staff' => $staff]);
   }


  
   public function store(Request $request)
   {


       $input = $request->all();
 // Ajouter une clé 'role' avec la valeur 'admin' lors de la création d'un admin
 $input['role'] = 'secretary';
  // Retrieve the DoctorID based on the Name
  
  $doctor = DB::table('doctors')->where('DoctorID', $input['DoctorID'])->first();
  echo 'Doctor DoctorID: ' . $doctor->Name;

    


// $lastId now contains the last inserted ID

       $lastId = DB::table('users')->insertGetId( 
        [
            'name' => $input['name'],
            'email' => $input['email'],
            'phone' => $input['phone'],
            'address' => $input['address'],
            'password' => Hash::make($input['password']),
            'role' => $input['role'],
        ] );
        if ($lastId === false) {
            // Il y a une erreur SQL
            die(DB::table('users')->get()->toSql());
        }
       if ($lastId && $doctor ) {
        $data=array(
            'Designation'=>$input['Designation'],
            "Highest_Qualification"=>$input['Highest_Qualification'],
            "Salary"=>$input['Salary'],
            "DoctorID"=>$doctor->DoctorID,
            "UserId"=>$lastId
        );
        DB::table('staff')->insert($data);


   
       // Retourner une réponse JSON
       return response()->json([
           'status' => true,
           'message' => "staf avec lutilisateur ".$input['name']." ajouté avec succès",
       ]);
       }else{
        
        return response()->json(['status' => false, 'message' => 'Un propbleme !!.']);

       }
   
       

   }




}
