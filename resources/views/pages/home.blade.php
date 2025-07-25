@extends('layouts.app')

@section('title', 'TEST PT MURNI SOULISINDO NUSANTARA | HOME')

@section('content')
  <section class="relative mt-1">
    <!-- Swiper Container -->
    <div class="swiper netflixHero h-[80vh] w-full">
      <div class="swiper-wrapper">
        @foreach ($banners as $banner)
          <!-- Single Slide -->
          <div class="swiper-slide relative">
            <!-- Video Background with Fallback -->
            <div class="absolute inset-0 z-0">
              <img class="h-full w-full object-cover" src="{{ $tmdb_imageBaseUrl }}/original/{{ $banner->backdrop_path }}"
                alt="{{ $banner->title }}">
              <!-- Gradient Overlay -->
              <div class="absolute inset-0 bg-gradient-to-t from-black via-black/40 to-transparent"></div>
            </div>

            <!-- Content -->
            <div class="relative z-10 flex h-full flex-col justify-center px-6 text-white md:px-16 lg:px-24">
              <div class="max-w-2xl">
                <!-- Title -->
                <h1 class="mb-4 text-4xl font-bold leading-tight drop-shadow-lg md:text-5xl lg:text-6xl">
                  {{ $banner->title }}
                </h1>

                <!-- Metadata Row -->
                <div class="mb-4 flex flex-wrap items-center gap-3 text-sm md:text-base">
                  <span class="font-semibold text-green-500">{{ round($banner->vote_average * 10) }}% Match</span>
                  <span>{{ $banner->release_date ? \Carbon\Carbon::parse($banner->release_date)->format('Y') : 'N/A' }}</span>
                  <span class="border border-gray-400 px-1">{{ $banner->adult ? '18+' : 'PG-13' }}</span>
                  {{-- @if ($banner->runtime)
                    <span>{{ floor($banner->runtime / 60) }}h {{ $banner->runtime % 60 }}m</span>
                  @endif --}}
                </div>

                <!-- Overview -->
                <p class="mb-6 text-sm leading-relaxed text-gray-200 drop-shadow-md md:text-base lg:max-w-xl">
                  {{ Str::limit($banner->overview, 200) }}
                </p>

                <!-- Action Buttons -->
                <div class="flex flex-wrap items-center gap-3">
                  {{-- <a
                  href="{}"
                    class="flex items-center gap-2 rounded bg-white px-5 py-2.5 text-sm font-semibold text-black transition hover:bg-gray-300 md:px-6 md:py-3 md:text-base">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                      <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z"
                        clip-rule="evenodd" />
                    </svg>
                    Play
                  </a> --}}
                  <a href="/movie/{{ $banner->id }}"
                    class="flex items-center gap-2 rounded bg-gray-600 bg-opacity-70 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-opacity-90 md:px-6 md:py-3 md:text-base">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                      <path fill-rule="evenodd"
                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2h-1V9z"
                        clip-rule="evenodd" />
                    </svg>
                    More Info
                  </a>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>

      <!-- Navigation -->
      <div class="swiper-button-next hidden items-center justify-center md:flex"></div>
      <div class="swiper-button-prev hidden items-center justify-center md:flex"></div>

      <!-- Pagination -->
      <div class="swiper-pagination !bottom-4 md:!bottom-8"></div>
    </div>
  </section>

  <div class="mx-auto max-w-7xl overflow-hidden">
    <!-- Section Title -->
    <div class="mb-4 flex items-center">
      <h2 class="my-5 text-2xl font-bold md:text-3xl">Top 10 Movies This Week</h2>
      <span class="top10-badge ml-4 rounded px-2 py-1 text-xs font-bold text-white md:text-sm">TOP 10</span>
    </div>

    <!-- Swiper Container -->
    <div class="relative h-max w-auto py-2">
      <div class="swiper top10Swiper overflow-visible">
        <div class="swiper-wrapper">

          @foreach ($moviesTrending as $movie)
            @php
              $original_date = $movie->release_date;
              $timestamp = strtotime($original_date);
              $movieYear = date('Y', $timestamp);
            @endphp
            <div class="swiper-slide group relative overflow-hidden rounded-lg" style="width: 16.666%;">
              <a href="/movie/{{ $movie->id }}" class="relative aspect-[2/3]">
                <img src="{{ $tmdb_imageBaseUrl }}/original/{{ $movie->poster_path }}" alt=""
                  class="h-full w-full object-cover">
                <div
                  class="absolute left-0 top-0 h-full w-full bg-gradient-to-t from-black/80 to-transparent opacity-0 transition-opacity duration-300 group-hover:opacity-100">
                </div>
                <div
                  class="absolute bottom-0 left-0 p-2 opacity-0 transition-opacity duration-300 group-hover:opacity-100">
                  <h3 class="text-sm font-bold text-white md:text-base">{{ $movie->title }}</h3>
                  <h4 class="text-xs font-bold text-gray-300">{{ $movieYear }}</h4>
                  <div class="mt-1 flex items-center text-gray-200">
                    <span class="text-xs text-yellow-400">★</span>
                    <span class="ml-1 text-xs">{{ number_format($movie->vote_average, 1) }}/10</span>
                  </div>
                </div>
                <div class="absolute left-0 top-0 rounded-br bg-red-600 px-2 py-1 text-xs font-bold text-white">
                  #{{ $loop->iteration }}</div>
              </a>
            </div>
          @endforeach

        </div>
      </div>
    </div>
  </div>
@endsection
