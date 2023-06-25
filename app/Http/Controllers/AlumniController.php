<?php

namespace App\Http\Controllers;

use App\DataTables\AlumniDataTable;
use App\Models\Alumni;
use Illuminate\Http\Request;

class AlumniController extends Controller
{
    public $title;

    public function __construct($title = '')
    {
        $this->title = 'Alumni';
    }

    public function index(AlumniDataTable $alumniDatatable)
    {
        $title = $this->title;
        $breadcrumbs = [['url' => '', 'title' => $title]];

        return $alumniDatatable->render('alumni.index', compact('breadcrumbs', 'title'));
    }

    public function create()
    {
        $title = $this->title;
        $breadcrumbs = [['url' => route('alumni.index'), 'title' => $title], ['url' => '#', 'title' => 'tambah']];

        return view('alumni.create', compact('breadcrumbs', 'title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'foto' => 'mimes:jpg,jpeg,png|max:1000|required',
            'nama' => 'required|max:250',
            'tahun_lulus' => 'required',
            'jurusan' => 'required',
            'domisili' => 'required',
        ]);

        $id = Alumni::create($request->all());

        return redirect()->route('alumni.show', $id);
    }

    public function show(Alumni $alumnus)
    {
        $title = $this->title;
        $breadcrumbs = [['url' => route('alumni.index'), 'title' => $title], ['url' => '#', 'title' => 'preview']];

        return view('alumni.show', compact('alumnus', 'breadcrumbs', 'title'));
    }

    public function edit(Alumni $alumnus)
    {
        $title = $this->title;
        $breadcrumbs = [['url' => route('alumni.index'), 'title' => $title], ['url' => '', 'title' => 'Edit']];

        return view('alumni.edit', compact('alumnus', 'title', 'breadcrumbs'));
    }

    public function update(Request $request, Alumni $alumnus)
    {
        $request->validate([
            'foto' => 'mimes:jpg,jpeg,png|max:1000',
            'nama' => 'required|max:250',
            'tahun_lulus' => 'required',
            'jurusan' => 'required',
            'domisili' => 'required',
        ]);

        $alumnus->update($request->all());

        return redirect()->route('alumni.show', $alumnus->id);
    }

    public function destroy(Alumni $alumnus)
    {
        if ($alumnus->delete()) {
            return response()->json(['success' => true, 'redirect' => route('alumni.index')]);
        }

        return response()->json(['message' => 'Gagal menghapus data'], 400);
    }
}
