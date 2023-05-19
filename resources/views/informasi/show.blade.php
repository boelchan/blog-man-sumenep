@extends('layouts.app')

@section('title', 'informasi')
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
                            <a href="javascript:void(0)" class="btn btn-outline-danger delete-data" data-url="{{ route('post.informasi.destroy', [$informasi->id, 'uuid' => $informasi->uuid]) }}" data-token="{{ csrf_token() }}" data-label="{{ $informasi->judul }}"> Hapus </a>
                            <a href="{{ route('post.informasi.edit', [$informasi->id, 'uuid' => $informasi->uuid]) }}" class="btn btn-outline-primary">Edit</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="fw-bold">Judul</div>
                            <div>{{ $informasi->judul }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="fw-bold">Meta Keywords</div>
                            <div>{{ $informasi->meta_keywords ?? '-' }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="fw-bold">Meta Description</div>
                            <div>{{ $informasi->meta_description ?? '-' }}</div>
                        </div>
                        @if ($informasi->publish == 'ya')
                            <span class="badge bg-success-lt">Publish {{ $informasi->published_at }}</span>
                            @if ($informasi->tampil_banner == 'ya')
                                <span class="badge bg-primary-lt">Ditampilkan di Banner</span>
                            @endif
                        @else
                            <span class="badge bg-secondary-lt ">Pending</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="row justify-content-center mb-5">
                            <img src="{{ $informasi->gambar ? asset('storage/gambar/' . $informasi->gambar) : '' }}" class="img-thumbnail rounded">
                        </div>
                        {!! $informasi->konten !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
