<?php

namespace App\Http\Middleware;

use App\Models\Visit;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LogVisitor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Ambil alamat IP pengunjung
        $ipAddress = $request->ip();

        // Cek jika IP sudah tercatat di database
        if (!Visit::where('ip_address', $ipAddress)->exists()) {
            // Catat pengunjung baru
            Visit::create([
                'ip_address' => $ipAddress
            ]);
        }

        return $next($request);
    }
}
