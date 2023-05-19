<?php

namespace App\Http\Controllers;

use App\DataTables\PelayananDataTable;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PelayananController extends Controller
{
    public function index(PelayananDataTable $pelayananDataTable)
    {
        $breadcrumbs = [['url' => '', 'title' => 'Post'], ['url' => '', 'title' => 'pelayanan']];

        return $pelayananDataTable->render('pelayanan.index', compact('breadcrumbs'));
    }

    public function create()
    {
        $breadcrumbs = [['url' => '#', 'title' => 'Post'], ['url' => route('post.pelayanan.index'), 'title' => 'pelayanan'], ['url' => '#', 'title' => 'tambah']];

        return view('pelayanan.create', compact('breadcrumbs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'icon' => 'mimes:png,gif,svg|max:1000',
            'gambar' => 'mimes:jpg,jpeg,png|max:1000',
            'nama' => 'required|max:250|unique:services',
            'meta_keywords' => 'max:250',
            'meta_description' => 'max:250',
        ]);

        $uuid = (string) Str::uuid();
        $id = Service::create($request->all() + ['uuid' => $uuid]);

        return redirect()->route('post.pelayanan.show', [$id, 'uuid' => $uuid]);
    }

    public function show(Service $pelayanan)
    {
        checkUuid($pelayanan->uuid);
        $breadcrumbs = [['url' => '#', 'title' => 'Post'], ['url' => route('post.pelayanan.index'), 'title' => 'pelayanan'], ['url' => '#', 'title' => 'preview']];

        return view('pelayanan.show', compact('pelayanan', 'breadcrumbs'));
    }

    public function edit(Service $pelayanan)
    {
        checkUuid($pelayanan->uuid);
        $breadcrumbs = [['url' => '#', 'title' => 'Post'], ['url' => route('post.pelayanan.index'), 'title' => 'pelayanan'], ['url' => '', 'title' => 'Edit']];

        return view('pelayanan.edit', compact('pelayanan', 'breadcrumbs'));
    }

    public function update(Request $request, Service $pelayanan)
    {
        $request->validate([
            'icon' => 'mimes:png,gif,svg|max:1000',
            'gambar' => 'mimes:jpg,jpeg,png|max:1000',
            'nama' => 'required|max:250|unique:services,nama,'.$pelayanan->id,
            'meta_keywords' => 'max:250',
            'meta_description' => 'max:250',
        ]);

        $pelayanan->update($request->all());

        return redirect()->route('post.pelayanan.show', [$pelayanan->id, 'uuid' => $pelayanan->uuid]);
    }

    public function destroy(Service $pelayanan)
    {
        checkUuid($pelayanan->uuid);
        if (in_array($pelayanan->id, [1, 2])) {
            return response()->json(['message' => 'Data tidak dapat dihapus'], 400);
        }

        if ($pelayanan->delete()) {
            return response()->json(['success' => true, 'redirect' => route('post.pelayanan.index')]);
        }

        return response()->json(['message' => 'Gagal menghapus data'], 400);
    }
}
