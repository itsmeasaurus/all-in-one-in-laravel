<?php

namespace App\Services;

use App\Services\Geolocation\GeolocationFacade;

class Playground
{
    public function __construct()
    {
        $data = GeolocationFacade::search('hello');
        dump($data);
    }
}