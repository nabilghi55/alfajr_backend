<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaketUmroh;
use App\Models\MarketingNumber;
use App\Models\Visitor; // Pastikan model Visitor sudah dibuat
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // ==========================================
        // 1. STATISTIK PENGUNJUNG (Real-time)
        // ==========================================
        $visitorsToday = 0;
        $visitorsGrowth = 0;
        $totalPageViews = 0;
        $chartLabels = [];
        $chartData = [];

        try {
            $today = Carbon::today();
            $yesterday = Carbon::yesterday();

            // Hitung visitor hari ini & kemarin
            $visitorsToday = Visitor::whereDate('created_at', $today)->count();
            $visitorsYesterday = Visitor::whereDate('created_at', $yesterday)->count();
            $totalPageViews = Visitor::count();

            // Hitung % Pertumbuhan
            if ($visitorsYesterday > 0) {
                $visitorsGrowth = (($visitorsToday - $visitorsYesterday) / $visitorsYesterday) * 100;
            } elseif ($visitorsToday > 0) {
                $visitorsGrowth = 100;
            }

            // Data Grafik 7 Hari Terakhir
            for ($i = 6; $i >= 0; $i--) {
                $date = Carbon::now()->subDays($i);
                $chartLabels[] = $date->format('d M');
                $chartData[] = Visitor::whereDate('created_at', $date->format('Y-m-d'))->count();
            }

        } catch (\Exception $e) {
            // Fallback: Jika tabel visitor belum dimigrasi, beri nilai 0 agar dashboard tidak error
            // (Berguna saat development awal)
        }

        // ==========================================
        // 2. STATISTIK PAKET UMROH
        // ==========================================
        $totalPaket = PaketUmroh::count();
        // Asumsi: Paket 'Penuh' dianggap tidak aktif
        $paketAktif = PaketUmroh::where('status_paket', '!=', 'Penuh')->count();
        
        // Ambil 5 paket terakhir yang diinput
        $popularPakets = PaketUmroh::latest()->take(5)->get();

        // ==========================================
        // 3. CS / MARKETING BERTUGAS (Logika Rotasi)
        // ==========================================
        $activeCS = null;
        $allMarketing = MarketingNumber::orderBy('rotation_order')->get();

        if ($allMarketing->isNotEmpty()) {
            // Gunakan logika yang sama dengan MarketingNumberController::apiCurrent
            $firstItem = $allMarketing->first();
            
            // Pastikan duration_hours ada, default 720 (1 bulan) jika null/0
            $duration = (int) ($firstItem->duration_hours ?? 720); 
            if ($duration <= 0) $duration = 720;

            $epochHours = intval(now()->timestamp / 3600);
            $totalNumbers = $allMarketing->count();

            // Rumus Rotasi
            $index = intval($epochHours / $duration) % $totalNumbers;
            $activeCS = $allMarketing->values()[$index];
        }

        // ==========================================
        // 4. DATA LAINNYA
        // ==========================================
        // Placeholder untuk klik WA (karena belum ada tabel tracking klik)
        $waClicks = 0; 

        return view('dashboard.index', [
            'stats' => [
                'visitors_today' => $visitorsToday,
                'visitors_growth' => round($visitorsGrowth, 1),
                'active_pakets' => $paketAktif,
                'total_pakets' => $totalPaket,
                'wa_clicks' => $waClicks,
                'total_views' => number_format($totalPageViews),
            ],
            'chart' => [
                'labels' => $chartLabels,
                'data' => $chartData
            ],
            'popularPakets' => $popularPakets,
            'activeCS' => $activeCS // Variable ini bisa ditampilkan di dashboard jika mau
        ]);
    }
}