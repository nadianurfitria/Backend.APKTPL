<?php

namespace App\Http\Controllers;

use App\Http\Resources;
use App\Models\DataRiwayat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\DataPeminjaman; // Import model DataPeminjaman

class DataRiwayatController extends Controller
{
    public function show($id)
    {
        $dataRiwayat = DataRiwayat::with('datapeminjaman')->find($id);

        if (!$dataRiwayat) {
            return response()->json(['success' => false, 'message' => 'Data Riwayat Peminjaman Tidak Ada', 'data' => null]);
        } else {
            return response()->json(['success' => true, 'message' => 'Data Riwayat Peminjaman Ada', 'data' => $dataRiwayat]);
        }
    }
}
