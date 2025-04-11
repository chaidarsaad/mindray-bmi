<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\App;

class OrderStatusService
{
    // Status Constants
    const STATUS_PENDING = 'pending';
    const STATUS_PROCESSING = 'processing';
    const STATUS_COMPLETED = 'completed';
    const STATUS_CANCELLED = 'cancelled';

    // Payment Status Constants
    const PAYMENT_UNPAID = 'unpaid';
    const PAYMENT_PAID = 'paid';

    public static function getStatusLabel($status): string
    {
        return match ($status) {
            self::STATUS_PENDING => 'Menunggu Pembayaran',
            self::STATUS_PROCESSING => 'Diproses',
            self::STATUS_COMPLETED => 'Selesai',
            self::STATUS_CANCELLED => 'Dibatalkan',
            default => 'Status Tidak Diketahui'
        };
    }

    public static function getStatusColor($status): string
    {
        return match ($status) {
            self::STATUS_PENDING => 'text-warning',
            self::STATUS_PROCESSING => 'text-primary',
            self::STATUS_COMPLETED => 'text-success',
            self::STATUS_CANCELLED => 'text-danger',
            default => 'text-secondary'
        };
    }

    public static function getStatusBadgeClass($status): string
    {
        return match ($status) {
            self::STATUS_PENDING => 'badge bg-warning text-dark',
            self::STATUS_PROCESSING => 'badge bg-primary',
            self::STATUS_COMPLETED => 'badge bg-success',
            self::STATUS_CANCELLED => 'badge bg-danger',
            default => 'badge bg-secondary'
        };
    }

    public static function getStatusInfo($status, $paymentDeadline = null, $completedAt = null): array
    {
        // Set locale dan timezone
        Carbon::setLocale('id');
        $tz = 'Asia/Jakarta';

        return match ($status) {
            self::STATUS_PENDING => [
                'icon' => 'fas fa-hourglass-half',
                'color' => 'warning',
                'title' => 'Menunggu Pembayaran',
                'message' => $paymentDeadline
                    ? 'Selesaikan pembayaran sebelum ' . Carbon::parse($paymentDeadline)->timezone($tz)->translatedFormat('d F Y H:i')
                    : 'Selesaikan pembayaran secepatnya.'
            ],
            self::STATUS_PROCESSING => [
                'icon' => 'fas fa-box-open',
                'color' => 'primary',
                'title' => 'Pesanan Diproses',
                'message' => 'Kami sedang menyiapkan pesanan Anda.'
            ],
            self::STATUS_COMPLETED => [
                'icon' => 'fas fa-check-circle',
                'color' => 'success',
                'title' => 'Pesanan Selesai',
                'message' => $completedAt
                    ? 'Pesanan telah diterima pada ' . Carbon::parse($completedAt)->timezone($tz)->translatedFormat('d F Y H:i')
                    : 'Pesanan telah selesai.'
            ],
            self::STATUS_CANCELLED => [
                'icon' => 'fas fa-times-circle',
                'color' => 'danger',
                'title' => 'Pesanan Dibatalkan',
                'message' => 'Pesanan telah dibatalkan.'
            ],
            default => [
                'icon' => 'fas fa-info-circle',
                'color' => 'secondary',
                'title' => 'Status Tidak Diketahui',
                'message' => ''
            ]
        };
    }



    public static function getPaymentStatusLabel($status): string
    {
        return match ($status) {
            self::PAYMENT_UNPAID => 'Belum Dibayar',
            self::PAYMENT_PAID => 'Sudah Dibayar',
            default => 'Status Pembayaran Tidak Diketahui'
        };
    }

    public static function getPaymentStatusColor($status): string
    {
        return match ($status) {
            self::PAYMENT_UNPAID => 'text-danger',
            self::PAYMENT_PAID => 'text-success',
            default => 'text-secondary'
        };
    }

    public static function getPaymentBadgeClass($status): string
    {
        return match ($status) {
            self::PAYMENT_UNPAID => 'badge bg-danger',
            self::PAYMENT_PAID => 'badge bg-success',
            default => 'badge bg-secondary'
        };
    }
}
