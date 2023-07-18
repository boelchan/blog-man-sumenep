<?php

namespace App\Http\Controllers;

use App\Enum\CategoryEnum;
use App\Models\Alumni;
use App\Models\Category;
use App\Models\Post;
use App\Models\Profile;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Spatie\Searchable\Search;

class FrontController extends Controller
{
    public function navbarMenu()
    {
        $profil = Post::select(['id', 'judul', 'slug'])->where(['publish' => 'ya', 'kategori_id' => CategoryEnum::PROFIL])->get();
        $kategori = Category::whereNotIn('id', [1, 2, 3])->get();

        return ['profil' => $profil, 'kategori' => $kategori];
    }

    public function index()
    {
        $navbarMenu = $this->navbarMenu();

        $banner = Post::where('kategori_id', CategoryEnum::BANNER)->where('publish', 'ya')->orderBy('publish_at', 'asc')->get();
        $post = Post::where('tampil_banner', 'ya')->where('publish', 'ya')->orderBy('publish_at', 'desc')->orderBy('updated_at', 'desc')->get();
        $slider = $banner->merge($post);

        $lastestPost = Post::where('publish', 'ya')->orderBy('publish_at', 'desc')->orderBy('updated_at', 'desc')->get();

        $pamflet = Post::where('kategori_id', CategoryEnum::PAMFLET)->where('publish', 'ya')->orderBy('publish_at', 'desc')->orderBy('updated_at', 'desc')->get()->take(6);
        $tentangKami = Profile::find(1);
        $fasilitas = Service::all();

        $meta = [
            'title' => 'Beranda',
            'category' => 'Beranda',
            'description' => 'MAN Sumenep',
            'keywords' => 'MAN Sumenep',
            'image' => setting('logo'),
        ];

        return view('front.index', compact('navbarMenu', 'slider', 'tentangKami', 'pamflet', 'meta', 'fasilitas', 'lastestPost'));
    }

    public function post($slug = '')
    {
        $navbarMenu = $this->navbarMenu();

        $post = Post::where('slug', $slug)->where('publish', 'ya')->first();

        if (! $post) {
            return redirect()->route('index');
        }

        $meta = [
            'title' => $post->judul,
            'category' => $post->kategori->nama,
            'description' => ($post->meta_description != '' ? $post->meta_description : Str::limit($post->konten, 250)),
            'keywords' => $post->meta_keywords,
            'image' => $post->gambar_url,
        ];

        return view('front.post-detail', compact('navbarMenu', 'post', 'meta'));
    }

    public function kategori($kategoriSlug)
    {
        $navbarMenu = $this->navbarMenu();

        $kategori = Category::firstWhere('slug', $kategoriSlug);

        if (! $kategori) {
            return redirect()->route('index');
        }

        $post = Post::where('kategori_id', $kategori->id)
            ->where('publish', 'ya')
            ->orderBy('publish_at', 'desc')
            ->orderBy('updated_at', 'desc')
            ->paginate(15);

        $meta = [
            'title' => 'Post',
            'category' => $kategori->nama,
            'description' => $kategori->nama,
            'keywords' => 'Agenda, Kegiatan, '.$kategori->nama,
            'image' => setting('logo'),
        ];

        return view('front.post', compact('navbarMenu', 'post', 'meta'));
    }

    public function fasilitas($slug = '')
    {
        $navbarMenu = $this->navbarMenu();

        $post = Service::where('slug', $slug)->where('publish', 'ya')->first();

        if (! $post) {
            return redirect()->route('index');
        }

        $meta = [
            'title' => $post->nama,
            'category' => 'Fasilitas',
            'description' => ($post->meta_description != '' ? $post->meta_description : Str::limit($post->konten, 250)),
            'keywords' => $post->meta_keywords,
            'image' => $post->icon_url,
        ];

        return view('front.fasilitas-detail', compact('navbarMenu', 'post', 'meta'));
    }

    public function cari(Request $request)
    {
        $navbarMenu = $this->navbarMenu();

        $meta = [
            'title' => 'Pencarian',
            'category' => 'Pencarian',
            'description' => 'pencarian',
            'keywords' => 'pencarian, search, cari',
            'image' => setting('logo'),
        ];

        $q = $request->search;

        $searchResults = (new Search())
            ->registerModel(Post::class, 'judul', 'konten')
            ->search(trim($q));

        return view('front.pencarian', compact('navbarMenu', 'q', 'searchResults', 'meta'));
    }

    // alumni
    public function alumni($id = '')
    {
        $navbarMenu = $this->navbarMenu();

        if ($id) {
            $post = Alumni::findOrFail($id);

            if (! $post) {
                return redirect()->route('index');
            }

            $meta = [
                'title' => $post->nama,
                'category' => 'Detail Alumni',
                'description' => 'alumni',
                'keywords' => $post->meta_keywords,
                'image' => $post->foto_url,
            ];

            return view('front.alumni.show', compact('navbarMenu', 'post', 'meta'));
        } else {
            $post = Alumni::orderBy('updated_at', 'desc')
                ->when(request()->tahun_lulus, function ($q) {
                    $q->where('tahun_lulus', request()->tahun_lulus);
                })
                ->when(request()->jurusan, function ($q) {
                    $q->where('jurusan', request()->jurusan);
                });

            $postCount = $post->count();
            $post = $post->paginate(16);

            $meta = [
                'title' => 'Alumni',
                'category' => 'Alumni',
                'description' => 'alumni',
                'keywords' => 'alumni',
                'image' => setting('logo'),
            ];

            return view('front.alumni.index', compact('navbarMenu', 'meta', 'post', 'postCount'));
        }
    }

    public function alumniCreate()
    {
        $navbarMenu = $this->navbarMenu();
        $meta = [
            'title' => 'Alumni',
            'category' => 'Tambah Alumni Baru',
            'description' => 'alumni',
            'keywords' => 'alumni',
            'image' => setting('logo'),
        ];

        return view('front.alumni.create', compact('navbarMenu', 'meta'));
    }

    public function alumniStore(Request $request)
    {
        $request->validate([
            'foto' => 'mimes:jpg,jpeg,png|max:1000|required',
            'nama' => 'required|max:250',
            'tahun_lulus' => 'required',
            'jurusan' => 'required',
            'domisili' => 'required',
        ]);

        $id = Alumni::create($request->all());

        return redirect()->route('front.alumni.baca', $id);
    }
}
