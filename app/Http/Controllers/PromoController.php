<?php

namespace App\Http\Controllers;

use App\DataTables\PromoDataTable;
use App\Enum\CategoryEnum;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PromoController extends Controller
{
    public function index(PromoDataTable $promoDataTable)
    {
        $breadcrumbs = [['url' => '', 'title' => 'Post'], ['url' => '', 'title' => 'promo']];

        return $promoDataTable->render('promo.index', compact('breadcrumbs'));
    }

    public function create()
    {
        $breadcrumbs = [['url' => '#', 'title' => 'Post'], ['url' => route('post.promo.index'), 'title' => 'promo'], ['url' => '#', 'title' => 'tambah']];

        return view('promo.create', compact('breadcrumbs'));
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
        $id = Post::create($request->all() + ['uuid' => $uuid, 'kategori_id' => CategoryEnum::PROMO]);

        return redirect()->route('post.promo.show', [$id, 'uuid' => $uuid]);
    }

    public function show(Post $promo)
    {
        checkUuid($promo->uuid);
        $breadcrumbs = [['url' => '#', 'title' => 'Post'], ['url' => route('post.promo.index'), 'title' => 'promo'], ['url' => '#', 'title' => 'preview']];

        return view('promo.show', compact('promo', 'breadcrumbs'));
    }

    public function edit(Post $promo)
    {
        checkUuid($promo->uuid);
        $breadcrumbs = [['url' => '#', 'title' => 'Post'], ['url' => route('post.promo.index'), 'title' => 'promo'], ['url' => '', 'title' => 'Edit']];

        return view('promo.edit', compact('promo', 'breadcrumbs'));
    }

    public function update(Request $request, Post $promo)
    {
        $request->validate([
            'gambar' => 'mimes:jpg,jpeg,png|max:1000',
            'judul' => 'required|max:250|unique:posts,judul,'.$promo->id,
            'published_at' => 'required_if:publish,ya',
            'meta_keywords' => 'max:250',
            'meta_description' => 'max:250',

        ]);

        $promo->update($request->all());

        return redirect()->route('post.promo.show', [$promo->id, 'uuid' => $promo->uuid]);
    }

    public function destroy(Post $promo)
    {
        checkUuid($promo->uuid);

        if ($promo->delete()) {
            return response()->json(['success' => true, 'redirect' => route('post.promo.index')]);
        }

        return response()->json(['message' => 'Gagal menghapus data'], 400);
    }
}
