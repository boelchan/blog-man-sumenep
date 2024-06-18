<?php

namespace App\Http\Controllers;

use App\DataTables\SiswaDataTable;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SiswaController extends Controller
{
    public $title;

    public function __construct($title = '')
    {
        $this->title = 'Siswa';
    }

    public function index(SiswaDataTable $siswaDataTable)
    {
        $title = $this->title;
        $breadcrumbs = [['url' => '', 'title' => $title]];

        return $siswaDataTable->render('siswa.index', compact('breadcrumbs', 'title'));
    }

    public function create()
    {
        $title = $this->title;
        $breadcrumbs = [['url' => route('siswa.index'), 'title' => $title], ['url' => '#', 'title' => 'tambah']];

        return view('siswa.create', compact('breadcrumbs', 'title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|max:250|unique:siswa',
            'nama' => 'required',
            'kelas' => 'required',
        ]);

        $uuid = (string) Str::uuid();
        $id = Siswa::create($request->all() + ['uuid' => $uuid]);

        return redirect()->route('siswa.show', [$id, 'uuid' => $uuid]);
    }

    public function show(Siswa $siswa)
    {
        checkUuid($siswa->uuid);
        $title = $this->title;
        $breadcrumbs = [['url' => route('siswa.index'), 'title' => $title], ['url' => '#', 'title' => 'preview']];

        return view('siswa.show', compact('siswa', 'breadcrumbs', 'title'));
    }

    public function edit(Siswa $siswa)
    {
        checkUuid($siswa->uuid);
        $title = $this->title;
        $breadcrumbs = [['url' => route('siswa.index'), 'title' => $title], ['url' => '', 'title' => 'Edit']];

        return view('siswa.edit', compact('siswa', 'title', 'breadcrumbs'));
    }

    public function update(Request $request, Siswa $siswa)
    {
        $request->validate([
            'kode' => 'required|max:250|unique:siswa,kode,'.$siswa->id,
            'nama' => 'required',
            'kelas' => 'required',

        ]);

        $siswa->update($request->all());

        return redirect()->route('siswa.show', [$siswa->id, 'uuid' => $siswa->uuid]);
    }

    public function destroy(Siswa $siswa)
    {
        checkUuid($siswa->uuid);

        if ($siswa->delete()) {
            return response()->json(['success' => true, 'redirect' => route('siswa.index')]);
        }

        return response()->json(['message' => 'Gagal menghapus data'], 400);
    }
}
