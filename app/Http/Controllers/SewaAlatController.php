<?php

namespace App\Http\Controllers;

use App\DataTables\ServiceDataTable;
use App\Models\Alat;
use App\Models\Service;
use App\Models\SewaAlat;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SewaAlatController extends Controller
{
    public $title;

    public function __construct($title = '')
    {
        $this->title = 'Sewa Alat';
    }

    public function index(ServiceDataTable $serviceDatatable)
    {
        $title = $this->title;
        $breadcrumbs = [['url' => '', 'title' => $title]];

        return $serviceDatatable->render('sewa-alat.index', compact('breadcrumbs', 'title'));
    }

    public function create()
    {
        $title = $this->title;
        $breadcrumbs = [['url' => route('sewa-alat.index'), 'title' => $title], ['url' => '#', 'title' => 'tambah']];
        $siswa = Siswa::select('id', DB::raw("CONCAT(kode,' - ',nama, ' - ', kelas) as full_name"))->pluck('full_name', 'id')->all();

        return view('sewa-alat.create', compact('breadcrumbs', 'title', 'siswa'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required',
            'tanggal_sewa' => 'required',
            'tanggal_kembali' => 'required',
        ]);

        $uuid = (string) Str::uuid();
        $id = SewaAlat::create($request->all() + ['uuid' => $uuid]);

        return redirect()->route('sewa-alat.edit', [$id, 'uuid' => $uuid]);
    }

    public function show(Service $service)
    {
        checkUuid($service->uuid);
        $title = $this->title;
        $breadcrumbs = [['url' => route('sewa-alat.index'), 'title' => $title], ['url' => '#', 'title' => 'preview']];

        return view('sewa-alat.show', compact('service', 'breadcrumbs', 'title'));
    }

    public function edit(SewaAlat $sewaAlat)
    {
        checkUuid($sewaAlat->uuid);
        $title = $this->title;
        $breadcrumbs = [['url' => route('sewa-alat.index'), 'title' => $title], ['url' => '', 'title' => 'Edit']];
        $siswa = Siswa::select('id', DB::raw("CONCAT(kode,' - ',nama, ' - ', kelas) as full_name"))->pluck('full_name', 'id')->all();
        $alat = Alat::select('id', DB::raw("CONCAT(kode,' - ',nama) as full_name"))->pluck('full_name', 'id')->all();

        return view('sewa-alat.edit', compact('sewaAlat', 'title', 'breadcrumbs', 'siswa', 'alat'));
    }

    public function update(Request $request, Service $service)
    {
        $request->validate([
            'icon' => 'mimes:jpg,jpeg,png,gif|max:1000',
            'nama' => 'required|max:250|unique:services,nama,'.$service->id,
            'meta_keywords' => 'max:250',
            'meta_description' => 'max:250',
        ]);

        $service->update($request->all());

        return redirect()->route('sewa-alat.show', [$service->id, 'uuid' => $service->uuid]);
    }

    public function destroy(Service $service)
    {
        checkUuid($service->uuid);

        if ($service->delete()) {
            return response()->json(['success' => true, 'redirect' => route('sewa-alat.index')]);
        }

        return response()->json(['message' => 'Gagal menghapus data'], 400);
    }
}
