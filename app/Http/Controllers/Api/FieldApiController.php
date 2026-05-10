<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Field;
use Illuminate\Http\Request;

class FieldApiController extends Controller
{
    // 1. GET: Menampilkan semua data lapangan
    public function index()
    {
        $fields = Field::all();
        return response()->json([
            'success' => true,
            'message' => 'Daftar Lapangan berhasil diambil',
            'data'    => $fields
        ], 200);
    }

    // 2. POST: Menambah data lapangan baru (dengan validasi)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price_per_hour' => 'required|numeric|min:0',
        ]);

        $field = Field::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Lapangan baru berhasil ditambahkan',
            'data'    => $field
        ], 201);
    }

    // 3. GET: Menampilkan satu data lapangan spesifik
    public function show(string $id)
    {
        $field = Field::find($id);

        if (!$field) {
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan'], 404);
        }

        return response()->json(['success' => true, 'data' => $field], 200);
    }

    // 4. DELETE: Menghapus data lapangan
    public function destroy(string $id)
    {
        $field = Field::find($id);

        if (!$field) {
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan'], 404);
        }

        $field->delete();
        return response()->json(['success' => true, 'message' => 'Lapangan berhasil dihapus'], 200);
    }
}