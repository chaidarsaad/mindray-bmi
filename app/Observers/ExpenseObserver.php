<?php

namespace App\Observers;

use App\Models\Expense;
use Illuminate\Support\Facades\Storage;

class ExpenseObserver
{
    /**
     * Handle the Expense "created" event.
     */
    public function created(Expense $expense): void
    {
        //
    }

    /**
     * Handle the Expense "updated" event.
     */
    public function updated(Expense $expense): void
    {
        if ($expense->isDirty('payment_proofs')) {

            $originalFieldContents = $expense->getOriginal('payment_proofs');
            $newFieldContents = $expense->payment_proofs;

            # We attempt to JSON decode the field. If it is an array, this is an indication we have ->multiple() activated
            $originalFieldContentsDecoded = $expense->getOriginal('payment_proofs');

            # Clean up empty entries in the resulting array
            if (is_array($originalFieldContentsDecoded)) $originalFieldContentsDecoded = array_filter($originalFieldContentsDecoded);

            # Simple case: one file
            if (!is_array($originalFieldContentsDecoded) or count($originalFieldContentsDecoded) == 0) {
                Storage::disk('public')->delete($originalFieldContents);
            }

            # Complex case: multiple files
            else {
                foreach ($originalFieldContentsDecoded as $originalFile) {
                    if (trim($originalFile) != null && !in_array($originalFile, $newFieldContents)) {
                        Storage::disk('public')->delete($originalFile);
                    }
                }
            }
        }
    }

    /**
     * Handle the Expense "deleted" event.
     */
    public function deleted(Expense $expense): void
    {
        if (! is_null($expense->payment_proofs)) {

            # We attempt to JSON decode the field. If it is an array, there are multiple files
            $fieldContentsDecoded = $expense->payment_proofs;

            # Simple case: one file
            if (!is_array($fieldContentsDecoded)) {
                Storage::disk('public')->delete($expense->payment_proofs);
            }

            # Complex case: multiple files
            else {

                foreach ($fieldContentsDecoded as $file) {
                    Storage::disk('public')->delete($file);
                }
            }
        }
    }

    /**
     * Handle the Expense "restored" event.
     */
    public function restored(Expense $expense): void
    {
        //
    }

    /**
     * Handle the Expense "force deleted" event.
     */
    public function forceDeleted(Expense $expense): void
    {
        //
    }
}
