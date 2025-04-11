<?php

namespace App\Http\Middleware;

use App\Models\TrainingOrder;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PreventAccessIfPaymentProofUploaded
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $order = $request->route('order');
        if (!$order || $order->user_id !== auth()->id()) {
            return redirect()->route('home')->with('notify-error', 'Pesanan tidak ditemukan.');
        }

        if ($order->payment_proof) {
            return redirect()
                ->route('detail.training.order', ['order' => $order->order_number])
                ->with('notify-success', 'Anda sudah mengunggah bukti pembayaran.');
        }


        return $next($request);
    }
}
