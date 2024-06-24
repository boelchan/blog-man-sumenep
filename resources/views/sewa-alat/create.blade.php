@extends('layouts.app')

@section('title', $title)
@section('sub-title', 'Tambah')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Tambah</h3>
                    </div>
                    <div class="card-body">
                        <x-form :action="route('sewa-alat.store')">
                            <div class="row">
                                <div class="col-md-12">
                                    <x-form-input type="date" name="tanggal_sewa" label="Tanggal Sewa" class="mb-2 h-auto" rows="3" />
                                    <x-form-input type="date" name="tanggal_kembali" label="Tanggal kembali" class="mb-2 h-auto" rows="3" />
                                    <x-form-select name="siswa_id" label="Siswa" :options="$siswa" class="mb-2 h-auto" rows="3" />
                                </div>
                                <x-form-submit class="mt-3">Lanjut</x-form-submit>
                            </div>
                        </x-form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
