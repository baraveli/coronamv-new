<?php

namespace App\Http\Controllers\OPEN\Client;

use GuzzleHttp\Client as GuzzleClient;
use Illuminate\Support\Facades\Cache;

use Exception;

class Client
{
    /**
     * CallApi
     *
     *  This function takes care of sending http Get request to api;
     *
     * @param  mixed $endpoint
     * @return void
     */
    public function CallApi($endpoint, $cachekey)
    {
        try {
            return Cache::remember($cachekey, 3600, function () use ($endpoint, $cachekey) {
                $client = new GuzzleClient();
                $response = $client->request('GET', $endpoint);
                $rawdata = $response->getBody();
                return json_decode($rawdata, true);
            });
        } catch (Exception $e) {
            throw new \Exception('Error communicating API');
        }
    }
}
