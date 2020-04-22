<?php

namespace App\Http\Controllers\OPEN;

use App\Http\Controllers\AppBaseController;
use App\Modules\CovidRest;

class StatisticsAPIController extends AppBaseController
{


    /**
     * index
     * global summary
     *  This function returns the total statistics of the world
     */
    public function index(CovidRest $covidrest)
    {

        return $this->sendResponse($covidrest->GetTotal(), 'Global data retrieved successfully');
    }
}
