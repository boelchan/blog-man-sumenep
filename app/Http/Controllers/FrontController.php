<?php

namespace App\Http\Controllers;

use App\Enum\CategoryEnum;
use App\Models\Category;
use App\Models\Poly;
use App\Models\Post;
use App\Models\Profile;
use App\Models\Room;
use App\Models\Service;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Spatie\Searchable\Search;

class FrontController extends Controller
{
    public function navbarMenu()
    {
        $profilMenu = Profile::where('publish', 'ya')->get();
        $kategoriMenu = Category::whereNotIn('id', [1, 2, 3])->get();

        return ['profilMenu' => $profilMenu, 'kategoriMenu' => $kategoriMenu];
    }

    public function index()
    {
        $navbarMenu = $this->navbarMenu();

        $banner = Post::where('kategori_id', CategoryEnum::BANNER)->where('publish', 'ya')->orderBy('publish_at', 'asc')->get();
        $post = Post::where('tampil_banner', 'ya')->where('publish', 'ya')->orderBy('publish_at', 'desc')->orderBy('updated_at', 'desc')->get();
        $slider = $banner->merge($post);

        $pamflet = Post::where('kategori_id', CategoryEnum::PAMFLET)->where('publish', 'ya')->orderBy('publish_at', 'desc')->orderBy('updated_at', 'desc')->get()->take(6);
        $tentangKami = Profile::find(1);

        $meta = [
            'title' => 'Beranda',
            'category' => 'Beranda',
            'description' => 'MAN Sumenep',
            'keywords' => 'MAN Sumenep',
            'image' => setting('logo'),
        ];

        return view('front.index', compact('navbarMenu', 'slider', 'tentangKami', 'pamflet', 'meta'));
    }

    public function agenda($slug = '')
    {
        $navbarMenu = $this->navbarMenu();

        if ($slug) {
            $post = Post::where('slug', $slug)->where('kategori_id', CategoryEnum::AGENDA)->where('publish', 'ya')->first();

            if (! $post) {
                return redirect()->route('front.agenda');
            }

            $meta = [
                'title' => $post->judul,
                'category' => $post->kategori->nama,
                'description' => ($post->meta_description != '' ? $post->meta_description : Str::limit($post->konten, 250)),
                'keywords' => $post->meta_keywords,
                'image' => $post->url_gambar,
            ];

            return view('front.post-detail', compact('navbarMenu', 'post', 'meta'));
        } else {
            $post = Post::where('kategori_id', CategoryEnum::AGENDA)->where('publish', 'ya')->orderBy('publish_at', 'desc')->orderBy('updated_at', 'desc')->paginate(15);

            $meta = [
                'title' => 'Agenda',
                'category' => 'Agenda',
                'description' => 'Agenda di RSIA Siti Aisyah Pamekasan',
                'keywords' => 'Agenda, Kegiatan',
                'image' => setting('logo'),
            ];

            return view('front.post', compact('navbarMenu', 'post', 'meta'));
        }
    }

    public function artikel($slug = '')
    {
        $navbarMenu = $this->navbarMenu();

        if ($slug) {
            $post = Post::where('slug', $slug)->where('kategori_id', CategoryEnum::ARTIKEL)->where('publish', 'ya')->first();

            if (! $post) {
                return redirect()->route('front.artikel');
            }

            $meta = [
                'title' => $post->judul,
                'category' => $post->kategori->nama,
                'description' => ($post->meta_description != '' ? $post->meta_description : Str::limit($post->konten, 250)),
                'keywords' => $post->meta_keywords,
                'image' => $post->url_gambar,
            ];

            return view('front.post-detail', compact('navbarMenu', 'post', 'meta'));
        } else {
            $post = Post::where('kategori_id', CategoryEnum::ARTIKEL)->where('publish', 'ya')->orderBy('publish_at', 'desc')->orderBy('updated_at', 'desc')->paginate(15);

            $meta = [
                'title' => 'Artikel',
                'category' => 'Artikel',
                'description' => 'Artikel di RSIA Siti Aisyah Pamekasan',
                'keywords' => 'Artikel',
                'image' => setting('logo'),
            ];

            return view('front.post', compact('navbarMenu', 'post', 'meta'));
        }
    }

