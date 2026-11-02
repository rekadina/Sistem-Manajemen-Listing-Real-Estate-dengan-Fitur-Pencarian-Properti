<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'LuxuryEstate'))</title>
    <meta name="description" content="@yield('meta_description', 'Luxury real estate for discerning clients')">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700|playfair-display:700" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" 
          integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" 
          crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    @stack('styles')
    
    <style>
        /* Hindari layout memanjang */
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        /* Wrapper utama pakai flexbox */
        .layout-wrapper {
            min-height: 100vh;       /* TIDAK memanjang berlebihan */
            display: flex;
            flex-direction: column;  /* Header di atas, konten di tengah */
            background: #f7f7f7;
        }

        /* Area konten fleksibel */
        main.content-area {
            flex: 1;
            overflow-x: hidden;      /* Hindari scroll horizontal aneh */
        }
        
        /* Dropdown Styles */
        .dropdown-menu {
            transition: all 0.3s ease;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
        }
        
        .dropdown-menu.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
        
        /* Mobile Menu Styles */
        #mobile-menu {
            transition: all 0.3s ease;
            max-height: 0;
            overflow: hidden;
        }
        
        #mobile-menu.show {
            max-height: 500px;
        }
        
        #mobile-categories {
            transition: all 0.3s ease;
            max-height: 0;
            overflow: hidden;
        }
        
        #mobile-categories.show {
            max-height: 300px;
        }
    </style>
</head>

