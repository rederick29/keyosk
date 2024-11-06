
{{--
    Cart menu component to appear in navbar

    Author(s): Ben Snaith : Main Developer

    TODO: change the size of the icons on mobile
--}}

<div class="flex flex-row items-center justify-center p-2 rounded-md hover:bg-white/5 transition-colors duration-300 relative" id="cart-icon">
    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="10" cy="20.5" r="1"/><circle cx="18" cy="20.5" r="1"/><path d="M2.5 2.5h3l2.7 12.4a2 2 0 0 0 2 1.6h7.7a2 2 0 0 0 2-1.6l1.6-8.4H7.1"/></svg>
    <div class="hidden lg:inline md:inline">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg>
    </div>
    {{-- Drop down menu --}}
    <div class="dropdown-hide-desktop w-96 h-fit top-12 right-0" id="cart-dropdown">
        <div class="flex flex-col items-center space-y-1 min-h-[100%] m-2">
            <div class="font-bold text-xl w-full p-2 justify-start">Shopping Basket</div>
            <x-navbar.cart-item productImage="https://picsum.photos/id/237/75/75" productTitle="Labrador" productPrice="£100.00" productQuantity="1" />
            <x-navbar.cart-item productImage="https://picsum.photos/id/237/75/75" productTitle="Labrador" productPrice="£100.00" productQuantity="1" />
            <x-navbar.cart-item productImage="https://picsum.photos/id/237/75/75" productTitle="Labrador" productPrice="£100.00" productQuantity="1" />
            <div class="grow h-5"></div>
            <a href="/" class="dropdown-link hover:bg-violet-700/50 text-white bg-violet-700">Checkout</a>
        </div>
    </div>
</div>

@once
    <script nonce="{{ session("csp_nonce") }}">
        let cartIcon = document.getElementById('cart-icon');
        let cartDropdown = document.getElementById('cart-dropdown');
        let cartToggle = false;

        document.body.addEventListener("click", function(e) {
            if(cartToggle) {
                hideCartMenu();
            }
        });

        cartIcon.addEventListener("click", function(event) {
            if(!cartToggle) {
                showCartMenu();
                hideAccountMenu();
            }
            else {
                hideCartMenu();
            }
            // stopPropagation must be called on the parent / spawner element.
            event.stopPropagation();
        });

        const showCartMenu = () => {
            cartIcon.classList.add("bg-white/5", "ring-2")
            cartDropdown.classList.remove('dropdown-hide-desktop');
            cartDropdown.classList.add('dropdown-display-desktop');
            cartToggle = true;
        }

        const hideCartMenu = () => {
            cartIcon.classList.remove("bg-white/5", "ring-2")
            cartDropdown.classList.remove('dropdown-display-desktop');
            cartDropdown.classList.add('dropdown-hide-desktop');
            cartToggle = false;
        }
    </script>
@endonce
