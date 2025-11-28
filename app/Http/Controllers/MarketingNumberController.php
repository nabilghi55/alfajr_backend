<?php

namespace App\Http\Controllers;

use App\Models\MarketingNumber;
use Illuminate\Http\Request;
use Carbon\Carbon;

class MarketingNumberController extends Controller
{
    // WEB: List
    public function index()
    {
        $marketing = MarketingNumber::orderBy('rotation_order', 'asc')->get();

        return view('marketing.index', compact('marketing'));
    }


    // WEB: create view
    public function create()
    {
        return view('marketing.create');
    }

    // WEB: store
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'phone_number' => 'required|string|unique:marketing_numbers,phone_number',
            'rotation_order' => 'required|integer|unique:marketing_numbers,rotation_order',
        ]);

        MarketingNumber::create($request->all());

        return redirect()->route('marketing.index')->with('success', 'Marketing number created successfully!');
    }

    // WEB: show (optional)
    public function show($id)
    {
        $number = MarketingNumber::findOrFail($id);
        return view('marketing.show', compact('number'));
    }

    // WEB: edit
    public function edit($id)
    {
        $number = MarketingNumber::findOrFail($id);
        return view('marketing.edit', compact('number'));
    }

    // WEB: update
    public function update(Request $request, $id)
    {
        $number = MarketingNumber::findOrFail($id);

        $request->validate([
            'name' => 'required|string',
            'phone_number' => 'required|string|unique:marketing_numbers,phone_number,' . $id,
            'rotation_order' => 'required|integer|unique:marketing_numbers,rotation_order,' . $id,
        ]);

        $number->update($request->all());

        return redirect()->route('marketing.index')->with('success', 'Marketing number updated successfully!');
    }

    // WEB: destroy
    public function destroy($id)
    {
        MarketingNumber::findOrFail($id)->delete();
        return back()->with('success', 'Marketing number deleted!');
    }

    // API: return all numbers
    public function apiIndex()
    {
        $numbers = MarketingNumber::orderBy('rotation_order')->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Marketing numbers retrieved successfully.',
            'data' => $numbers
        ], 200);
    }

    // API: get single by id
    public function apiShow($id)
    {
        $number = MarketingNumber::findOrFail($id);
        return response()->json([
            'status' => 'success',
            'data' => $number
        ], 200);
    }

    // API: get current active number based on rotation (every duration_hours)
    public function apiCurrent()
    {
        $all = MarketingNumber::orderBy('rotation_order')->get();
        if ($all->isEmpty()) {
            return response()->json(['status' => 'error', 'message' => 'No marketing numbers configured.'], 404);
        }

        // rotation calculation:
        // 1 month = 720 hours (user stated) -> but instead we'll use continuous epoch hours to compute rotation
        // Use each number's duration_hours (45) to rotate.
        $duration = (int) $all->first()->duration_hours; // assume same for all

        // compute number index using epoch hours (UTC)
        $epochHours = intval(now()->timestamp / 3600); // hours since epoch
        $totalNumbers = $all->count();

        // which rotation index (0-based)
        $index = ($epochHours / $duration);
        $index = intval($index) % $totalNumbers; // 0..total-1

        $active = $all->values()[$index];

        return response()->json([
            'status' => 'success',
            'data' => [
                'active_index' => $index + 1,
                'rotation_order' => $active->rotation_order,
                'name' => $active->name,
                'phone_number' => $active->phone_number,
                'duration_hours' => $active->duration_hours,
                'calculated_at' => now()->toDateTimeString()
            ]
        ], 200);
    }
}