    public function promo($slug = '')
    {
        $navbarMenu = $this->navbarMenu();

        if ($slug) {
            $post = Post::where('slug', $slug)->where('kategori_id', CategoryEnum::PROMO)->where('publish', 'ya')->first();

            if (! $post) {
                return redirect()->route('front.promo');
            }

            $meta = [
                'title' => $post->judul,
                'category' => $post->kategori->nama,
                'description' => ($post->meta_description != '' ? $post->meta_description : Str::limit($post->konten, 250)),
                'keywords' => $post->meta_keywords,
                'image' => $post->url_gambar,
            ];

            return view('front.post-detail', compact('navbarMenu', 'post', 'meta'));
        } else {
            $post = Post::where('kategori_id', CategoryEnum::PROMO)->where('publish', 'ya')->orderBy('publish_at', 'desc')->orderBy('updated_at', 'desc')->paginate(15);
            $meta = [
                'title' => 'Promo',
                'category' => 'Promo',
                'description' => 'Promo di RSIA Siti Aisyah Pamekasan',
                'keywords' => 'Promo, diskon, potongan, sale',
                'image' => setting('logo'),
            ];

            return view('front.post', compact('navbarMenu', 'post', 'meta'));
        }
    }

    public function informasi($slug = '')
    {
        $navbarMenu = $this->navbarMenu();

        if ($slug) {
            $post = Post::where('slug', $slug)->where('kategori_id', CategoryEnum::INFORMASI)->where('publish', 'ya')->first();

            if (! $post) {
                return redirect()->route('front.informasi');
            }

            $meta = [
                'title' => $post->judul,
                'category' => $post->kategori->nama,
                'description' => ($post->meta_description != '' ? $post->meta_description : Str::limit($post->konten, 250)),
                'keywords' => $post->meta_keywords,
                'image' => $post->url_gambar,
            ];

            return view('front.post-detail', compact('navbarMenu', 'post', 'meta'));
        } else {
            $post = Post::where('kategori_id', CategoryEnum::INFORMASI)->where('publish', 'ya')->orderBy('publish_at', 'desc')->orderBy('updated_at', 'desc')->paginate(15);
            $meta = [
                'title' => 'Informasi',
                'category' => 'Informasi',
                'description' => 'Informasi di RSIA Siti Aisyah Pamekasan',
                'keywords' => 'Informasi, pengumuman',
                'image' => setting('logo'),
            ];

            return view('front.post', compact('navbarMenu', 'post', 'meta'));
        }
    }

    public function gallery($slug = '')
    {
        $navbarMenu = $this->navbarMenu();

        if ($slug) {
            $post = Post::where('slug', $slug)->where('kategori_id', CategoryEnum::GALLERY)->where('publish', 'ya')->first();

            if (! $post) {
                return redirect()->route('front.gallery');
            }

            $meta = [
                'title' => $post->judul,
                'category' => $post->kategori->nama,
                'description' => ($post->meta_description != '' ? $post->meta_description : Str::limit($post->konten, 250)),
                'keywords' => $post->meta_keywords,
                'image' => $post->url_gambar,
            ];

            return view('front.post-detail', compact('navbarMenu', 'post', 'meta'));
        } else {
            $post = Post::where('kategori_id', CategoryEnum::GALLERY)->where('publish', 'ya')->orderBy('publish_at', 'desc')->orderBy('updated_at', 'desc')->paginate(15);
            $meta = [
                'title' => 'Gallery',
                'category' => 'Gallery',
                'description' => 'Gallery di RSIA Siti Aisyah Pamekasan',
                'keywords' => 'Gallery, foto, video',
                'image' => setting('logo'),
            ];

            return view('front.post', compact('navbarMenu', 'post', 'meta'));
        }
    }

