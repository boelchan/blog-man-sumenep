<?php

namespace App\Http\Controllers;

use App\DataTables\PoliDataTable;
use App\Models\Poly;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PoliController extends Controller
{
    public function index(PoliDataTable $dataTable)
    {
        $breadcrumbs = [['url' => route('post.pelayanan.index'), 'title' => 'pelayanan'], ['url' => '', 'title' => 'rawat jalan']];

        return $dataTable->render('poli.index', compact('breadcrumbs'));
    }

    public function create()
    {
        $breadcrumbs = [['url' => route('post.pelayanan.index'), 'title' => 'pelayanan'], ['url' => route('post.poli.index'), 'title' => 'poli'], ['url' => '#', 'title' => 'tambah']];

        return view('poli.create', compact('breadcrumbs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'icon' => 'mimes:png,gif,svg|max:1000',
            'gambar' => 'mimes:jpg,jpeg,png|max:1000',
            'nama' => 'required|max:250|unique:polies',
            'meta_keywords' => 'max:250',
            'meta_description' => 'max:250',

        ]);

        $uuid = (string) Str::uuid();
        $id = Poly::create($request->all() + ['uuid' => $uuid]);

        return redirect()->route('post.poli.show', [$id, 'uuid' => $uuid]);
    }

    public function show(Poly $poli)
    {
        checkUuid($poli->uuid);
        $breadcrumbs = [['url' => route('post.pelayanan.index'), 'title' => 'pelayanan'], ['url' => route('post.poli.index'), 'title' => 'poli'], ['url' => '#', 'title' => 'preview']];

        return view('poli.show', compact('poli', 'breadcrumbs'));
    }

    public function edit(Poly $poli)
    {
        checkUuid($poli->uuid);
        $breadcrumbs = [['url' => route('post.pelayanan.index'), 'title' => 'pelayanan'], ['url' => route('post.poli.index'), 'title' => 'poli'], ['url' => '', 'title' => 'Edit']];

        return view('poli.edit', compact('poli', 'breadcrumbs'));
    }

    public function update(Request $request, Poly $poli)
    {
        $request->validate([
            'icon' => 'mimes:png,gif,svg|max:1000',
            'gambar' => 'mimes:jpg,jpeg,png|max:1000',
            'nama' => 'required|max:250|unique:polies,nama,'.$poli->id,
            'meta_keywords' => 'max:250',
            'meta_description' => 'max:250',

        ]);

        $poli->update($request->all());

        return redirect()->route('post.poli.show', [$poli->id, 'uuid' => $poli->uuid]);
    }

    public function destroy(Poly $poli)
    {
        checkUuid($poli->uuid);

        if ($poli->delete()) {
            return response()->json(['success' => true, 'redirect' => route('post.poli.index')]);
        }

        return response()->json(['message' => 'Gagal menghapus data'], 400);
    }
}
