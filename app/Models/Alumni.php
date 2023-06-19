<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    protected static function boot()
    {
        parent::boot();
        static::saving(function ($model) {

            if ($file = request()->file('foto')) {
                $fileName = microtime().'.'.$file->extension();
                $file->move('storage/alumni/', $fileName);

                $model->foto = $fileName;
            }
        });
    }

    public function getFotoUrlAttribute()
    {
        return $this->foto != '' ? asset("storage/alumni/$this->foto") : asset('static/sampel.jpg');
    }
}
