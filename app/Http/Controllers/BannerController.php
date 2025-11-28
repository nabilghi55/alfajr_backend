<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::latest()->get();
        return view('banner.index', compact('banners'));
    }

    public function create()
    {
        return view('banner.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:4096',
        ]);

        $data = $request->only('name');

        // upload image
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')
                ->store('banner', 'public');
        }

        Banner::create($data);

        return redirect()->route('banner.index')->with('success', 'Banner berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        $banner = Banner::findOrFail($id);

        // hapus file
        if ($banner->image && Storage::disk('public')->exists($banner->image)) {
            Storage::disk('public')->delete($banner->image);
        }

        $banner->delete();

        return back()->with('success', 'Banner berhasil dihapus!');
    }
    public function getBanner()
    {
        return response()->json([
            'status' => 'success',
            'data' => Banner::latest()->get()
        ], 200);
    }

}
