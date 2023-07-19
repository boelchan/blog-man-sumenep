@extends('front.base')

@section('content')
    @include('front.breadcrumb', ['title' => $meta['category']])

    <div class="sl-blog-details-area ptb-80 ptb-sm-40 ptb-md-60">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12 col-sm-12 col-12">
                    <div class="col-md-12 mb-30">
                        <div class="blog-post blog-classic blog-horizontal">
                            <div>
                                <img src="{{ $post->foto_url }}" alt="foto"  style="max-width: 400px;">
                            </div>
                            <div class="blog-inner py-3 px-5 shadow-none">
                                <div class="blog-meta">
                                    <span class="badge rounded-pill bg-secondary fw-normal">{{ $post->tahun_lulus }}</span>
                                    @if ($post->jurusan == 'ipa')
                                        <span class="badge rounded-pill text-uppercase fw-normal bg-primary">{{ $post->jurusan }}</span>
                                    @elseif ($post->jurusan == 'ips')
                                        <span class="badge rounded-pill text-uppercase fw-normal bg-success">{{ $post->jurusan }}</span>
                                    @else
                                        <span class="badge rounded-pill text-uppercase fw-normal bg-warning">{{ $post->jurusan }}</span>
                                    @endif
                                </div>
                                <h3 class="blog-title">{{ $post->nama }}</h3>
                                <span class="d-block"><i class="ti ti-home"></i>{{ $post->domisili }}</span>
                                @if ($post->pekerjaan)
                                    <span class="d-block"><i class="ti ti-adjustments-alt"></i>{{ $post->pekerjaan }}</span>
                                @endif
                                @if ($post->no_hp)
                                    <span class="d-block"><i class="ti ti-brand-whatsapp"></i>{{ $post->no_hp }}</span>
                                @endif
                                @if ($post->email)
                                    <span class="d-block"><i class="ti ti-brand-gmail"></i>{{ $post->email }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @include('front.sidebar')

            </div>
        </div>
    </div>
@endsection
