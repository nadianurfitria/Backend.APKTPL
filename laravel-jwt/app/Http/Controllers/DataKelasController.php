<?php

namespace App\Http\Controllers;

use App\Http\Resources;
use App\Models\DataKelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DataKelasController extends Controller
{
    public function index()
    {
        $dataKelas = DataKelas::all();
        if (!$dataKelas) {
            return response()->json(['success' => false, 'message' => 'Data Semua Kelas tidak ada', 'data' => null]);
        } else {
            return response()->json(['success' => true, 'message' => 'Data Semua Kelas', 'data' => $dataKelas]);
        }
    }

    public function show(DataKelas $dataKelas)
    {
        return $dataKelas;
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_kelas' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $dataKelas = DataKelas::create($request->all());

        return response()->json($dataKelas, 201);
    }

    public function update(Request $request, $id)
    {
        $dataKelas = DataKelas::findOrFail($id);

        // Validasi data yang dikirimkan
        $validator = Validator::make($request->all(), [
            'nama_kelas' => 'sometimes|required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Update data kelas
        $data = $request->only('nama_kelas'); // Filter hanya atribut yang diperbolehkan diupdate
        $dataKelas->fill($data)->save();

        // Cek jika data kelas berhasil diupdate
        if ($dataKelas->wasChanged()) {
            return response()->json(['success' => true, 'message' => 'Data Kelas Berhasil Di Update', 'data' => $dataKelas]);
        } else {
            return response()->json(['success' => false, 'message' => 'Tidak Ada Perubahan Pada Data Kelas', 'data' => null]);
        }
    }

    public function delete(DataKelas $dataKelas)
    {
        $dataKelas->delete();

        return response()->json(null, 204);
    }
}