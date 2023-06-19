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
                            <a href="javascript:void(0)" class="btn btn-outline-danger btn-sm delete-data" data-url="{{ route('alumni.destroy', $alumnus->id) }}" data-token="{{ csrf_token() }}" data-label="{{ $alumnus->judul }}"> Hapus </a>
                            <a href="{{ route('alumni.edit', $alumnus->id) }}" class="btn btn-primary btn-sm">Edit</a>
                        </div>
                    </div>
                    <div class="card-body py-2">
                        @if ($alumnus->approved == 'yes')
                            <span class="badge bg-lime">Approved</span>
                        @else
                            <span class="badge bg-secondary-lt ">Not Approved</span>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <div>
                                <img src="{{ $alumnus->foto_url }}" class="rounded">
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="fw-bold">Tahun Lulus</div>
                            <div>{{ $alumnus->tahun_lulus }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="fw-bold">Jurusan</div>
                            <div>{{ $alumnus->jurusan }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="fw-bold">Nama Lengkap</div>
                            <div>{{ $alumnus->nama }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="fw-bold">Alamat Domisili</div>
                            <div>{{ $alumnus->domisili }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="fw-bold">Pekerjaan</div>
                            <div>{{ $alumnus->pekerjaan }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="fw-bold">No HP / WA</div>
                            <div>{{ $alumnus->no_hp }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="fw-bold">Email</div>
                            <div>{{ $alumnus->email }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
