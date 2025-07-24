<header class="bg-white shadow-md sticky top-0 z-50">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center py-4">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="#" class="text-2xl font-bold text-indigo-600">
                    <span class="hidden md:inline">NOBAR</span>
                    <span class="md:hidden">NB</span>
                </a>
            </div>

            <!-- Navigation Desktop -->
            <nav class="hidden md:flex space-x-8">
                <a href="#" class="text-gray-700 hover:text-indigo-600 font-medium">Movies</a>
                <a href="#" class="text-gray-700 hover:text-indigo-600 font-medium">TV Movie</a>
            </nav>

            <!-- CTA Buttons Desktop -->
            <div class="hidden md:flex items-center space-x-4">
                <a href="#" class="text-gray-700 hover:text-indigo-600 font-medium">Masuk</a>
                <a href="#" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition duration-300">Daftar</a>
            </div>

            <!-- Mobile Menu Button -->
            <div class="md:hidden">
                <button id="mobile-menu-button" class="text-gray-700 hover:text-indigo-600 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu (Hidden by default) -->
        <div id="mobile-menu" class="hidden md:hidden pb-4">
            <div class="flex flex-col space-y-3">
                <a href="#" class="block py-2 text-gray-700 hover:text-indigo-600 font-medium">Movie</a>
                <a href="#" class="block py-2 text-gray-700 hover:text-indigo-600 font-medium">TV Movie</a>
                <div class="pt-2 border-t border-gray-200">
                    <a href="#" class="block py-2 text-gray-700 hover:text-indigo-600 font-medium">Masuk</a>
                    <a href="#" class="block mt-2 bg-indigo-600 text-white text-center px-4 py-2 rounded-md hover:bg-indigo-700 transition duration-300">Daftar</a>
                </div>
            </div>
        </div>
    </div>
</header>