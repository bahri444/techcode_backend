<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function GetAllUser()
    {
        $data = User::all();
        return response()->json($data);
    }

    public function GetByUuid($uuid)
    {
        $findByUuid = User::findOrFail($uuid); //cari data berdasarkan uuid yang di cari
        $findByUuid->user_uuid = $uuid; //jika data yang di cari telah di temukan maka tampilkan dengan res json
        return response()->json($findByUuid);
    }

    public function UpdateProfileMemeber(Request $request, $uuid)
    {
        Validator::make($request->all(), [
            /*user_uuid
            nama_lengkap
            email
            email_verified_at
            password
            role
            tanggal_lahir
            jenis_kelamin
            alamat
            foto
            github
            jenis_anggota
            status_anggota
            angkatan
            remember_token
            */
            'nama_lengkap' => 'required',
            'email' => 'required',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'github' => 'required',
        ]);
        try {
            $data = User::find($uuid);
            $data->nama_lengkap = $request->nama_lengkap;
            $data->email = $request->email;
            $data->tanggal_lahir = $request->tanggal_lahir;
            $data->jenis_kelamin = $request->jenis_kelamin;
            $data->alamat = $request->alamat;
            $data->github = $request->github;
            $data->save();
            return response()->json([
                'success' => 'data berhasil di update',
                'data' => $data,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'errors' => 'data gagal di update', $e
            ], 500);
        }
    }

    public function UpdateFotoProfile(Request $request, $uuid)
    {
        Validator::make($request->all(), [
            'foto' => 'required|image|mimes:png,jpg,svg|max:1024'
        ]);
        try {
            $data = User::find($uuid);
            $getFotoUpload = $request->file('foto');
            $getFotoName = $getFotoUpload->hashName();
            $direktoryFoto = "/foto_profile/$getFotoName";
            $request->foto->move(public_path('/foto_profile/'), $getFotoName);
            $data->foto = $direktoryFoto;
            $data->save();
            return response()->json([
                'success' => 'foto berhasil di update',
                'data' => $data
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'errors' => 'foto gagal di update', $e
            ], 500);
        }
    }

    public function UpdateRoleMember(Request $request, $uuid)
    {
        Validator::make($request->all(), [
            'role' => 'required',
            'jenis_anggota' => 'required',
            'status_anggota' => 'required',
            'angkatan' => 'required',
        ]);
        try {
            $data = User::find($uuid);
            $data->role = $request->role;
            $data->jenis_anggota = $request->jenis_anggota;
            $data->status_anggota = $request->status_anggota;
            $data->angkatan = $request->angkatan;
            $data->save();
            return response()->json([
                'success' => 'data berhasil di update',
                'data' => $data
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'errors' => 'data gagal di update', $e
            ], 500);
        }
    }
    public function AddUser(Request $request){
        if($request->foto){

            $Validator=Validator::make($request->all(),[
            "nim"=>"required",
            "nama_lengkap"=>"required",
            "email"=>"required",
            "jenis_kelamin"=>"required",
            "alamat"=>"required",
            "foto"=>"required",
            "jenis_anggota"=>"required",
            "status_anggota"=>"required",
            "angkatan"=>"required",
            "prodi"=>"required"
            ]);
            try{
                if(!$Validator->fails()){
                    $getFoto = $request->file('foto');
                    $getFotoName = $getFoto->hashName();
                    $directory = "/foto_member/$getFotoName";
                    $request->foto->move(public_path('/foto_member/'),$getFotoName);
                    $data_member = new User([
                        'nim'=>$request->nim,
                        'nama_lengkap'=>$request->nama_lengkap,
                        'email'=>$request->email,
                        'tanggal_lahir'=>$request->tanggal_lahir,
                        'jenis_kelamin'=>$request->jenis_kelamin,
                        'alamat'=>$request->alamat,
                        'foto'=>$directory,
                        'jenis_anggota'=>$request->jenis_anggota,
                        'status_anggota'=>$request->status_anggota,
                        'angkatan'=>$request->angkatan,
                        'prodi'=>$request->prodi
                    ]);
                    dd($data_member);
                    $data_member->save();
                    return response()->json(['success'=>'Data berhasil disimpan'],200);
                }elseif($Validator->fails()){
                    return response()->json(['not_file'=>'foto tidak boleh kosong']);
    
                }
            }catch(\Exception $e){
                return response()->json(['errors'=>$e.'Data gagal ditambahkan'],500);
            }
        }else{
            $Validator=Validator::make($request->all(),[
            "nim"=>"required",
            "nama_lengkap"=>"required",
            "email"=>"required",
            "jenis_kelamin"=>"required",
            "alamat"=>"required",
            "jenis_anggota"=>"required",
            "status_anggota"=>"required",
            "angkatan"=>"required",
            "prodi"=>"required"
            ]);
            try{
                
                    $data_member = new User([
                        'nim'=>$request->nim,
                        'nama_lengkap'=>$request->nama_lengkap,
                        'email'=>$request->email,
                        'tanggal_lahir'=>$request->tanggal_lahir,
                        'jenis_kelamin'=>$request->jenis_kelamin,
                        'alamat'=>$request->alamat,
                        'jenis_anggota'=>$request->jenis_anggota,
                        'status_anggota'=>$request->status_anggota,
                        'angkatan'=>$request->angkatan,
                        'prodi'=>$request->prodi
                    ]);
                    // dd($data_member);
                    $data_member->save();
                    return response()->json(['success'=>'Data berhasil disimpan'],200);
            }catch(\Exception $e){
                return response()->json(['errors'=>$e.'Data gagal disimpan'],500);
            }

        }
    }
}
