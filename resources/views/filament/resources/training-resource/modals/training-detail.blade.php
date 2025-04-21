<div class="space-y-6">
    @foreach ($training->trainingPrices as $price)
        <div class="border p-4 rounded-lg bg-white dark:bg-gray-800 shadow">
            <div class="mb-2">
                <strong>Jenis Pelatihan:</strong> {{ $price->trainingType->name ?? '-' }}
            </div>

            <div class="mb-2">
                <strong>Kota:</strong> {{ $price->city->name ?? '-' }}
            </div>

            <div class="mb-2">
                <strong>Tanggal:</strong> {{ $price->start_date->translatedFormat('l, d F Y') }} -
                {{ $price->end_date->translatedFormat('l, d F Y') }}
            </div>

            <div class="mb-2">
                <strong>Tempat:</strong> {{ $price->place }}
            </div>

            @php
                $jumlahPendaftar = $price->orderDetails->filter(fn($detail) => $detail->trainingOrder?->user)->count();
            @endphp

            <h4 class="font-semibold mt-4 mb-1">
                Pendaftar ({{ $jumlahPendaftar }})
            </h4>

            @if ($jumlahPendaftar > 0)
                <ul class="list-disc list-inside text-base">
                    @foreach ($price->orderDetails as $detail)
                        @php $user = $detail->trainingOrder->user ?? null; @endphp
                        @if ($user)
                            <li>{{ $user->name }} ({{ $user->email }}, {{ $user->phone_number }})</li>
                        @endif
                    @endforeach
                </ul>
            @else
                <p>Belum ada pendaftar.</p>
            @endif

        </div>
    @endforeach
</div>
