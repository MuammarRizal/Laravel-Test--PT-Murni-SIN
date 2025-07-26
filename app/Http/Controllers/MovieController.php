<?php

namespace App\Http\Controllers;

use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MovieController extends Controller
{
    protected $baseURL;
    protected $imageBaseUrl;
    protected $apiKey;
    protected $minimalVoter = 100;
    protected $defaultSort = 'popularity.desc';
    protected $defaultPage = 1;

    public function __construct()
    {
        $this->baseURL = env('TMDB_API_URL');
        $this->imageBaseUrl = env('TMDB_API_IMAGE_URL');
        $this->apiKey = env('TMDB_API_KEY');
    }

    public function index()
    {
        Debugbar::info(
            Http::get("{$this->baseURL}/trending/all/week", ['api_key' => $this->apiKey])
        );

        return view('pages.home', [
            'tmdb_baseUrl' => $this->baseURL,
            'tmdb_imageBaseUrl' => $this->imageBaseUrl,
            'tmdb_api_key' => $this->apiKey,
            'banners' => $this->getTrendingData('movie', 5),
            'moviesTrending' => $this->getTrendingData('movie'),
            'tvTrending' => $this->getTrendingData('tv')
        ]);
    }

    public function movies()
    {
        $response = $this->fetchMediaData('movie');

        return view('pages.movies', $this->buildViewData(
            'movies', 
            $response
        ));
    }

    public function tv()
    {
        $response = $this->fetchMediaData('tv');

        return view('pages.tv', $this->buildViewData(
            'tvShows', 
            $response
        ));
    }

    public function movieDetail(string $id){
        // {{TMDB_URL}}/movie/1087192?api_key={{TMDB_API_KEY}}
        $dataResponse = Http::get("{$this->baseURL}/movie/{$id}",[
            'api_key' => $this->apiKey
        ]);

        $data = [];
        if ($dataResponse -> successful()){
            $data = $dataResponse->object();
            if(!isset($data)){
                $data = [];
            }
        }

        $responseVideo = Http::get("{$this->baseURL}/movie/{$id}/videos",[
            'api_key' => $this->apiKey
        ]);
        $dataVideo= '';
        Debugbar::info($responseVideo);
        if ($responseVideo -> successful()){
            $videoData = $responseVideo->object()->results;
            if(isset($videoData)){
                $firstVideo = collect($videoData)->first();
                $dataVideo = $firstVideo;
            }
        }

        
        Debugbar::info($responseVideo);
        Debugbar::info($data);
        return view('pages.movie_detail', [
            'tmdb_baseUrl' => $this->baseURL,
            'tmdb_imageBaseUrl' => $this->imageBaseUrl,
            'tmdb_api_key' => $this->apiKey,
            'data' => $data,
            'data_video' => $dataVideo
        ]);
    }
    public function tvDetail(string $id){
        // {{TMDB_URL}}/movie/1087192?api_key={{TMDB_API_KEY}}
        $dataResponse = Http::get("{$this->baseURL}/tv/{$id}",[
            'api_key' => $this->apiKey
        ]);

        $data = [];
        if ($dataResponse -> successful()){
            $data = $dataResponse->object();
            if(!isset($data)){
                $data = [];
            }
        }

        $responseVideo = Http::get("{$this->baseURL}/tv/{$id}/videos",[
            'api_key' => $this->apiKey
        ]);
        $dataVideo= '';
        Debugbar::info($responseVideo);
        if ($responseVideo -> successful()){
            $videoData = $responseVideo->object()->results;
            if(isset($videoData)){
                $firstVideo = collect($videoData)->first();
                $dataVideo = $firstVideo;
            }
        }

        
        Debugbar::info($responseVideo);
        Debugbar::info($data);
        return view('pages.tv_detail', [
            'tmdb_baseUrl' => $this->baseURL,
            'tmdb_imageBaseUrl' => $this->imageBaseUrl,
            'tmdb_api_key' => $this->apiKey,
            'data' => $data,
            'data_video' => $dataVideo
        ]);
    }

    protected function fetchMediaData(string $mediaType)
    {
        return Http::get("{$this->baseURL}/discover/{$mediaType}", [
            'api_key' => $this->apiKey,
            'sort_by' => $this->defaultSort,
            'vote_count.gte' => $this->minimalVoter,
            'page' => $this->defaultPage
        ]);
    }

    protected function buildViewData(string $itemsKey, $response)
    {
        $items = $response->successful() 
            ? $response->object()->results ?? []
            : [];

        return [
            'tmdb_baseUrl' => $this->baseURL,
            'tmdb_imageBaseUrl' => $this->imageBaseUrl,
            'tmdb_api_key' => $this->apiKey,
            $itemsKey => $items,
            'sortBy' => $this->defaultSort,
            'page' => $this->defaultPage,
            'minimalVoter' => $this->minimalVoter
        ];
    }

    protected function getTrendingData(string $mediaType, int $dataLength = 10)
    {
        $response = Http::get("{$this->baseURL}/trending/{$mediaType}/week", [
            'api_key' => $this->apiKey
        ]);

        if (!$response->successful()) {
            return [];
        }

        $results = $response->object()->results ?? [];
        return array_slice($results, 0, $dataLength);
    }
}