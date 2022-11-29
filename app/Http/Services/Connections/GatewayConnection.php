<?php

namespace App\Http\Services\Connections;

use App\Http\Services\Connections\CreateConnection;

class GatewayConnection {

    use CreateConnection;

    public $baseUri;

    public function __construct()
    {
        $this->baseUri = config('connection.GATEWAY_URL');
    }

    public function callApi($config_name, $data = [], $content = 'json', $token = null, $headers = [])
    {
        $config = config('api.'.$config_name);
        $user_token = session()->get('user_token') ? json_decode(session()->get('user_token'), true) : [];
        $token = isset($user_token['access_token']) ? 'Bearer '.$user_token['access_token'] : null;

        if ($config) {
            $headers['Authorization'] = $token;
            $headers['Accept'] = '*/json';

            $method = $config['method'];
            $url = $config['url'];

            return $this->connect($method, $url, $data, $headers, $content);
        }
    }
}
