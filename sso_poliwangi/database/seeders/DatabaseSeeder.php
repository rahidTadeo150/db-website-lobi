<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\user;
use App\Models\mahasiswa;
use App\Models\prodi;
use App\Models\jurusan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        user::create([
         'nama_client' => 'Lobi Poliwangi',
         'email' => 'lobipoliwangi@gmail.com',
        ]);
    }
}
