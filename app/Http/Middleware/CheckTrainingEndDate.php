<?php

namespace App\Http\Middleware;

use App\Models\Training;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Symfony\Component\HttpFoundation\Response;

class CheckTrainingEndDate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Mendapatkan slug dari URL
        $slug = $request->route('slug');

        // Cari training berdasarkan slug
        $training = Training::where('slug', $slug)->first();

        // Jika training tidak ditemukan, return 404
        if (!$training) {
            abort(404);
        }

        // Ambil semua trainingPrices untuk pelatihan ini
        $trainingPrices = $training->trainingPrices()->get();

        // Cek jika tidak ada trainingPrices
        if ($trainingPrices->isEmpty()) {
            abort(404);
        }

        // Ambil semua end_date dan cari yang paling besar (terbaru)
        $latestEndDate = $trainingPrices->max(function ($price) {
            return Carbon::parse($price->end_date);
        });

        // Cek apakah end_date yang paling besar sudah lewat
        if ($latestEndDate && $latestEndDate->isPast()) {
            // Jika sudah lewat, menggunakan session flash
            session()->flash('notify-error', 'Pelatihan sudah selesai dan tidak dapat dipesan.');

            // Redirect ke dashboard atau halaman lain
            return redirect()->route('home');
        }

        // Jika belum lewat, lanjutkan ke route berikutnya
        return $next($request);
    }
}
