<?php namespace App\Models;
use CodeIgniter\Model;
class PostModel extends Model {
    protected $table = 'posts';
    protected $allowedFields = ['category_id', 'title', 'slug', 'image', 'excerpt', 'content', 'status', 'published_at'];
    protected $useTimestamps = true;
}
