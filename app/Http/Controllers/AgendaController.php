<?php

namespace App\Http\Controllers;

use App\DataTables\AgendaDataTable;
use App\Enum\CategoryEnum;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AgendaController extends Controller
{
    public function index(AgendaDataTable $agendaDataTable)
    {
        $breadcrumbs = [['url' => '', 'title' => 'Post'], ['url' => '', 'title' => 'Agenda']];

        return $agendaDataTable->render('agenda.index', compact('breadcrumbs'));
    }

    public function create()
    {
        $breadcrumbs = [['url' => '#', 'title' => 'Post'], ['url' => route('post.agenda.index'), 'title' => 'Agenda'], ['url' => '#', 'title' => 'tambah']];

        return view('agenda.create', compact('breadcrumbs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'gambar' => 'required|mimes:jpg,jpeg,png|max:1000',
            'judul' => 'required|max:250|unique:posts',
            'tanggal' => 'required|date',
            'published_at' => 'required_if:publish,ya',
            'meta_keywords' => 'max:250',
            'meta_description' => 'max:250',
        ]);

        $uuid = (string) Str::uuid();
        $id = Post::create($request->all() + ['uuid' => $uuid, 'kategori_id' => CategoryEnum::AGENDA]);

        return redirect()->route('post.agenda.show', [$id, 'uuid' => $uuid]);
    }

    public function show(Post $agenda)
    {
        checkUuid($agenda->uuid);
        $breadcrumbs = [['url' => '#', 'title' => 'Post'], ['url' => route('post.agenda.index'), 'title' => 'Agenda'], ['url' => '#', 'title' => 'preview']];

        return view('agenda.show', compact('agenda', 'breadcrumbs'));
    }

    public function edit(Post $agenda)
    {
        checkUuid($agenda->uuid);
        $breadcrumbs = [['url' => '#', 'title' => 'Post'], ['url' => route('post.agenda.index'), 'title' => 'Agenda'], ['url' => '', 'title' => 'Edit']];

        return view('agenda.edit', compact('agenda', 'breadcrumbs'));
    }

    public function update(Request $request, Post $agenda)
    {
        checkUuid($agenda->uuid);

        $request->validate([
            'gambar' => 'mimes:jpg,jpeg,png|max:1000',
            'judul' => 'required|max:250|unique:posts,judul,'.$agenda->id,
            'tanggal' => 'required|date',
            'published_at' => 'required_if:publish,ya',
            'meta_keywords' => 'max:250',
            'meta_description' => 'max:250',
        ]);

        $agenda->update($request->all());

        return redirect()->route('post.agenda.show', [$agenda->id, 'uuid' => $agenda->uuid]);
    }

    public function destroy(Post $agenda)
    {
        checkUuid($agenda->uuid);

        if ($agenda->delete()) {
            return response()->json(['success' => true, 'redirect' => route('post.agenda.index')]);
        }

        return response()->json(['message' => 'Gagal menghapus data'], 400);
    }
}
