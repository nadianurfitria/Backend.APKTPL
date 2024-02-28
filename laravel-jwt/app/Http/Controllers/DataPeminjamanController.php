<?php

namespace App\Http\Controllers;

use App\Http\Resources;
use App\Models\DataPeminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DataPeminjamanController extends Controller
{
    public function index()
    {
        $dataPeminjaman = DataPeminjaman::all();
        if (!$dataPeminjaman) {
            return response()->json(['success' => false, 'message' => 'Data Semua Peminjaman tidak ada', 'data' => null]);
        } else {
            return response()->json(['success' => true, 'message' => 'Data Semua Peminjaman ada', 'data' => $dataPeminjaman]);
        }
    }

    public function show(DataPeminjaman $dataPeminjaman)
    {
        return $dataPeminjaman;
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_barang' => 'required|string|max:255',
            'id_user' => 'required|string|max:255',
            'status' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $dataPeminjaman = DataPeminjaman::create($request->all());

        return response()->json($dataPeminjaman, 201);
    }

    public function update(Request $request, $id)
    {
        $dataPeminjaman = DataPeminjaman::findOrFail($id);

        // Validasi data yang dikirimkan
        $validator = Validator::make($request->all(), [
            'id_barang' => 'sometimes|required|string|max:255',
            'id_user' => 'sometimes|required|string|max:255',
            'status' => 'sometimes|required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Update data peminjaman
        $data = $request->only('id_barang', 'id_user', 'status'); // Filter hanya atribut yang diperbolehkan diupdate
        $dataPeminjaman->fill($data)->save();

        // Cek jika data peminjaman berhasil diupdate
        if ($dataPeminjaman->wasChanged()) {
            return response()->json(['success' => true, 'message' => 'Data Peminjaman Berhasil Di Update', 'data' => $dataPeminjaman]);
        } else {
            return response()->json(['success' => false, 'message' => 'Tidak Ada Perubahan Pada Data Ruang', 'data' => null]);
        }
    }

    public function delete(DataPeminjaman $dataPeminjaman)
    {
        $dataPeminjaman->delete();

        return response()->json(null, 204);
    }
}