<?php

namespace App\Http\Controllers;

use App\DataTables\BannerDataTable;
use App\Enum\CategoryEnum;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BannerController extends Controller
{
    public function index(BannerDataTable $dataTable)
    {
        $breadcrumbs = [['url' => '', 'title' => 'Post'], ['url' => '', 'title' => 'banner']];

        return $dataTable->render('banner.index', compact('breadcrumbs'));
    }

    public function create()
    {
        $breadcrumbs = [['url' => '#', 'title' => 'Post'], ['url' => route('post.banner.index'), 'title' => 'banner'], ['url' => '#', 'title' => 'tambah']];

        return view('banner.create', compact('breadcrumbs'));
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
        $id = Post::create($request->all() + ['uuid' => $uuid, 'kategori_id' => CategoryEnum::BANNER]);

        return redirect()->route('post.banner.show', [$id, 'uuid' => $uuid]);
    }

    public function show(Post $banner)
    {
        checkUuid($banner->uuid);
        $breadcrumbs = [['url' => '#', 'title' => 'Post'], ['url' => route('post.banner.index'), 'title' => 'banner'], ['url' => '#', 'title' => 'preview']];

        return view('banner.show', compact('banner', 'breadcrumbs'));
    }

    public function edit(Post $banner)
    {
        checkUuid($banner->uuid);
        $breadcrumbs = [['url' => '#', 'title' => 'Post'], ['url' => route('post.banner.index'), 'title' => 'banner'], ['url' => '', 'title' => 'Edit']];

        return view('banner.edit', compact('banner', 'breadcrumbs'));
    }

    public function update(Request $request, Post $banner)
    {
        checkUuid($banner->uuid);

        $request->validate([
            'gambar' => 'mimes:jpg,jpeg,png|max:1000',
            'judul' => 'required|max:250|unique:posts,judul,'.$banner->id,
            'published_at' => 'required_if:publish,ya',
            'meta_keywords' => 'max:250',
            'meta_description' => 'max:250',
        ]);

        $banner->update($request->all());

        return redirect()->route('post.banner.show', [$banner->id, 'uuid' => $banner->uuid]);
    }

    public function destroy(Post $banner)
    {
        checkUuid($banner->uuid);

        if ($banner->delete()) {
            return response()->json(['success' => true, 'redirect' => route('post.banner.index')]);
        }

        return response()->json(['message' => 'Gagal menghapus data'], 400);
    }
}
