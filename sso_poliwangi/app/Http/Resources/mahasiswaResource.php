<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class mahasiswaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'nim' => $this->nim,
            'nama_mahasiswa' => $this->nama_mahasiswa,
            'foto_mahasiswa' => "http://127.0.0.1:8000/storage/" . $this->foto_mahasiswa,
            'password' => $this->password,
            'prodi' => new prodiResource($this->prodi),   
        ];
    }
}
