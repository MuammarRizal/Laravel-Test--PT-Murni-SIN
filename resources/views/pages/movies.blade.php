@extends('layouts.app')
@section('title', 'TEST PT MURNI SOULISINDO NUSANTARA | Movies')

@section('content')
  <div class="relative h-96 bg-gradient-to-r from-gray-900 to-transparent">
    <div
      class="absolute inset-0 bg-[url('https://image.tmdb.org/t/p/original/yzqaKAhglTrkeOfuIXYYArf0WnA.jpg')] bg-cover bg-center opacity-50">
    </div>
    <div class="relative flex h-full items-center px-8 md:px-16">
      <div class="max-w-xl">
        <h1 class="mb-4 text-4xl font-bold md:text-5xl">Stranger Things</h1>
        <p class="mb-6 text-lg">When a young boy vanishes, a small town uncovers a mystery involving secret experiments,
          terrifying supernatural forces and one strange little girl.</p>
        <div class="flex space-x-4">
          <button class="flex items-center space-x-2 rounded bg-white px-6 py-2 text-black hover:bg-opacity-80">
            <i class="fas fa-play"></i>
            <span>Play</span>
          </button>
          <button class="flex items-center space-x-2 rounded bg-gray-600 bg-opacity-70 px-6 py-2 hover:bg-opacity-50">
            <i class="fas fa-info-circle"></i>
            <span>More Info</span>
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- Movie Sections -->
  <div class="relative p-8">
    <div class="mb-4 flex items-center justify-between">
      <h2 class="text-xl font-bold md:text-2xl">MovieFlix</h2>
      <div class="relative">
        <select id="movie-filter"
          class="cursor-pointer appearance-none rounded-md border border-gray-600 bg-gray-700 py-2 pl-3 pr-8 text-sm text-white transition-all focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500"
          onchange="filterMovies(this.value)">
          <option value="now_playing" class="bg-gray-700">Now Playing</option>
          <option value="popular" class="bg-gray-700">Popular</option>
          <option value="top_rated" class="bg-gray-700">Top Rated</option>
          <option value="upcoming" class="bg-gray-700">Upcoming</option>
        </select>
        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-400">
          <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
          </svg>
        </div>
      </div>
    </div>

  </div>
  <div class="grid grid-cols-2 gap-4 px-8 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5" id="movie-container">
    @foreach ($movies as $movie)
      @php
        $original_date = $movie->release_date;
        $timestamp = strtotime($original_date);
        $movieYear = date('Y', $timestamp);
      @endphp
      <div class="group relative overflow-hidden rounded-lg">
        <a href="/movie/{{ $movie->id }}" class="relative aspect-[2/3]">
          <img src="{{ $tmdb_imageBaseUrl }}/w500/{{ $movie->poster_path }}" alt="{{ $movie->title }}"
            class="h-full w-full object-cover">
          <div
            class="absolute left-0 top-0 h-full w-full bg-gradient-to-t from-black/80 to-transparent opacity-0 transition-opacity duration-300 group-hover:opacity-100">
          </div>
          <div class="absolute bottom-0 left-0 p-2 opacity-0 transition-opacity duration-300 group-hover:opacity-100">
            <h3 class="text-sm font-bold text-white md:text-base">{{ $movie->title }}</h3>
            <h4 class="text-xs font-bold text-gray-300">{{ $movieYear }}</h4>
            <div class="mt-1 flex items-center text-gray-200">
              <span class="text-xs text-yellow-400">★</span>
              <span class="ml-1 text-xs">{{ number_format($movie->vote_average, 1) }}/10</span>
            </div>
          </div>
        </a>
      </div>
    @endforeach
  </div>

  <!-- Load More Button -->
  <div id="loadingSpinner" class="flex justify-center">
    <div class="flex h-40 items-center justify-center">
      <div class="h-10 w-10 animate-spin rounded-full border-4 border-blue-500 border-t-transparent"></div>
    </div>
  </div>
  <div class="index-30 fixed bottom-5 right-4">
    <!-- Error Notification -->
    <div id="errorNotification"
      class="relative mx-auto mt-4 max-w-md rounded border border-red-400 bg-red-100 px-4 py-3 text-red-700 transition-all"
      role="alert">
      <strong class="font-bold">Error!</strong>
      <span class="block sm:inline">Gagal memuat data. Silakan coba lagi.</span>
    </div>

  </div>
  <div class="my-8 flex justify-center">
    <button id="load-more"
      class="rounded-md bg-gray-800 px-6 py-2 font-medium text-slate-100 transition-colors duration-300 hover:bg-gray-700"
      onclick="loadMore()">
      Load More
    </button>
  </div>
  </div>

  <script>
    let currentPage = 1;
    let filterMoviePage = 1;
    const baseURL = "{{ $tmdb_baseUrl }}";
    const apiKey = "{{ $tmdb_api_key }}";
    const minimalVoter = "{{ $minimalVoter }}";
    const imageBaseUrl = "{{ $tmdb_imageBaseUrl }}";

    // DOM Elements
    const $errorNotification = $("#errorNotification").hide();
    const $loadingSpinner = $("#loadingSpinner").hide();
    const $movieContainer = $("#movie-container");

    function handleError() {
      $loadingSpinner.hide();
      $errorNotification.show().delay(3000).fadeOut();
    }

    function createMovieElement(item) {
      const {
        id,
        title,
        release_date,
        poster_path,
        vote_average
      } = item;
      const movieYear = new Date(release_date).getFullYear();

      return `
        <div class="group relative overflow-hidden rounded-lg">
            <a href="/movie/${id}" class="relative aspect-[2/3]">
                <img src="${imageBaseUrl}/w500/${poster_path}" alt="${title}"
                class="h-full w-full object-cover">
                <div
                class="absolute left-0 top-0 h-full w-full bg-gradient-to-t from-black/80 to-transparent opacity-0 transition-opacity duration-300 group-hover:opacity-100">
                </div>
                <div class="absolute bottom-0 left-0 p-2 opacity-0 transition-opacity duration-300 group-hover:opacity-100">
                <h3 class="text-sm font-bold text-white md:text-base">${title}</h3>
                <h4 class="text-xs font-bold text-gray-300">${movieYear}</h4>
                <div class="mt-1 flex items-center text-gray-200">
                    <span class="text-xs text-yellow-400">★</span>
                    <span class="ml-1 text-xs">${vote_average}/10</span>
                </div>
                </div>
            </a>
        </div>`;
    }

    function processResponse(response) {
      if (response.results) {
        return response.results.map(createMovieElement).join('');
      }
      return '';
    }

    function loadMore() {
      const url =
        `${baseURL}/discover/movie?api_key=${apiKey}&sort_by=popularity.desc&vote_count.gte=${minimalVoter}&page=${++currentPage}`;

      $.ajax({
          url: url,
          type: "GET",
          beforeSend: () => $loadingSpinner.show(),
        })
        .done((response) => {
          $loadingSpinner.hide();
          $movieContainer.append(processResponse(response));
        })
        .fail(handleError);
    }

    function getFilterData(url) {
      $.ajax({
          url: url,
          type: "GET",
          beforeSend: () => $loadingSpinner.show(),
        })
        .done((response) => {
          $loadingSpinner.hide();
          $movieContainer.append(processResponse(response));
          currentPage++;
        })
        .fail(handleError);
    }

    function filterMovies(filter) {
      $movieContainer.empty();
      const urlApi = `${baseURL}/movie/${filter}?api_key=${apiKey}&language=en-US&page=${filterMoviePage}`;
      getFilterData(urlApi);
    }
  </script>
@endsection
