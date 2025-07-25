@extends('layouts.app')

@section('title','TEST PT MURNI SOULISINDO NUSANTARA | HOME')

@section('content')
    <section class="relative w-full h-screen overflow-hidden">
  <!-- Video Background -->
  <video
    autoplay
    loop
    muted
    playsinline
    class="absolute inset-0 w-full h-full object-cover"
  >
    <source src="https://www.w3schools.com/howto/rain.mp4" type="video/mp4" />
    Your browser does not support the video tag.
  </video>

  <!-- Overlay -->
  <div class="absolute inset-0 bg-black bg-opacity-50"></div>

  <!-- Content -->
  <div class="relative z-10 flex flex-col justify-center items-start h-full px-6 md:px-16 text-white max-w-2xl">
    <h1 class="text-4xl md:text-6xl font-extrabold mb-4 leading-tight drop-shadow-lg">
      Stranger Things
    </h1>
    <p class="text-base md:text-lg mb-6 text-gray-200 drop-shadow-md">
      When a young boy vanishes, a small town uncovers a mystery involving secret experiments, terrifying supernatural forces and one strange little girl.
    </p>
    <div class="flex gap-4 flex-wrap">
      <button class="bg-white text-black px-6 py-3 rounded-md font-semibold hover:bg-gray-300 transition">
        ▶ Play
      </button>
      <button class="bg-gray-700 bg-opacity-80 text-white px-6 py-3 rounded-md font-semibold hover:bg-gray-600 transition">
        ℹ More Info
      </button>
    </div>
  </div>
</section>


@endsection