@extends('front.base')

@section('content')
    @include('front.breadcrumb', ['title' => $meta['category']])

    <div class="ptb-80 ptb-sm-40 ptb-md-60">
        <div class="container">
            <form action="/alumni" method="get" class="pb-4 px-4">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-6 ps-0">
                            <x-form-select name="tahun_lulus" label="Tahun Lulus" :options="['' => 'Semua'] + tahunOption()" :default="request()->tahun_lulus" floating onchange="this.form.submit()" />
                        </div>
                        <div class="col-6 pe-0">
                            <x-form-select name="jurusan" label="Jurusan" :options="['' => 'Semua', 'ipa' => 'IPA', 'ips' => 'IPS', 'bahasa' => 'Bahasa']" :default="request()->jurusan" floating onchange="this.form.submit()" />
                        </div>
                    </div>
                </div>
            </form>
            <div class="row px-4 pb-2">
                <a href="{{ route('front.alumni.create') }}" class="btn btn-primary text-white">Isi Buku Alumni</a>
            </div>
            <div class="row ps-4 pb-2">
                Ditemukan {{ $postCount }} alumni
            </div>
            <div class="row gallery-wrapper masonry-wrap justify-content-center masonary-row m-0 w-100">
                @forelse ($post as $p)
                    <div class="col-lg-3 col-md-3 col-6 mb-30 masonary-item wow fadeInUp">
                        <div class="blog-post blog-classic common-blog-post shadow-sm">
                            <div class="blog-imgs" style="height: 200px">
                                <a class="blog-img" href="{{ $p->url }}">
                                    <img src="{{ $p->foto_url }}" alt="Blog imgs" style="height: 200px!important; object-fit: cover; ">
                                </a>
                            </div>
                            <div class="blog-inner p-3" style="height: 110px">
                                <span class="badge rounded-pill bg-secondary fw-normal">{{ $p->tahun_lulus }}</span>
                                @if ($p->jurusan == 'ipa')
                                    <span class="badge rounded-pill text-uppercase fw-normal bg-primary">{{ $p->jurusan }}</span>
                                @elseif ($p->jurusan == 'ips')
                                    <span class="badge rounded-pill text-uppercase fw-normal bg-success">{{ $p->jurusan }}</span>
                                @else
                                    <span class="badge rounded-pill text-uppercase fw-normal bg-warning">{{ $p->jurusan }}</span>
                                @endif
                                <br>
                                <span class="blog-title">
                                    <a class="fw-normal fs-6" href="{{ $p->url }}">{{ $p->nama }}</a>
                                </span>
                            </div>
                        </div>
                    </div>
                @empty
                    data tidak ditemukan
                @endforelse
            </div>
            {{ $post->withQueryString()->links('vendor.pagination.bootstrap-5') }}
        </div>
    </div>
@endsection
