<?php
namespace Database\Factories;

use Faker\Provider\Base;

class CustomFakerProvider extends Base
{
    public function urlPicsumPhotos($width = 400, $height = 300, $category=null)
    {
        $baseUrl = "https://picsum.photos//{$width}/{$height}";

        if ($category) {
            $baseUrl .= "?category={$category}";
        }

        return $baseUrl;
    }
}