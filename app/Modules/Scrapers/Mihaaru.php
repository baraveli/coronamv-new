<?php
namespace App\Modules\Scrapers;

use Goutte\Client;

class Sun implements IScraper
{
    public $data = [];

    public $time = [];

    /**
     * scrap
     *
     *  Get the latest update of the article related to coronavirus_outbreak in Sun
     *
     * @return void
     */
    public function scrap()
    {
        $goutte = new Client();

        $baseURL = 'http://www.sun.mv/covid19';

        $crawler = $goutte->request('GET', $baseURL);

        $data = [];
 
        $crawler->filter('div[class*="row custom-gutter flex-row-reverse"] div[class*="col-xl-5 col-lg-6 col-md-12 w-100"] a h1')->each(function ($node) use (&$data) {
            $data['title'][] = $node->text();
        });

        $crawler->filter('div[class*="row custom-gutter flex-row-reverse"] div[class*="col-xl-5 col-lg-6 col-md-12 w-100"] a')->each(function ($node) use (&$data) {
            $data['href'][] = $node->attr('href');
        });

        $crawler->filter('div[class*="row custom-gutter flex-row-reverse"] div[class*="col-xl-4 col-lg-3 col-sm-6 w-100 --fill-height"] h2')->each(function ($node) use (&$data) {
            $data['title'][] = $node->text();
        });

        $crawler->filter('div[class*="row custom-gutter flex-row-reverse"] div[class*="col-xl-4 col-lg-3 col-sm-6 w-100 --fill-height"] a')->each(function ($node) use (&$data) {
            $data['href'][] = $node->attr('href');
        });

        $crawler->filter('div[class*="row custom-gutter flex-row-reverse"] div[class*="col-xl-3 col-lg-3 col-sm-6 w-100 --fill-height"] h3')->each(function ($node) use (&$data) {
            $data['title'][] = $node->text();
        });

        $crawler->filter('div[class*="row custom-gutter flex-row-reverse"] div[class*="col-xl-3 col-lg-3 col-sm-6 w-100 --fill-height"] a')->each(function ($node) use (&$data) {
            $data['href'][] = $node->attr('href');
        });

     
     
    
        foreach ($data['title'] as $index => $title) {
            $this->data[] = [
                    'title' => $title,
                    'href' => $data['href'][$index],
                    'logo' => 'sun.png'
                ];
        }

        return $this->data;
    }
}
