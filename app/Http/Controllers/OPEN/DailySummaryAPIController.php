<?php

namespace App\Http\Controllers\OPEN;

use App\Http\Controllers\AppBaseController;
use App\Http\Controllers\OPEN\Client\Client;

class DailySummaryAPIController extends AppBaseController
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
        $response = $this->client->CallApi("https://covid19.mathdro.id/api/daily", "dailyindex23434");

        return $this->sendResponse($response, 'Daily reports retrieved successfully');
    }
    
}
