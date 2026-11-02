<header class="sticky top-0 z-50 bg-black/95 backdrop-blur-sm border-b border-dark-gray">
    <div class="container mx-auto px-4 py-4">
        <div class="flex items-center justify-between">
            <!-- Logo -->
            <div class="flex items-center space-x-2">
                <div class="w-10 h-10 bg-gold rounded-lg flex items-center justify-center">
                    <span class="text-black font-bold text-xl">L</span>
                </div>
                <div>
                    <h1 class="text-2xl font-bold gold-gradient">Luxury<span class="text-white">Estate</span></h1>
                    <p class="text-xs text-gray-400">Premium Properties</p>
                </div>
            </div>

            <!-- Desktop Navigation -->
            <nav class="hidden md:flex items-center space-x-8">
                <a href="{{ url('/') }}" class="text-white hover:text-gold transition-colors {{ request()->is('/') ? 'text-gold font-medium' : '' }}">
                    Home
                </a>
                <a href="{{ route('properties.index') }}" class="text-white hover:text-gold transition-colors {{ request()->is('properties') ? 'text-gold font-medium' : '' }}">
                    Properties
                </a>
                <a href="{{ route('categories.index') }}" class="text-white hover:text-gold transition-colors">
                    Categories
                </a>
                <a href="{{ route('about') }}" class="text-white hover:text-gold transition-colors">
                    About
                </a>
                <a href="{{ route('contact') }}" class="text-white hover:text-gold transition-colors">
                    Contact
                </a>
            </nav>

            <!-- Right Side Actions -->
            <div class="flex items-center space-x-4">
                <!-- Search Button -->
                <button onclick="toggleSearch()" class="text-gray-400 hover:text-gold transition-colors">
                    <i class="fas fa-search"></i>
                </button>

                <!-- User Actions -->
                @auth
                    <a href="{{ route('admin.dashboard') }}" class="bg-gold text-black px-4 py-2 rounded-lg hover:bg-yellow-500 transition-colors">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="text-white hover:text-gold transition-colors">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="bg-gold text-black px-4 py-2 rounded-lg hover:bg-yellow-500 transition-colors">
                        Register
                    </a>
                @endauth

                <!-- Mobile Menu Button -->
                <button onclick="toggleMobileMenu()" class="md:hidden text-gray-400 hover:text-gold">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>
        </div>

        <!-- Search Bar -->
        <div id="search-bar" class="hidden mt-4">
            <form action="{{ route('properties.index') }}" method="GET" class="flex space-x-2">
                <input type="text" name="search" placeholder="Search luxury properties..." 
                       class="flex-1 bg-dark-gray border border-gray-700 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-gold">
                <button type="submit" class="bg-gold text-black px-6 py-3 rounded-lg hover:bg-yellow-500 transition-colors">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden md:hidden bg-dark-gray border-t border-gray-800">
        <div class="container mx-auto px-4 py-4 space-y-4">
            <a href="{{ url('/') }}" class="block text-white hover:text-gold transition-colors">
                Home
            </a>
            <a href="{{ route('properties.index') }}" class="block text-white hover:text-gold transition-colors">
                Properties
            </a>
            <a href="{{ route('categories.index') }}" class="block text-white hover:text-gold transition-colors">
                Categories
            </a>
            <a href="{{ route('about') }}" class="block text-white hover:text-gold transition-colors">
                About
            </a>
            <a href="{{ route('contact') }}" class="block text-white hover:text-gold transition-colors">
                Contact
            </a>
        </div>
    </div>
</header>