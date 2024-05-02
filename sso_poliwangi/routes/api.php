<?php

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\AuthAPI\oauthApiController;
use App\Http\Resources\mahasiswaResource;
use App\Http\Resources\prodiResource;
use App\Models\mahasiswa;
use App\Models\prodi;
use App\Models\jurusan;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::get('/user', function (Request $request) {
    return mahasiswa::all();
})->middleware('auth:api');

Route::post('/logoutme', [oauthApiController::class, 'logoutme'])->middleware('auth:api');

Route::post('/tambah-mahasiswa', function (Request $request) {
    $validateData = $request->validate([
        'nim' => ['required', 'max:255'],
        'namaMahasiswa' => ['required', 'max:255'],
        'password' => ['required', 'max:255'],
        'fotoMahasiswa' => ['required', 'file', 'image'],
        'prodi' => ['required', 'max:255'],
        'jurusan' => ['required', 'max:255'],
    ]);
    $validateData['fotoMahasiswa'] = $request->file('fotoMahasiswa')->store('fotoMahasiswa');

    $jurusanId = jurusan::firstOrCreate(['nama_jurusan' => $request->jurusan]);
    $prodiId = prodi::firstOrCreate([
        'nama_prodi' => $request->prodi,
        'jurusan_id'=> $jurusanId->id,
    ]);

    $newMahasiswa = mahasiswa::create([
        'nim' => $validateData['nim'],
        'nama_mahasiswa' => $validateData['namaMahasiswa'],
        'password' => $validateData['password'],
        'foto_mahasiswa' => $validateData['fotoMahasiswa'],
        'prodi_id' => $prodiId->id,
    ]);
    return Response::json([
        'message' => 'Mahasiswa added successfully',
        'data' => $newMahasiswa,
    ], 201);
});

Route::get('/get-all-data-mahasiswa', function (Request $request) {
    $dataMahasiswa = mahasiswa::all();
    return mahasiswaResource::collection($dataMahasiswa);
});

Route::get('/get-data-mahasiswa/{nim}', function ($nim) {
    $dataMahasiswaByNim = mahasiswa::where('nim', $nim)->get();
    if ($dataMahasiswaByNim->isNotEmpty()) {
        return mahasiswaResource::collection($dataMahasiswaByNim);
    } else {
        return response()->json([
            'message' => 'Not Found Data',
            'data' => mahasiswaResource::collection($dataMahasiswaByNim),
        ], 404);
    }
});


Route::get('/get-data-mahasiswa-by-nim/{nimMahasiswa}', function ($nimMahasiswa) {
    $dataMahasiswaSearchNim = mahasiswa::where('nim', 'like', '%'. $nimMahasiswa . '%')->get();
    $errorMessage = [
        'statusCode' => '404',
        'message' => 'Not Found Data'
    ];
    if (!empty($dataMahasiswaSearchNim)) {
        return mahasiswaResource::collection($dataMahasiswaSearchNim);
    } else {
        return $errorMessage;
    }
});

Route::get('/get-data-mahasiswa-by-nama/{namaMahasiswa}', function ($namaMahasiswa) {
    $dataMahasiswaSearchNama = mahasiswa::where('nama_mahasiswa', 'like', '%'. $namaMahasiswa . '%')->get();
    $errorMessage = [
        'statusCode' => '404',
        'message' => 'Not Found Data'
    ];
    if (!empty($dataMahasiswaSearchNama)) {
        return mahasiswaResource::collection($dataMahasiswaSearchNama);
    } else {
        return $errorMessage;
    }
});

Route::get('/get-data-prodi-all', function () {
    $dataJurusan = prodi::all();
    return prodiResource::collection($dataJurusan);
});