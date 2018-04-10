<?php
/**
 * Created by PhpStorm.
 * User: USUARIO
 * Date: 28/03/2018
 * Time: 11:03 PM
 */

$base = __DIR__ . '/../app/';

$folders = [
    'lib',
    'model',
    'middleware',
    'validation',
    'route',
];

foreach($folders as $f)
{
    foreach (glob($base . "$f/*.php") as $k => $filename)
    {
        require $filename;
    }
}

