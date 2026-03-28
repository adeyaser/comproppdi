<?php

namespace App\Helpers;

class BroadcastHelper
{
    public static function getLoginToken()
    {
        $apiUrl = env('broadcast.api_url') ?: 'https://maziskappdi.com';
        $username = env('broadcast.api_user') ?: 'admin';
        $password = env('broadcast.api_pass') ?: 'admin123';

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => rtrim($apiUrl, '/') . '/auth/login',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode([
                "username" => $username,
                "password" => $password
            ]),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6MSwidXNlcm5hbWUiOiJhZG1pbiIsImlhdCI6MTc3NDcwNDgwOCwiZXhwIjoxNzc0NzkxMjA4fQ._D3_PbNu80vEnZUrtJIlcRC4_amsaX5h1imRBV8Z19o'
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            log_message('error', 'Broadcast Auth Error: ' . $err);
            return null;
        }

        $res = json_decode($response, true);
        if(!isset($res['token'])) {
            log_message('error', 'Broadcast Auth Failed: ' . $response);
        }
        return $res['token'] ?? null;
    }

    public static function sendBulkMessage($members, $imageUrl, $caption, $deviceId = null)
    {
        $token = self::getLoginToken();
        if (!$token) {
            return ['status' => false, 'message' => 'Failed to get authentication token'];
        }

        $apiUrl = env('broadcast.api_url') ?: 'https://maziskappdi.com';
        if(!$deviceId) {
            $deviceId = env('broadcast.device_id') ?: 'dev_a63d121d';
        }

        $curl = curl_init();

        // Handle localhost images (Remote API cannot access local files)
        if (strpos($imageUrl, 'localhost') !== false || strpos($imageUrl, '127.0.0.1') !== false) {
            log_message('info', 'Broadcast: Localhost detected, swapping to public placeholder.');
            $imageUrl = 'https://images.bisnis.com/posts/2023/01/09/1616472/img-20230102-wa0035-1.jpg';
        }

        $data = [
            "deviceId" => $deviceId,
            "members"  => $members,
            "message"  => "",
            "type"     => "image",
            "url"      => $imageUrl,
            "caption"  => $caption
        ];

        curl_setopt_array($curl, array(
            CURLOPT_URL => rtrim($apiUrl, '/') . '/api/groups/send-bulk-direct',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_TIMEOUT => 60,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer ' . $token
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            log_message('error', 'Broadcast Send Error: ' . $err);
            return ['status' => false, 'message' => $err];
        }

        log_message('info', 'Broadcast API Response: ' . $response);
        return json_decode($response, true);
    }

    public static function getDevices()
    {
        $token = self::getLoginToken();
        if (!$token) {
            return [];
        }

        $apiUrl = env('broadcast.api_url') ?: 'https://maziskappdi.com';
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => rtrim($apiUrl, '/') . '/api/devices',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $token
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            log_message('error', 'Broadcast GetDevices Error: ' . $err);
            return [];
        }

        $res = json_decode($response, true);
        return $res['data'] ?? $res; // Fallback to raw res if no 'data' wrapper
    }
}
