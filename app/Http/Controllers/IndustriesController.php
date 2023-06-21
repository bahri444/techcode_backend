<?php

namespace App\Http\Controllers;

use App\Models\Industries;
use Illuminate\Http\Request;
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
                $direktory = "/storage/industries_logo/$getLogoName";
                $request->industy_logo->move(public_path('/storage/industries_logo/'), $getLogoName);
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
    }
    public function DeleteIndustries($uuid)
    {
    }
}
