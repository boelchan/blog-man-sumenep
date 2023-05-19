@extends('front.base')

@section('content')
    @include('front.breadcrumb', ['title' => 'Dokter'])

    <div class="sl-blog-details-area ptb-80 ptb-sm-40 ptb-md-60">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12 col-sm-12 col-12">
                    <div class="blog-details-wrapper">
                        <article class="blog-post standard-post">
                            <!-- Start Thumbnail -->
                            <div class="text-align-center">
                                <div class="team-single text-center">
                                    <div class="team-img border-color">
                                        <img src="{{ asset('storage/team/' . $post->gambar) }}" draggable="false" class="" height="100%" width="100%" style="object-fit: cover;">
                                    </div>
                                    <div class="team-info mt-20 mb-20">
                                        <h3>{{ $post->nama }}</h3>
                                        <p class="text-color">{{ $post->jabatan }}</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Start Content -->
                            <div class="content basic-dark2-line-1px pb-50 mb-35">
                                <div class="inner">
                                    {!! $post->konten !!}
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
                @include('front.sidebar')
            </div>
        </div>
    </div>
@endsection
