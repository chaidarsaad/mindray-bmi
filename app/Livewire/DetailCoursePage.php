<?php

namespace App\Livewire;

use App\Models\Training;
use Carbon\Carbon;
use Livewire\Component;

class DetailCoursePage extends Component
{
    public $training;
    public $isPastDate = false;
    public $trainingPricesGrouped = [];
    public $trainingPricesWithPrice = [];

    public function mount($slug)
    {
        $this->training = Training::where('slug', $slug)
            ->with('trainingPrices.city', 'trainingPrices.trainingType')  // Pastikan relasi sudah dimuat
            ->firstOrFail();

        // Menghitung apakah tanggal pelatihan sudah lewat
        $tanggal_training = strtotime($this->training->tanggal);
        $tanggal_sekarang = time();
        $this->isPastDate = ($tanggal_training < $tanggal_sekarang);

        // Mengelompokkan training prices berdasarkan tempat
        $this->groupTrainingPrices();
        $this->groupTrainingPricesWithPrice(); // Tambahkan untuk harga
    }

    public function groupTrainingPrices()
    {
        $groupedPrices = $this->training->trainingPrices->groupBy('place');

        foreach ($groupedPrices as $place => $prices) {
            $city = $prices->first()->city->name;

            // Gabungkan tipe pelatihan yang unik
            $trainingTypes = $prices->pluck('trainingType.name')->unique()->implode(' + ');

            // Format tanggal mulai dan selesai
            $startDate = Carbon::parse($prices->first()->start_date)->locale('id')->format('d');
            $endDate = Carbon::parse($prices->first()->end_date)->locale('id')->format('d F Y');

            $this->trainingPricesGrouped[] = [
                'city' => $city,
                'place' => $place,
                'trainingTypes' => $trainingTypes,
                'startDate' => $startDate,
                'endDate' => $endDate,
            ];
        }
    }

    public function groupTrainingPricesWithPrice()
    {
        $groupedPrices = $this->training->trainingPrices->groupBy('city');

        foreach ($groupedPrices as $city => $prices) {
            $priceList = [];

            foreach ($prices as $price) {
                $priceList[] = [
                    'trainingType' => $price->trainingType->name,
                    'price' => "Rp. " . number_format($price->price, 0, ',', '.'),
                ];
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
