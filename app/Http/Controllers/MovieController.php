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

        $bannerResponse = Http::get("{$baseURL}/trending/all/week",[
            'api_key' => $apiKey
        ]);
        Debugbar::info($bannerResponse);
        $trendingMovies = $this->getDataAPI('trending', 'movie', 'week', 10);
        $trendingTV = $this->getDataAPI('trending', 'tv', 'week', 10);
        $banners = $this->getDataAPI('trending', 'movie', 'week', 5);
       

        return view('pages.home', [
            'tmdb_baseUrl' => $baseURL,
            'tmdb_imageBaseUrl' => $imageBaseUrl,
            'tmdb_api_key' => $apiKey,
            'banners' => $banners,
            'moviesTrending' => $trendingMovies,
            'tvTrending' => $trendingTV
            
        ]);
    }

    private function getDataAPI($type='trending', $media='movie', $daily='week',$datalength=10){
        $baseURL = env('TMDB_API_URL');
        $apiKey = env('TMDB_API_KEY');

        $endpoint = "{$baseURL}/{$type}/{$media}/{$daily}";

        $response = Http::get($endpoint,[
            'api_key' => $apiKey
        ]);


        if (!$response->successful()) {
        // Log error or return empty array
            return [];
        }

        $results = $response->object()->results ?? [];

        // Ambil hanya sejumlah data yang diinginkan
        return array_slice($results, 0, $datalength);
        // $data = [];

        // if ($response -> successful()){
        //     $dataResponse = $response->object()->results;
        //     if(isset($dataResponse)){
        //         foreach ($dataResponse as $item) {
        //             array_push($data, $item);

        //             if(count($data) == $datalength){
        //                 break;
        //             }
        //         }
        //     }
        // }
        // return $data;
    }
}
