@extends('front.base')

@section('content')
    <section class="position-relative ptb-70 ptb-sm-70 ptb-md-70">
        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                @forelse ($slider as $b)
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="{{ $loop->index }}" class="@if ($loop->first) active @endif" aria-current="true" aria-label="Slide 1"></button>
                @empty
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" class="active" aria-current="true" aria-label="Slide 1"></button>
                @endforelse
            </div>
            <div class="carousel-inner">
                @forelse ($slider as $b)
                    <div class="carousel-item @if ($loop->first) active @endif">
                        <a href="{{ $b->url }}">
                            <img src="{{ $b->gambar_url }}" class="d-block w-100" alt="..." style="object-fit: cover; max-height:600px">
                            <div class="carousel-caption d-none d-md-block">
                                <label class="blur rounded-pill px-3 py-1">
                                    {{ $b->judul }}
                                </label>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="carousel-item active">
                        <img src="{{ asset('storage/static/9191758_26363.jpg') }}" class="d-block img-fluid w-100" alt="...">
                    </div>
                @endforelse
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                <span class="carousel-control-prev-icon bg-secondary rounded-3" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                <span class="carousel-control-next-icon bg-secondary rounded-3" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>
    <section class="position-relative ptb-80 ptb-sm-30 ptb-md-60">
        <div class="container">
            <div class="row justify-content-center">
                <div class="text-center mb-4">
                    <h2 class="bg-beauty-salon text-clip d-inline-block">Pamflet</h2>
                </div>
            </div>
            <div class="row ">
                <!-- Start Single Gallery -->
                @foreach ($pamflet as $pf)
                    <div class="col-md-4 col-6 p-1">
                        <a class="gallery wow fadeInUp" data-fancybox="gallery" href="{{ $pf->gambar_url }}">
                            <div class="thumb">
                                <img class="rounded-3" src="{{ $pf->gambar_url }}" alt="pamflet Images">
                            </div>
                            <div class="hover-overlay">
                                <div class="inner">
                                    <span class="ti ti-plus"></span>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
                <!-- End Single Gallery -->
            </div>
        </div>
        <!-- End Gallery Area -->
    </section>

    <section class="position-relative ptb-80 ptb-sm-40 ptb-md-60 gray-bg">
        <div class="services-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-lg-3 mb-5 mb-md-3">
                        <div class="section-title text-center text-md-start">
                            <h2 class="wow fadeInUp bg-beauty-salon text-clip mb-0">Fasiltas</h2>
                            <h4 class="wow fadeInUp bg-beauty-salon text-clip mb-0">terbaik untuk Anda</h4>
                        </div>
                    </div>
                    @foreach ($fasilitas as $l)
                        <div class="col-6 col-lg-3 mb-4 wow fadeInUp ">
                            <div class="service-box text-center text-md-start orange-gradient p-4 rounded-3">
                                @if ($l->icon)
                                    <img class="mb-2" src="{{ $l->icon_url }}" alt="" height="100px">
                                @else
                                    <i class="fas fa-stethoscope fa-4x mb-4"></i>
                                @endif
                                <p class="fw-normal">{{ $l->nama }}</p>
                                <a class="readmore" href="{{ $l->url }}"><span>Detail fasilitas</span></a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="position-relative ptb-80 ptb-sm-30 ptb-md-60">
        <div class="container">
            <div class="row justify-content-center">
                <div class="text-center mb-4">
                    <h2 class="bg-beauty-salon text-clip d-inline-block">Kabar Terbaru</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="common-owl-carousel mb-5 owl-carousel owl-theme owl-loaded owl-drag" data-nav="false" data-laptop-view="3" data-main-view="3">
                    <div class="owl-stage-outer">
                        <div class="owl-stage">
                            @foreach ($lastestPost as $post)
                                <div class="owl-item p-3">
                                    <div class="blog-post blog-classic item">
                                        <a class="blog-img" href="{{ $post->url }}">
                                            <img src="{{ $post->gambar_url }}" alt="Blog 1">
                                        </a>
                                        <div class="blog-inner pt-4 px-4">
                                            <div class="blog-meta">
                                                <a href="#"> {{ tanggal($post->approved_at) }} </a>
                                            </div>
                                            <h3 class="blog-title"><a href="{{ $post->url }}">{{ $post->judul }}</a></h3>
                                            <div class="post-meta post-meta-two">
                                                <div class="sh-columns post-meta-comments">
                                                    <span class="post-meta-categories">
                                                        <i class="icon-tag"></i>
                                                        <a href="{{ route('front.post.kategori', $post->kategori->slug) }}" rel="category tag" class="post-category text-uppercase">{{ $post->kategori->nama }}</a>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
