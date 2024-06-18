<?php

namespace App\Http\Controllers;

use App\DataTables\AlatDataTable;
use App\Models\Alat;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AlatController extends Controller
{
    public $title;

    public function __construct($title = '')
    {
        $this->title = 'Alat';
    }

    public function index(AlatDataTable $alatDatatable)
    {
        $title = $this->title;
        $breadcrumbs = [['url' => '', 'title' => $title]];

        return $alatDatatable->render('alat.index', compact('breadcrumbs', 'title'));
    }

    public function create()
    {
        $title = $this->title;
        $breadcrumbs = [['url' => route('alat.index'), 'title' => $title], ['url' => '#', 'title' => 'tambah']];

        return view('alat.create', compact('breadcrumbs', 'title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:250|unique:alat',
            'kode' => 'required|max:250|unique:alat',
            'jumlah' => 'required',
        ]);

        $uuid = (string) Str::uuid();
        $id = Alat::create($request->all() + ['uuid' => $uuid]);

        return redirect()->route('alat.show', [$id, 'uuid' => $uuid]);
    }

    public function show(Alat $alat)
    {
        checkUuid($alat->uuid);
        $title = $this->title;
        $breadcrumbs = [['url' => route('alat.index'), 'title' => $title], ['url' => '#', 'title' => 'preview']];

        return view('alat.show', compact('alat', 'breadcrumbs', 'title'));
    }

    public function edit(Alat $alat)
    {
        checkUuid($alat->uuid);
        $title = $this->title;
        $breadcrumbs = [['url' => route('alat.index'), 'title' => $title], ['url' => '', 'title' => 'Edit']];

        return view('alat.edit', compact('alat', 'title', 'breadcrumbs'));
    }

    public function update(Request $request, Alat $alat)
    {
        $request->validate([
            'nama' => 'required|max:250|unique:alat,nama,'.$alat->id,
            'kode' => 'required|max:250|unique:alat,kode,'.$alat->id,
            'jumlah' => 'required',

        ]);

        $alat->update($request->all());

        return redirect()->route('alat.show', [$alat->id, 'uuid' => $alat->uuid]);
    }

    public function destroy(Alat $alat)
    {
        checkUuid($alat->uuid);

        if ($alat->delete()) {
            return response()->json(['success' => true, 'redirect' => route('alat.index')]);
        }

        return response()->json(['message' => 'Gagal menghapus data'], 400);
    }
}
