<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <meta name="title" content="{{ $meta['title'] }}">
    <meta name="description" content="{{ $meta['description'] }}">
    <meta name="keywords" content="{{ $meta['keywords'] }}, {{ ENV('META_KEYWORDS') }}" itemprop="keywords">
    <meta name="author" content="{{ ENV('META_KEYWORDS') }}">
    <meta property="og:title" content="{{ $meta['title'] }}">
    <meta property="og:description" content="{{ $meta['description'] }}">
    <meta property="og:locale" content="id_ID" />
    <meta property="og:site_name" content="{{ ENV('META_KEYWORDS') }}" />
    <meta property="og:type" content="{{ $meta['category'] }}" />
    <meta property="og:title" content="{{ $meta['title'] }}" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:image" content="{{ $meta['image'] ?? '' }}" />
    <meta property="og:image:width" content="220" />
    <meta property="og:image:height" content="220" />
    <meta property="twitter:site_name" content="{{ ENV('META_KEYWORDS') }}" />
    <meta property="twitter:type" content="{{ $meta['category'] }}" />
    <meta property="twitter:title" content="{{ $meta['title'] }}" />
    <meta property="twitter:url" content="{{ url()->current() }}" />
    <meta property="twitter:image" content="{{ $meta['image'] ?? '' }}" />

    <!-- Title -->
    <title>{{ $meta['title'] }} - {{ ENV('APP_NAME') }}</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('static/favicon.png') }}" type="image/x-icon">

    <link rel="apple-touch-icon" href="{{ asset('static/favicon.png') }}">
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="{{ asset('front/css/bootstrap.min.css') }}">
    <!-- Plugins css -->
    <link rel="stylesheet" href="{{ asset('front/css/plugins.css') }}">
    <!-- Style Css -->
    <link rel="stylesheet" href="{{ asset('front/css/style.css') }}">
    <!-- Custom styles -->
    <link rel="stylesheet" href="{{ asset('front/css/custom.css') }}">
    <link href="{{ asset('dist/css/tabler-icons.min.css') }}" rel="stylesheet" />

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600&display=swap');

        * {
            font-family: 'Quicksand', sans-serif !important;
        }

        :root {
            font-family: 'Quicksand', sans-serif !important;
        }
    </style>

</head>

