<?php

namespace App\Observers;

use App\Models\About;
use Illuminate\Support\Facades\Storage;

class AboutObserver
{
    /**
     * Handle the About "created" event.
     */
    public function created(About $about): void
    {
        //
    }

    /**
     * Handle the About "updated" event.
     */
    public function updated(About $about): void
    {
        if ($about->isDirty('logo')) {
            Storage::disk('public')->delete($about->getOriginal('logo'));
        }
    }

    /**
     * Handle the About "deleted" event.
     */
    public function deleted(About $about): void
    {
        if (! is_null($about->logo)) {
            Storage::disk('public')->delete($about->logo);
        }
    }

    /**
     * Handle the About "restored" event.
     */
    public function restored(About $about): void
    {
        //
    }

    /**
     * Handle the About "force deleted" event.
     */
    public function forceDeleted(About $about): void
    {
        //
    }
}
