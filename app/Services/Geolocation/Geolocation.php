<?php

namespace App\Services\Geolocation;

use App\Services\Map\Map;
use App\Services\Satellite\Satellite;

class Geolocation
{
    public function __construct(public Map $map, public Satellite $satellite)
    {
        
    }

    public function search(string $name)
    {
        $locationInfo = $this->map->findAddress($name);
        return $this->satellite->pinpoint($locationInfo);
    }
}