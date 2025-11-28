<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::latest()->get();
        return view('faq.index', compact('faqs'));
    }

    public function create()
    {
        return view('faq.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'pertanyaan' => 'required|string|max:255',
            'jawaban' => 'required|string',
        ]);

        Faq::create($request->all());

        return redirect()->route('faq.index')->with('success', 'FAQ berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        Faq::findOrFail($id)->delete();

        return back()->with('success', 'FAQ berhasil dihapus!');
    }
    public function getFaq()
    {
        return response()->json([
            'status' => 'success',
            'data' => Faq::latest()->get()
        ], 200);
    }

}
