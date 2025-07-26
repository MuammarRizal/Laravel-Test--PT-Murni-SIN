<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
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

        return view('pages.search', [
            'tmdb_baseUrl' => $this->baseURL,
            'tmdb_imageBaseUrl' => $this->imageBaseUrl,
            'tmdb_api_key' => $this->apiKey,
            'minimalVoter' => $this->minimalVoter,
            'defaultSort' => $this->defaultSort,
            'defaultPage' => $this->defaultPage,
        ]);
    }
}
