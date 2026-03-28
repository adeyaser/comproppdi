<?php namespace App\Models;
use CodeIgniter\Model;
class PageModel extends Model {
    protected $table = 'pages';
    protected $allowedFields = ['slug', 'title', 'content', 'image', 'type', 'gallery'];
    protected $useTimestamps = true;
}
