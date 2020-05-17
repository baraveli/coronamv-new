<?php

namespace App\Http\Controllers\OPEN;

use App\Http\Controllers\AppBaseController;
use App\Modules\Covid19API;

class CountriesDetailAPIController extends AppBaseController
{
    
    /**
     * Total
     *
     *  Get total number of cases in countries
     *
     * @param  mixed $global
     * @return void
     */
    public function index(Covid19API $covid19api)
    {

        return $this->sendResponse($covid19api->GetTotalCountry(), 'Country total retrieved successfully');
    }
    
}