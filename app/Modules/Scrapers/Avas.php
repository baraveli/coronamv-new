<?php
namespace App\Modules\Scrapers;

use Goutte\Client;

class Avas implements IScraper
{
    public $data = [];

    public $time = [];

    /**
     * scrap
     *
     *  Get the latest update of the article related to coronavirus_outbreak in avas.mv
     *
     * @return void
     */
    public function scrap()
    {
        try {
            $goutte = new Client();
            $baseURL = 'https://avas.mv/covid-19';
            $crawler = $goutte->request('GET', $baseURL);
            if ($goutte->getResponse()->getStatusCode() == 200) {
                $data = [];
            
                $crawler->filter('div[class*="block md:flex rtl md:-mx-4 mb-7"] h3')->each(function ($node) use (&$data) {
                    $data['title'][] = $node->text();
                });
         
                $crawler->filter('div[class*="block md:flex rtl md:-mx-4 mb-7"] a')->each(function ($node) use (&$data) {
                    $data['href'][] = $node->attr('href');
                });
        
                foreach ($data['title'] as $index => $title) {
                    $this->data[] = [
                        'title' => $title,
                        'href' => "https://avas.mv". $data['href'][$index],
                        'logo' => 'avas.png'
                    ];
                }
                return $this->data;
            }
        } catch (Exception $e) {
        }
    }
}
