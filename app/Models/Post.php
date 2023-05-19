<?php

namespace App\Models;

use App\Enum\CategoryEnum;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Post extends Model implements Searchable
{
    use HasFactory;

    public $searchableType = 'Informasi / Artikel';

    protected $guarded = ['id'];

    public function getSearchResult(): SearchResult
    {
        return new \Spatie\Searchable\SearchResult(
            $this,
            $this->judul,
            $this->url
        );
    }

    protected static function boot()
    {
        parent::boot();
        static::saving(function ($model) {
            $model->slug = (string) Str::slug($model->judul);

            if ($file = request()->file('gambar')) {
                $fileName = microtime().'.'.$file->extension();
                $file->move('storage/gambar/', $fileName);

                $model->gambar = $fileName;
            }
        });
    }

    public function kategori()
    {
        return $this->belongsTo(PostCategory::class, 'kategori_id');
    }

    public function getUrlAttribute()
    {
        switch ($this->kategori_id) {
            case CategoryEnum::AGENDA->value:
                return route('front.agenda.baca', $this->slug);
                break;
            case CategoryEnum::ARTIKEL->value:
                return route('front.artikel.baca', $this->slug);
                break;
            case CategoryEnum::INFORMASI->value:
                return route('front.informasi.baca', $this->slug);
                break;
            case CategoryEnum::PROMO->value:
                return route('front.promo.baca', $this->slug);
                break;
            case CategoryEnum::GALLERY->value:
                return route('front.gallery.baca', $this->slug);
                break;
            case CategoryEnum::PAMFLET->value:
                return route('front.pamflet.baca', $this->slug);
                break;
            case CategoryEnum::BANNER->value:
                return route('front.banner.baca', $this->slug);
                break;
        }
    }

    public function getUrlGambarAttribute()
    {
        return asset("storage/gambar/$this->gambar");
    }

    public function getPublishDateAttribute()
    {
        return $this->kategori_id == CategoryEnum::AGENDA->value ? $this->tanggal : Carbon::parse($this->published_at)->diffForHumans();
    }
}
