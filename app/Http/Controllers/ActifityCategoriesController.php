<?php

namespace App\Http\Controllers;

use App\Models\ActifityCategories;
use Illuminate\Http\Request;

class ActifityCategoriesController extends Controller
{
    public function GetAllActifityCategories()
    {
        $dataActifityCategories = ActifityCategories::all();
        return response()->json([
            'title' => 'all categories actifity',
            'data_actifity_categories' => $dataActifityCategories,
        ]);
    }

    public function GetActifityCategoriesByUuid($uuid)
    {
        $data = ActifityCategories::findOrFail($uuid);
        return response()->json([
            'data_actifity_categori' => $data
        ]);
    }

    public function AddActifityCategories(Request $request)
    {
        $data = ActifityCategories::create([
            'actifity_categories_name' => $request->actifity_categories_name
        ]);
        return response()->json([
            'success' => 'berhasil menambahkan data',
            'data' => $data,
        ], 200);
    }

    public function UpdateActifityCategories(Request $request, $uuid)
    {
        try {
            $data = ActifityCategories::find($uuid);
            $data->actifity_categories_name = $request->actifity_categories_name;
            $data->save();
            return response()->json([
                'success' => 'data berhasil di update',
                'data' => $data,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => 'data gagal di update',
            ], 500);
        }
    }

    public function DeleteActifityCategories($uuid)
    {
        try {
            $delete_data = ActifityCategories::find($uuid);
            $delete_data->actifity_categories_uuid = $uuid;
            $delete_data->delete();
            return response()->json([
                'success' => 'data berhasil di hapus',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => 'data berhasil di hapus',
            ], 500);
        }
    }
}
