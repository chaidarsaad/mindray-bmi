<?php

namespace App\Livewire;

use App\Models\PaymentMethod;
use App\Models\Training;
use Carbon\Carbon;
use Livewire\Component;

class DetailCoursePage extends Component
{
    public $training;
    public $paymentMethods;
    public $accountName;
    public $isPastDate = true;
    public $trainingPricesGrouped = [];
    public $trainingPricesWithPrice = [];

    public function mount($slug)
    {
        $this->paymentMethods = PaymentMethod::all();
        $this->accountName = PaymentMethod::first();

        $this->training = Training::where('slug', $slug)
            ->with('trainingPrices.city', 'trainingPrices.trainingType')
            ->firstOrFail();

        $trainingPrices = $this->training->trainingPrices;

        // ✅ Inisialisasi dulu biar tidak undefined
        $lastTrainingPrice = null;


        if ($trainingPrices->isNotEmpty()) {
            $lastTrainingPrice = $trainingPrices->sortByDesc('end_date')->first();
            $this->training->last_end_date = $lastTrainingPrice->end_date;

            $endDate = strtotime($lastTrainingPrice->end_date);
            $currentDate = time();

            // Hanya jika end_date lebih dari hari ini, maka belum lewat
            $this->isPastDate = ($endDate < $currentDate);
        } else {
            $this->training->last_end_date = null;
        }

        // ✅ Hanya jalankan ini jika $lastTrainingPrice tidak null
        if ($lastTrainingPrice) {
            $endDate = strtotime($lastTrainingPrice->end_date);
            $currentDate = time();
            $this->isPastDate = ($endDate < $currentDate);
        }

        $this->groupTrainingPrices();
        $this->groupTrainingPricesWithPrice();
    }



    public function groupTrainingPrices()
    {
        // Mengelompokkan berdasarkan kota dan tempat (place)
        $groupedPrices = $this->training->trainingPrices->groupBy(function ($price) {
            return $price->place . '|' . $price->city->name; // Mengelompokkan berdasarkan tempat dan kota
        });

        foreach ($groupedPrices as $key => $prices) {
            $placeCity = explode('|', $key);
            $place = $placeCity[0];
            $city = $placeCity[1];

            // Mengelompokkan berdasarkan tipe pelatihan (ANC, ABDOMEN, dsb.)
            $trainingTypesGrouped = $prices->groupBy('trainingType.name');

            // Array untuk menyimpan hasil pengelompokan
            $datesByType = [];  // Untuk menyimpan tanggal berdasarkan tipe pelatihan

            foreach ($trainingTypesGrouped as $trainingType => $typePrices) {
                // Map tanggal yang unik untuk setiap tipe pelatihan dan urutkan berdasarkan tanggal
                $dates = $typePrices->map(function ($price) {
                    $startDate = Carbon::parse($price->start_date);
                    $endDate = Carbon::parse($price->end_date);
                    return [
                        'start' => $startDate,
                        'end' => $endDate,
                        'formatted' => $startDate->isoFormat('D') . ' - ' . $endDate->isoFormat('D MMMM YYYY')
                    ];
                });

                // Urutkan berdasarkan startDate yang lebih awal
                $dates = $dates->sortBy('start')->values();

                // Menyimpan tanggal yang sudah diurutkan dalam array
                $datesByType[$trainingType] = $dates->pluck('formatted');
            }

            // Gabungkan hasil ke dalam array yang sudah digabung
            $this->trainingPricesGrouped[] = [
                'city' => $city,
                'place' => $place,
                'datesByType' => $datesByType, // Menyimpan tanggal berdasarkan tipe pelatihan
            ];
        }
    }

    public function groupTrainingPricesWithPrice()
    {
        $groupedPrices = $this->training->trainingPrices->groupBy('city');

        foreach ($groupedPrices as $city => $prices) {
            $priceList = [];
            $uniquePrices = [];

            foreach ($prices as $price) {
                $trainingType = $price->trainingType->name;
                $formattedPrice = "Rp. " . number_format($price->price, 0, ',', '.');

                // Gabungkan harga dan training type untuk memastikan tidak ada duplikasi
                $priceKey = $trainingType . ' - ' . $formattedPrice;

                // Jika harga dan tipe pelatihan belum ada di dalam list, tambahkan
                if (!in_array($priceKey, $uniquePrices)) {
                    $priceList[] = [
                        'trainingType' => $trainingType,
                        'price' => $formattedPrice,
                    ];

                    // Tambahkan key harga dan tipe pelatihan ke array uniquePrices
                    $uniquePrices[] = $priceKey;
                }
            }

            // Ambil nama kota dari relasi city
            $cityName = $prices->first()->city->name;

            $this->trainingPricesWithPrice[] = [
                'city' => $cityName, // Menggunakan nama kota
                'prices' => $priceList,
            ];
        }
    }


    public function render()
    {
        return view('livewire.detail-course-page');
    }
}
