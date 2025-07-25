<?php

namespace App\Http\Controllers;

use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MovieController extends Controller
{
    public function index(){
        $baseURL = env('TMDB_API_URL');
        $imageBaseUrl = env('TMDB_API_IMAGE_URL');
        $apiKey = env('TMDB_API_KEY');
        $MAX_BANNER = 5;

        $bannerResponse = Http::get("{$baseURL}/trending/movie/week",[
            'api_key' => $apiKey
        ]);
        Debugbar::info($bannerResponse);
        $bannerArray = [];

        if ($bannerResponse -> successful()){
            $resultArray = $bannerResponse->object()->results;
            if(isset($resultArray)){
                foreach ($resultArray as $item) {
                    array_push($bannerArray, $item);

                    if(count($bannerArray) == $MAX_BANNER){
                        break;
                    }
                }
            }
        }

        return view('pages.home', [
            'tmdb_baseUrl' => $baseURL,
            'tmdb_imageBaseUrl' => $imageBaseUrl,
            'tmdb_api_key' => $apiKey,
            'banners' => $bannerArray
        ]);
    }
}
