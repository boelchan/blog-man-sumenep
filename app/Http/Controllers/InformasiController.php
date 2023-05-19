<?php

namespace App\Http\Controllers;

use App\DataTables\InformasiDataTable;
use App\Enum\CategoryEnum;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class InformasiController extends Controller
{
    public function index(InformasiDataTable $informasiDataTable)
    {
        $breadcrumbs = [['url' => '', 'title' => 'Post'], ['url' => '', 'title' => 'informasi']];

        return $informasiDataTable->render('informasi.index', compact('breadcrumbs'));
    }

    public function create()
    {
        $breadcrumbs = [['url' => '#', 'title' => 'Post'], ['url' => route('post.informasi.index'), 'title' => 'informasi'], ['url' => '#', 'title' => 'tambah']];

        return view('informasi.create', compact('breadcrumbs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'gambar' => 'required|mimes:jpg,jpeg,png|max:1000',
            'judul' => 'required|max:250|unique:posts',
            'published_at' => 'required_if:publish,ya',
            'meta_keywords' => 'max:250',
            'meta_description' => 'max:250',
        ]);

        $uuid = (string) Str::uuid();
        $id = Post::create($request->all() + ['uuid' => $uuid, 'kategori_id' => CategoryEnum::INFORMASI]);

        return redirect()->route('post.informasi.show', [$id, 'uuid' => $uuid]);
    }

    public function show(Post $informasi)
    {
        checkUuid($informasi->uuid);
        $breadcrumbs = [['url' => '#', 'title' => 'Post'], ['url' => route('post.informasi.index'), 'title' => 'informasi'], ['url' => '#', 'title' => 'preview']];

        return view('informasi.show', compact('informasi', 'breadcrumbs'));
    }

    public function edit(Post $informasi)
    {
        checkUuid($informasi->uuid);
        $breadcrumbs = [['url' => '#', 'title' => 'Post'], ['url' => route('post.informasi.index'), 'title' => 'informasi'], ['url' => '', 'title' => 'Edit']];

        return view('informasi.edit', compact('informasi', 'breadcrumbs'));
    }

    public function update(Request $request, Post $informasi)
    {
        $request->validate([
            'gambar' => 'mimes:jpg,jpeg,png|max:1000',
            'judul' => 'required|max:250|unique:posts,judul,'.$informasi->id,
            'published_at' => 'required_if:publish,ya',
            'meta_keywords' => 'max:250',
            'meta_description' => 'max:250',
        ]);

        $informasi->update($request->all());

        return redirect()->route('post.informasi.show', [$informasi->id, 'uuid' => $informasi->uuid]);
    }

    public function destroy(Post $informasi)
    {
        checkUuid($informasi->uuid);

        if ($informasi->delete()) {
            return response()->json(['success' => true, 'redirect' => route('post.informasi.index')]);
        }

        return response()->json(['message' => 'Gagal menghapus data'], 400);
    }
}
