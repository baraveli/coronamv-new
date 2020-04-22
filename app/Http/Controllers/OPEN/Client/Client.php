<?php
namespace App\Http\Controllers\OPEN\Client;

use GuzzleHttp\Client as GuzzleClient;
use Illuminate\Support\Facades\Cache;

use Exception;

class Client implements IClient
{
    /**
     * sendRequest
     *
     *  This function takes care of sending http Get request to api;
     *
     * @param  mixed $endpoint
     * @return void
     */
    public function sendRequest($endpoint, $cachekey)
    {
        try {
            if (!Cache::has($cachekey)) {
                $client = new GuzzleClient();
                $response = $client->request('GET', $endpoint);
                $rawdata = $response->getBody();
                $data = json_decode($rawdata, true);
                Cache::put($cachekey, $data, 3600); // Cache for 1 hour
            }
            return Cache::get($cachekey);
        } catch (Exception $e) {
            throw new \Exception('Error communicating API');
        }
    }
}
