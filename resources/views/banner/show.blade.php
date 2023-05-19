@extends('layouts.app')

@section('title', 'banner')
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
                            <a href="javascript:void(0)" class="btn btn-outline-danger delete-data" data-url="{{ route('post.banner.destroy', [$banner->id, 'uuid' => $banner->uuid]) }}" data-token="{{ csrf_token() }}" data-label="{{ $banner->judul }}"> Hapus </a>
                            <a href="{{ route('post.banner.edit', [$banner->id, 'uuid' => $banner->uuid]) }}" class="btn btn-outline-primary">Edit</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="fw-bold">Judul</div>
                            <div>{{ $banner->judul }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="fw-bold">Meta Keywords</div>
                            <div>{{ $banner->meta_keywords ?? '-' }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="fw-bold">Meta Description</div>
                            <div>{{ $banner->meta_description ?? '-' }}</div>
                        </div>

                        @if ($banner->publish == 'ya')
                            <span class="badge bg-success-lt">Publish {{ $banner->published_at }}</span>
                            @if ($banner->tampil_banner == 'ya')
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
                            <img src="{{ $banner->gambar ? asset('storage/gambar/' . $banner->gambar) : '' }}" class="img-thumbnail rounded">
                        </div>
                        {!! $banner->konten !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
