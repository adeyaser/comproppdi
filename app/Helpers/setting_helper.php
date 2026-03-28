<?php

if (!function_exists('get_setting')) {
    function get_setting($key, $default = '') {
        $db = \Config\Database::connect();
        $row = $db->table('settings')->where('setting_key', $key)->get()->getRow();
        return $row ? $row->setting_value : $default;
    }
}
