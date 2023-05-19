<?php

namespace App\Http\Controllers;

use App\DataTables\ProfilDataTable;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProfilController extends Controller
{
    public function index(ProfilDataTable $profilDataTable)
    {
        $breadcrumbs = [['url' => '', 'title' => 'Post'], ['url' => '', 'title' => 'profil']];

        return $profilDataTable->render('profil.index', compact('breadcrumbs'));
    }

    public function create()
    {
        $breadcrumbs = [['url' => '#', 'title' => 'Post'], ['url' => route('post.profil.index'), 'title' => 'profil'], ['url' => '#', 'title' => 'tambah']];

        return view('profil.create', compact('breadcrumbs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'gambar' => 'mimes:jpg,jpeg,png|max:1000',
            'nama' => 'required|max:250|unique:profiles',
            'meta_keywords' => 'max:250',
            'meta_description' => 'max:250',
        ]);

        $uuid = (string) Str::uuid();
        $id = Profile::create($request->all() + ['uuid' => $uuid]);

        return redirect()->route('post.profil.show', [$id, 'uuid' => $uuid]);
    }

    public function show(Profile $profil)
    {
        checkUuid($profil->uuid);
        $breadcrumbs = [['url' => '#', 'title' => 'Post'], ['url' => route('post.profil.index'), 'title' => 'profil'], ['url' => '#', 'title' => 'preview']];

        return view('profil.show', compact('profil', 'breadcrumbs'));
    }

    public function edit(Profile $profil)
    {
        checkUuid($profil->uuid);
        $breadcrumbs = [['url' => '#', 'title' => 'Post'], ['url' => route('post.profil.index'), 'title' => 'profil'], ['url' => '', 'title' => 'Edit']];

        return view('profil.edit', compact('profil', 'breadcrumbs'));
    }

    public function update(Request $request, Profile $profil)
    {
        $request->validate([
            'gambar' => 'mimes:jpg,jpeg,png|max:1000',
            'nama' => 'required|max:250|unique:profiles,nama,'.$profil->id,
            'meta_keywords' => 'max:250',
            'meta_description' => 'max:250',

        ]);

        $profil->update($request->all());

        return redirect()->route('post.profil.show', [$profil->id, 'uuid' => $profil->uuid]);
    }

    public function destroy(Profile $profil)
    {
        checkUuid($profil->uuid);

        if ($profil->id == 3) {
            return response()->json(['message' => 'Data tidak dapat dihapus'], 400);
        }

        if ($profil->delete()) {
            return response()->json(['success' => true, 'redirect' => route('post.profil.index')]);
        }

        return response()->json(['message' => 'Gagal menghapus data'], 400);
    }
}
