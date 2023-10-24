<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Moduls;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function GetMembers()
    {
        $data_member = User::all()->count();
        return response()->json($data_member, 200);
    }
    public function AllKelas()
    {
        $data_kelas = Classes::all()->count();
        return response()->json($data_kelas, 200);
    }
    public function AllModul()
    {
        $data_modul = Moduls::all()->count();
        return response()->json($data_modul, 200);
    }
}
