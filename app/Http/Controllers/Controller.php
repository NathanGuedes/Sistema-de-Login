<?php

namespace Http\Controllers;

use Exception;
use League\Plates\Engine;

class Controller
{
    /**
     * @throws Exception
     */
    public static function view(string $view, array $data = [])
    {

        $path = basePath() . '/resources/views/';

        if (! file_exists($path . $view . '.php')) {
            throw new Exception('View ' . $view . ' does not exist');
        }

        $templates = new Engine($path);
        return $templates->render($view, $data);
    }
}