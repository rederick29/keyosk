
{{--
    Cart menu component to appear in navbar

    Author(s): Ben Snaith : Main Developer

    TODO: fix menu progagation issue
--}}

<div class="flex flex-row items-center justify-center p-2 rounded-md hover:bg-white/5 ring-violet-700 transition-colors duration-300 relative" id="cart-icon">
    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="10" cy="20.5" r="1"/><circle cx="18" cy="20.5" r="1"/><path d="M2.5 2.5h3l2.7 12.4a2 2 0 0 0 2 1.6h7.7a2 2 0 0 0 2-1.6l1.6-8.4H7.1"/></svg>
    <div class="hidden lg:inline md:inline">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg>
    </div>
    {{-- Drop down menu --}}
    <div class="dropdown-hide w-[100vw] md:w-96 lg:w-96 h-fit top-24 md:top-12 lg:top-12 right-0" id="cart-dropdown">
        <div class="flex flex-col items-center space-y-1 min-h-[100%] m-4">
            <div class="font-bold text-xl w-full p-2 justify-start">Shopping Basket</div>
            <?php
            use App\Models\Product;
            use App\Models\Image;
            use Illuminate\Support\Facades\DB;

            $product = Product::with('images')->where('name', '=', 'Labrador')->first();
            if ($product == null) {
                $product = Product::factory()->create(['name' => 'Labrador']);
                Image::factory()->forProduct($product)->create(['location' => 'https://picsum.photos/id/237/75/75']);
            }
            ?>
            <div class="w-full p-5 bg-zinc-900 min-h-[30vh] max-h-[30vh] overflow-y-scroll rounded-xl">
                <x-navbar.cart-item productImage="{{ $product->images->first->get()->location }}" productTitle="{{ $product->name }}" productPrice="{{ floatval($product->price) }}" productQuantity="{{ $product->stock }}" />
                <x-navbar.cart-item productImage="https://picsum.photos/id/237/75/75" productTitle="Labrador" productPrice=100.00 productQuantity=1 />
                <x-navbar.cart-item productImage="https://picsum.photos/id/237/75/75" productTitle="Labrador" productPrice=100.00 productQuantity=1 />
                <x-navbar.cart-item productImage="https://picsum.photos/id/237/75/75" productTitle="Labrador" productPrice=100.00 productQuantity=1 />
                <x-navbar.cart-item productImage="https://picsum.photos/id/237/75/75" productTitle="Labrador" productPrice=100.00 productQuantity=1 />
                <x-navbar.cart-item productImage="https://picsum.photos/id/237/75/75" productTitle="Labrador" productPrice=100.00 productQuantity=1 />
                <x-navbar.cart-item productImage="https://picsum.photos/id/237/75/75" productTitle="Labrador" productPrice=100.00 productQuantity=1 />
                <x-navbar.cart-item productImage="https://picsum.photos/id/237/75/75" productTitle="Labrador" productPrice=100.00 productQuantity=1 />
                <x-navbar.cart-item productImage="https://picsum.photos/id/237/75/75" productTitle="Labrador" productPrice=100.00 productQuantity=1 />
                <x-navbar.cart-item productImage="https://picsum.photos/id/237/75/75" productTitle="Labrador" productPrice=100.00 productQuantity=1 />
                <x-navbar.cart-item productImage="https://picsum.photos/id/237/75/75" productTitle="Labrador" productPrice=100.00 productQuantity=1 />
            </div>
            <div class="h-[12px]"></div>
            <x-navbar.dropdown-link type="a" href="/" class="bg-violet-700 text-white hover:bg-violet-700/50">Checkout</x-navbar.dropdown-link>
            <div class="h-[12px]"></div>
            <x-navbar.dropdown-link type="a" href="/" class="bg-transparent ring-2 ring-violet-700 text-violet-700">View cart</x-navbar.dropdown-link>
        </div>
    </div>
</div>

