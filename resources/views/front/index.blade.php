@extends('front.base')

@section('content')
    <section class="position-relative ptb-65 ptb-sm-65 ptb-md-65">
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
                            <img src="{{ asset('storage/gambar/' . $b->gambar) }}" class="d-block w-100" alt="..." style="object-fit: cover; max-height:600px">
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
            <div class="row ">
                <!-- Start Single Gallery -->
                @foreach ($pamflet as $pf)
                    <div class="col-md-4 col-6 p-1">
                        <a class="gallery wow fadeInUp" data-fancybox="gallery" href="{{ asset('storage/gambar/' . $pf->gambar) }}">
                            <div class="thumb">
                                <img class="rounded-3" src="{{ asset('storage/gambar/' . $pf->gambar) }}" alt="Gallery Images">
                            </div>
                            <div class="hover-overlay">
                                <div class="inner">
                                    <span class="ti-plus"></span>
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
                            <h2 class="wow fadeInUp bg-beauty-salon text-clip fw-normal mb-0">Layanan <br>Kami</h2>
                            <a href="{{ route('front.pelayanan') }}" class="btn p-0">
                                <span class="gradients-button text-color grad-btn-5 outline btn-ex-small">Lihat Semua</span>
                            </a>
                        </div>
                    </div>
                    @foreach ($layanan as $l)
                        <div class="col-6 col-lg-3 mb-4 wow fadeInUp ">
                            <div class="service-box text-center text-md-start orange-gradient p-4 rounded-3">
                                @if ($l->icon)
                                    <img class="mb-2" src="{{ asset('storage/pelayanan/icon/' . $l->icon)  }}" alt="" height="100px">
                                @else
                                    <i class="fas fa-stethoscope fa-4x mb-4"></i>
                                @endif
                                <p class="fw-normal">{{ $l->nama }}</p>
                                <a class="readmore" href="{{ $l->url }}"><span>detail layanan</span></a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- service end -->

    <!-- Customization And Privacy -->
    <section class="position-relative w-100 ptb-80 ptb-sm-50 ptb-md-60 z-index-2" id="about">
        <div class="container">
            <div class="row align-items-center about-wrap">
                <div class="col-md-6 mb-5 mb-md-0 position-relative">
                    <div class="beauty-salon-shape">
                        <img src="{{ asset('storage/profil/' . $tentangKami->gambar) }}" alt="beauty girl 2">
                    </div>
                    <div class="about-bg-img-setting bg-beauty-salon"></div>
                </div>
                <div class="col-md-6">
                    <div class="section-title text-center pe-0 pe-lg-3 text-md-start section-heading mb-5">
                        <h2 class="bg-beauty-salon text-clip d-inline-block fw-normal">Tentang Kami</h2>
                        {!! Str::words($tentangKami->konten, 70, '...') !!}<br>
                        <a href="{{ route('front.profil.baca', 'tentang-kami') }}" class="btn p-0">
                            <span class="gradients-button grad-btn-5 outline text-color btn-ex-small"> selengkapnya </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Customization And Privacy end -->

    <div class="position-relative ptb-80 ptb-sm-40 ptb-md-60 z-index-2 bg-white">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="section-title text-center mb-5">
                        <h2 class="wow fadeInUp bg-beauty-salon text-clip fw-normal mb-0">Tim Dokter</h2>
                        <p class="wow fadeInUp">Dokter terbaik untuk kesahatan Anda</p>
                        <a href="{{ route('front.dokter') }}" class="btn p-0 wow fadeInDown">
                            <span class="gradients-button grad-btn-5 outline text-color btn-ex-small"> lihat semua </span>
                        </a>
                    </div>
                </div>
            </div>
            <div id="team-carousel-2" class="owl-carousel owl-theme">
                @foreach ($tim as $t)
                    <!--start team single-->
                    <a href="{{ route('front.dokter.baca', $t->slug) }}">
                        <div class="item  wow fadeInUp">
                            <div class="team-single text-center">
                                <div class="team-img border-color">
                                    <img src="{{ asset('storage/team/' . $t->gambar) }}" draggable="false" alt="nama" height="100%" width="100%" style="object-fit: cover;">
                                </div>
                                <div class="team-info mt-20 mb-20">
                                    <h3>{{ $t->nama }}</h3>
                                    <p class="text-color">{{ $t->jabatan }}</p>
                                </div>
                            </div>
                        </div>
                    </a>
                    <!--end team single-->
                @endforeach

            </div>
        </div>
    </div>
@endsection
