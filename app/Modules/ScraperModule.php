<?php
namespace App\Modules;

use App\Modules\Scrapers\Mihaaru;
use App\Modules\Scrapers\Avas;
use App\Modules\Scrapers\Sun;
use Illuminate\Support\Facades\Cache;

class ScraperModule
{
    /**
     * dispatch
     *
     *  This method takes care of dispatching the scrapers and encoding the array accordingly to return as json
     *
     * @return void
     */
    public function dispatch()
    {
        if (!Cache::has('mvfeeds54')) {
            //$mihaaru = new Mihaaru();
            $avas = new Avas();
            $sun = new Sun();

            $collection = collect($avas->scrap())->merge($sun->scrap());
    
            $data = $collection->shuffle();
            Cache::put('mvfeeds54', $data, 600); //10 min caching
        }

        $data = Cache::get('mvfeeds54');

        return $data;
    }
}
