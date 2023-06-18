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
            <div class="row ">
                <!-- Start Single Gallery -->
                @foreach ($pamflet as $pf)
                    <div class="col-md-4 col-6 p-1">
                        <a class="gallery wow fadeInUp" data-fancybox="gallery" href="{{ $pf->gambar_url }}">
                            <div class="thumb">
                                <img class="rounded-3" src="{{ $pf->gambar_url }}" alt="Gallery Images">
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


@endsection
