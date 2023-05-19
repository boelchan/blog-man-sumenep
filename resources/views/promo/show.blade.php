@extends('layouts.app')

@section('title', 'Promo')
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
                            <a href="javascript:void(0)" class="btn btn-outline-danger delete-data" data-url="{{ route('post.promo.destroy', [$promo->id, 'uuid' => $promo->uuid]) }}" data-token="{{ csrf_token() }}" data-label="{{ $promo->judul }}"> Hapus </a>
                            <a href="{{ route('post.promo.edit', [$promo->id, 'uuid' => $promo->uuid]) }}" class="btn btn-outline-primary">Edit</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="fw-bold">Judul</div>
                            <div>{{ $promo->judul }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="fw-bold">Meta Keywords</div>
                            <div>{{ $promo->meta_keywords ?? '-' }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="fw-bold">Meta Description</div>
                            <div>{{ $promo->meta_description ?? '-' }}</div>
                        </div>
                        @if ($promo->publish == 'ya')
                            <span class="badge bg-success-lt">Publish {{ $promo->published_at }}</span>
                            @if ($promo->tampil_banner == 'ya')
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
                            <img src="{{ $promo->gambar ? asset('storage/gambar/' . $promo->gambar) : '' }}" class="img-thumbnail rounded">
                        </div>
                        {!! $promo->konten !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
