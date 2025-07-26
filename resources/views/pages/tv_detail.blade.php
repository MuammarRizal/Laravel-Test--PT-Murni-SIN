@extends('layouts.app')

@section('title', 'UNTAMED | ' . $data->name)

@section('content')
  @php
    // Cari trailer dari videos jika ada
    $trailerID = '';
    if (isset($data->videos)) {
        foreach ($data->videos->results as $video) {
            if (strtolower($video->type) === 'trailer' && strtolower($video->site) === 'youtube') {
                $trailerID = $video->key;
                break;
            }
        }
    }
  @endphp

  <!-- Hero Section -->
  <div class="relative h-[92vh] w-full overflow-hidden px-8">
    <!-- Backdrop Image -->
    <div class="absolute inset-0 z-10 bg-gradient-to-t from-black/90 via-black/50 to-transparent"></div>
    <div class="absolute inset-0 z-10 bg-gradient-to-r from-black/80 via-black/30 to-transparent"></div>
    <img src="https://image.tmdb.org/t/p/original{{ $data->backdrop_path }}" alt="{{ $data->name }} backdrop"
      class="absolute inset-0 h-full w-full object-cover">

    <!-- Series Info -->
    <div class="container relative z-20 mx-auto flex h-full items-center px-4 md:px-8 lg:px-16">
      <div class="max-w-4xl">
        <h1 class="mb-4 text-4xl font-bold text-white md:text-5xl lg:text-6xl">{{ $data->name }}</h1>

        <div class="mb-6 flex flex-wrap items-center gap-4">
          <span class="font-semibold text-green-500">{{ round($data->vote_average * 10) }}% Match</span>
          <span class="text-gray-300">{{ date('Y', strtotime($data->first_air_date)) }}</span>
          @if ($data->episode_run_time)
            <span
              class="rounded border border-gray-400 px-2 py-1 text-xs text-gray-300">{{ min($data->episode_run_time) }}
              min/ep</span>
          @endif
          <span class="rounded border border-gray-400 px-2 py-1 text-xs text-gray-300">HD</span>
        </div>

        <div class="mb-6 flex flex-wrap gap-3">
          @foreach ($data->genres as $genre)
            <span class="rounded-full bg-gray-800/80 px-3 py-1 text-sm text-gray-300">{{ $genre->name }}</span>
          @endforeach
          <span class="rounded-full bg-gray-800/80 px-3 py-1 text-sm text-gray-300">{{ $data->type }}</span>
        </div>

        <p class="mb-8 max-w-3xl text-base leading-relaxed text-gray-300 md:text-lg">{{ $data->overview }}</p>

        <div class="flex flex-wrap gap-4">
          @if ($trailerID)
            <button onclick="showModal('{{ $trailerID }}')"
              class="flex items-center gap-3 rounded bg-white px-8 py-3 font-semibold text-black transition-all duration-200 hover:bg-gray-200">
              <i class="fas fa-play"></i>
              <span>Play Trailer</span>
            </button>
          @endif

          @if ($data->networks && count($data->networks) > 0)
            <a href="{{ $data->homepage }}" target="_blank"
              class="flex items-center gap-3 rounded bg-gray-700/80 px-8 py-3 font-semibold text-white backdrop-blur-sm transition-all duration-200 hover:bg-gray-600/80">
              @if ($data->networks[0]->logo_path)
                <img src="https://image.tmdb.org/t/p/w92{{ $data->networks[0]->logo_path }}"
                  alt="{{ $data->networks[0]->name }} logo" class="h-6 object-contain">
              @endif
              <span>Watch on {{ $data->networks[0]->name }}</span>
            </a>
          @endif
        </div>
      </div>
    </div>
  </div>

  <!-- Additional Info Section -->
  <div class="min-h-screen bg-black">
    <div class="container mx-auto px-4 py-16 md:px-8 lg:px-16">
      <h2 class="lg:m10-5 mb-8 text-3xl font-bold text-white">About {{ $data->name }}</h2>

      <div class="grid grid-cols-1 gap-12 lg:grid-cols-2">
        <!-- Left Column -->
        <div class="space-y-10 lg:col-span-2">
          <!-- Creators -->
          @if ($data->created_by && count($data->created_by) > 0)
            <div>
              <h3 class="mb-4 text-xl font-semibold text-gray-300">Created By</h3>
              <div class="flex flex-wrap gap-6">
                @foreach ($data->created_by as $creator)
                  <div class="flex items-center gap-3">
                    @if ($creator->profile_path)
                      <img src="https://image.tmdb.org/t/p/w45{{ $creator->profile_path }}" alt="{{ $creator->name }}"
                        class="h-12 w-12 rounded-full object-cover">
                    @else
                      <div class="flex h-12 w-12 items-center justify-center rounded-full bg-gray-700">
                        <i class="fas fa-user text-gray-400"></i>
                      </div>
                    @endif
                    <span class="font-medium text-white">{{ $creator->name }}</span>
                  </div>
                @endforeach
              </div>
            </div>
          @endif

          <!-- Basic Info Grid -->
          <div class="grid grid-cols-1 gap-8 md:grid-cols-2">
            <div class="space-y-2">
              <h3 class="text-lg font-semibold text-gray-300">First Air Date</h3>
              <p class="text-white">{{ date('F j, Y', strtotime($data->first_air_date)) }}</p>
            </div>

            <div class="space-y-2">
              <h3 class="text-lg font-semibold text-gray-300">Last Air Date</h3>
              <p class="text-white">{{ date('F j, Y', strtotime($data->last_air_date)) }}</p>
            </div>

            <div class="space-y-2">
              <h3 class="text-lg font-semibold text-gray-300">Seasons & Episodes</h3>
              <p class="text-white">{{ $data->number_of_seasons }} seasons ({{ $data->number_of_episodes }} episodes)
              </p>
            </div>

            <div class="space-y-2">
              <h3 class="text-lg font-semibold text-gray-300">Status</h3>
              <p class="text-white">{{ $data->status }}</p>
            </div>
          </div>

          <!-- Production Info -->
          <div class="grid grid-cols-1 gap-8 md:grid-cols-2">
            <div class="space-y-3">
              <h3 class="text-lg font-semibold text-gray-300">Production Companies</h3>
              <div class="flex flex-wrap gap-2">
                @foreach ($data->production_companies as $company)
                  <span
                    class="rounded-full border border-gray-700 bg-gray-800 px-4 py-2 text-sm text-gray-300">{{ $company->name }}</span>
                @endforeach
              </div>
            </div>

            <div class="space-y-3">
              <h3 class="text-lg font-semibold text-gray-300">Languages</h3>
              <div class="flex flex-wrap gap-2">
                @foreach ($data->spoken_languages as $language)
                  <span
                    class="rounded-full border border-gray-700 bg-gray-800 px-4 py-2 text-sm text-gray-300">{{ $language->english_name }}</span>
                @endforeach
              </div>
            </div>
          </div>

          <!-- Last Episode Info -->
          @if ($data->last_episode_to_air)
            <div class="">
              <h3 class="my-5 text-2xl font-bold text-white">Last Episode</h3>
              <div class="rounded-lg border border-gray-800 bg-gray-900/80 p-6 backdrop-blur-sm">
                <div class="flex flex-col gap-6 md:flex-row">
                  @if ($data->last_episode_to_air->still_path)
                    <div class="flex-shrink-0">
                      <img src="https://image.tmdb.org/t/p/w300{{ $data->last_episode_to_air->still_path }}"
                        alt="{{ $data->last_episode_to_air->name }}" class="h-20 w-full rounded-lg object-cover md:w-32">
                    </div>
                  @endif
                  <div class="min-w-0 flex-1">
                    <h4 class="mb-2 text-xl font-semibold text-white">{{ $data->last_episode_to_air->name }}</h4>
                    <div class="mb-3 flex flex-wrap items-center gap-3 text-sm text-gray-400">
                      <span>Episode {{ $data->last_episode_to_air->episode_number }}</span>
                      <span class="text-gray-600">•</span>
                      <span>{{ $data->last_episode_to_air->runtime }} min</span>
                      <span class="text-gray-600">•</span>
                      <span>{{ date('M j, Y', strtotime($data->last_episode_to_air->air_date)) }}</span>
                    </div>
                    <p class="leading-relaxed text-gray-300">{{ $data->last_episode_to_air->overview }}</p>
                  </div>
                </div>
              </div>
            </div>
          @endif
        </div>

        <!-- Right Column -->
        <div class="space-y-8">
          <div class="mt-2">
            <h3 class="text-lg font-semibold text-gray-300">Original Title</h3>
            <p class="text-white">{{ $data->original_name }}</p>
          </div>

          <div class="mt-2">
            <h3 class="text-lg font-semibold text-gray-300">Production Countries</h3>
            <div class="space-y-1">
              @foreach ($data->production_countries as $country)
                <p class="text-white">{{ $country->name }}</p>
              @endforeach
            </div>
          </div>

          @if ($data->homepage)
            <div class="mt-2">
              <h3 class="text-lg font-semibold text-gray-300">Homepage</h3>
              <a href="{{ $data->homepage }}" class="break-all text-blue-400 transition-colors hover:text-blue-300"
                target="_blank">
                {{ $data->homepage }}
              </a>
            </div>
          @endif
        </div>
      </div>
      @if ($data->seasons && count($data->seasons) > 0)
        <div class="space-y-4">
          <h3 class="text-lg font-semibold text-gray-300">Seasons</h3>
          <div class="max-h-96 space-y-4 overflow-y-auto pr-2">
            @foreach ($data->seasons as $season)
              <div class="flex items-start gap-4 rounded-lg border border-gray-800 bg-gray-900/50 p-3">
                @if ($season->poster_path)
                  <img src="https://image.tmdb.org/t/p/w92{{ $season->poster_path }}" alt="{{ $season->name }}"
                    class="h-20 w-14 flex-shrink-0 rounded object-cover">
                @else
                  <div class="flex h-20 w-14 flex-shrink-0 items-center justify-center rounded bg-gray-800">
                    <i class="fas fa-image text-gray-600"></i>
                  </div>
                @endif
                <div class="min-w-0 flex-1">
                  <p class="font-medium text-white">{{ $season->name }}</p>
                  <p class="text-sm text-gray-400">{{ $season->episode_count }} episodes</p>
                  @if ($season->air_date)
                    <p class="mt-1 text-xs text-gray-500">{{ date('Y', strtotime($season->air_date)) }}</p>
                  @endif
                </div>
              </div>
            @endforeach
          </div>
        </div>
      @endif
    </div>
  </div>

  <!-- YouTube Modal -->
  <div class="fixed inset-0 z-50 hidden items-center justify-center bg-black/90 p-4 backdrop-blur-sm"
    id="youtube-modal">
    <div class="relative w-full max-w-5xl">
      <button onclick="closeModal()"
        class="absolute -top-12 right-0 text-white transition-colors hover:text-gray-300 focus:outline-none">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24"
          stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>
      <div class="aspect-video overflow-hidden rounded-lg bg-black">
        <iframe id="youtube-iframe" class="h-full w-full" frameborder="0"
          allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
          allowfullscreen></iframe>
      </div>
    </div>
  </div>

  <script>
    function showModal(videoId) {
      const modal = document.getElementById('youtube-modal');
      const iframe = document.getElementById('youtube-iframe');

      iframe.src = `https://www.youtube.com/embed/${videoId}?autoplay=1`;
      modal.classList.remove('hidden');
      document.body.style.overflow = 'hidden';
    }

    function closeModal() {
      const modal = document.getElementById('youtube-modal');
      const iframe = document.getElementById('youtube-iframe');

      iframe.src = '';
      modal.classList.add('hidden');
      document.body.style.overflow = '';
    }

    // Close modal when clicking outside
    document.getElementById('youtube-modal').addEventListener('click', function(e) {
      if (e.target === this) {
        closeModal();
      }
    });

    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
      if (e.key === 'Escape') {
        closeModal();
      }
    });
  </script>
@endsection
