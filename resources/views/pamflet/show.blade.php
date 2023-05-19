@extends('layouts.app')

@section('title', 'pamflet')
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
                            <a href="javascript:void(0)" class="btn btn-outline-danger delete-data" data-url="{{ route('post.pamflet.destroy', [$pamflet->id, 'uuid' => $pamflet->uuid]) }}" data-token="{{ csrf_token() }}" data-label="{{ $pamflet->judul }}">Hapus </a>
                            <a href="{{ route('post.pamflet.edit', [$pamflet->id, 'uuid' => $pamflet->uuid]) }}" class="btn btn-outline-primary">Edit</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="fw-bold">Judul</div>
                            <div>{{ $pamflet->judul }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="fw-bold">Meta Keywords</div>
                            <div>{{ $pamflet->meta_keywords ?? '-' }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="fw-bold">Meta Description</div>
                            <div>{{ $pamflet->meta_description ?? '-' }}</div>
                        </div>
                        @if ($pamflet->publish == 'ya')
                            <span class="badge bg-success-lt">Publish {{ $pamflet->published_at }}</span>
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
                            <img src="{{ $pamflet->gambar ? asset('storage/gambar/' . $pamflet->gambar) : '' }}" class="img-thumbnail rounded">
                        </div>
                        {!! $pamflet->konten !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
