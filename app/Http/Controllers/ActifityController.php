<?php

namespace App\Http\Controllers;

use App\Models\Actifity;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ActifityController extends Controller
{
    public function GetAllActifity()
    {
        $data_actifity = Actifity::all();
        return response()->json([
            'data_actifity' => $data_actifity,
        ]);
    }

    public function GetActifityByUuid($uuid)
    {
        $data_actifity = Actifity::findOrFail($uuid);
        $data_actifity->actifity_id = $uuid;
        return response()->json([
            'data_actifity' => $data_actifity,
        ]);
    }

    public function AddActifity(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'actifity_categories_uuid' => 'required',
            'actifity_name' => 'required',
            'actifity_foto' => 'required|mimes:jpg,png,svg|max:2048',
            'description' => 'required',
            'place_actifity' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'actifity_status' => 'required',
        ]);
        try {
            if (!$validator->fails()) {
                $getFile = $request->file('actifity_foto'); //ambil file yang di upload dari gambar
                $getFileName = $getFile->hashName(); //hash nama file yang di upload
                Storage::putFileAs('foto_kegiatan', $request->actifity_foto, $getFileName); //simpan file yang telah rename ke dalam storage
            } elseif ($request->fails()) {
                return response()->json([
                    'not_file' => 'gambar tidak boleh kosong',
                ]);
            }
            $dataActifity = new Actifity([
                'actifity_categories_uuid' => $request->actifity_categories_uuid,
                'actifity_name' => $request->actifity_name,
                'actifity_foto' => $getFileName,
                'description' => $request->description,
                'place_actifity' => $request->place_actifity,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'actifity_status' => $request->actifity_status,
            ]);
            // dd($dataActifity);
            $dataActifity->save();

            return response()->json([
                'success' => 'data berhasil di tambahkan',
                'data' => $dataActifity
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'errors' => 'data gagal di tambahkan',
            ], 500);
        }
    }

    public function UpdateActifityByUuid(Request $request, $uuid)
    {
        Validator::make($request->all(), [
            'actifity_categories_uuid' => 'required',
            'actifity_name' => 'required',
            'actifity_foto' => 'required|mimes:jpg,png,svg|max:2048',
            'description' => 'required',
            'place_actifity' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'actifity_status' => 'required',
        ]);
        try {
            if ($request == true) {
                // find data update by uuid
                $actifity = Actifity::find($uuid);
                $getFileUpload = $request->file('actifity_foto');
                $getFileNameUpdate = $getFileUpload->hashName();
                Storage::putFileAs('foto_kegiatan', $request->actifity_foto, $getFileNameUpdate);

                //delete image yang lama
                Storage::delete('actifity_foto/' . basename($actifity->actifity_foto));

                // update data dengan foto yang baru
                $actifity->actifity_categories_uuid = $request->input('actifity_categories_uuid');
                $actifity->actifity_name = $request->input('actifity_name');
                $actifity->actifity_foto = $getFileNameUpdate;
                $actifity->description = $request->input('description');
                $actifity->place_actifity = $request->input('place_actifity');
                $actifity->start_date = $request->input('start_date');
                $actifity->end_date = $request->input('end_date');
                $actifity->actifity_status = $request->input('actifity_status');
                $actifity->save();
                return response()->json([
                    'success' => 'data berhasil di update',
                    'data' => $actifity
                ], 200);
            } elseif ($request == false) {
                return response()->json([
                    'required' => 'field tidak boleh ada yang kosong',
                ], 400);
            }
        } catch (\Exception $e) {
            return response()->json([
                'errors' => 'data gagal di update',
            ], 500);
        }
    }

    public function DeleteActifityByUuid($uuid)
    {
        try {
            $data_actifity = Actifity::find($uuid);
            // $data_actifity->actifity_uuid = $uuid;
            $data_actifity->delete();
            return response()->json([
                'success' => 'data berhasil di hapus',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'errors' => 'data gagal di update'
            ], 500);
        }
    }
}
