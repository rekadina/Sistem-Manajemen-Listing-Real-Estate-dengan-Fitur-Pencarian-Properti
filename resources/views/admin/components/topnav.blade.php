<nav class="bg-white dark:bg-gray-800 shadow-md border-b border-gray-200 dark:border-gray-700">
    <div class="px-6 py-4 flex items-center justify-between">
        <div>
            <h2 class="text-xl font-bold text-gray-800 dark:text-white">
                Kelola Properti 
            </h2>
        </div>
        
        <div class="flex items-center space-x-4">
            <button onclick="toggleTheme()" class="p-2 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors">
                <span id="theme-icon">🌙</span>
            </button>
            
            <div class="flex items-center space-x-3 pl-4 border-l border-gray-300 dark:border-gray-600">
                <span class="text-sm text-gray-700 dark:text-gray-300 font-medium">{{ auth()->user()->name }}</span>
            </div>
        </div>
    </div>
</nav>

<script>
function toggleTheme() {
    document.documentElement.classList.toggle('dark');
    localStorage.setItem('theme', document.documentElement.classList.contains('dark') ? 'dark' : 'light');
}
</script>