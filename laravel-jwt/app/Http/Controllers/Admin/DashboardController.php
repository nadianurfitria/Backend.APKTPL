<?php

namespace App\Http\Controllers;

use App\Models\DataUser;
use App\Models\DataKelas;
use App\Models\DataRuang;
use App\Models\DataBarang;
use App\Models\DataRiwayat;
use App\Models\DataService;
use Illuminate\Http\Request;
use App\Models\DataPeminjaman;
use App\Http\Controllers\Controller;
use App\Http\Resources\DataUserResource;
use App\Http\Resources\DataKelasResource;
use App\Http\Resources\DataRuangResource;
use App\Http\Resources\DataBarangResource;
use App\Http\Resources\DataRiwayatResource;
use App\Http\Resources\DataServiceResource;
use App\Http\Resources\DataPeminjamanResource;

class DashboardController extends Controller
{
    public function index()
    {
        //Get the total number of users, posts, and comments
        $dataBarangCount = DataBarang::count();
        $dataKelasCount = DataKelas::count();
        $dataPeminjamanCount = DataPeminjaman::count();
        $dataRiwayatCount = DataRiwayat::count();
        $dataRuangCount = DataRuang::count();
        $dataServiceCount = DataService::count();
        $dataUserCount = DataUser::count();
        
        $dataBarang = DataBarangResource::collection(DataBarang::get());
        $dataKelas = DataKelasResource::collection(DataKelas::get());
        $dataPeminjaman = DataPeminjamanResource::collection(DataPeminjaman::get());
        $dataRiwayat = DataRiwayatResource::collection(DataRiwayat::get());
        $dataRuang = DataRuangResource::collection(DataRuang::get());
        $dataService = DataServiceResource::collection(DataService::get());
        $dataUser = DataUserResource::collection(DataUser::get());

        //return the data as a JSON response
        return response()->json([
            'databarang_count' => $dataBarangCount,
            'datakelas_count' => $dataKelasCount,
            'datapeminjaman_count' => $dataPeminjamanCount,
            'datariwayat_count' => $dataRiwayatCount,
            'dataruang_count' => $dataRuangCount,
            'dataservice_count' => $dataServiceCount,
            'datauser_count' => $dataUserCount
        ]);
    }
}
