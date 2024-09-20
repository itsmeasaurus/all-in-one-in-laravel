<?php

namespace App\Helpers\Routes;

use RecursiveIterator;
use RecursiveIteratorIterator;

class RouteHelper
{
    public static function loadRoutes($path)
    {
        $directory = new \RecursiveDirectoryIterator($path);
        $iterator = new \RecursiveIteratorIterator($directory, RecursiveIteratorIterator::LEAVES_ONLY);
        foreach ($iterator as $file) {
            if ($file->getExtension() === 'php') {
                require $file->getPathname();
            }
        }
    
    }
}