    public function pelayanan($slug = '')
    {
        $navbarMenu = $this->navbarMenu();

        if ($slug) {
            $post = Service::where('slug', $slug)->where('publish', 'ya')->first();

            if (! $post) {
                return redirect()->route('front.pelayanan');
            }

            $meta = [
                'title' => $post->nama,
                'category' => 'Pelayanan',
                'description' => ($post->meta_description != '' ? $post->meta_description : Str::limit($post->konten, 250)),
                'keywords' => $post->meta_keywords,
                'image' => $post->url_gambar,
            ];

            return view('front.post-detail', compact('navbarMenu', 'post', 'meta'));
        } else {
            $post = Service::where('publish', 'ya')->get();
            $meta = [
                'title' => 'Pelayanan',
                'category' => 'Pelayanan',
                'description' => 'pelayanan',
                'keywords' => 'Pelayanan, rawat jalan, rawat inap, ICU, UGD',
                'image' => setting('logo'),
            ];

            return view('front.pelayanan', compact('navbarMenu', 'post', 'meta'));
        }
    }

    public function pelayananRajal($slug = '')
    {
        $navbarMenu = $this->navbarMenu();

        if ($slug) {
            $post = Poly::where('slug', $slug)->where('publish', 'ya')->first();

            if (! $post) {
                return redirect()->route('front.rajal');
            }

            $meta = [
                'title' => $post->nama,
                'category' => 'Rawat Jalan',
                'description' => ($post->meta_description != '' ? $post->meta_description : Str::limit($post->konten, 250)),
                'keywords' => $post->meta_keywords,
                'image' => $post->url_gambar,
            ];

            return view('front.post-detail', compact('navbarMenu', 'post', 'meta'));
        } else {
            $post = Poly::where('publish', 'ya')->get();
            $detail = Service::find(1);

            $meta = [
                'title' => 'Rawat Jalan',
                'category' => 'Rawat Jalan',
                'description' => $detail->meta_description,
                'keywords' => $detail->meta_keywords,
                'image' => $detail->url_gambar,
            ];

            return view('front.poli', compact('navbarMenu', 'post', 'meta', 'detail'));
        }
    }

    public function pelayananRanap($slug = '')
    {
        $navbarMenu = $this->navbarMenu();

        if ($slug) {
            $post = Room::where('slug', $slug)->where('publish', 'ya')->first();

            if (! $post) {
                return redirect()->route('front.ranap');
            }

            $meta = [
                'title' => $post->nama,
                'category' => 'Rawat Inap',
                'description' => ($post->meta_description != '' ? $post->meta_description : Str::limit($post->konten, 250)),
                'keywords' => $post->meta_keywords,
                'image' => $post->url_gambar,
            ];

            return view('front.post-detail', compact('navbarMenu', 'post', 'meta'));
        } else {
            $post = Room::where('publish', 'ya')->get();
            $detail = Service::find(2);

            $meta = [
                'title' => 'Rawat Inap',
                'category' => 'Rawat Inap',
                'description' => $detail->meta_description,
                'keywords' => $detail->meta_keywords,
                'image' => $detail->url_gambar,
            ];

            return view('front.room', compact('navbarMenu', 'post', 'meta', 'detail'));
        }
    }

    public function profil($slug = '')
    {
        $navbarMenu = $this->navbarMenu();

        if ($slug) {
            $post = Profile::where('slug', $slug)->where('publish', 'ya')->first();

            if (! $post) {
                return redirect()->route('front.profil');
            }

            $meta = [
                'title' => $post->nama,
                'category' => 'Profil',
                'description' => ($post->meta_description != '' ? $post->meta_description : Str::limit($post->konten, 250)),
                'keywords' => $post->meta_keywords,
                'image' => $post->url_gambar,
            ];

            return view('front.post-detail-single', compact('navbarMenu', 'post', 'meta'));
        } else {
            $post = Profile::where('publish', 'ya')->get();
            $meta = [
                'title' => 'Profil',
                'category' => 'Profil',
                'description' => 'Profil RSIA Siti Aisyah Pamekasan',
                'keywords' => 'Profil, sejarah, visi, misi',
                'image' => setting('logo'),
            ];

            return view('front.profil', compact('navbarMenu', 'post', 'meta'));
        }
    }

