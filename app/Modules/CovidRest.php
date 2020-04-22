<?php
namespace App\Modules;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Arr;

class CovidRest
{
    protected $data;

    public function GetTotal() : array
    {
        $data = Cache::remember('covidrest.totals', 1800, function () {
             $response = Http::get('http://covid-rest.herokuapp.com');
             $total = json_decode($response->body(),true);

             foreach($total["data"] as $key => $value)
             {
                 if(in_array("world", $value))
                 {
                     $totalData = $total["data"][$key];
                 }
             }

             return $totalData;
        });

        return $data;
    }

    public function GetTotalCountry() : array
    {
        $data = Cache::remember('covidrest.country.total', 1800, function () {
            $response = Http::get('http://covid-rest.herokuapp.com');
            $country = json_decode($response->body(),true);
            return $country["data"];
       });

       return $data;
    }
}
