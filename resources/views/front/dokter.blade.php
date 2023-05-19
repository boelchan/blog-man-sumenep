@extends('front.base')

@section('content')
    @include('front.breadcrumb', ['title' => "Dokter"])
    <div class="ptb-80 ptb-sm-40 ptb-md-60">
        <div class="container">
            <div class="row ">
                @foreach ($post as $p)
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('front.dokter.baca', $p->slug) }}">
                            <div class="team-single text-center">
                                <div class="team-img border-color">
                                    <img src="{{ asset('storage/team/' . $p->gambar) }}" draggable="false" class="" height="100%" width="100%" style="object-fit: cover;">
                                </div>
                                <div class="team-info mt-20 mb-20">
                                    <h3>{{ $p->nama }}</h3>
                                    <p class="text-color">{{ $p->jabatan }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            {{ $post->links('vendor.pagination.bootstrap-5') }}
        </div>
    </div>
@endsection
