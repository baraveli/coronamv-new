<?php
namespace App\Modules;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Arr;

class Covid19API
{
    protected $data;

    public function GetTotal() : array
    {
        $data = Cache::remember('covid19.totals', 3600, function () {
             $response = Http::get('https://api.covid19api.com/summary')->json();
            
             $totalData = [
                 'totals' => $response["Global"],
                 'date' =>$response["Date"]
             ];

             return $totalData;
        });

        return $data;
    }

    public function GetTotalCountry() : array
    {
        $data = Cache::remember('covid19.country.total', 3600, function () {
            $response = Http::get('https://api.covid19api.com/summary')->json();
            return $response["Countries"];
       });

       return $data;
    }
}
