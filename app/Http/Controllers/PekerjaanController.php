<?php

namespace App\Http\Controllers;

use App\Models\Pekerjaan;
use Illuminate\Http\Request;

class PekerjaanController extends Controller
{
    public function index2()
    {
        $data = Pekerjaan::all();
        return view('charts2', compact('data'));
    }

    public function user()
    {
        $data = Pekerjaan::all();
        return view('user2', compact('data'));
    }

    

    // PekerjaanController.php
    public function store(Request $request)
    {
        $request->validate([
            'pekerjaan' => 'required|string|max:255',
            'laki_laki' => 'required|integer',
            'perempuan' => 'required|integer',
            'jumlah' => 'required|integer',
        ]);

        Pekerjaan::create($request->all());

        return response()->json(['success' => 'Data berhasil disimpan']);
    }

    public function edit($id)
    {
        $data = Pekerjaan::find($id);

        if (!$data) {
            return response()->json(['error' => 'Data tidak ditemukan'], 404);
        }

        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'pekerjaan' => 'required|string|max:255',
            'laki_laki' => 'required|integer',
            'perempuan' => 'required|integer',
            'jumlah' => 'required|integer',
        ]);

        $pekerjaan = Pekerjaan::find($id);

        if (!$pekerjaan) {
            return response()->json(['error' => 'Data tidak ditemukan'], 404);
        }

        $pekerjaan->update($request->all());

        return response()->json(['success' => 'Data berhasil diperbarui']);
    }

    public function destroy($id)
    {
        $pekerjaan = Pekerjaan::find($id);

        if (!$pekerjaan) {
            return response()->json(['error' => 'Data tidak ditemukan'], 404);
        }

        $pekerjaan->delete();

        return response()->json(['success' => 'Data berhasil dihapus']);
    }
}