    public function banner($slug = '')
    {
        $navbarMenu = $this->navbarMenu();

        if ($slug) {
            $post = Post::where('slug', $slug)->where('kategori_id', CategoryEnum::BANNER)->where('publish', 'ya')->first();

            $meta = [
                'title' => $post->judul,
                'category' => $post->kategori->nama,
                'description' => ($post->meta_description != '' ? $post->meta_description : Str::limit($post->konten, 250)),
                'keywords' => $post->meta_keywords,
                'image' => $post->url_gambar,
            ];

            return view('front.post-detail', compact('navbarMenu', 'post', 'meta'));
        } else {
            $post = Post::where('kategori_id', CategoryEnum::BANNER)->where('publish', 'ya')->paginate(15);
            $meta = [
                'title' => 'Banner',
                'category' => 'Banner',
                'description' => 'Banner RSIA Siti Aisyah Pamekasan',
                'keywords' => 'Banner, pamflet',
                'image' => setting('logo'),
            ];

            return view('front.post', compact('navbarMenu', 'post', 'meta'));
        }
    }

    public function pamflet($slug = '')
    {
        $navbarMenu = $this->navbarMenu();
        $title = 'pamflet';

        if ($slug) {
            $post = Post::where('slug', $slug)->where('kategori_id', CategoryEnum::PAMFLET)->where('publish', 'ya')->first();
            $meta = [
                'title' => $post->judul,
                'category' => $post->kategori->nama,
                'description' => ($post->meta_description != '' ? $post->meta_description : Str::limit($post->konten, 250)),
                'keywords' => $post->meta_keywords,
                'image' => $post->url_gambar,
            ];

            return view('front.post-detail', compact('navbarMenu', 'post', 'meta'));
        } else {
            $post = Post::where('kategori_id', CategoryEnum::PAMFLET)->where('publish', 'ya')->paginate(15);
            $meta = [
                'title' => 'pamflet',
                'category' => 'pamflet',
                'description' => 'pamflet, promo, banner',
                'keywords' => 'pamflet, promo, banner',
                'image' => setting('logo'),
            ];

            return view('front.post', compact('navbarMenu', 'post', 'meta', 'title'));
        }
    }

    public function dokter($slug = '')
    {
        $navbarMenu = $this->navbarMenu();

        if ($slug) {
            $post = Team::where('slug', $slug)->where('publish', 'ya')->first();
            $meta = [
                'title' => $post->nama,
                'category' => 'Dokter',
                'description' => ($post->meta_description != '' ? $post->meta_description : Str::limit($post->konten, 250)),
                'keywords' => $post->meta_keywords,
                'image' => $post->url_gambar,
            ];

            return view('front.dokter-detail', compact('navbarMenu', 'post', 'meta'));
        } else {
            $post = Team::where('publish', 'ya')->paginate(8);
            $meta = [
                'title' => 'Dokter',
                'category' => 'Dokter',
                'description' => 'Dokter Spesialis RSIA Siti Aisyah Pamekasan',
                'keywords' => 'Dokter, spesialis',
                'image' => setting('logo'),
            ];

            return view('front.dokter', compact('navbarMenu', 'post', 'meta'));
        }
    }

    public function cari(Request $request)
    {
        $navbarMenu = $this->navbarMenu();

        $meta = [
            'title' => 'Pencarian',
            'category' => 'pencarian',
            'description' => 'pencarian  RSIA Siti Aisyah Pamekasan',
            'keywords' => 'pencarian, search, cari',
            'image' => setting('logo'),
        ];
        $q = $request->search;

        $searchResults = (new Search())
            ->registerModel(Poly::class, 'nama', 'konten')
            ->registerModel(Room::class, 'nama', 'konten')
            ->registerModel(Service::class, 'nama', 'konten')
            ->registerModel(Team::class, 'nama', 'jabatan')
            ->registerModel(Post::class, 'judul', 'konten')
            ->search(trim($q));

        return view('front.pencarian', compact('navbarMenu', 'q', 'searchResults', 'meta'));
    }
}
