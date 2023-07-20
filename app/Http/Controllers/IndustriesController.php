<?php

namespace App\Http\Controllers;

use App\Models\Actifity;
use App\Models\Industries;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class IndustriesController extends Controller
{
    public function GetAllIndustries()
    {
        $industries = Industries::all();
        return response()->json($industries);
    }
    public function GetIndustriesByUuid($uuid)
    {
        $data = Industries::findOrFail($uuid);
        return response()->json($data);
    }
    public function AddIndustries(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'industry_name' => 'required',
            'industy_logo' => 'required|image|mimes:png,svg,jpeg|max:2048',
            'vision' => 'required ',
            'mision' => 'required ',
            'objective' => 'required',
            'social_media' => 'required',
        ]);
        // dd($validator);
        try {
            if (!$validator->fails()) {
                $getLogoFile = $request->file('industy_logo');
                $getLogoName = $getLogoFile->hashName();
                $direktory = "/industries_logo/$getLogoName";
                $request->industy_logo->move(public_path('/industries_logo/'), $getLogoName);
                $data_industry = new Industries([
                    'industry_name' => $request->industry_name,
                    'industy_logo' => $direktory,
                    'vision' => $request->vision,
                    'mision' => $request->mision,
                    'objective' => $request->objective,
                    'social_media' => $request->social_media,
                ]);
                // dd($data_industry);
                $data_industry->save();
                return response()->json(['success' => 'data industry berhasil di simpan'], 200);
            } elseif ($validator->fails()) {
                return response()->json(['not_file' => 'logo tidak boleh kosong']);
            }
        } catch (\Exception $e) {
            return response()->json(['errors' => $e . 'data gagal di tambahkan'], 500);
        }
    }
    public function UpdateIndustries(Request $request, $uuid)
    {
        Validator::make($request->all(), [
            'industry_name' => 'required',
            'industy_logo' => 'required|image|mimes:png,svg,jpg|max:2048',
            'vision' => 'required ',
            'mision' => 'required ',
            'objective' => 'required',
            'social_media' => 'required',
        ]);
        // dd($request);
        try {
            if ($request == true) {
                $industry = Industries::find($uuid);

                // handle file yang du upload
                $getLogoUpload = $request->file('industy_logo');
                $getLogoName = $getLogoUpload->hashName();
                $saveIndirektory = "/industries_logo/$getLogoName";
                $request->industy_logo->move(public_path('/industries_logo/'), $getLogoName);

                // delete file lama
                Storage::delete('/industries_logo/' . basename($industry->industy_logo));

                // update data dengan logo yang baru di upload
                $industry->industry_name = $request->input('industry_name');
                $industry->industy_logo = $saveIndirektory;
                $industry->vision = $request->input('vision');
                $industry->mision = $request->input('mision');
                $industry->objective = $request->input('objective');
                $industry->social_media = $request->input('social_media');
                $industry->save();
                return response()->json([
                    'success' => 'data berhasil di update',
                    'data' => $industry
                ], 200);
            } elseif ($request == false) {
                return response()->json([
                    'errors' => "field tidak boleh kosong",
                ], 400);
            }
        } catch (\Exception $e) {
            return response()->json([
                'errors' => "data gagal di update", $e
            ], 500);
        }
    }
    public function DeleteIndustries($uuid)
    {
        try {
            $industry = Industries::find($uuid);
            $industry->delete();
            return response()->json([
                'errors' => 'data berhasil di hapus'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'errors' => 'data gagal di hapus', $e
            ], 500);
        }
    }
}
