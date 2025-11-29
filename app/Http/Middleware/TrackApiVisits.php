<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use App\Models\Visitor;
use Carbon\Carbon;

class TrackApiVisits
{
    public function handle(Request $request, Closure $next)
    {
        // Cek agar tidak spam (misal: IP yang sama hanya dihitung 1x per hari)
        $exists = Visitor::where('ip_address', $request->ip())
                         ->whereDate('created_at', Carbon::today())
                         ->exists();

        if (!$exists) {
            Visitor::create([
                'ip_address' => $request->ip(),
                'user_agent' => $request->header('User-Agent'),
                'endpoint'   => $request->path(),
            ]);
        }

        return $next($request);
    }
}
