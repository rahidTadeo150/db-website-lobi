<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\mahasiswa;

class mahasiswaController extends Controller
{
    public function getAllData()
    {
        return mahasiswa::all();
    }
}
