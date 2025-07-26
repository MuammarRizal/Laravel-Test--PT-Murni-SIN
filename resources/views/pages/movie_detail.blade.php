@extends('layouts.app')

@section('title', 'TEST PT MURNI SOULISINDO NUSANTARA | {{ $data->title }}')

@section('content')
  @php
    $modalState = false;
    $trailerID = '';
    if (isset($movieData->videos->results)) {
        foreach ($movieData->videos->result as $video) {
            if (strtolower($item->type) === 'trailer') {
                $trailerID = $item->key;
            }
        }
    }
  @endphp
  <!-- Hero Section -->
  <div class="h-92 relative mt-5 flex h-screen w-full items-center">
    <!-- Backdrop Image -->
    <div class="absolute inset-0 z-10 bg-gradient-to-t from-black via-black/70 to-transparent"></div>
    <div class="absolute inset-0 z-10 bg-gradient-to-r from-black via-black/70 to-transparent"></div>
    <img src="https://image.tmdb.org/t/p/original{{ $data->backdrop_path }}" alt="{{ $data->title }} backdrop"
      class="absolute inset-0 h-full w-full object-cover">

    <!-- Movie Info -->
    <div class="container relative z-20 mx-auto mt-10 px-4 pt-32 md:px-8 md:pt-48 lg:px-16">
      <h1 class="mb-4 text-4xl font-bold text-white md:text-6xl">{{ $data->title }}</h1>

      <div class="mb-6 flex flex-wrap items-center gap-4">
        <span class="font-semibold text-green-500">{{ round($data->vote_average * 10) }}% Match</span>
        <span class="text-gray-300">{{ date('Y', strtotime($data->release_date)) }}</span>
        <span class="rounded border px-2 py-1 text-xs text-gray-300">{{ $data->runtime }} min</span>
        <span class="rounded border px-2 py-1 text-xs text-gray-300">HD</span>
      </div>

      <div class="mb-6 flex flex-wrap gap-3">
        @foreach ($data->genres as $genre)
          <span class="rounded-full bg-gray-800 px-3 py-1 text-sm text-gray-300">{{ $genre->name }}</span>
        @endforeach
      </div>

      <p class="mb-8 max-w-2xl text-lg text-gray-300">{{ $data->overview }}</p>

      <div class="flex flex-wrap gap-4">

        @if ($data->video)
          {
          <button onclick="showModal(true)"
            class="flex items-center gap-2 rounded bg-white px-6 py-2 text-black transition hover:bg-opacity-80">
            <i class="fas fa-play"></i> Play
          </button>
          }
        @else
          <a href="https://www.youtube.com/watch?v={{ $data_video->key }}" target="_blank"
            class="flex items-center gap-2 rounded bg-white px-6 py-2 text-black transition hover:bg-opacity-80">
            <i class="fas fa-play"></i> Play
          </a>
        @endif
      </div>
    </div>
  </div>

  <!-- Additional Info Section -->
  <div class="container mx-auto px-4 py-12 md:px-8 lg:px-16">
    <h2 class="mb-4 text-2xl font-bold">About {{ $data->title }}</h2>
    <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
      <!-- Left Column -->
      <div class="lg:col-span-2">
        <div class="mb-8 grid grid-cols-1 gap-6 md:grid-cols-2">
          <div>
            <h3 class="font-semibold text-gray-400">Tagline</h3>
            <p>"{{ $data->tagline }}"</p>
          </div>
          <div>
            <h3 class="font-semibold text-gray-400">Release Date</h3>
            <p>{{ date('F j, Y', strtotime($data->release_date)) }}</p>
          </div>
          <div>
            <h3 class="font-semibold text-gray-400">Budget</h3>
            <p>${{ number_format($data->budget) }}</p>
          </div>
          <div>
            <h3 class="font-semibold text-gray-400">Revenue</h3>
            <p>${{ number_format($data->revenue) }}</p>
          </div>
          <div>
            <h3 class="font-semibold text-gray-400">Production Companies</h3>
            <div class="mt-2 flex flex-wrap gap-2">
              @foreach ($data->production_companies as $company)
                <span class="rounded-full bg-gray-800 px-3 py-1 text-sm text-gray-300">{{ $company->name }}</span>
              @endforeach
            </div>
          </div>
          <div>
            <h3 class="font-semibold text-gray-400">Languages</h3>
            <div class="mt-2 flex flex-wrap gap-2">
              @foreach ($data->spoken_languages as $language)
                <span
                  class="rounded-full bg-gray-800 px-3 py-1 text-sm text-gray-300">{{ $language->english_name }}</span>
              @endforeach
            </div>
          </div>
        </div>
      </div>

      <!-- Right Column -->
      <div class="space-y-6">
        <div>
          <h3 class="font-semibold text-gray-400">Status</h3>
          <p>{{ $data->status }}</p>
        </div>

        <div>
          <h3 class="mt-2 font-semibold text-gray-400">Original Title</h3>
          <p>{{ $data->original_title }}</p>
        </div>

        <div>
          <h3 class="mt-2 font-semibold text-gray-400">Production Countries</h3>
          @foreach ($data->production_countries as $country)
            <p>{{ $country->name }}</p>
          @endforeach
        </div>

        <div>
          <h3 class="mt-2 font-semibold text-gray-400">Homepage</h3>
          <a href="{{ $data->homepage }}" class="text-blue-400 hover:underline"
            target="_blank">{{ $data->homepage }}</a>
        </div>

        <div>
          <h3 class="mt-2 font-semibold text-gray-400">IMDB</h3>
          <a href="https://www.imdb.com/title/{{ $data->imdb_id }}" class="text-blue-400 hover:underline"
            target="_blank">IMDB Page</a>
        </div>
      </div>
    </div>
  </div>

  <div class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-80 p-4" id="youtube-modal">
    <!-- Modal Content -->
    <div class="relative w-full max-w-4xl">
      <!-- Close Button -->
      <button id="close-modal" class="absolute -top-12 right-0 z-50 text-white hover:text-gray-300 focus:outline-none"
        onclick="closeModal(false)">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24"
          stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>

      <!-- YouTube Player -->
      <div class="aspect-w-16 aspect-h-9 relative z-10 bg-black">
        <iframe src="https://www.youtube.com/embed/{{ $data_video->key }}" title="YouTube video player" frameborder="0"
          class="h-full w-full"
          allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
          referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
      </div>
    </div>
  </div>

  <script>
    function showModal() {
      $("#youtube-modal").show()
    }

    function closeModal() {
      $("#youtube-modal").hide()
    }
  </script>
@endsection
