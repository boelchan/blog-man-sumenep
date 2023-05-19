<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Service extends Model implements Searchable
{
    use HasFactory;

    public $searchableType = 'Pelayanan';

    protected $guarded = ['id'];

    public function getSearchResult(): SearchResult
    {
        return new \Spatie\Searchable\SearchResult(
            $this,
            $this->nama,
            $this->url
        );
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->slug = (string) Str::slug($model->nama);

            if ($file = request()->file('icon')) {
                $fileName = microtime().'.'.$file->extension();
                $file->move('storage/pelayanan/icon/', $fileName);

                $model->icon = $fileName;
            }
            if ($file = request()->file('gambar')) {
                $fileName = microtime().'.'.$file->extension();
                $file->move('storage/pelayanan/', $fileName);

                $model->gambar = $fileName;
            }
        });
    }

    public function getUrlGambarAttribute()
    {
        return $this->gambar != '' ? asset("storage/pelayanan/$this->gambar") : false;
    }

    public function getUrlAttribute()
    {
        return match ($this->id) {
            1 => route('front.rajal'),
            2 => route('front.ranap'),
            default => route('front.pelayanan.baca', $this->slug),
        };
    }
}
