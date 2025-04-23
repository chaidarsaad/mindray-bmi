<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'slug',
        'judul',
        'sub_judul',
        'image',
        'content',
        'views',
        'is_show',
    ];

    public function setJudulAttribute($value)
    {
        $this->attributes['judul'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function incrementViews()
    {
        $this->increment('views');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    protected static function booted()
    {
        // Saat artikel dihapus
        static::deleting(function ($article) {
            self::deleteImagesFromContent($article->content);
        });

        // Saat artikel diperbarui
        static::updating(function ($article) {
            $oldContent = $article->getOriginal('content');
            $newContent = $article->content;

            $oldImages = self::extractImagePaths($oldContent);
            $newImages = self::extractImagePaths($newContent);

            $deletedImages = array_diff($oldImages, $newImages);

            foreach ($deletedImages as $path) {
                if (Storage::disk('public')->exists($path)) {
                    Storage::disk('public')->delete($path);
                }
            }
        });
    }

    protected static function deleteImagesFromContent($html)
    {
        foreach (self::extractImagePaths($html) as $path) {
            if (Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }
        }
    }

    protected static function extractImagePaths($html)
    {
        preg_match_all('/<img[^>]+src="([^">]+)"/i', $html, $matches);
        $urls = $matches[1] ?? [];

        return collect($urls)->map(function ($url) {
            return str_replace(asset('storage') . '/', '', $url);
        })->toArray();
    }
}
