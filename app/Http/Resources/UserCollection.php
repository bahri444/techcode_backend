<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UserCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'user_id' => $this->user_id,
            'nama_lengkap' => $this->nama_lengkap,
            'email' => $this->email,
            'password' => $this->password,
            'role' => $this->role,
            'tanggal_lahir' => $this->tanggal_lahir,
            'jenis_kelamin' => $this->jenis_kelamin,
            'alamat' => $this->alamat,
            'foto' => $this->foto,
            'github' => $this->github,
            'status_anggota' => $this->status_anggota,
            'angkatan' => $this->angkatan,
        ];
    }
}
