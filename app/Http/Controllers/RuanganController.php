<?php

namespace App\Http\Controllers;

use App\DataTables\RuanganDataTable;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RuanganController extends Controller
{
    public function index(RuanganDataTable $dataTable)
    {
        $breadcrumbs = [['url' => route('post.pelayanan.index'), 'title' => 'pelayanan'], ['url' => '', 'title' => 'ruangan']];

        return $dataTable->render('ruangan.index', compact('breadcrumbs'));
    }

    public function create()
    {
        $breadcrumbs = [['url' => route('post.pelayanan.index'), 'title' => 'pelayanan'], ['url' => route('post.ruangan.index'), 'title' => 'ruangan'], ['url' => '#', 'title' => 'tambah']];

        return view('ruangan.create', compact('breadcrumbs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'icon' => 'mimes:png,gif,svg|max:1000',
            'gambar' => 'mimes:jpg,jpeg,png|max:1000',
            'nama' => 'required|max:250|unique:rooms',
            'meta_keywords' => 'max:250',
            'meta_description' => 'max:250',

        ]);

        $uuid = (string) Str::uuid();
        $id = Room::create($request->all() + ['uuid' => $uuid]);

        return redirect()->route('post.ruangan.show', [$id, 'uuid' => $uuid]);
    }

    public function show(Room $ruangan)
    {
        checkUuid($ruangan->uuid);
        $breadcrumbs = [['url' => route('post.pelayanan.index'), 'title' => 'pelayanan'], ['url' => route('post.ruangan.index'), 'title' => 'ruangan'], ['url' => '#', 'title' => 'preview']];

        return view('ruangan.show', compact('ruangan', 'breadcrumbs'));
    }

    public function edit(Room $ruangan)
    {
        checkUuid($ruangan->uuid);
        $breadcrumbs = [['url' => route('post.pelayanan.index'), 'title' => 'pelayanan'], ['url' => route('post.ruangan.index'), 'title' => 'ruangan'], ['url' => '', 'title' => 'Edit']];

        return view('ruangan.edit', compact('ruangan', 'breadcrumbs'));
    }

    public function update(Request $request, Room $ruangan)
    {
        $request->validate([
            'icon' => 'mimes:png,gif,svg|max:1000',
            'gambar' => 'mimes:jpg,jpeg,png|max:1000',
            'nama' => 'required|max:250|unique:rooms,nama,'.$ruangan->id,
            'meta_keywords' => 'max:250',
            'meta_description' => 'max:250',

        ]);

        $ruangan->update($request->all());

        return redirect()->route('post.ruangan.show', [$ruangan->id, 'uuid' => $ruangan->uuid]);
    }

    public function destroy(Room $ruangan)
    {
        checkUuid($ruangan->uuid);

        if ($ruangan->delete()) {
            return response()->json(['success' => true, 'redirect' => route('post.ruangan.index')]);
        }

        return response()->json(['message' => 'Gagal menghapus data'], 400);
    }
}
