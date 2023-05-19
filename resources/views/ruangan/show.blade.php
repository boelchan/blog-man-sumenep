@extends('layouts.app')

@section('title', 'ruangan')
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
                            <a href="javascript:void(0)" class="btn btn-outline-danger delete-data" data-url="{{ route('post.ruangan.destroy', [$ruangan->id, 'uuid' => $ruangan->uuid]) }}" data-token="{{ csrf_token() }}" data-label="{{ $ruangan->nama }}"> Hapus </a>
                            <a href="{{ route('post.ruangan.edit', [$ruangan->id, 'uuid' => $ruangan->uuid]) }}" class="btn btn-outline-primary">Edit</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="fw-bold">Icon</div>
                            <div><img src="{{ $ruangan->icon_url }}" alt="" height="100px"></div>
                        </div>
                        <div class="mb-3">
                            <div class="fw-bold">Nama</div>
                            <div>{{ $ruangan->nama }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="fw-bold">Meta Keywords</div>
                            <div>{{ $ruangan->meta_keywords ?? '-' }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="fw-bold">Meta Description</div>
                            <div>{{ $ruangan->meta_description ?? '-' }}</div>
                        </div>
                        @if ($ruangan->publish == 'ya')
                            <span class="badge bg-success-lt">Publish {{ $ruangan->published_at }}</span>
                        @else
                            <span class="badge bg-secondary-lt ">Pending</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        @if ($ruangan->gambar)
                            <div class="row justify-content-center mb-5">
                                <img src="{{ $ruangan->gambar ? asset('storage/room/' . $ruangan->gambar) : '' }}" class="img-thumbnail rounded">
                            </div>
                        @endif
                        {!! $ruangan->konten !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
