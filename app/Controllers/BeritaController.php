<?php namespace App\Controllers;

class BeritaController extends BaseController {
    public function index() {
        $postModel = new \App\Models\PostModel();
        $db = \Config\Database::connect();
        
        $data['categories'] = $db->table('categories')->where('type', 'berita')->get()->getResultArray();
        $data['posts'] = $postModel->select('posts.*, categories.name as category_name, categories.slug as category_slug')
                                   ->join('categories', 'categories.id = posts.category_id', 'left')
                                   ->where('posts.status', 'published')
                                   ->orderBy('posts.published_at', 'DESC')
                                   ->findAll();
        $data['active_category'] = 'semua';
        $data['title'] = 'Kabar & Berita Terbaru';
        
        return view('berita/index', $data);
    }
    
    public function kategori($segment) {
        $postModel = new \App\Models\PostModel();
        $db = \Config\Database::connect();
        
        $data['categories'] = $db->table('categories')->where('type', 'berita')->get()->getResultArray();
        $data['posts'] = $postModel->select('posts.*, categories.name as category_name, categories.slug as category_slug')
                                   ->join('categories', 'categories.id = posts.category_id', 'left')
                                   ->where('categories.slug', $segment)
                                   ->where('posts.status', 'published')
                                   ->orderBy('posts.published_at', 'DESC')
                                   ->findAll();
        $data['active_category'] = $segment;
        $data['title'] = 'Berita: ' . ucwords(str_replace('-', ' ', $segment));
        
        return view('berita/index', $data);
    }
    public function artikel() { return view('pages/fallback', ['title' => 'Artikel']); }
    public function laporan() { return view('pages/fallback', ['title' => 'Laporan (Keuangan & LZN)']); }
    public function pustaka() { return view('pages/fallback', ['title' => 'Pustaka']); }
    public function detail($slug) {
        $postModel = new \App\Models\PostModel();
        $post = $postModel->where('slug', $slug)->first();
        if (!$post) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        return view('berita/detail', ['title' => $post['title'], 'post' => $post]);
    }
}
