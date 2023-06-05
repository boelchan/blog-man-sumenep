<?php

namespace App\Http\Controllers;

use App\Enum\CategoryEnum;
use App\Models\Category;
use App\Models\Post;
use App\Models\Profile;
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

    public function post($slug = '')
    {
        $navbarMenu = $this->navbarMenu();

        if ($slug) {
            $post = Post::where('slug', $slug)->where('publish', 'ya')->first();

            if (! $post) {
                return redirect()->route('front.post.index');
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
            $post = Post::where('publish', 'ya')->orderBy('publish_at', 'desc')->orderBy('updated_at', 'desc')->paginate(15);

            $meta = [
                'title' => 'Post',
                'category' => 'Agenda',
                'description' => '',
                'keywords' => 'Agenda, Kegiatan',
                'image' => setting('logo'),
            ];

            return view('front.post', compact('navbarMenu', 'post', 'meta'));
        }
    }

    public function kategori($kategoriSlug)
    {
        $navbarMenu = $this->navbarMenu();

        $kategori = Category::firstWhere('slug', $kategoriSlug);
        $post = Post::where('kategori_id', $kategori->id)->where('publish', 'ya')->orderBy('publish_at', 'desc')->orderBy('updated_at', 'desc')->paginate(15);

        $meta = [
            'title' => 'Post',
            'category' => $kategori->nama,
            'description' => $kategori->nama,
            'keywords' => 'Agenda, Kegiatan',
            'image' => setting('logo'),
        ];

        return view('front.post', compact('navbarMenu', 'post', 'meta'));
    }

    public function cari(Request $request)
    {
        $navbarMenu = $this->navbarMenu();

        $meta = [
            'title' => 'Pencarian',
            'category' => 'Pencarian',
            'description' => 'pencarian  RSIA Siti Aisyah Pamekasan',
            'keywords' => 'pencarian, search, cari',
            'image' => setting('logo'),
        ];

        $q = $request->search;

        $searchResults = (new Search())
            ->registerModel(Post::class, 'judul', 'konten')
            ->search(trim($q));

        return view('front.pencarian', compact('navbarMenu', 'q', 'searchResults', 'meta'));
    }
}
