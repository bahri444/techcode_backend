<?php

namespace App\Http\Controllers;

use App\Models\Moduls;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ModulsController extends Controller
{

    public function GetAllModuls()
    {
        $data_all_moduls = Moduls::with('joinToModulCategories', 'joinToClass')->get();
        return response()->json($data_all_moduls);
    }
    public function GetModulsByUuid($uuid)
    {
        $find_data_modul = Moduls::findOrFail($uuid);
        $find_data_modul->modul_uuid = $uuid;
        return response()->json($find_data_modul, 200);
    }
    public function AddModuls(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'modul_categories_uuid' => 'required',
            'class_uuid' => 'required',
            'modul_title' => 'required',
            'modul_files' => 'required|file|mimes:pdf',
            'modul_to' => 'required',
            'learn_state' => 'required',
        ]);
        try {
            if (!$validator->fails()) {
                $getFileModul = $request->file('modul_files');
                $fileNameHash = $getFileModul->hashName();
                $fileSaveInStorage = "/storage/moduls/$fileNameHash";
                $request->modul_files->move(public_path('/storage/moduls'), $fileNameHash);
            } elseif (!$validator->fails()) {
                return response()->json([
                    'errors' => 'field tidak boleh ada yang kosong',
                ]);
            }
            $data_add = new Moduls([
                'modul_categories_uuid' => $request->modul_categories_uuid,
                'class_uuid' => $request->class_uuid,
                'modul_title' => $request->modul_title,
                'modul_files' => $fileSaveInStorage,
                'modul_to' => $request->modul_to,
                'learn_state' => $request->learn_state,
            ]);
            $data_add->save();
            return response()->json([
                'data' => $data_add,
                'success' => 'data berhasil di tambahkan'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'errors' => 'data gagal di tambahkan',
            ], 500);
        }
    }
    public function UpdateModuls(Request $request, $uuid)
    {
        $validator = Validator::make($request->all(), [
            'modul_categories_uuid' => 'required',
            'class_uuid' => 'required',
            'modul_title' => 'required',
            'modul_files' => 'required|file|mimes:pfd',
            'modul_to' => 'required',
            'learn_state' => 'required',
        ]);
        // dd($validator);
        try {
            if ($request == true) {
                $update_modul_uuid = Moduls::find($uuid);
                $getFile = $request->file('modul_files');
                $fileNameHash = $getFile->hashName();
                $fileSaveInStorage = "/storage/moduls/$fileNameHash";
                $request->modul_files->move(public_path('/storage/moduls'), $fileNameHash);

                $update_modul_uuid->modul_categories_uuid = $request->input('modul_categories_uuid');
                $update_modul_uuid->class_uuid = $request->input('class_uuid');
                $update_modul_uuid->modul_title = $request->input('modul_title');
                $update_modul_uuid->modul_files = $fileSaveInStorage;
                $update_modul_uuid->modul_to = $request->input('modul_to');
                $update_modul_uuid->learn_state = $request->input('learn_state');
                $update_modul_uuid->save();
                return response()->json([
                    'success' => 'data berhasil di update'
                ]);
            } elseif ($request == false) {
                return response()->json([
                    'errors' => 'filed tidak boleh ada yang kosong',
                ], 400);
            }
        } catch (\Exception $e) {
            return response()->json([
                'errors' => 'data gagal di update',
                'exception' => $e
            ]);
        }
    }
    public function DeleteModuls($uuid)
    {
        try {
            $delete_data = Moduls::find($uuid);
            $delete_data->delete();
            return response()->json([
                'success' => 'data berhasil di hapus',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'errors' => 'data gagal di hapus',
                'exception' => $e
            ]);
        }
    }
}
