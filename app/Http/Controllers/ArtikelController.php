<?php

namespace App\Http\Controllers;

use App\DataTables\ArtikelDataTable;
use App\Enum\CategoryEnum;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArtikelController extends Controller
{
    public function index(ArtikelDataTable $artikelDataTable)
    {
        $breadcrumbs = [['url' => '', 'title' => 'Post'], ['url' => '', 'title' => 'artikel']];

        return $artikelDataTable->render('artikel.index', compact('breadcrumbs'));
    }

    public function create()
    {
        $breadcrumbs = [['url' => '#', 'title' => 'Post'], ['url' => route('post.artikel.index'), 'title' => 'artikel'], ['url' => '#', 'title' => 'tambah']];

        return view('artikel.create', compact('breadcrumbs'));
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
        $id = Post::create($request->all() + ['uuid' => $uuid, 'kategori_id' => CategoryEnum::ARTIKEL]);

        return redirect()->route('post.artikel.show', [$id, 'uuid' => $uuid]);
    }

    public function show(Post $artikel)
    {
        checkUuid($artikel->uuid);
        $breadcrumbs = [['url' => '#', 'title' => 'Post'], ['url' => route('post.artikel.index'), 'title' => 'artikel'], ['url' => '#', 'title' => 'preview']];

        return view('artikel.show', compact('artikel', 'breadcrumbs'));
    }

    public function edit(Post $artikel)
    {
        checkUuid($artikel->uuid);
        $breadcrumbs = [['url' => '#', 'title' => 'Post'], ['url' => route('post.artikel.index'), 'title' => 'artikel'], ['url' => '', 'title' => 'Edit']];

        return view('artikel.edit', compact('artikel', 'breadcrumbs'));
    }

    public function update(Request $request, Post $artikel)
    {
        $request->validate([
            'gambar' => 'mimes:jpg,jpeg,png|max:1000',
            'judul' => 'required|max:250|unique:posts,judul,'.$artikel->id,
            'published_at' => 'required_if:publish,ya',
            'meta_keywords' => 'max:250',
            'meta_description' => 'max:250',
        ]);

        $artikel->update($request->all());

        return redirect()->route('post.artikel.show', [$artikel->id, 'uuid' => $artikel->uuid]);
    }

    public function destroy(Post $artikel)
    {
        checkUuid($artikel->uuid);

        if ($artikel->delete()) {
            return response()->json(['success' => true, 'redirect' => route('post.artikel.index')]);
        }

        return response()->json(['message' => 'Gagal menghapus data'], 400);
    }
}
