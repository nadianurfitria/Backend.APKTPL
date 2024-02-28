<?php

namespace App\Http\Controllers;

use App\Http\Resources;
use App\Models\DataRuang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DataRuangController extends Controller
{
    public function index()
    {
        $dataRuang = DataRuang::all();
        if (!$dataRuang) {
            return response()->json(['success' => false, 'message' => 'Data Semua Ruang Tidak Ada', 'data' => null]);
        } else {
            return response()->json(['success' => true, 'message' => 'Data Semua Ruang Ada', 'data' => $dataRuang]);
        }
    }

    public function show(DataRuang $dataRuang)
    {
        return $dataRuang;
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_ruang' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $dataRuang = DataRuang::create($request->all());

        return response()->json($dataRuang, 201);
    }

    public function update(Request $request, $id)
    {
        $dataRuang = DataRuang::findOrFail($id);

        // Validasi data yang dikirimkan
        $validator = Validator::make($request->all(), [
            'nama_ruang' => 'sometimes|required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Update data ruang
        $data = $request->only('nama_ruang'); // Filter hanya atribut yang diperbolehkan diupdate
        $dataRuang->fill($data)->save();

        // Cek jika data ruang berhasil diupdate
        if ($dataRuang->wasChanged()) {
            return response()->json(['success' => true, 'message' => 'Data Ruang Berhasil Di Update', 'data' => $dataRuang]);
        } else {
            return response()->json(['success' => false, 'message' => 'Tidak Ada Perubahan Pada Data Ruang', 'data' => null]);
        }
    }


    public function delete(DataRuang $dataRuang)
    {
        $dataRuang->delete();

        return response()->json(null, 204);
    }
}
