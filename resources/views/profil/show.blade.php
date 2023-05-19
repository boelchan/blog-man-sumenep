@extends('layouts.app')

@section('title', 'profil')
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
                            @if ($profil->slug != 'tentang-kami')
                                <a href="javascript:void(0)" class="btn btn-outline-danger delete-data" data-url="{{ route('post.profil.destroy', [$profil->id, 'uuid' => $profil->uuid]) }}" data-token="{{ csrf_token() }}" data-label="{{ $profil->nama }}"> Hapus </a>
                            @endif
                            <a href="{{ route('post.profil.edit', [$profil->id, 'uuid' => $profil->uuid]) }}" class="btn btn-outline-primary">Edit</a>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="mb-3">
                            <div class="fw-bold">Nama</div>
                            <div>{{ $profil->nama }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="fw-bold">Meta Keywords</div>
                            <div>{{ $profil->meta_keywords ?? '-' }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="fw-bold">Meta Description</div>
                            <div>{{ $profil->meta_description ?? '-' }}</div>
                        </div>
                        @if ($profil->publish == 'ya')
                            <span class="badge bg-success-lt">Publish {{ $profil->published_at }}</span>
                        @else
                            <span class="badge bg-secondary-lt ">Pending</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        @if ($profil->gambar)
                            <div class="row justify-content-center mb-5">
                                <img src="{{ $profil->gambar ? asset('storage/profil/' . $profil->gambar) : '' }}" class="img-thumbnail rounded">
                            </div>
                        @endif
                        {!! $profil->konten !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
