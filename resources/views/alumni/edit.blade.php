@extends('layouts.app')

@section('title', $title)
@section('sub-title', 'Edit')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Edit</h3>
                    </div>
                    <div class="card-body">
                        <x-form :action="route('alumni.update', $alumnus->id)" method="PATCH" enctype="multipart/form-data">
                            <div class="row">
                                @bind($alumnus)
                                    <div class="col-md-12">
                                        <div class="form-group mb-2">
                                            <label for="">Foto *</label>
                                            <img id="output" src="{{ $alumnus->foto_url }}" class="img-fluid rounded">
                                            <x-form-input name="foto" id="foto" type="file" accept="image/*" onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])" />
                                        </div>
                                        <x-form-input type="number" name="tahun_lulus" label="Tahun Lulus  *" class="mb-2 h-auto" />
                                        <x-form-input name="jurusan" label="Jurusan *" class="mb-2 h-auto" />
                                        <x-form-input name="nama" label="Nama lengkap *" class="mb-2 h-auto" />
                                        <x-form-textarea name="domisili" label="Alamat Domisili *" class="mb-2 h-auto" />
                                        <x-form-input name="pekerjaan" label="Pekerjaan" class="mb-2 h-auto" />
                                        <x-form-input name="no_hp" label="No HP/WA" class="mb-2 h-auto" />
                                        <x-form-input type="email" name="email" label="Email" class="mb-2 h-auto" />

                                        <x-form-group name="approved" label="Approved" inline class="mb-2">
                                            <x-form-radio name="approved" value="yes" label="Ya" />
                                            <x-form-radio name="approved" value="no" label="Tidak" />
                                        </x-form-group>
                                    </div>
                                @endbind
                                <x-form-submit class="mt-3">Simpan</x-form-submit>
                            </div>
                        </x-form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
