<?php

namespace App\Http\Controllers;

use App\Models\Testimoni;
use Illuminate\Http\Request;

class TestimoniController extends Controller
{
    public function index()
    {
        $testimonis = Testimoni::latest()->get();
        return view('testimoni.index', compact('testimonis'));
    }

    public function create()
    {
        return view('testimoni.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'text_description' => 'required|string',
        ]);

        Testimoni::create($request->all());

        return redirect()->route('testimoni.index')->with('success', 'Testimoni berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        Testimoni::findOrFail($id)->delete();

        return back()->with('success', 'Testimoni berhasil dihapus!');
    }
    public function getTestimoni()
    {
        return response()->json([
            'status' => 'success',
            'data' => Testimoni::latest()->get()
        ], 200);
    }

}
