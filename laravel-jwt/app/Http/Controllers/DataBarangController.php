<?php

namespace App\Http\Controllers;

use App\Http\Resources;
use App\Models\DataBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DataBarangController extends Controller
{
    public function index()
    {
        $dataBarang = DataBarang::all();
        if (!$dataBarang) {
            return response()->json(['success' => false, 'message' => 'Data Semua Barang tidak ada', 'data' => null]);
        } else {
            return response()->json(['success' => true, 'message' => 'Data Semua Barang', 'data' => $dataBarang]);
        }
    }

    public function show(DataBarang $dataBarang)
    {
        return $dataBarang;
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'jenis_barang' => 'required|string|max:255',
            'merk' => 'nullable|string|max:255',
            'id_ruang' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $dataBarang = DataBarang::create($request->all());

        return response()->json($dataBarang, 201);
    }

    public function update(Request $request, $id)
    {
        $dataBarang = DataBarang::findOrFail($id);

        // Validasi data yang dikirimkan
        $validator = Validator::make($request->all(), [
            'jenis_barang' => 'sometimes|required|string|max:255',
            'merk' => 'sometimes|nullable|string|max:255',
            'id_ruang' => 'sometimes|required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Update data barang
        $data = $request->only('jenis_barang', 'merk', 'id_ruang'); // Filter hanya atribut yang diperbolehkan diupdate
        $dataBarang->fill($data)->save();

        // Cek jika data barang berhasil diupdate
        if ($dataBarang->wasChanged()) {
            return response()->json(['success' => true, 'message' => 'Data Barang Berhasil Di Update', 'data' => $dataBarang]);
        } else {
            return response()->json(['success' => false, 'message' => 'Tidak ada perubahan pada data barang', 'data' => null]);
        }
    }


    public function delete(Request $request, $id)
    {
        $dataBarang = DataBarang::findOrFail($id);

        // Hapus data barang
        $deleted = $dataBarang->delete();

        // Cek jika data barang berhasil dihapus
        if ($deleted) {
            return response()->json(['success' => true, 'message' => 'Data Barang Berhasil Dihapus', 'data' => null]);
        } else {
            return response()->json(['success' => false, 'message' => 'Data Barang Gagal Dihapus', 'data' => null]);
        }
    }

}
