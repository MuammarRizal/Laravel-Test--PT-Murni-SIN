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
    <div class="flex justify-between">
      <h2 class="mb-4 text-xl font-bold">Popular on MovieFlix</h2>
      <div class="relative right-0 inline-block text-left">
        <div>
          <button type="button" id="dropdownButton"
            class="inline-flex w-full justify-center rounded-md border border-gray-300 bg-slate-500 px-4 py-2 text-sm font-medium text-white shadow-sm transition-all hover:bg-gray-50 hover:text-black focus:outline-none"
            aria-expanded="true" aria-haspopup="true">
            Filter
            <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
              stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
          </button>
        </div>

        <div id="dropdownMenu"
          class="absolute right-0 z-20 mt-2 hidden w-40 origin-top-right rounded-md bg-slate-400 shadow-lg ring-1 ring-black ring-opacity-5">
          <div class="py-1">
            <button onclick="filterData('popular')"
              class="block w-full px-4 py-2 text-left text-sm text-slate-100 hover:bg-slate-600">Popular</button>
            <button onclick="filterData('top_rated')"
              class="block w-full px-4 py-2 text-left text-sm text-slate-100 hover:bg-slate-600">Top Rated</button>
            <button onclick="filterData('upcoming')"
              class="block w-full px-4 py-2 text-left text-sm text-slate-100 hover:bg-slate-600">Upcoming</button>
          </div>
        </div>
      </div>

    </div>
    <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5" id="movie-container">
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
    <div class="mt-8 flex justify-center">
      <button id="load-more"
        class="rounded-md bg-gray-800 px-6 py-2 font-medium text-slate-100 transition-colors duration-300 hover:bg-gray-700"
        onclick="loadMore('{{ $tmdb_baseUrl }}', '{{ $tmdb_api_key }}', '{{ $page }}', '{{ $sortBy }}','{{ $tmdb_imageBaseUrl }}')">
        Load More
      </button>
    </div>
  </div>

  <script>
    $("#errorNotification").hide();
    $("#loadingSpinner").hide();
    let currentPage = 1

    function loadMore(baseURL, apiKey, page, minimalVoter, tmdb_imageBaseUrl) {
      $.ajax({
          url: `${baseURL}/discover/movie?api_key=${apiKey}&sort_by=popularity.desc&vote_count.gte=${minimalVoter}&page=${++currentPage}`,
          type: "get",
          beforeSend: function() {
            $("#loadingSpinner").show();
          },
        })
        .done(function(response) {
          $("#loadingSpinner").hide()

          if (response.results) {}
          const dataResponse = response.results.map((item) => {
            const {
              id,
              title,
              release_date,
              poster_path,
              vote_average,
              overview
            } = item
            const original_date = release_date;
            const date = new Date(original_date);
            const movieYear = date.getFullYear();
            return `
            <div class="group relative overflow-hidden rounded-lg">
                <a href="/movie/${ id }" class="relative aspect-[2/3]">
                    <img src="${ tmdb_imageBaseUrl }/w500/${ poster_path }" alt="${ title }"
                    class="h-full w-full object-cover">
                    <div
                    class="absolute left-0 top-0 h-full w-full bg-gradient-to-t from-black/80 to-transparent opacity-0 transition-opacity duration-300 group-hover:opacity-100">
                    </div>
                    <div class="absolute bottom-0 left-0 p-2 opacity-0 transition-opacity duration-300 group-hover:opacity-100">
                    <h3 class="text-sm font-bold text-white md:text-base">${ title }</h3>
                    <h4 class="text-xs font-bold text-gray-300">${ movieYear }</h4>
                    <div class="mt-1 flex items-center text-gray-200">
                        <span class="text-xs text-yellow-400">★</span>
                        <span class="ml-1 text-xs">${ vote_average }/10</span>
                    </div>
                    </div>
                </a>
            </div>`
          })
          $("#movie-container").append(dataResponse.join(''))
          currentPage++
        })
        .fail(function(jqHXR, ajaxOptions, thrownError) {
          $("#loadingSpinner").hide();

          $("#errorNotification").show()

          setTimeout(() => {
            $("#errorNotification").hide()
          }, 3000);
        });
    }
  </script>
@endsection
