<?php

namespace App\Http\Controllers;

use App\Models\Professions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProfessionsController extends Controller
{
    public function GetAllProfession()
    {
        $data_professions = Professions::all();
        return response()->json($data_professions, 200);
    }
    public function GetProfessionByUuid($uuid)
    {
        $find_professions = Professions::findOrFail($uuid);
        $find_professions->profession_uuid = $uuid;
        return response()->json([
            'profession_byuuid' => $find_professions,
        ], 200);
    }
    public function AddProfession(Request $request)
    {
        Validator::make($request->all(), [
            'profession_name' => 'required',
        ]);
        try {
            $add_data_professions = new Professions([
                'profession_name' => $request->profession_name,
            ]);
            $add_data_professions->save();
            return response()->json([
                'success' => 'data_berhasil di tambahkan',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'errors' => 'data gagal di tambahkan',
            ]);
        }
    }
    public function UpdateProfession(Request $request, $uuid)
    {
        Validator::make($request->all(), [
            'profession_name' => 'required',
        ]);
        try {
            $data = Professions::find($uuid);
            $data->profession_name = $request->profession_name;
            $data->save();
            return response()->json([
                'success' => 'data berhasil di update',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'errors' => 'data gagal di update'
            ]);
        }
    }
    public function DeleteProfession($uuid)
    {
        try {
            $data = Professions::find($uuid);
            $data->delete();
            return response()->json([
                'success' => 'data berhasil di hapus',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'errors' => 'data gagal di hapus',
                'exception' => $e,
            ]);
        }
    }
}
