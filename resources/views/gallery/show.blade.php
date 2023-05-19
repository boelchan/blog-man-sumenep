@extends('layouts.app')

@section('title', 'Gallery')
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
                            <a href="javascript:void(0)" class="btn btn-outline-danger delete-data" data-url="{{ route('post.gallery.destroy', [$gallery->id, 'uuid' => $gallery->uuid]) }}" data-token="{{ csrf_token() }}" data-label="{{ $gallery->judul }}"> Hapus </a>
                            <a href="{{ route('post.gallery.edit', [$gallery->id, 'uuid' => $gallery->uuid]) }}" class="btn btn-outline-primary">Edit</a>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="mb-3">
                            <div class="fw-bold">Judul</div>
                            <div>{{ $gallery->judul }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="fw-bold">Meta Keywords</div>
                            <div>{{ $gallery->meta_keywords ?? '-' }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="fw-bold">Meta Description</div>
                            <div>{{ $gallery->meta_description ?? '-' }}</div>
                        </div>
                        @if ($gallery->publish == 'ya')
                            <span class="badge bg-success-lt">Publish {{ $gallery->published_at }}</span>
                            @if ($gallery->tampil_banner == 'ya')
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
                            <img src="{{ $gallery->gambar ? asset('storage/gambar/' . $gallery->gambar) : '' }}" class="img-thumbnail rounded">
                        </div>
                        {!! $gallery->konten !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
