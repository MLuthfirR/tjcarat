<?php

namespace App\Http\Services\Connections;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;

trait CreateConnection {

    public function connect($method, $requestUrl, $formParams = [], $headers = [], $content = 'json')
    {
        $client = new Client([
            'base_uri' => $this->baseUri,
        ]);

        try {
            $response = $client->request($method, $requestUrl, ['headers' => $headers, $content => $formParams]);
            return $response->getBody()->getContents();
        } catch (BadResponseException $e) {
            if ($e->getResponse()) {
                return $e->getResponse()->getBody()->getContents();
            }
            return json_encode($e->getMessage());
        }
    }
}
