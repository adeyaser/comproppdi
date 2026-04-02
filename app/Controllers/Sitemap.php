<?php

namespace App\Controllers;

use App\Models\PostModel;
use App\Models\ProgramModel;
use App\Models\PageModel;
use CodeIgniter\Controller;

class Sitemap extends BaseController
{
    public function index()
    {
        if (ob_get_level() > 0) ob_clean();
        $postModel = new PostModel();
        $programModel = new ProgramModel();
        $pageModel = new PageModel();

        $posts = $postModel->where('status', 'published')->orderBy('published_at', 'DESC')->findAll();
        $programs = $programModel->where('is_active', 1)->findAll();
        $pages = $pageModel->findAll();

        $data = [
            'posts' => $posts,
            'programs' => $programs,
            'pages' => $pages,
            'base_url' => base_url()
        ];

        return $this->response->setHeader('Content-Type', 'text/xml')
                              ->setBody(view('sitemap', $data));
    }

    public function robots()
    {
        $robots = "User-agent: *\n";
        $robots .= "Disallow: /admin/\n";
        $robots .= "Allow: /\n\n";
        $robots .= "Sitemap: " . base_url('sitemap.xml');

        return $this->response->setHeader('Content-Type', 'text/plain')
                              ->setBody($robots);
    }
}
