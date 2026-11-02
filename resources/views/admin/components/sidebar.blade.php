<aside class="w-64 bg-white dark:bg-gray-800 text-gray-900 dark:text-white shadow-lg hidden md:block border-r border-gray-200 dark:border-gray-700">
    <div class="p-6 border-b border-gray-200 dark:border-gray-700">
        <div class="flex items-center space-x-3">
            <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center font-bold text-lg text-white">
                🏠
            </div>
            <div>
                <h1 class="font-bold text-lg text-gray-900 dark:text-white">PropertyID</h1>
                <p class="text-xs text-gray-500 dark:text-gray-400">Admin</p>
            </div>
        </div>
    </div>

    <nav class="p-4 space-y-2">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-blue-50 dark:hover:bg-gray-700 transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-blue-100 dark:bg-gray-700 text-blue-600 dark:text-blue-400' : '' }}">
            <span class="text-xl">📊</span>
            <span class="font-medium">Dashboard</span>
        </a>
        <a href="{{ route('admin.properties.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-blue-50 dark:hover:bg-gray-700 transition-colors {{ request()->routeIs('admin.properties.*') ? 'bg-blue-100 dark:bg-gray-700 text-blue-600 dark:text-blue-400' : '' }}">
            <span class="text-xl">🏢</span>
            <span class="font-medium">Properties</span>
        </a>
        <a href="#" class="flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-blue-50 dark:hover:bg-gray-700 transition-colors">
            <span class="text-xl">📂</span>
            <span class="font-medium">Categories</span>
        </a>
    </nav>

    <div class="absolute bottom-0 left-0 w-64 p-4 border-t border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800">
        <form method="POST" action="{{ route('logout') }}" class="w-full">
            @csrf
            <button type="submit" class="w-full flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-red-50 dark:hover:bg-red-900 hover:text-red-600 transition-colors font-medium">
                <span class="text-xl">🚪</span>
                <span>Logout</span>
            </button>
        </form>
    </div>
</aside>