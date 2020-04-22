<?php

namespace App\Http\Controllers\OPEN;

use App\Http\Controllers\AppBaseController;
use App\Modules\CovidRest;

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
    public function index(CovidRest $covidrest)
    {

        return $this->sendResponse($covidrest->GetTotalCountry(), 'Country total retrieved successfully');
    }
    
}