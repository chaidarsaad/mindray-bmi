<?php

namespace App\Observers;

use App\Models\Training;
use Illuminate\Support\Facades\Storage;

class TrainingObserver
{
    /**
     * Handle the Training "created" event.
     */
    public function created(Training $training): void
    {
        //
    }

    /**
     * Handle the Training "updated" event.
     */
    public function updated(Training $training): void
    {
        if ($training->isDirty('image')) {
            Storage::disk('public')->delete($training->getOriginal('image'));
        }
    }

    /**
     * Handle the Training "deleted" event.
     */
    public function deleted(Training $training): void
    {
        if (! is_null($training->image)) {
            Storage::disk('public')->delete($training->image);
        }
    }

    /**
     * Handle the Training "restored" event.
     */
    public function restored(Training $training): void
    {
        //
    }

    /**
     * Handle the Training "force deleted" event.
     */
    public function forceDeleted(Training $training): void
    {
        //
    }
}