<body class="it-company-template template-color-58">
    <!-- Wrapper -->
    <div id="wrapper" class="wrapper">
        <!-- Header magamenu dark -->
        <div class="header-menu">
            <header class="sl_header header-default header-transparent header-black-version header-fixed-width header-fixed-150 header-sticky header-mega-menu clearfix" style="background-color: rgba(255, 255, 255, 0.9) !important">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="header__wrapper me-0">
                                <!-- Header Left -->
                                <div class="header-left flex-20">
                                    <div class="logo p-0">
                                        <a href="/">
                                            <img style="height: 70px;width:auto;" src="{{ setting('logo') }}" class="static" alt=" Images">
                                        </a>
                                    </div>
                                </div>
                                <!-- Mainmenu Wrap -->
                                <div class="header-flex-right flex-80">
                                    <div class="mainmenu-wrapper have-not-flex d-none d-lg-block pl-40">
                                        <nav class="page_nav">
                                            <ul class="mainmenu">
                                                <li class="lavel-1 p-0"><a class="p-1" href="/"><span>Home</span></a></li>
                                                @foreach ($navbarMenu['addToHeader'] as $menu)
                                                    @if ($menu->subMenu->count() == 0)
                                                        <li class="lavel-1 p-0"><a class="pe-1" href="{{ $menu->url }}"><span>{{ $menu->nama }}</span></a></li>
                                                    @else
                                                        <li class="lavel-1 p-0 with--drop slide-dropdown">
                                                            <a class="p-1" href="#"><span>{{ $menu->nama }}</span></a>
                                                            <ul class="dropdown__menu p-1">
                                                                @foreach ($menu->subMenu as $sb)
                                                                    <li class="text-black px-3"><a href="{{ $sb->url }}"><span>{{ $sb->judul }}</span></a>
                                                                @endforeach
                                                                <li class="text-black px-3"><a href="{{ $menu->url }}"><span>Lihat Semua</span></a> </li>
                                                            </ul>
                                                        </li>
                                                    @endif
                                                @endforeach
                                                @if ($navbarMenu['kategori']->count() > 0)
                                                    <li class="lavel-1 p-0 with--drop slide-dropdown">
                                                        <a class="p-1" href="#"><span>Kategori</span></a>
                                                        <ul class="dropdown__menu p-1">
                                                            @foreach ($navbarMenu['kategori'] as $p)
                                                                <li class="text-black px-3"><a href="{{ $p->url }}"><span>{{ $p->nama }}</span></a> </li>
                                                            @endforeach
                                                        </ul>
                                                    </li>
                                                @endif
                                                <li class="lavel-1 p-0"><a class="pe-1" href="{{ route('front.alumni.index') }}"><span>Alumni</span></a> </li>
                                                <li class="lavel-1 p-0"><a class="pe-0" href="{{ route('cari') }}" title="pencarian"><span><i class="ti ti-search fs-4"></i></span></a></li>
                                            </ul>
                                        </nav>
                                    </div>

                                </div>
                                <div class="d-block d-lg-none dark-version d-block d-xl-none pl_md--10 pl_sm--10 mt-2 me-2">
                                    <a href="{{ route('cari') }}" class=""><i class="ti ti-search fw-bold fs-4"></i></a>
                                </div>
                                <div class="manu-hamber popup-mobile-click d-block d-lg-none dark-version d-block d-xl-none pl_md--10 pl_sm--10">
                                    <div>
                                        <i></i>
                                    </div>
                                </div>
                                <!-- End Hamberger -->
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        </header>
        <!-- Header -->
        <!-- Start Popup Menu -->
        <div class="popup-mobile-manu popup-mobile-visiable">
            <div class="inner">
                <div class="mobileheader">
                    <div class="logo">
                        <a href="/">
                            <img src="{{ setting('logo') }}" alt="Multipurpose" style="height: 70px">
                        </a>
                    </div>
                    <a class="mobile-close" href="#" aria-label="Close"></a>
                </div>
                <div class="menu-content">
                    <ul class="menulist object-custom-menu">
                        <li class="lavel-1"><a href="/"><span>Home</span></a></li>
                        @foreach ($navbarMenu['addToHeader'] as $menu)
                            @if ($menu->subMenu->count() == 0)
                                <li class="lavel-1"><a href="{{ $menu->url }}"><span>{{ $menu->nama }}</span></a></li>
                            @else
                                <li class="has-mega-menu"><a href=""><span>{{ $menu->nama }}</span></a>
                                    <ul class="object-submenu">
                                        @foreach ($menu->subMenu as $sb)
                                            <li><a href="{{ $sb->url }}"><span>{{ $sb->judul }}</span></a> </li>
                                        @endforeach
                                        <li><a href="{{ $menu->url }}"><span>Lihat Semua</span></a> </li>
                                    </ul>
                                </li>
                            @endif
                        @endforeach
                        @if ($navbarMenu['kategori']->count() > 0)
                            <li class="has-mega-menu"><a href=""><span>Kategori</span></a>
                                <ul class="object-submenu">
                                    @foreach ($navbarMenu['kategori'] as $p)
                                        <li><a href="{{ $p->url }}"><span>{{ $p->nama }}</span></a> </li>
                                    @endforeach
                                </ul>
                            </li>
                        @endif
                        <li class="lavel-1"><a href="{{ route('front.alumni.index') }}"><span>Alumni</span></a></li>
                        <li class="lavel-1"><a href="{{ route('cari') }}"><span><i class="ti ti-search"></i> Pencarian</span></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- End Popup Menu -->
    </div>

    <!-- Main content start -->
    <main class="page-content">
        @yield('content')

        <!-- footer part start -->
        <footer class="footer-part product-footer single_image-wrapper main-color">
            <div class="image-wrapper  wow fadeInUp" data-wow-duration="1.5s" data-bg-image="{{ setting('footer') }}"></div>
            <div class="inner text-style-light text-style-light-2">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-lg-7 mb-3 mb-lg-0 wow fadeInUp" data-wow-duration="1s">
                            <div class="row">
                                <div class="col-md-5 mb-2">
                                    <img src="{{ setting('logo') }}" alt="multipurpose logo" height="50px">
                                </div>
                                <div class="col-md-7">
                                    <div class="">
                                        <i class="ti ti-home"></i> {{ setting('alamat') }}
                                    </div>
                                    <div class="">
                                        <i class="ti ti-phone"></i> {{ setting('telepon') }}
                                    </div>
                                    <div class="">
                                        <i class="ti ti-mail"></i> {{ setting('email') }}
                                    </div>
                                </div>
                            </div>
                            <iframe class=" rounded-3 mt-2 wow fadeInUp" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.05590126829!2d113.86641047417714!3d-7.0027000685862175!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd9e5d2dce40611%3A0x8a78862419c24e76!2sMA%20Negeri%20Sumenep!5e0!3m2!1sid!2sid!4v1687077558943!5m2!1sid!2sid" width="100%" height="190px" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                        <div class="col-6 col-lg-3 wow fadeInUp" data-wow-duration="1s">
                            <h3 class="main-color">Tentang Kami</h3>
                            <ul class="list-unstyled">
                                @foreach ($navbarMenu['addToFooter'] as $menu)
                                    <li class="p-0 pb-1"><a class="main-color" href="{{ $menu->url }}">{{ $menu->nama }}</a> </li>
                                @endforeach
                                <li class="p-0 pb-1"><a class="main-color" href="{{ route('cari') }}">Pencarian</a> </li>
                            </ul>
                        </div>
                        <div class="col-6 col-lg-2 wow fadeInUp" data-wow-duration="1s">
                            <h3 class="main-color">Ikuti kami</h3>
                            <ul class="social-icon style-solid-rounded-icon icon-size-medium text-start mt-2">
                                @if (setting('instagram'))
                                    <li class="instagram"><a href="{{ setting('instagram') }}" class="link hover-text-color main-color" aria-label="Instagram"><i class="ti ti-brand-instagram"></i></a></li>
                                @endif
                                @if (setting('facebook'))
                                    <li class="facebook"><a href="{{ setting('facebook') }}" class="link hover-text-color main-color" aria-label="facebook"><i class="ti ti-brand-facebook"></i></a> </li>
                                @endif
                                @if (setting('youtube'))
                                    <li class="youtube"><a href="{{ setting('youtube') }}" class="link hover-text-color main-color" aria-label="youtube"><i class="ti ti-brand-youtube"></i></a></li>
                                @endif
                                @if (setting('tiktok'))
                                    <li class="tiktok"> <a href="{{ setting('tiktok') }}" class="link hover-text-color main-color" aria-label="tiktok"> <i class="ti ti-brand-tiktok"></i> </a> </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container wow fadeInUp" data-wow-duration="1s">
                <div class="basic-thine-line"></div>
                <div class="row">
                    <div class="footer-copyright text-style-light">
                        <div class="copyright ">
                            <p class="text-center main-color mb-0 pt-4 pb-3">&copy;
                                <script>
                                    document.write(new Date().getFullYear())
                                </script>
                                {{ setting('nama') }}, Supported by <a href="mailto:boelchan@live.com" class=" hover-text-color main-color">Boolean</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- footer part end -->
    </main>
    <!-- Main content end -->
    <!-- Scroll to top -->
    {{-- <a href="#" id="scroll-top" class="scroll-top show with-hover" aria-label="Arrow Up">
            <i class="ti-arrow-up"></i>
        </a> --}}
    @if (setting('whatsapp'))
        <a href="https://api.whatsapp.com/send?phone={{ setting('whatsapp') }}&text=Halo" class="myfloat" target="_blank">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-whatsapp fs-2" width="35" height="35" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M3 21l1.65 -3.8a9 9 0 1 1 3.4 2.9l-5.05 .9"></path>
                <path d="M9 10a.5 .5 0 0 0 1 0v-1a.5 .5 0 0 0 -1 0v1a5 5 0 0 0 5 5h1a.5 .5 0 0 0 0 -1h-1a.5 .5 0 0 0 0 1">
                </path>
            </svg>
        </a>
    @endif
    </div><!-- Wrapper end -->
    <!-- jquery -->
    <script src="{{ asset('front/js/jquery.min.js') }}"></script>
    <!-- Plugins js -->
    <script src="{{ asset('front/js/plugins.js') }}"></script>
    <!-- owl -->
    <script src="{{ asset('front/js/section/owl-carousel-init-min.js') }}"></script>
    <!-- custom js -->
    <script src="{{ asset('front/js/custom.js') }}"></script>
    <!-- script js -->
    <script src="{{ asset('front/js/script.min.js') }}"></script>
</body>

</html>
