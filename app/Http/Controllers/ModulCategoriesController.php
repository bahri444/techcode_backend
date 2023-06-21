<?php

namespace App\Http\Controllers;

use App\Models\ModulCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ModulCategoriesController extends Controller
{
    public function GetAllModulCategories()
    {
        $data = ModulCategories::all();
        return response()->json($data);
    }
    public function GetModulCategoriesByUuid($uuid)
    {
        $data = ModulCategories::findOrFail($uuid);
        $data->modul_categories_uuid = $uuid;
        return response()->json([
            'title' => 'get one categories moduls',
            'data' => $data
        ]);
    }
    public function AddModulCategories(Request $request)
    {
        // dd($request);
        Validator::make($request->all(), ['categories_name' => 'required']);
        $data = ModulCategories::create([
            'categories_name' => $request->categories_name
        ]);
        return response()->json([
            'data' => $data,
            'success' => 'data berhasil di tambahkan',
        ]);
    }
    public function UpdateModulCategories(Request $request, $uuid)
    {
        Validator::make($request->all(), [
            'categories_name' => 'required',
        ]);
        // dd($request);
        try {
            $data_update = ModulCategories::find($uuid);
            $data_update->categories_name = $request->categories_name;
            $data_update->save();
            return response()->json([
                'data' => 'data berhasil di update'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'errors' => 'data gagal di update',
                'exception' => $e
            ], 500);
        }
    }
    public function DeleteModulCategories($uuid)
    {
        try {
            $data_moduls_category = ModulCategories::find($uuid);
            $data_moduls_category->delete();
            return response()->json([
                'success' => 'data berhasil di hapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'errors' => 'data gagal di hapus',
                'exception' => $e
            ]);
        }
    }
}
