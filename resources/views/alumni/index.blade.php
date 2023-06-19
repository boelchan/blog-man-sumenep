@extends('layouts.app')

@section('title', $title)

@section('content')
    <div class="container">
        <div class="col-md-12">

            <x-datatable.filter target='alumni-table' collapsed="true">
                <div class="col-md-3">
                    <x-form-input type="number" name="tahun_lulus" label="Tahun Lulus" floating />
                </div>
                <div class="col-md-3">
                    <x-form-select name="jurusan" label="Jurusan" :options="['' => 'Semua', 'ipa' => 'IPA', 'ips' => 'IPS', 'bahasa' => 'Bahasa']" floating />
                </div>
                <div class="col-md-3">
                    <x-form-input name="nama" label="Nama Lengkap" floating />
                </div>
                <div class="col-md-3">
                    <x-form-select name="approved" :options="['' => 'Semua', 'yes' => 'Ya', 'no' => 'Tidak']" label="Approved" floating />
                </div>
            </x-datatable.filter>

            <div class="card">
                <div class="card-table">
                    {{ $dataTable->table(['class' => 'table table-hover table-sm w-100 border-bottom']) }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-script')
    <script src="{{ asset('js/datatables/actions.js') }}"></script>
    {{ $dataTable->scripts() }}
@endsection
