<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\SewaAlatDetail;
use Illuminate\Http\Request;

class SewaAlatDetailController extends Controller
{
    public $title;

    public function __construct($title = '')
    {
        $this->title = 'Alat';
    }

    public function store(Request $request)
    {
        $request->validate([
            'sewa_alat_id' => 'required',
            'alat_id' => 'required',
            'jumlah' => 'required',
        ]);

        SewaAlatDetail::create($request->all());

        return redirect()->route('sewa-alat.edit', [$request->id, 'uuid' => $request->uuid]);
    }

}
