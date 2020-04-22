<?php
namespace App\Http\Controllers\OPEN\Client;

interface IClient
{
    public function sendRequest($endpoint,$cachekey);
}