<?php

namespace App\Http\Controllers\OPEN;

use App\Http\Controllers\AppBaseController;

use App\Models\Maldives;
use App\Models\Risk;
use App\Models\Total;
use App\Models\Test;
use Illuminate\Support\Facades\Cache;
use Jinas\Covid19\MV\HPA;

class MaldivesDetailAPIController extends AppBaseController
{
    /**
     * index
     *
     *  Return a json response of Maldives data and risks locations as an array
     *
     * 
     *
     */
    public function index()
    {

        $data = Cache::remember('maldives.data', 600, function (){
            return $this->tranform(new HPA);
        });


        return $this->sendResponse($data, 'Maldives data retrieved successfully');
    }

    /**
     * tranform
     * 
     *  Tranforms the data for output
     *
     * @param  mixed $hpa
     * @param  mixed $totals
     * @param  mixed $tests
     * @return void
     */
    protected function tranform(HPA $hpa)
    {
        $local = $hpa->GetLocalTotal();

        return [
            'Location' => 'Maldives',
            'cases' => Maldives::all(),
            'risks' => Risk::orderBy('created_at', 'desc')->get(),
            'totals' => $local
            //'travel_bans' => $this->BuildTravelBans($hpa->GetTravelBans())

        ];
    }


    /**
     * BuildTravelBans
     * 
     *  Builds up the travel bans for outout
     * 
     *  Strips off the date active from
     *
     * @param  mixed $travelbans
     * @return void
     */
    protected function BuildTravelBans($travelbans)
    {
        foreach ($travelbans as $ban) {
            $DataWithDate[] = [
                'name' => $ban["dhivehi_country"],
                'date' => str_replace("Active from ", "", $ban["english_details"])
            ];
        }

        return $DataWithDate;
    }
}
