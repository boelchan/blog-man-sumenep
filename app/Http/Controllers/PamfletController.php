<?php

namespace App\Http\Controllers;

use App\DataTables\PamfletDataTable;
use App\Enum\CategoryEnum;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PamfletController extends Controller
{
    public function index(PamfletDataTable $dataTable)
    {
        $breadcrumbs = [['url' => '', 'title' => 'Post'], ['url' => '', 'title' => 'pamflet']];

        return $dataTable->render('pamflet.index', compact('breadcrumbs'));
    }

    public function create()
    {
        $breadcrumbs = [['url' => '#', 'title' => 'Post'], ['url' => route('post.pamflet.index'), 'title' => 'pamflet'], ['url' => '#', 'title' => 'tambah']];

        return view('pamflet.create', compact('breadcrumbs'));
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
        $id = Post::create($request->all() + ['uuid' => $uuid, 'kategori_id' => CategoryEnum::PAMFLET]);

        return redirect()->route('post.pamflet.show', [$id, 'uuid' => $uuid]);
    }

    public function show(Post $pamflet)
    {
        checkUuid($pamflet->uuid);
        $breadcrumbs = [['url' => '#', 'title' => 'Post'], ['url' => route('post.pamflet.index'), 'title' => 'pamflet'], ['url' => '#', 'title' => 'preview']];

        return view('pamflet.show', compact('pamflet', 'breadcrumbs'));
    }

    public function edit(Post $pamflet)
    {
        checkUuid($pamflet->uuid);
        $breadcrumbs = [['url' => '#', 'title' => 'Post'], ['url' => route('post.pamflet.index'), 'title' => 'pamflet'], ['url' => '', 'title' => 'Edit']];

        return view('pamflet.edit', compact('pamflet', 'breadcrumbs'));
    }

    public function update(Request $request, Post $pamflet)
    {
        checkUuid($pamflet->uuid);

        $request->validate([
            'gambar' => 'mimes:jpg,jpeg,png|max:1000',
            'judul' => 'required|max:250|unique:posts,judul,'.$pamflet->id,
            'published_at' => 'required_if:publish,ya',
            'meta_keywords' => 'max:250',
            'meta_description' => 'max:250',
        ]);

        $pamflet->update($request->all());

        return redirect()->route('post.pamflet.show', [$pamflet->id, 'uuid' => $pamflet->uuid]);
    }

    public function destroy(Post $pamflet)
    {
        checkUuid($pamflet->uuid);

        if ($pamflet->delete()) {
            return response()->json(['success' => true, 'redirect' => route('post.pamflet.index')]);
        }

        return response()->json(['message' => 'Gagal menghapus data'], 400);
    }
}
