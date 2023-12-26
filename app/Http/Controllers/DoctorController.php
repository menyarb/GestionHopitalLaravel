<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index()
    {
        // Retrieve only users with the role 'admin'
        $doctor = Doctor::all();
        return $doctor;
    }
    public function store(Request $request)
    {
        // Validate the request data
    $request->validate([
        // Other validation rules...
        'DeptNo' => 'required|integer', // Adjust validation rules accordingly
    ]);
    $doctor = new Doctor([
    'Name' => $request->input('Name'),
    'Phone' => $request->input('Phone'),
    'Address' => $request->input('Address'),
   
    'Gender' => $request->input('Gender'),
    'DeptNo' => $request->input('DeptNo'), 
    'ReputeIndex' => $request->input('ReputeIndex'),
    'Qualification' => $request->input('Qualification'),
    'Specialization' => $request->input('Specialization'),
    'Work_Experience' => $request->input('Work_Experience'),
    'Status' => $request->input('Status'),
    'img' => $request->input('img'),
    
]);
    $doctor->save();
return response()->json('doctor créée !');
}
public function show($id)
{
    // Find the doctor by DoctorID
    $doctor = Doctor::where('DoctorID', $id)->first();

    if (!$doctor) {
        // If doctor is not found, return a 404 response
        return response()->json(['error' => 'Doctor not found'], 404);
    }

    // Return the doctor as JSON
    return response()->json($doctor);
}

public function update(Request $request, $id)
{
    try {
        // Validate the request data
        $request->validate([
            'Name' => 'required|string',
            'Phone' => 'required|string',
            'Address' => 'required|string',
          //  'BirthDate' => 'required|date', // Make sure it's a valid date format
            'Gender' => 'required|string',
            'DeptNo' => 'required|integer', // Assuming it's an integer
            'ReputeIndex' => 'required|string', // Adjust validation rules accordingly
            'Qualification' => 'required|string',
            'Specialization' => 'required|string',
            'Work_Experience' => 'required|integer',
            'Status' => 'required|string',
            'img' => 'required|string',
        ]);

        // Find the doctor by ID
        $doctor = Doctor::where('DoctorID', $id)->firstOrFail();

        // Update the doctor's information
        $doctor->update($request->all());

        return response()->json(['message' => 'Doctor updated successfully', 'doctor' => $doctor], 200);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Failed to update doctor', 'message' => $e->getMessage()], 500);
    }}
    public function destroy($id)
    {
        $doctor = Doctor::find($id);
        $doctor->delete();
return response()->json('doctor supprimé !');
    } 
}
