<?php namespace App\Models;
use CodeIgniter\Model;
class ProgramModel extends Model {
    protected $table = 'programs';
    protected $allowedFields = ['name', 'slug', 'type', 'default_amount', 'target_amount', 'collected_amount', 'description', 'image', 'is_active'];
    protected $useTimestamps = true;
}
