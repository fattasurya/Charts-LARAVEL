<?php

namespace App\Http\Controllers;

use App\Models\Population;
use Illuminate\Http\Request;

class PopulationController extends Controller
{
    public function index()
    {
        $populations = Population::all();
        return view('charts1', compact('populations'));
    }

    public function user()
    {
        $populations = Population::all();
        return view('user1', compact('populations'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'year' => 'required|integer',
            'penduduk' => 'required|integer',
            'pria' => 'required|integer',
            'wanita' => 'required|integer',
        ]);

        $population = new Population;
        $population->year = $validated['year'];
        $population->penduduk = $validated['penduduk'];
        $population->pria = $validated['pria'];
        $population->wanita = $validated['wanita'];
        $population->save();

        return response()->json(['success' => 'Data berhasil disimpan']);
    }


    public function edit($id)
    {
        $population = Population::find($id);
        if (!$population) {
            return response()->json(['error' => 'Data not found'], 404);
        }

        return response()->json($population);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'year' => 'required|integer',
            'penduduk' => 'required|integer',
            'pria' => 'required|integer',
            'wanita' => 'required|integer',
        ]);

        $population = Population::find($id);
        if (!$population) {
            return response()->json(['error' => 'Data not found'], 404);
        }

        $population->year = $request->year;
        $population->penduduk = $request->penduduk;
        $population->pria = $request->pria;
        $population->wanita = $request->wanita;
        $population->save();

        return response()->json(['success' => 'Data successfully updated']);
    }



    public function destroy($id)
    {
        $population = Population::findOrFail($id);
        $population->delete();

        return response()->json(['success' => 'Data berhasil dihapus']);
    }


}
