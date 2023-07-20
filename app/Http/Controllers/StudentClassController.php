<?php

namespace App\Http\Controllers;

use App\Models\StudentsClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentClassController extends Controller
{
    public function GetAllStudentClass()
    {
        $data = StudentsClass::with('joinToClass', 'joinToUser', 'joinToClassWithModul', 'joinToProfessionWithClass')->get();
        return response()->json($data);
    }
    public function GetStudentClassByUuid($uuid)
    {
        $findUuid = StudentsClass::with('joinToClass', 'joinToUser', 'joinToClassWithModul', 'joinToProfessionWithClass')->findOrFail($uuid);
        $findUuid->student_class_uuid = $uuid;
        return response()->json($findUuid);
    }
    public function AddStudentClass(Request $request)
    {
        Validator::make(
            $request->all(),
            [
                // student_class_uuid	user_uuid	class_uuid	date_checkout_class	payment_state
                'user_uuid' => 'required',
                'class_uuid' => 'required',
                'date_checkout_class' => 'required',
                'payment_state' => 'required',
            ]
        );
        try {
            $data = new StudentsClass([
                // 'student_class_uuid' => $request->student_class_uuid,
                'user_uuid' => $request->user_uuid,
                'class_uuid' => $request->class_uuid,
                'date_checkout_class' => $request->date_checkout_class,
                'payment_state' => $request->payment_state,
            ]);
            return response()->json([
                'success' => 'data berhasil di tambahkan',
                'data' => $data
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'errors' => 'data gagal di tambahkan', $e
            ], 500);
        }
    }
    public function UpdateStudentClass(Request $request, $uuid)
    {
        Validator::make(
            $request->all(),
            [
                'user_uuid' => 'required',
                'class_uuid' => 'required',
                'date_checkout_class' => 'required',
                'payment_state' => 'required',
            ]
        );
        try {
            $data = StudentsClass::find($uuid);
            $data->user_uuid = $request->input('user_uuid');
            $data->class_uuid = $request->input('class_uuid');
            $data->date_checkout_class = $request->input('date_checkout_class');
            $data->payment_state = $request->input('payment_state');
            $data->save();
            return response()->json([
                'success' => 'data berhasil di update',
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'errors' => 'data gagal di update',
                $data
            ]);
        }
    }
    public function DeleteStudentClass($uuid)
    {
        try {
            $dataByUuid = StudentsClass::find($uuid);
            $dataByUuid->delete();
            return response()->json([
                'success' => 'data berhasil di hapus',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => 'data gagal di hapus',
                $e
            ]);
        }
    }
}
