<?php

namespace App\Http\Controllers\OPEN;

use App\Http\Controllers\AppBaseController;
use App\Http\Controllers\OPEN\Client\Client;
use App\Modules\ScraperModule;

class LiveFeedAPIController extends AppBaseController
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client;
    }
    /**
     * index
     *
     *  Return global cases per day
     *
     * @param  mixed $client
     */
    public function index()
    {
        $response = $this->client->sendRequest("https://feeds.coronamv.live/api/timeline",'elivefeed343');

        return $this->sendResponse($response["data"], ' live feed retrieved successfully');
    }
    
    /**
     * maldives
     * 
     *  Get the aggrigated maldives news
     *
     * @param  mixed $scrapermodule
     * @return void
     */
    public function maldives(ScraperModule $scrapermodule)
    {
        return $this->sendResponse($scrapermodule->dispatch(), 'Mv News feed retrieved successfully');
    }
   
}
