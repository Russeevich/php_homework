<?php

use Intervention\Image\ImageManager;

require_once "vendor/autoload.php";

$manager = new ImageManager(["driver" => "imagick"]);

$image = $manager->make(__DIR__ . DIRECTORY_SEPARATOR . 'photo.png')
        ->crop(200, 0)
        ->insert("https://internetsotrudnik.ru/wp-content/uploads/2017/05/unnamed-2-200x200.jpg", 'center')
        ->save(__DIR__ . DIRECTORY_SEPARATOR . 'newPhoto.png', 100);