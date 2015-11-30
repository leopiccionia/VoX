<?php

/**
 * To run PHP server just paste the code bellow in root path :
 * Estando na pasta VoX, execute: php -S 0.0.0.0:8000  .\webServer.php
 **/

if (preg_match('/\.css|\.js|\.jpg|\.png|\.map$/', $_SERVER['REQUEST_URI'], $match)) {
    $mimeTypes = [
        '.css' => 'text/css',
        '.js'  => 'application/javascript',
        '.jpg' => 'image/jpg',
        '.png' => 'image/png',
        '.map' => 'application/json'
    ];
    $path = __DIR__ . $_SERVER['REQUEST_URI'];
    if (is_file($path)) {
        header("Content-Type: {$mimeTypes[$match[0]]}");
        require $path;
        exit;
    }
}

require 'bootstrap.php';

?>