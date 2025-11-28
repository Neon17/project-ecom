<button 
    x-data="{ darkMode: false }"
    x-init="
        darkMode = localStorage.getItem('theme') === 'dark' || 
                   (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches);
        if (darkMode) document.documentElement.classList.add('dark');
    "
    @click="
        darkMode = !darkMode;
        if (darkMode) {
            document.documentElement.classList.add('dark');
            localStorage.setItem('theme', 'dark');
        } else {
            document.documentElement.classList.remove('dark');
            localStorage.setItem('theme', 'light');
        }
    "
    class="p-2 rounded-lg hover:bg-blue-700 dark:hover:bg-slate-700 transition-colors"
    :aria-label="darkMode ? 'Switch to light mode' : 'Switch to dark mode'"
    title="Toggle theme"
>
    <!-- Sun Icon (shown in dark mode) -->
    <svg x-show="darkMode" class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
              d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
    </svg>
    
    <!-- Moon Icon (shown in light mode) -->
    <svg x-show="!darkMode" class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
              d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
    </svg>
</button>
