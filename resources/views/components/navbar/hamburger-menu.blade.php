<div class="lg:hidden md:hidden max-w-[40%]">
    <div class="flex flex-row lg:hidden md:hidden items-center space-x-0.5 p-2 rounded-md hover:bg-white/5 transition-colors duration-300" id="hamburger">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
    </div>
</div>

@once
    <script nonce="{{ session("csp_nonce") }}">
        let hamburger = document.getElementById('hamburger');

        hamburger.addEventListener("click", function() {
            console.log("Hamburger icon");
        });
    </script>
@endonce
