<?php

namespace App\Http\Controllers\OPEN;

use App\Http\Controllers\AppBaseController;

use App\Models\Maldives;
use App\Models\Risk;
use App\Models\Total;
use App\Models\Test;
use Illuminate\Support\Facades\Cache;
use Jinas\Covid19\MV\HPA;
use Illuminate\Support\Arr;

class MaldivesDetailAPIController extends AppBaseController
{
    /**
     * index
     *
     *  Return a json response of Maldives data and risks locations as an array
     *
     * @param  mixed $maldives
     *
     */
    public function index(Test $tests, Total $totals)
    {

        $data = Cache::remember('maldives.data', 3, function () use ($totals, $tests) {
            $hpa = new HPA;
            $local = $hpa->GetLocalTotal();

            return [
                'Location' => 'Maldives',
                'cases' => Maldives::all(),
                'risks' => Risk::orderBy('created_at', 'desc')->get(),
                'totals' => $totals->GetLatestTotal(),
                'total_isolation' => $local["Isolation Facilities"],
                'total_quarantine' => $local["Quarantine Facilities"],
                'tests' =>  $tests->GetLatestTest(),
                'travel_bans' => $this->BuildDhivehiBanDate($hpa->GetTravelBans())

            ];
        });


        return $this->sendResponse($data, 'Maldives data retrieved successfully');
    }

    protected function BuildDhivehiBanDate($data)
    {
        foreach ($data as $detail) {
            $newdata[] = [
                'name' => $detail["dhivehi_country"],
                'date' => str_replace("Active from ", "", $detail["english_details"])
            ];
        }

        return $newdata;
    }
}
