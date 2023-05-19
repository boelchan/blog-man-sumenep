@extends('layouts.app')

@section('title', 'poli')
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
                            <a href="javascript:void(0)" class="btn btn-outline-danger delete-data" data-url="{{ route('post.poli.destroy', [$poli->id, 'uuid' => $poli->uuid]) }}" data-token="{{ csrf_token() }}" data-label="{{ $poli->nama }}"> Hapus </a>
                            <a href="{{ route('post.poli.edit', [$poli->id, 'uuid' => $poli->uuid]) }}" class="btn btn-outline-primary">Edit</a>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="mb-3">
                            <div class="fw-bold">Icon</div>
                            <div><img src="{{ $poli->icon_url }}" alt="" height="100px"></div>
                        </div>
                        <div class="mb-3">
                            <div class="fw-bold">Judul</div>
                            <div>{{ $poli->judul }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="fw-bold">Meta Keywords</div>
                            <div>{{ $poli->meta_keywords ?? '-' }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="fw-bold">Meta Description</div>
                            <div>{{ $poli->meta_description ?? '-' }}</div>
                        </div>
                        @if ($poli->publish == 'ya')
                            <span class="badge bg-success-lt">Publish {{ $poli->published_at }}</span>
                        @else
                            <span class="badge bg-secondary-lt ">Pending</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        @if ($poli->gambar)
                            <div class="row justify-content-center mb-5">
                                <img src="{{ $poli->gambar ? asset('storage/poly/' . $poli->gambar) : '' }}" class="img-thumbnail rounded">
                            </div>
                        @endif
                        {!! $poli->konten !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
