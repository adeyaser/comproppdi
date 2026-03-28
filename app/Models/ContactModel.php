<?php namespace App\Models;

use CodeIgniter\Model;

class ContactModel extends Model
{
    protected $table = 'contacts';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'email', 'subject', 'message', 'status', 'created_at'];
    protected $useTimestamps = false;
}
