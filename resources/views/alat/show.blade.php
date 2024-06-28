@extends('layouts.app')

@section('title', $title)
@section('sub-title', 'Overview')

@section('content')
    <div class="container">
        <div class="row justify-content-center row-cards">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            Preview
                        </h3>
                        <div class="card-actions">
                            <a href="javascript:void(0)" class="btn btn-outline-danger btn-sm delete-data" data-url="{{ route('alat.destroy', [$alat->id, 'uuid' => $alat->uuid]) }}" data-token="{{ csrf_token() }}" data-label="{{ $alat->judul }}"> Hapus </a>
                            <a href="{{ route('alat.edit', [$alat->id, 'uuid' => $alat->uuid]) }}" class="btn btn-success btn-sm">Edit</a>
                            <a href="{{ route('alat.create') }}" class="btn btn-primary btn-sm">Tambah Baru</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="fw-bold">Kode</div>
                            <div>{{ $alat->kode }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="fw-bold">Nama</div>
                            <div>{{ $alat->nama }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="fw-bold">Jumlah</div>
                            <div>{{ $alat->jumlah }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
