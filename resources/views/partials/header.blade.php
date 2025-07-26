<header class="sticky top-0 z-50 bg-white shadow-md">
  <div class="container mx-auto px-4">
    <div class="flex items-center justify-between py-4">
      <!-- Logo -->
      <div class="flex items-center">
        <a href="/" class="text-2xl font-bold text-indigo-600">
          <span class="hidden md:inline">NOBAR</span>
          <span class="md:hidden">NB</span>
        </a>
      </div>

      <!-- Navigation Desktop -->
      <nav class="hidden space-x-8 md:flex">
        <a href="/movies" class="font-medium text-gray-700 hover:text-indigo-600">Movies</a>
        <a href="/tv" class="font-medium text-gray-700 hover:text-indigo-600">TV Movie</a>
      </nav>

      <!-- CTA Buttons Desktop -->
      <div class="hidden items-center space-x-4 md:flex">
        <div class="">
          <!-- Search Form -->
          <a href="/search">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24"
              stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
          </a>
        </div>
      </div>

      <!-- Mobile Menu Button -->
      <div class="md:hidden">
        <button id="mobile-menu-button" class="text-gray-700 hover:text-indigo-600 focus:outline-none">
          <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
          </svg>
        </button>
      </div>
    </div>

    <!-- Mobile Menu (Hidden by default) -->
    <div id="mobile-menu" class="hidden pb-4 md:hidden">
      <div class="flex flex-col space-y-3">
        <a href="/movies" class="block py-2 font-medium text-gray-700 hover:text-indigo-600">Movie</a>
        <a href="/tv" class="block py-2 font-medium text-gray-700 hover:text-indigo-600">TV Movie</a>
        <div class="border-t border-gray-200 pt-2">
          <!-- Search Form -->
          <div class="relative mb-3">
            <a href="/search">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
              </svg>
            </a>
          </div>
        </div>
      </div>
    </div>
</header>
