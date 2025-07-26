@extends('layouts.app')

@section('title', 'TEST PT MURNI SOULISINDO NUSANTARA | HOME')

@section('content')
  <div class="relative min-h-screen w-full p-5">
    <div class="flex gap-2">
      <input id="search-input" type="text" placeholder="Cari..." onclick="onSearch"
        class="w-52 rounded-md border border-gray-300 py-2 pl-3 pr-4 text-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500">
      <button id="search-submit"
        class="rounded-md bg-gray-800 px-6 py-2 font-medium text-slate-100 transition-colors duration-300 hover:bg-gray-700"
        onclick="onSearch()">
        Search
      </button>

    </div>
    <div class="mt-4 grid grid-cols-2 gap-4 px-8 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5" id="movie-container">
      <div class="col-span-full flex flex-col items-center justify-center py-12 text-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24"
          stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
        </svg>
        <h3 class="mt-4 text-lg font-medium text-gray-900">Cari film favorit Anda</h3>
        <p class="mt-1 text-sm text-gray-500">Gunakan kolom pencarian di atas untuk menemukan film</p>
      </div>
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

    function onSearch(e) {
      const valueInput = $('#search-input').val()
      const url = `${baseURL}/search/movie?api_key=${apiKey}&query=${valueInput}`
      getData(url)
    }

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

    function searchNotFound(input) {
      return `
            <div class="col-span-full flex flex-col items-center justify-center py-12 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                </svg>
                <h3 class="mt-4 text-lg font-medium text-gray-900">Film tidak ditemukan</h3>
                <p class="mt-1 text-sm text-gray-500">Tidak ada hasil untuk "<span class="font-medium text-indigo-600" id="search-query">${input}</span>"</p>
            </div>
        `
    }

    function getData(url) {
      $.ajax({
          url: url,
          type: "GET",
          beforeSend: () => $loadingSpinner.show(),
        })
        .done((response) => {
          $loadingSpinner.hide();
          if (response.results.length === 0) {
            const inputValue = $('#search-input').val()
            $movieContainer.html(searchNotFound(inputValue))
            return
          }
          $movieContainer.html(processResponse(response));
          currentPage++;
        })
        .fail(handleError);
    }
  </script>
@endsection
