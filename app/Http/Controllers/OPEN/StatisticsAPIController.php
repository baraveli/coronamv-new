<?php

namespace App\Http\Controllers\OPEN;

use App\Http\Controllers\AppBaseController;
use App\Modules\Covid19API;

class StatisticsAPIController extends AppBaseController
{


    /**
     * index
     * global summary
     *  This function returns the total statistics of the world
     */
    public function index(Covid19API $covid19api)
    {

        return $this->sendResponse($covid19api->GetTotal(), 'Global data retrieved successfully');
    }
}
