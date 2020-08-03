<?php

use Illuminate\Support\Facades\Route;
use Jinas\Covid19\Render;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Cache;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('coronamv.index');
});


Route::get('/resources', function () {
    return view('coronamv.resources.index');
});

Route::get('/render/global', function () {

    return Cache::remember('global.image', 900, function () {
        $response = Response::make(Render::RenderGlobal());

        // set content-type
        $response->header('Content-Type', 'image/png');

        // output
        return $response;
    });
});
