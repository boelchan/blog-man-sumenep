<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Poly extends Model implements Searchable
{
    use HasFactory;

    public $searchableType = 'Poli';

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

            if ($file = request()->file('gambar')) {
                $fileName = microtime().'.'.$file->extension();
                $file->move('storage/poly/', $fileName);

                $model->gambar = $fileName;
            }
            if ($file = request()->file('icon')) {
                $fileName = microtime().'.'.$file->extension();
                $file->move('storage/poly/icon/', $fileName);

                $model->icon = $fileName;
            }
        });
    }

    public function getUrlGambarAttribute()
    {
        return $this->gambar != '' ? asset("storage/poly/$this->gambar") : false;
    }

    public function getIconUrlAttribute()
    {
        if ($this->icon) {
            return asset("storage/poly/icon/$this->icon");
        } else {
            $icon = Service::select(['icon'])->find(1)->icon;

            return asset("storage/pelayanan/icon/$icon");
        }
    }

    public function getUrlAttribute()
    {
        return route('front.rajal.baca', $this->slug);
    }
}
