<?php

namespace App\Http\Controllers;

use App\DataTables\PostDatatable;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index(PostDatatable $postDatatable)
    {
        $breadcrumbs = [['url' => '', 'title' => 'Post']];

        return $postDatatable->render('post.index', compact('breadcrumbs'));
    }

    public function create()
    {
        $breadcrumbs = [['url' => route('post.index'), 'title' => 'post'], ['url' => '#', 'title' => 'tambah']];
        $kategoriOption = Category::pluck('nama', 'id')->all();

        return view('post.create', compact('breadcrumbs', 'kategoriOption'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'gambar' => 'mimes:jpg,jpeg,png|max:1000',
            'kategori_id' => 'required',
            'judul' => 'required|max:250|unique:posts',
            'publish_at' => 'required_if:publish,ya',
            'meta_keywords' => 'max:250',
            'meta_description' => 'max:250',
        ]);

        $uuid = (string) Str::uuid();
        $id = Post::create($request->all() + ['uuid' => $uuid]);

        return redirect()->route('post.show', [$id, 'uuid' => $uuid]);
    }

    public function show(Post $post)
    {
        checkUuid($post->uuid);
        $breadcrumbs = [['url' => route('post.index'), 'title' => 'Post'], ['url' => '#', 'title' => 'preview']];

        return view('post.show', compact('post', 'breadcrumbs'));
    }

    public function edit(Post $post)
    {
        checkUuid($post->uuid);
        $breadcrumbs = [['url' => route('post.index'), 'title' => 'post'], ['url' => '', 'title' => 'Edit']];
        $kategoriOption = Category::pluck('nama', 'id')->all();

        return view('post.edit', compact('post', 'breadcrumbs', 'kategoriOption'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'gambar' => 'mimes:jpg,jpeg,png|max:1000',
            'judul' => 'required|max:250|unique:posts,judul,'.$post->id,
            'publish_at' => 'required_if:publish,ya',
            'meta_keywords' => 'max:250',
            'meta_description' => 'max:250',
        ]);

        $post->update($request->all());

        return redirect()->route('post.show', [$post->id, 'uuid' => $post->uuid]);
    }

    public function destroy(Post $post)
    {
        checkUuid($post->uuid);

        if ($post->delete()) {
            return response()->json(['success' => true, 'redirect' => route('post.index')]);
        }

        return response()->json(['message' => 'Gagal menghapus data'], 400);
    }
}
