<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Moduls;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function CountData()
    {
        $data_modul = Moduls::all()->count();
        $data_kelas = Classes::all()->count();
        $data_member = User::all()->count();
        return response()->json(
            [
                "data_member" => $data_member,
                "data_kelas" => $data_kelas,
                "data_modul" => $data_modul
            ],
            200
        );
    }
}
