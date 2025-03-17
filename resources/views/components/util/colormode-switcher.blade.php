<button id="theme-toggle" type="button"
    class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-hidden focus:ring-2 focus:ring-gray-700 rounded-lg p-1">
    <svg id="theme-toggle-dark-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path></svg>
    <svg id="theme-toggle-light-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="5"/><path d="M12 1v2M12 21v2M4.2 4.2l1.4 1.4M18.4 18.4l1.4 1.4M1 12h2M21 12h2M4.2 19.8l1.4-1.4M18.4 5.6l1.4-1.4"/></svg>
</button>

<script nonce="{{ csp_nonce() }}">
document.addEventListener('DOMContentLoaded', () => {
    // Get elements
    const themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
    const themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');
    const themeToggleBtn = document.getElementById('theme-toggle');
    const storedTheme = localStorage.getItem('color-theme');

    // Dark mode is enabled by default if the user's OS is set to dark mode
    const isDarkMode = storedTheme === 'dark' || (!storedTheme && window.matchMedia('(prefers-color-scheme: dark)').matches);

    // Set initial theme and icons
    document.documentElement.classList.toggle('dark', isDarkMode);
    themeToggleDarkIcon.classList.toggle('hidden', isDarkMode);
    themeToggleLightIcon.classList.toggle('hidden', !isDarkMode);

    // Add event listener
    themeToggleBtn.addEventListener('click', () => {
        const isDark = document.documentElement.classList.toggle('dark');
        localStorage.setItem('color-theme', isDark ? 'dark' : 'light');
        themeToggleDarkIcon.classList.toggle('hidden', isDark);
        themeToggleLightIcon.classList.toggle('hidden', !isDark);

        themeToggleBtn.disabled = true;
            setTimeout(() => {
                themeToggleBtn.disabled = false;
            }, 250);
    });
});
</script>
