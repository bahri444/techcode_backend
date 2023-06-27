<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PhpParser\Builder\Class_;

class ClassesController extends Controller
{
    public function GetAllClass()
    {
        $data_class = Classes::with('joinToProfession')->get();
        return response()->json($data_class);
    }
    public function GetClassByUuid($uuid)
    {
        $findClass = Classes::findOrFail($uuid);
        $findClass->class_uuid = $uuid;
        return response()->json([
            'data_class_byuuid' => $findClass,
        ]);
    }
    public function AddClass(Request $request)
    {
        Validator::make($request->all(), [
            'profession_uuid' => 'required',
            'class_name' => 'required',
            'price_class' => 'required',
            'class_duration' => 'required',
            'start' => 'required',
            'end' => 'required',
        ]);
        try {
            $data_add_class = new Classes([
                'profession_uuid' => $request->profession_uuid,
                'class_name' => $request->class_name,
                'price_class' => $request->price_class,
                'class_duration' => $request->class_duration,
                'start' => $request->start,
                'end' => $request->end,
            ]);
            $data_add_class->save();
            return response()->json([
                'success' => 'data berhasil di tambahkan',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'errors' => 'data gagal di tambahkan',
                'exception' => $e
            ]);
        }
    }
    public function UpdateClass(Request $request, $uuid)
    {
        Validator::make($request->all(), [
            'profession_uuid' => 'required',
            'class_name' => 'required',
            'price_class' => 'required',
            'class_duration' => 'required',
            'start' => 'required',
            'end' => 'required',
        ]);
        try {
            $update_data = Classes::find($uuid);
            $update_data->profession_uuid = $request->profession_uuid;
            $update_data->class_name = $request->class_name;
            $update_data->price_class = $request->price_class;
            $update_data->class_duration = $request->class_duration;
            $update_data->start = $request->start;
            $update_data->end = $request->end;
            $update_data->save();
            return response()->json([
                'success' => 'data berhasil di update'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'errors' => 'data gagal di update',
                'exception' => $e
            ]);
        }
    }
    public function DeleteClass($uuid)
    {
        try {
            $delete_data = Classes::find($uuid);
            $delete_data->delete();
            return response()->json([
                'success' => 'data berhasil di hapus',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => 'data gagal di hapus',
                'exception' => $e
            ], 500);
        }
    }
}
