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
                            <a href="javascript:void(0)" class="btn btn-outline-danger btn-sm delete-data" data-url="{{ route('siswa.destroy', [$siswa->id, 'uuid' => $siswa->uuid]) }}" data-token="{{ csrf_token() }}" data-label="{{ $siswa->judul }}"> Hapus </a>
                            <a href="{{ route('siswa.edit', [$siswa->id, 'uuid' => $siswa->uuid]) }}" class="btn btn-success btn-sm">Edit</a>
                            <a href="{{ route('siswa.create') }}" class="btn btn-primary btn-sm">Tambah Baru</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="fw-bold">Kode</div>
                            <div>{{ $siswa->kode }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="fw-bold">Nama</div>
                            <div>{{ $siswa->nama }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="fw-bold">Kelas</div>
                            <div>{{ $siswa->kelas }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
