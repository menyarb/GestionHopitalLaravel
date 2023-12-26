<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {

        $departments = Department::all();
        return $departments;
    }

  

    public function store(Request $request)
    {
        $request->validate([
            'DeptName' => 'required',
            'Description' => 'nullable',
            'img' => 'nullable',
        ]);

        Department::create($request->all());

        return response()->json([
            'status' => true,
            'message' => "Department ajouté avec succès",
        ]);
    }

    public function show($id)
    {
        // Find the user by ID
        $department = Department::find($id);
        return response()->json($department);
    }

    public function update(Request $request, $id)
    {
   
        $department = Department::find($id);
        $department->update($request->all());
        return response()->json('$department MAJ !');
    }

    

    public function destroy($id)
    {
        $department = Department::find($id);
        $department->delete();
return response()->json('department supprimé !');
    }
}
