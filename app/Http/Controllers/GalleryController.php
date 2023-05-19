<?php

namespace App\Http\Controllers;

use App\DataTables\GalleryDataTable;
use App\Enum\CategoryEnum;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GalleryController extends Controller
{
    public function index(GalleryDataTable $galleryDataTable)
    {
        $breadcrumbs = [['url' => '', 'title' => 'Post'], ['url' => '', 'title' => 'gallery']];

        return $galleryDataTable->render('gallery.index', compact('breadcrumbs'));
    }

    public function create()
    {
        $breadcrumbs = [['url' => '#', 'title' => 'Post'], ['url' => route('post.gallery.index'), 'title' => 'gallery'], ['url' => '#', 'title' => 'tambah']];

        return view('gallery.create', compact('breadcrumbs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'gambar' => 'required|mimes:jpg,jpeg,png|max:1000',
            'judul' => 'required|max:250|unique:posts',
            'meta_keywords' => 'max:250',
            'meta_description' => 'max:250',
            'published_at' => 'required_if:publish,ya',
        ]);

        $uuid = (string) Str::uuid();
        $id = Post::create($request->all() + ['uuid' => $uuid, 'kategori_id' => CategoryEnum::GALLERY]);

        return redirect()->route('post.gallery.show', [$id, 'uuid' => $uuid]);
    }

    public function show(Post $gallery)
    {
        checkUuid($gallery->uuid);
        $breadcrumbs = [['url' => '#', 'title' => 'Post'], ['url' => route('post.gallery.index'), 'title' => 'gallery'], ['url' => '#', 'title' => 'preview']];

        return view('gallery.show', compact('gallery', 'breadcrumbs'));
    }

    public function edit(Post $gallery)
    {
        checkUuid($gallery->uuid);
        $breadcrumbs = [['url' => '#', 'title' => 'Post'], ['url' => route('post.gallery.index'), 'title' => 'gallery'], ['url' => '', 'title' => 'Edit']];

        return view('gallery.edit', compact('gallery', 'breadcrumbs'));
    }

    public function update(Request $request, Post $gallery)
    {
        $request->validate([
            'gambar' => 'mimes:jpg,jpeg,png|max:1000',
            'judul' => 'required|max:250|unique:posts,judul,'.$gallery->id,
            'published_at' => 'required_if:publish,ya',
            'meta_keywords' => 'max:250',
            'meta_description' => 'max:250',
        ]);

        $gallery->update($request->all());

        return redirect()->route('post.gallery.show', [$gallery->id, 'uuid' => $gallery->uuid]);
    }

    public function destroy(Post $gallery)
    {
        checkUuid($gallery->uuid);

        if ($gallery->delete()) {
            return response()->json(['success' => true, 'redirect' => route('post.gallery.index')]);
        }

        return response()->json(['message' => 'Gagal menghapus data'], 400);
    }
}