<body class="font-sans antialiased">
    <div class="layout-wrapper">

        {{-- NAVIGATION --}}
        <nav class="bg-black border-b border-white/10 sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-20">
                    
                    {{-- LOGO --}}
                    <div class="flex items-center">
                        <a href="{{ route('dashboard') }}" class="text-2xl font-bold text-white">
                            Luxury<span class="text-yellow-500">Estate</span>
                        </a>
                    </div>

                    {{-- MENU UTAMA (TENGAH) - Desktop --}}
                    <div class="hidden lg:flex items-center space-x-8">
                        <a href="{{ url('/dashboard') }}" class="text-white hover:text-yellow-500 transition-colors font-medium">
                            Home
                        </a>
                        <a href="{{ url('/properties') }}" class="text-white hover:text-yellow-500 transition-colors font-medium">
                            Properties
                        </a>
                        
                        {{-- CATEGORIES DROPDOWN --}}
                        
                        <a href="{{ url('/about') }}" class="text-white hover:text-yellow-500 transition-colors font-medium">
                            About Us
                        </a>
                        <a href="{{ url('/contact') }}" class="text-white hover:text-yellow-500 transition-colors font-medium">
                            Contact
                        </a>
                    </div>

                    {{-- BAGIAN KANAN (CTA & USER) --}}
                    <div class="flex items-center space-x-4">
                        
                        {{-- SEARCH ICON --}}
                        <button class="text-white hover:text-yellow-500 transition-colors p-2">
                            <i class="fas fa-search"></i>
                        </button>
                        
                        {{-- === [FIX] LIST PROPERTY BUTTON (DESKTOP) === --}}
                        @auth
                            @if(Auth::user()->role === 'admin')
                                {{-- Admin: Ke Form Tambah Properti --}}
                                <a href="{{ route('admin.properties.create') }}" class="bg-yellow-500 hover:bg-yellow-600 text-black font-medium px-4 py-2 rounded-lg transition-colors text-sm">
                                    List Your Property
                                </a>
                            @else
                                {{-- User: Ke Halaman Sell --}}
                                <a href="{{ route('sell.property') }}" class="bg-yellow-500 hover:bg-yellow-600 text-black font-medium px-4 py-2 rounded-lg transition-colors text-sm">
                                    List Your Property
                                </a>
                            @endif
                        @else
                            {{-- Tamu: Ke Halaman Sell --}}
                            <a href="{{ route('sell.property') }}" class="bg-yellow-500 hover:bg-yellow-600 text-black font-medium px-4 py-2 rounded-lg transition-colors text-sm">
                                List Your Property
                            </a>
                        @endauth
                        {{-- ========================================== --}}
                        
                        {{-- USER MENU --}}
                        @if(Auth::check())
                           <div class="relative" id="user-container">
                             <button id="user-toggle" class="flex items-center space-x-2 text-white hover:text-yellow-500 transition-colors focus:outline-none">
                                <div class="w-8 h-8 bg-gray-700 rounded-full flex items-center justify-center">
                                    <span class="font-semibold">{{ substr(Auth::user()->name, 0, 1) }}</span>
                                </div>
                                <span class="hidden md:inline">{{ Auth::user()->name }}</span>
                                <i class="fas fa-chevron-down text-xs"></i>
                            </button>
                                
                                {{-- DROPDOWN USER --}}
                                <div id="user-dropdown" class="absolute right-0 hidden dropdown-menu bg-black border border-gray-800 rounded-lg shadow-xl mt-2 py-2 w-48 z-50">
                                    <a href="{{ url('/my-profile') }}" class="block px-4 py-2 text-gray-300 hover:text-yellow-500 hover:bg-gray-900 transition-colors">
                                        <i class="fas fa-user mr-2"></i> My Profile
                                    </a>
                                    <a href="{{ url('/my-inquiries') }}" class="block px-4 py-2 text-gray-300 hover:text-yellow-500 hover:bg-gray-900 transition-colors">
                                        <i class="fas fa-envelope mr-2"></i> My Inquiries
                                    </a>
                                    <hr class="border-gray-800 my-1">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="block w-full text-left px-4 py-2 text-gray-300 hover:text-yellow-500 hover:bg-gray-900 transition-colors">
                                            <i class="fas fa-sign-out-alt mr-2"></i> Logout
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @else
                            {{-- BELUM LOGIN --}}
                            <a href="{{ url('/login') }}" class="text-white hover:text-yellow-500 transition-colors font-medium">
                                Login
                            </a>
                            <a href="{{ url('/register') }}" class="bg-yellow-500 hover:bg-yellow-600 text-black font-medium px-4 py-2 rounded-lg transition-colors text-sm">
                                Register
                            </a>
                        @endif
                    </div>
                    
                    {{-- MOBILE MENU TOGGLE --}}
                    <button class="lg:hidden text-white text-2xl ml-4" id="mobile-menu-toggle">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
            </div>
            
            {{-- MOBILE MENU --}}
            <div class="lg:hidden bg-black border-t border-white/10 px-4 py-4" id="mobile-menu">
                <div class="flex flex-col space-y-4">
                    <a href="{{ url('/dashboard') }}" class="text-white hover:text-yellow-500 transition-colors font-medium">Home</a>
                    <a href="{{ url('/properties') }}" class="text-white hover:text-yellow-500 transition-colors font-medium">Properties</a>
                    
                    <div>
                        <button class="text-white hover:text-yellow-500 transition-colors w-full text-left flex justify-between items-center font-medium" id="mobile-categories-toggle">
                            Categories
                            <i class="fas fa-chevron-down transition-transform" id="mobile-categories-icon"></i>
                        </button>
                        <div class="pl-4 mt-2 space-y-2" id="mobile-categories">
                            <a href="{{ url('/category/Penthouse') }}" class="block text-gray-300 hover:text-yellow-500 transition-colors">Penthouse</a>
                            <a href="{{ url('/category/apartmen') }}" class="block text-gray-300 hover:text-yellow-500 transition-colors">Apartment</a>
                            <a href="{{ url('/category/mansion') }}" class="block text-gray-300 hover:text-yellow-500 transition-colors">Mansion</a>
                            <a href="{{ url('/category/lcondo') }}" class="block text-gray-300 hover:text-yellow-500 transition-colors">Luxury Condo</a>
                            <a href="{{ url('/category/commercial') }}" class="block text-gray-300 hover:text-yellow-500 transition-colors">Commercial</a>
                            <a href="{{ url('/category/Thouse') }}" class="block text-gray-300 hover:text-yellow-500 transition-colors">Town House</a>
                        </div>
                    </div>
                    
                    <a href="{{ url('/about') }}" class="text-white hover:text-yellow-500 transition-colors font-medium">About Us</a>
                    <a href="{{ url('/contact') }}" class="text-white hover:text-yellow-500 transition-colors font-medium">Contact</a>
                    
                    {{-- === [FIX] LIST PROPERTY BUTTON (MOBILE) === --}}
                    @if(Auth::check())
                        @if(Auth::user()->role === 'admin')
                            <a href="{{ route('admin.properties.create') }}" class="text-white hover:text-yellow-500 transition-colors font-medium">List Your Property</a>
                        @else
                            <a href="{{ route('sell.property') }}" class="text-white hover:text-yellow-500 transition-colors font-medium">List Your Property</a>
                        @endif

                        <a href="{{ url('/my-profile') }}" class="text-white hover:text-yellow-500 transition-colors font-medium">My Profile</a>
                        <a href="{{ url('/my-inquiries') }}" class="text-white hover:text-yellow-500 transition-colors font-medium">My Inquiries</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-white hover:text-yellow-500 transition-colors text-left w-full font-medium">Logout</button>
                        </form>
                    @else
                        {{-- Untuk Tamu Mobile juga bisa lihat --}}
                        <a href="{{ route('sell.property') }}" class="text-white hover:text-yellow-500 transition-colors font-medium">List Your Property</a>

                        <a href="{{ url('/login') }}" class="text-white hover:text-yellow-500 transition-colors font-medium">Login</a>
                        <a href="{{ url('/register') }}" class="text-white hover:text-yellow-500 transition-colors font-medium">Register</a>
                    @endif
                    {{-- =========================================== --}}
                </div>
            </div>
        </nav>

        {{-- HEADER --}}
        @isset($header)
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        {{-- CONTENT --}}
        <main class="content-area">
            @if(isset($slot))
                {{-- Jika dipanggil pakai <x-app-layout> (Dashboard) --}}
                {{ $slot }}
            @else
                {{-- Jika dipanggil pakai @extends (Home/Index) --}}
                @yield('content')
            @endif
        </main>
        
        {{-- FOOTER SECTION --}}
        <footer class="bg-black border-t border-white/10 pt-16 pb-8">
            <div class="container mx-auto px-4">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
                    <div>
                        <a href="{{ route('dashboard') }}" class="text-2xl font-bold text-white mb-4 block">
                            Luxury<span class="text-yellow-500">Estate</span>
                        </a>
                        <p class="text-gray-400 text-sm leading-relaxed">
                            Premier luxury real estate brokerage specializing in exclusive properties for discerning clients worldwide.
                        </p>
                    </div>
                    
                    <div>
                        <h4 class="text-white font-semibold mb-4">Quick Links</h4>
                        <ul class="space-y-2 text-gray-400 text-sm">
                            <li><a href="#" class="hover:text-yellow-500 transition-colors">Home</a></li>
                            <li><a href="#" class="hover:text-yellow-500 transition-colors">Properties</a></li>
                            <li><a href="#" class="hover:text-yellow-500 transition-colors">Agents</a></li>
                            <li><a href="#" class="hover:text-yellow-500 transition-colors">Contact</a></li>
                        </ul>
                    </div>

                    <div>
                        <h4 class="text-white font-semibold mb-4">Contact Us</h4>
                        <ul class="space-y-3 text-gray-400 text-sm">
                            <li class="flex items-start">
                                <i class="fas fa-map-marker-alt mt-1 mr-3 text-yellow-500"></i>
                                <span>123 Luxury Avenue,<br>Beverly Hills, CA 90210</span>
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-phone mr-3 text-yellow-500"></i>
                                <span>+1 (555) 123-4567</span>
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-envelope mr-3 text-yellow-500"></i>
                                <span>info@luxuryestate.com</span>
                            </li>
                        </ul>
                    </div>

                    <div>
                        <h4 class="text-white font-semibold mb-4">Follow Us</h4>
                        <p class="text-gray-400 text-sm mb-4">Stay connected with our latest luxury listings.</p>
                        <div class="flex space-x-4">
                            <a href="#" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center text-gray-400 hover:bg-yellow-500 hover:text-black transition-all duration-300">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center text-gray-400 hover:bg-yellow-500 hover:text-black transition-all duration-300">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="#" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center text-gray-400 hover:bg-yellow-500 hover:text-black transition-all duration-300">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a href="#" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center text-gray-400 hover:bg-yellow-500 hover:text-black transition-all duration-300">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="border-t border-gray-800 pt-8 mt-8 text-center">
                    <p class="text-gray-500 text-sm">
                        &copy; {{ date('Y') }} LuxuryEstate. All rights reserved. | <a href="#" class="hover:text-yellow-500">Privacy Policy</a>
                    </p>
                </div>
            </div>
        </footer>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Desktop Dropdown Functionality
        const categoriesToggle = document.getElementById('categories-toggle');
        const categoriesDropdown = document.getElementById('categories-dropdown');
        const categoriesContainer = document.getElementById('categories-container');
        
        const userToggle = document.getElementById('user-toggle');
        const userDropdown = document.getElementById('user-dropdown');
        const userContainer = document.getElementById('user-container');
        
        // Mobile Menu Elements
        const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');
        const mobileCategoriesToggle = document.getElementById('mobile-categories-toggle');
        const mobileCategories = document.getElementById('mobile-categories');
        const mobileCategoriesIcon = document.getElementById('mobile-categories-icon');
        
        // Function to show dropdown
        function showDropdown(dropdown) {
            dropdown.classList.remove('hidden');
            setTimeout(() => {
                dropdown.classList.add('show');
            }, 10);
        }
        
        // Function to hide dropdown
        function hideDropdown(dropdown) {
            dropdown.classList.remove('show');
            setTimeout(() => {
                dropdown.classList.add('hidden');
            }, 300);
        }
        
        // Categories Dropdown
        if (categoriesToggle && categoriesDropdown) {
            categoriesToggle.addEventListener('click', function(e) {
                e.stopPropagation();
                const isVisible = !categoriesDropdown.classList.contains('hidden');
                
                // Hide user dropdown if open
                if (userDropdown && !userDropdown.classList.contains('hidden')) {
                    hideDropdown(userDropdown);
                }
                
                if (isVisible) {
                    hideDropdown(categoriesDropdown);
                } else {
                    showDropdown(categoriesDropdown);
                }
            });
            
            // Keep dropdown open when hovering over it
            categoriesContainer.addEventListener('mouseenter', function() {
                if (!categoriesDropdown.classList.contains('hidden')) {
                    showDropdown(categoriesDropdown);
                }
            });
            
            categoriesContainer.addEventListener('mouseleave', function(e) {
                // Check if mouse is leaving the container and not entering the dropdown
                if (!categoriesContainer.contains(e.relatedTarget)) {
                    hideDropdown(categoriesDropdown);
                }
            });
            
            categoriesDropdown.addEventListener('mouseleave', function(e) {
                // Check if mouse is leaving the dropdown and not entering the container
                if (!categoriesContainer.contains(e.relatedTarget)) {
                    hideDropdown(categoriesDropdown);
                }
            });
        }
        
        // User Dropdown
        if (userToggle && userDropdown) {
            userToggle.addEventListener('click', function(e) {
                e.stopPropagation();
                const isVisible = !userDropdown.classList.contains('hidden');
                
                // Hide categories dropdown if open
                if (categoriesDropdown && !categoriesDropdown.classList.contains('hidden')) {
                    hideDropdown(categoriesDropdown);
                }
                
                if (isVisible) {
                    hideDropdown(userDropdown);
                } else {
                    showDropdown(userDropdown);
                }
            });
            
            // Keep dropdown open when hovering over it
            userContainer.addEventListener('mouseenter', function() {
                if (!userDropdown.classList.contains('hidden')) {
                    showDropdown(userDropdown);
                }
            });
            
            userContainer.addEventListener('mouseleave', function(e) {
                if (!userContainer.contains(e.relatedTarget)) {
                    hideDropdown(userDropdown);
                }
            });
            
            userDropdown.addEventListener('mouseleave', function(e) {
                if (!userContainer.contains(e.relatedTarget)) {
                    hideDropdown(userDropdown);
                }
            });
        }
        
        // Mobile Menu Toggle
        if (mobileMenuToggle && mobileMenu) {
            // Initially hide mobile menu
            mobileMenu.style.maxHeight = '0';
            mobileMenu.style.paddingTop = '0';
            mobileMenu.style.paddingBottom = '0';
            mobileMenu.style.borderTopWidth = '0';
            
            mobileMenuToggle.addEventListener('click', function() {
                const isExpanded = mobileMenu.style.maxHeight !== '0px';
                
                if (isExpanded) {
                    // Collapse menu
                    mobileMenu.style.maxHeight = '0';
                    mobileMenu.style.paddingTop = '0';
                    mobileMenu.style.paddingBottom = '0';
                    mobileMenu.style.borderTopWidth = '0';
                    
                    // Also collapse categories if open
                    if (mobileCategories) {
                        mobileCategories.style.maxHeight = '0';
                        if (mobileCategoriesIcon) {
                            mobileCategoriesIcon.style.transform = 'rotate(0deg)';
                        }
                    }
                } else {
                    // Expand menu
                    mobileMenu.style.maxHeight = '500px';
                    mobileMenu.style.paddingTop = '1rem';
                    mobileMenu.style.paddingBottom = '1rem';
                    mobileMenu.style.borderTopWidth = '1px';
                }
            });
        }
        
        // Mobile Categories Toggle
        if (mobileCategoriesToggle && mobileCategories) {
            mobileCategoriesToggle.addEventListener('click', function() {
                const isExpanded = mobileCategories.style.maxHeight !== '0px';
                
                if (isExpanded) {
                    // Collapse categories
                    mobileCategories.style.maxHeight = '0';
                    if (mobileCategoriesIcon) {
                        mobileCategoriesIcon.style.transform = 'rotate(0deg)';
                    }
                } else {
                    // Expand categories
                    mobileCategories.style.maxHeight = '300px';
                    if (mobileCategoriesIcon) {
                        mobileCategoriesIcon.style.transform = 'rotate(180deg)';
                    }
                }
            });
        }
        
        // Close dropdowns when clicking outside
        document.addEventListener('click', function(e) {
            // Close categories dropdown
            if (categoriesContainer && categoriesDropdown && 
                !categoriesContainer.contains(e.target) && 
                !categoriesDropdown.contains(e.target)) {
                hideDropdown(categoriesDropdown);
            }
            
            // Close user dropdown
            if (userContainer && userDropdown && 
                !userContainer.contains(e.target) && 
                !userDropdown.contains(e.target)) {
                hideDropdown(userDropdown);
            }
        });
        
        // Close mobile menu when clicking on a link (optional)
        const mobileLinks = document.querySelectorAll('#mobile-menu a');
        mobileLinks.forEach(link => {
            link.addEventListener('click', function() {
                mobileMenu.style.maxHeight = '0';
                mobileMenu.style.paddingTop = '0';
                mobileMenu.style.paddingBottom = '0';
                mobileMenu.style.borderTopWidth = '0';
                
                // Also collapse categories if open
                if (mobileCategories) {
                    mobileCategories.style.maxHeight = '0';
                    if (mobileCategoriesIcon) {
                        mobileCategoriesIcon.style.transform = 'rotate(0deg)';
                    }
                }
            });
        });
    });
    </script>
</body>
</html> 