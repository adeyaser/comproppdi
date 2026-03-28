<?php namespace App\Models;
use CodeIgniter\Model;
class SettingModel extends Model {
    protected $table = 'settings';
    protected $allowedFields = ['setting_key', 'setting_value'];
    public function getSetting($key) {
        $row = $this->where('setting_key', $key)->first();
        return $row['setting_value'] ?? null;
    }
}
