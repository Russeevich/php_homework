<?php

use Intervention\Image\AbstractFont;
use Intervention\Image\Constraint;
use Intervention\Image\ImageManager;

require_once "vendor/autoload.php";

$manager = new ImageManager(["driver" => "imagick"]);

$img = $manager->make(__DIR__ . DIRECTORY_SEPARATOR . 'photo.png');

echo $img->resize(200, null, function (Constraint $option){
            $option->aspectRatio();
        })
        ->text('Loftschool', $img->getWidth() / 2, $img->getHeight() / 2, function (AbstractFont $font){
            $font->size(60);
            $font->color([0, 0, 0, 0.5]);
            $font->file('Sirius Cursiv.ttf');
            $font->valign('center');
            $font->align('center');
        })
        ->response('png', 100);