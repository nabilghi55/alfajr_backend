@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard Overview')

@section('content')
    <div class="space-y-6 pb-10">

        {{-- 1. WELCOME CARD --}}
        <div class="bg-gradient-to-r from-blue-600 to-blue-800 rounded-2xl p-6 text-white shadow-lg relative overflow-hidden">
            <div class="relative z-10">
                <h2 class="text-2xl font-bold">Selamat Datang, {{ auth()->user()->name ?? 'Admin' }}! 👋</h2>
                <p class="mt-1 text-blue-100 opacity-90">Berikut adalah ringkasan performa website <span class="font-semibold text-white">alfajrumroh.com</span> hari ini.</p>
                
                <div class="mt-6 flex gap-4">
                    <a href="{{ url('https://alfajrumroh.co.id') }}" target="_blank" class="px-4 py-2 bg-white/20 hover:bg-white/30 backdrop-blur-sm rounded-lg text-sm font-semibold transition flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                        Lihat Website
                    </a>
                    <a href="{{ route('paket.index') }}" class="px-4 py-2 bg-white text-blue-700 rounded-lg text-sm font-bold shadow hover:bg-blue-50 transition">
                        Kelola Paket
                    </a>
                </div>
            </div>
            
            {{-- Decorative Circle --}}
            <div class="absolute right-0 top-0 h-full w-1/3 bg-white/5 skew-x-12 transform translate-x-10"></div>
            <div class="absolute right-10 bottom-0 h-32 w-32 bg-yellow-400/20 rounded-full blur-2xl"></div>
        </div>


        {{-- 2. STATISTIK CARDS --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            
            {{-- Card 1: Pengunjung Hari Ini --}}
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-start justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Pengunjung Hari Ini</p>
                    <h3 class="text-3xl font-bold text-gray-800 mt-1">{{ number_format($stats['visitors_today']) }}</h3>
                    
                    {{-- Logika Warna Pertumbuhan --}}
                    @php $isPositive = $stats['visitors_growth'] >= 0; @endphp
                    <p class="text-xs {{ $isPositive ? 'text-green-600' : 'text-red-500' }} mt-1 font-semibold flex items-center">
                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $isPositive ? 'M13 7h8m0 0v8m0-8l-8 8-4-4-6 6' : 'M13 17h8m0 0v-8m0 8l-8-8-4 4-6-6' }}"></path>
                        </svg>
                        {{ $isPositive ? '+' : '' }}{{ $stats['visitors_growth'] }}% dari kemarin
                    </p>
                </div>
                <div class="p-3 bg-blue-50 rounded-lg text-blue-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                </div>
            </div>

            {{-- Card 2: Total Paket --}}
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-start justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Paket Aktif</p>
                    <h3 class="text-3xl font-bold text-gray-800 mt-1">{{ $stats['active_pakets'] }}</h3>
                    <p class="text-xs text-gray-400 mt-1">Total {{ $stats['total_pakets'] }} Paket Terdaftar</p>
                </div>
                <div class="p-3 bg-orange-50 rounded-lg text-orange-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                </div>
            </div>

            {{-- Card 3: Leads / Klik WA --}}
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-start justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Klik WhatsApp</p>
                    <h3 class="text-3xl font-bold text-gray-800 mt-1">{{ $stats['wa_clicks'] }}</h3>
                    <p class="text-xs text-green-600 mt-1 font-semibold flex items-center">
                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Estimasi
                    </p>
                </div>
                <div class="p-3 bg-green-50 rounded-lg text-green-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                </div>
            </div>

            {{-- Card 4: Total View --}}
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-start justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Pageviews</p>
                    <h3 class="text-3xl font-bold text-gray-800 mt-1">{{ $stats['total_views'] }}</h3>
                    <p class="text-xs text-gray-400 mt-1">Sepanjang Waktu</p>
                </div>
                <div class="p-3 bg-purple-50 rounded-lg text-purple-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                </div>
            </div>
        </div>


        {{-- 3. GRAFIK & SIDEBAR --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            {{-- Main Chart --}}
            <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="font-bold text-gray-800 text-lg">Statistik Kunjungan (7 Hari Terakhir)</h3>
                    <select class="text-sm border-gray-300 rounded-lg text-gray-500">
                        <option>7 Hari Terakhir</option>
                    </select>
                </div>
                <div class="relative h-80 w-full">
                    <canvas id="visitChart"></canvas>
                </div>
            </div>

            {{-- Sidebar Stats --}}
            <div class="space-y-6">
                
                {{-- CARD CS BERTUGAS (NEW) --}}
                <div class="bg-white rounded-xl shadow-sm border border-green-100 p-6 relative overflow-hidden">
                    <div class="absolute right-0 top-0 p-3 opacity-10">
                        <svg class="w-24 h-24 text-green-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/></svg>
                    </div>
                    <h3 class="font-bold text-gray-800 text-lg mb-2">CS Bertugas Sekarang</h3>
                    @if(isset($activeCS) && $activeCS)
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center text-green-600 font-bold text-xl">
                                {{ substr($activeCS->name, 0, 1) }}
                            </div>
                            <div>
                                <h4 class="font-bold text-lg text-gray-800">{{ $activeCS->name }}</h4>
                                <p class="text-sm text-gray-500 font-mono">{{ $activeCS->phone_number }}</p>
                            </div>
                        </div>
                        <div class="mt-3 text-xs text-green-600 bg-green-50 px-2 py-1 rounded inline-block">
                            ● Sedang Aktif di Website
                        </div>
                    @else
                        <p class="text-gray-500 text-sm">Belum ada data marketing.</p>
                    @endif
                </div>

                {{-- PAKET TERBARU --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h3 class="font-bold text-gray-800 text-lg mb-4">Paket Terbaru</h3>
                    
                    <div class="space-y-4">
                        @forelse($popularPakets as $index => $paket)
                            <div class="flex items-center gap-3 pb-3 border-b border-gray-50 last:border-0 last:pb-0">
                                <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center text-gray-500 font-bold text-sm">
                                    {{ $index + 1 }}
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="text-sm font-semibold text-gray-800 truncate" title="{{ $paket->nama_paket }}">
                                        {{ $paket->nama_paket }}
                                    </h4>
                                    <p class="text-xs text-gray-500">
                                        Rp {{ number_format($paket->harga_tampil, 0, ',', '.') }}
                                    </p>
                                </div>
                                <span class="text-xs font-bold px-2 py-1 rounded-full {{ $paket->status_paket == 'Tersedia' ? 'bg-green-50 text-green-600' : 'bg-orange-50 text-orange-600' }}">
                                    {{ $paket->status_paket }}
                                </span>
                            </div>
                        @empty
                            <div class="text-center py-4 text-gray-400 text-sm">
                                Belum ada paket yang ditambahkan.
                            </div>
                        @endforelse
                    </div>
                </div>

            </div>

        </div>

    </div>

    {{-- Data Tersembunyi untuk Chart (Agar JS Aman) --}}
    <div id="chart-data" 
         data-labels="{{ json_encode($chart['labels']) }}" 
         data-values="{{ json_encode($chart['data']) }}" 
         class="hidden"></div>

    {{-- CHART.JS (CDN) --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const ctx = document.getElementById('visitChart').getContext('2d');
            
            // PERBAIKAN: Mengambil data dari atribut HTML, bukan Blade injection langsung
            const chartDataEl = document.getElementById('chart-data');
            const labels = JSON.parse(chartDataEl.getAttribute('data-labels'));
            const rawData = JSON.parse(chartDataEl.getAttribute('data-values'));

            // Jika data kosong, kasih dummy 0 agar chart tidak error
            const chartData = rawData.length > 0 && rawData.some(val => val > 0) ? rawData : new Array(labels.length).fill(0);

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Pengunjung',
                        data: chartData,
                        borderColor: '#2563EB', // Blue-600
                        backgroundColor: 'rgba(37, 99, 235, 0.1)',
                        borderWidth: 2,
                        tension: 0.4, // Garis melengkung
                        fill: true,
                        pointBackgroundColor: '#fff',
                        pointBorderColor: '#2563EB',
                        pointRadius: 4,
                        pointHoverRadius: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#1E293B',
                            padding: 12,
                            titleFont: { size: 13 },
                            bodyFont: { size: 13 },
                            displayColors: false,
                            callbacks: {
                                label: function(context) {
                                    return context.parsed.y + ' Pengunjung';
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: { borderDash: [5, 5], color: '#f3f4f6' },
                            ticks: { precision: 0 } // Tidak ada desimal (0.5 orang)
                        },
                        x: {
                            grid: { display: false }
                        }
                    }
                }
            });
        });
    </script>
@endsection