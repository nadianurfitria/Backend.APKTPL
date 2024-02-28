<?php

namespace App\Http\Controllers;

use App\Http\Resources;
use App\Models\DataService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DataServiceController extends Controller
{
    public function index()
    {
        $dataService = DataService::all();
        if (!$dataService) {
            return response()->json(['success' => false, 'message' => 'Data Semua Ruang Tidak Ada', 'data' => null]);
        } else {
            return response()->json(['success' => true, 'message' => 'Data Semua Ruang Ada', 'data' => $dataService]);
        }
    }

    public function show(DataService $dataService)
    {
        return $dataService;
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kerusakan' => 'required|string|max:255',
            'deskripsi' => 'nullable|string|max:255',
            'tanggal_service' => 'required|date_format:Y-m-d',
            'selesai_service' => 'required|date_format:Y-m-d',
            'teknisi' => 'nullable|string|max:255',
            'biaya' => 'required|string|max:255',
            'id_barang' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $dataService = DataService::create($request->all());

        return response()->json($dataService, 201);
    }

    public function update(Request $request, $id)
    {
        $dataService = DataService::findOrFail($id);

        // Validasi data yang dikirimkan
        $validator = Validator::make($request->all(), [
            'kerusakan' => 'sometimes|required|string|max:255',
            'deskripsi' => 'sometimes|nullable|string|max:255',
            'tanggal_service' => 'sometimes|required|date_format:Y-m-d',
            'selesai_service' => 'sometimes|required|date_format:Y-m-d',
            'teknisi' => 'sometimes|nullable|string|max:255',
            'biaya' => 'sometimes|required|string|max:255',
            'id_barang' => 'sometimes|required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Update data service
        $data = $request->only('kerusakan', 'deskripsi', 'tanggal_service', 'selesai_service', 'teknisi', 'biaya', 'id_barang'); // Filter hanya atribut yang diperbolehkan diupdate
        $dataService->fill($data)->save();

        // Cek jika data service berhasil diupdate
        if ($dataService->wasChanged()) {
            return response()->json(['success' => true, 'message' => 'Data Service Berhasil Di Update', 'data' => $dataService]);
        } else {
            return response()->json(['success' => false, 'message' => 'Tidak Ada Perubahan Pada Data Barang', 'data' => null]);
        }
    }


    public function delete(DataService $dataService)
    {
        $dataService->delete();

        return response()->json(null, 204);
    }
}
