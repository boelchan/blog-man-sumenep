@extends('layouts.app')

@section('title', $title)
@section('sub-title', 'Edit')

@section('content')
    <div class="container">
        <div class="row justify-content-center row-cards">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Edit Data</h3>
                        </div>
                        <div class="card-body">
                            <x-form :action="route('sewa-alat.update', [$sewaAlat->id, 'uuid' => $sewaAlat->uuid])" method="PATCH" enctype="multipart/form-data">
                                <div class="row">
                                    @bind($sewaAlat)
                                        <x-form-input type="date" name="tanggal_sewa" label="Tanggal Sewa" class="mb-2 h-auto" rows="3" />
                                        <x-form-input type="date" name="tanggal_kembali" label="Tanggal kembali" class="mb-2 h-auto" rows="3" />
                                        <x-form-select name="siswa_id" label="Siswa" :options="$siswa" class="mb-2 h-auto" rows="3" />
                                    @endbind
                                </div>

                                <x-form-submit class="mt-3">Simpan dan Selesai</x-form-submit>
                            </x-form>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Daftar Alat</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-sm table-bordered">
                                <thead>
                                    <x-form :action="route('sewa-alat-detail.store')" id="form-tambah-item">
                                        @form_hidden('sewa_alat_id', $sewaAlat->id)
                                        @form_hidden('uuid', $sewaAlat->uuid)
                                        <tr>
                                            <td colspan="2">
                                                <x-form-select name="alat_id" label="Alat" :options="$alat" class="mb-2 h-auto" rows="3" />
                                            </td>
                                            <td>
                                                <x-form-input type="number" name="jumlah" label="Jumlah" class="mb-2 h-auto" rows="3" />
                                            </td>
                                            <td>
                                                <x-form-submit class="mt-3">Tambah</x-form-submit>
                                            </td>
                                        </tr>
                                    </x-form>
                                </thead>
                                <tbody>
                                    @foreach ($sewaAlat->listAlat as $list)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $list->alat->nama }}</td>
                                            <td>{{ $list->jumlah }}</td>
                                            <td>
                                                <button class="btn btn-sm btn-ghost-danger btn-icon me-1 fs-3"><i class="ti ti-trash"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
            </div>
        </div>
    </div>
@endsection
