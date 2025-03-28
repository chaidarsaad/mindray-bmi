<?php

namespace App\Observers;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductObserver
{
    /**
     * Handle the Product "created" event.
     */
    public function created(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "updated" event.
     */
    public function updated(Product $product): void
    {
        if ($product->isDirty('images')) {

            $originalFieldContents = $product->getOriginal('images');
            $newFieldContents = $product->images;

            # We attempt to JSON decode the field. If it is an array, this is an indication we have ->multiple() activated
            $originalFieldContentsDecoded = $product->getOriginal('images');

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
     * Handle the Product "deleted" event.
     */
    public function deleted(Product $product): void
    {
        if (! is_null($product->images)) {

            # We attempt to JSON decode the field. If it is an array, there are multiple files
            $fieldContentsDecoded = $product->images;

            # Simple case: one file
            if (!is_array($fieldContentsDecoded)) {
                Storage::disk('public')->delete($product->images);
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
     * Handle the Product "restored" event.
     */
    public function restored(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "force deleted" event.
     */
    public function forceDeleted(Product $product): void
    {
        //
    }
}
