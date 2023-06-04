@extends('layouts.app')

@section('title', 'pelayanan')
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
                            @if (!in_array($pelayanan->id, [1, 2]))
                                <a href="javascript:void(0)" class="btn btn-outline-danger delete-data" data-url="{{ route('post.pelayanan.destroy', [$pelayanan->id, 'uuid' => $pelayanan->uuid]) }}" data-token="{{ csrf_token() }}" data-label="{{ $pelayanan->nama }}"> Hapus </a>
                            @endif
                            <a href="{{ route('post.pelayanan.edit', [$pelayanan->id, 'uuid' => $pelayanan->uuid]) }}" class="btn btn-outline-primary">Edit</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="fw-bold">Icon</div>
                            <div>
                                @if ($pelayanan->icon)
                                    <img src="{{ asset('storage/pelayanan/icon/' . $pelayanan->icon) }}" alt="" height="100px">
                                @else
                                    <i class="ti ti-stethoscope fs-1"></i>
                                @endif
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="fw-bold">Nama</div>
                            <div>{{ $pelayanan->nama }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="fw-bold">Meta Keywords</div>
                            <div>{{ $pelayanan->meta_keywords ?? '-' }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="fw-bold">Meta Description</div>
                            <div>{{ $pelayanan->meta_description ?? '-' }}</div>
                        </div>
                        @if ($pelayanan->publish == 'ya')
                            <span class="badge bg-success-lt">Publish {{ $pelayanan->publish_at }}</span>
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
                            <img src="{{ $pelayanan->gambar ? asset('storage/pelayanan/' . $pelayanan->gambar) : '' }}" class="img-thumbnail rounded">
                        </div>
                        {!! $pelayanan->konten !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
