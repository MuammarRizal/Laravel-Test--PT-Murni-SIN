@extends('layouts.app')

@section('title', 'TEST PT MURNI SOULISINDO NUSANTARA | HOME')

@section('content')
  <section class="relative">
    <!-- Swiper Container -->
    <div class="swiper netflixHero h-screen w-full">
      <div class="swiper-wrapper">
        @foreach ($banners as $banner)
          <!-- Single Slide -->
          <div class="swiper-slide relative">
            <!-- Video Background with Fallback -->
            <div class="absolute inset-0 z-0">
              <video autoplay loop muted playsinline class="h-full w-full object-cover">
                <source src="{{ $banner->video_backdrop ?? 'https://www.w3schools.com/howto/rain.mp4' }}"
                  type="video/mp4" />
                <!-- Fallback Image -->
                <img
                  src="{{ $banner->backdrop_path ? $tmdb_imageBaseUrl . 'w1280' . $banner->backdrop_path : asset('images/placeholder.jpg') }}"
                  alt="{{ $banner->title }}" class="h-full w-full object-cover">
              </video>
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
                  <button
                    class="flex items-center gap-2 rounded bg-white px-5 py-2.5 text-sm font-semibold text-black transition hover:bg-gray-300 md:px-6 md:py-3 md:text-base">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                      <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z"
                        clip-rule="evenodd" />
                    </svg>
                    Play
                  </button>
                  <button
                    class="flex items-center gap-2 rounded bg-gray-600 bg-opacity-70 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-opacity-90 md:px-6 md:py-3 md:text-base">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                      <path fill-rule="evenodd"
                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2h-1V9z"
                        clip-rule="evenodd" />
                    </svg>
                    More Info
                  </button>
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
@endsection
