<nav x-data="{ open: false }" class="bg-black border-b border-gray-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <span class="text-2xl font-bold text-white">Luxury<span class="text-yellow-500">Estate</span></span>
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-gray-300 hover:text-white">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    <x-nav-link :href="route('properties.index')" :active="request()->routeIs('properties.*')" class="text-gray-300 hover:text-white">
                        {{ __('Properties') }}
                    </x-nav-link>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                
                {{-- === 1. FITUR SEARCH === --}}
                <div x-data="{ searchOpen: false }" class="relative flex items-center mr-4">
                    <form action="{{ route('properties.index') }}" method="GET" class="flex items-center">
                        <input type="text" 
                               name="search" 
                               x-ref="searchInput"
                               placeholder="Cari properti..." 
                               class="transition-all duration-300 ease-in-out bg-transparent border-b-2 border-yellow-500 text-white placeholder-gray-400 focus:outline-none focus:ring-0 px-2 py-1 text-sm"
                               :class="searchOpen ? 'w-64 opacity-100 visible' : 'w-0 opacity-0 invisible border-none p-0'"
                               value="{{ request('search') }}"
                               autocomplete="off"
                        >
                        <button type="button" 
                                @click="
                                    searchOpen = !searchOpen; 
                                    if (searchOpen) { $nextTick(() => $refs.searchInput.focus()); }
                                    else if ($refs.searchInput.value) { $el.closest('form').submit(); }
                                "
                                class="text-yellow-500 hover:text-yellow-400 transition p-2 focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </button>
                    </form>
                </div>

                {{-- === 2. TOMBOL LIST YOUR PROPERTY (PERBAIKAN) === --}}
<div class="mr-4">
    @auth
        @if(Auth::user()->role === 'admin')
            {{-- Admin: Menggunakan Route Admin Bawaan (Resource) --}}
            <a href="{{ route('admin.properties.create') }}" class="bg-yellow-400 hover:bg-yellow-500 text-black font-bold py-2 px-4 rounded">
                List Your Property
            </a>
        @else
            {{-- User Biasa: Menggunakan Route Baru (sell.property) --}}
            <a href="{{ route('sell.property') }}" class="bg-yellow-500 hover:bg-yellow-400 text-black font-bold py-2 px-4 rounded-lg transition text-sm">
                List Your Property
            </a>
        @endif
    @else
        {{-- Tamu: Menggunakan Route Baru (sell.property) --}}
        <a href="{{ route('sell.property') }}" class="bg-yellow-500 hover:bg-yellow-400 text-black font-bold py-2 px-4 rounded-lg transition text-sm">
            List Your Property
        </a>
    @endauth
</div>

                {{-- === 3. USER DROPDOWN / LOGIN === --}}
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-300 bg-transparent hover:text-white focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            {{-- Menu Tambahan untuk User --}}
                            @if(Auth::user()->role !== 'admin')
                                <x-dropdown-link :href="route('my-inquiries')">
                                    {{ __('My Inquiries') }}
                                </x-dropdown-link>
                            @endif

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <div class="space-x-4">
                        <a href="{{ route('login') }}" class="text-sm text-gray-300 hover:text-white font-medium">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="text-sm text-gray-300 hover:text-white font-medium">Register</a>
                        @endif
                    </div>
                @endauth
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-gray-900">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-white">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('properties.index')" :active="request()->routeIs('properties.*')" class="text-white">
                {{ __('Properties') }}
            </x-responsive-nav-link>
            
            {{-- Tombol List Property di Mobile --}}
            @auth
                @if(Auth::user()->role === 'admin')
                    <x-responsive-nav-link :href="route('admin.properties.create')" class="text-yellow-500 font-bold">
                        {{ __('+ List Your Property') }}
                    </x-responsive-nav-link>
                @else
                    <x-responsive-nav-link :href="route('sell.property')" class="text-yellow-500 font-bold">
                        {{ __('+ List Your Property') }}
                    </x-responsive-nav-link>
                @endif
            @else
                <x-responsive-nav-link :href="route('sell.property')" class="text-yellow-500 font-bold">
                    {{ __('+ List Your Property') }}
                </x-responsive-nav-link>
            @endauth
        </div>

        <div class="pt-4 pb-1 border-t border-gray-700">
            @auth
                <div class="px-4">
                    <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-400">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')" class="text-gray-300 hover:text-white">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    @if(Auth::user()->role !== 'admin')
                        <x-responsive-nav-link :href="route('my-inquiries')" class="text-gray-300 hover:text-white">
                            {{ __('My Inquiries') }}
                        </x-responsive-nav-link>
                    @endif

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')" class="text-gray-300 hover:text-white"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            @else
                <div class="mt-3 space-y-1 px-4">
                    <x-responsive-nav-link :href="route('login')" class="text-gray-300 hover:text-white">
                        {{ __('Log in') }}
                    </x-responsive-nav-link>
                    @if (Route::has('register'))
                        <x-responsive-nav-link :href="route('register')" class="text-gray-300 hover:text-white">
                            {{ __('Register') }}
                        </x-responsive-nav-link>
                    @endif
                </div>
            @endauth
        </div>
    </div>
</nav>