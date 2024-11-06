
{{--
    Cart menu component to appear in navbar

    Author(s): Ben Snaith : Main Developer

    TODO: change the size of the icons on mobile
--}}

<div class="flex flex-row items-center justify-center p-2 font-semibold rounded-md hover:bg-white/5 transition-colors duration-300" id="cart-icon">
    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="10" cy="20.5" r="1"/><circle cx="18" cy="20.5" r="1"/><path d="M2.5 2.5h3l2.7 12.4a2 2 0 0 0 2 1.6h7.7a2 2 0 0 0 2-1.6l1.6-8.4H7.1"/></svg>
    <div class="hidden lg:inline md:inline">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg>
    </div>
</div>

@once
    <script nonce="{{ session("csp_nonce") }}">
        let cartIcon = document.getElementById('cart-icon');

        cartIcon.addEventListener("click", function() {
            console.log("Cart icon");
        });
    </script>
@endonce
