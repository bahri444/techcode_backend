<?php

namespace App\Http\Controllers;

use App\Models\StudentsClass;
use Illuminate\Http\Request;

class StudentClassController extends Controller
{
    public function GetAllStudentClass()
    {
        $data = StudentsClass::with('joinToClass', 'joinToUser', 'joinToClassWithModul', 'joinToProfessionWithClass')->get();
        return response()->json([
            "data_transaction_class" => $data
        ]);
    }
    public function GetStudentClassByUuid($uuid)
    {
    }
    public function AddStudentClass(Request $request)
    {
    }
    public function UpdateStudentClass(Request $request, $uuid)
    {
    }
    public function DeleteStudentClass($uuid)
    {
    }
}
