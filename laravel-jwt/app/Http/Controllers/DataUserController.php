<?php

namespace App\Http\Controllers;

use App\Http\Resources;
use App\Models\DataUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Contracts\Service\Attribute\Required;

class DataUserController extends Controller
{
    public function index()
    {
        $dataUser = DataUser::all();
        if (!$dataUser) {
            return response()->json(['success' => false, 'message' => 'Data Semua User tidak ada', 'data' => null]);
        } else {
            return response()->json(['success' => true, 'message' => 'Data Semua User ada', 'data' => $dataUser]);
        }
    }

    public function show(DataUser $dataUser)
    {
        return $dataUser;
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255',
            'nisn' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'password' => 'required|string|max:255',
            'id_kelas' => 'required|string|max:255',
            'status' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $dataUser = DataUser::create($request->all());

        return response()->json($dataUser, 201);
    }

    public function update(Request $request, $id)
    {
        $dataUser = DataUser::findOrFail($id);

        // Validasi data yang dikirimkan
        $validator = Validator::make($request->all(), [
            'username' => 'sometimes|required|string|max:255',
            'nisn' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|max:255',
            'password' => 'sometimes|required|string|max:255',
            'id_kelas' => 'sometimes|required|string|max:255',
            'status' => 'sometimes|required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Update data service
        $data = $request->only('username', 'nisn', 'email', 'password', 'id_kelas', 'status'); // Filter hanya atribut yang diperbolehkan diupdate
        $dataUser->fill($data)->save();

        // Cek jika data user berhasil diupdate
        if ($dataUser->wasChanged()) {
            return response()->json(['success' => true, 'message' => 'Data User Berhasil Di Update', 'data' => $dataUser]);
        } else {
            return response()->json(['success' => false, 'message' => 'Tidak Ada Perubahan Pada Data User', 'data' => null]);
        }
    }

    public function delete(DataUser $dataUser)
    {
        $dataUser->delete();

        return response()->json(null, 204);
    }
}