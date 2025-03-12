@php
    use Illuminate\Support\Facades\Auth;
    $user = Auth::user();
    $addresses = $user->addresses;
    $primary_address = $addresses->where('priority', 0)->first();
@endphp
<x-layouts.layout>
    <x-slot:title>Keyosk | Checkout</x-slot:title>
    <main class="min-h-screen">
        <div class="container min-w-full min-h-screen pb-0 pt-12 mx-auto py-6 flex flex-row">
            <div class="container w-3/5 py-10 bg-white dark:bg-black">
                <div class="container pl-10">
                    <h1>Product Checkout</h1>
                </div>
                <form method="POST" action="{{ route('cart.checkout') }}" class="justify-items-center" id="checkout-form">
                    <div
                        class="container font-semibold text-center pb-2.5 pt-5 w-3/4 border-b border-orange-500 dark:border-violet-700">
                        <h2>Contact Details</h2>
                    </div>
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-6 gap-y-5 w-2/3 pt-5">
                        <div>
                            <label for="first_name"
                                   class="block text-black/50 dark:text-gray-300 text-sm font-semibold">First
                                name</label>
                            <div class="mt-2.5">
                                <input type="text" name="first_name" id="first_name"
                                       class="font-semibold w-full rounded-lg py-2 text-black/50 dark:text-gray-300 bg-zinc-300 dark:bg-zinc-700"
                                       value="{{ $user->first_name }}" required>
                            </div>
                        </div>
                        <div>
                            <label for="last_name"
                                   class="block text-black/50 dark:text-gray-300 text-sm font-semibold">Last
                                name</label>
                            <div class="mt-2.5">
                                <input type="text" name="last_name" id="last_name"
                                       class="font-semibold w-full rounded-lg py-2 text-black/50 dark:text-gray-300 bg-zinc-300 dark:bg-zinc-700"
                                       value="{{ $user->last_name }}" required>
                            </div>
                        </div>
                        <div class="lg:col-span-2">
                            <label for="email"
                                   class="block text-black/50 dark:text-gray-300 text-sm font-semibold">Email</label>
                            <div class="mt-2.5">
                                <input type="email" name="email" id="email"
                                       class="font-semibold w-full rounded-lg py-2 text-black/50 dark:text-gray-300 bg-zinc-300 dark:bg-zinc-700"
                                       value="{{ $user->email }}" required>
                            </div>
                        </div>
                    </div>
                    <div
                        class="container font-semibold text-center pb-2.5 pt-10 w-3/4 border-b border-orange-500 dark:border-violet-700">
                        <h2>Shipping Address</h2>
                    </div>
                    <div>
                        <p>Select an address:</p>
                        @foreach($addresses as $address)
                            <label for="address-{{ $address->priority }}">Address {{ $address->priority + 1 }}</label>
                            <input type="radio" id="address-{{ $address->priority }}" name="addressId" value="{{ $address->priority }}">
                        @endforeach
                        <label for="new-address">New address</label>
                        <input type="radio" id="new-address" name="addressId" value="-1">
                    </div>
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-6 gap-y-5 w-2/3 pt-5">

                        <input type="hidden" name="addressId" id="addressId" value="{{ $primary_address->priority ?? -1 }}">

                        <div>
                            <label for="address_name"
                                   class="block text-black/50 dark:text-gray-300 text-sm font-semibold">Shipping Name</label>
                            <div class="mt-2.5">
                                <input type="text" name="address_name" id="address_name"
                                       class="font-semibold w-full rounded-lg py-2 text-black/50 dark:text-gray-300 bg-zinc-300 dark:bg-zinc-700"
                                       value="{{ $primary_address->name ?? "" }}"
                                >
                            </div>
                        </div>

                        <div>
                            <label for="address1"
                                   class="block text-black/50 dark:text-gray-300 text-sm font-semibold">Address
                                1</label>
                            <div class="mt-2.5">
                                <input type="text" name="address1" id="address1"
                                       class="font-semibold w-full rounded-lg py-2 text-black/50 dark:text-gray-300 bg-zinc-300 dark:bg-zinc-700"
                                       value="{{ $primary_address->line_one ?? "" }}"
                                >
                            </div>
                        </div>
                        <div>
                            <label for="address2"
                                   class="block text-black/50 dark:text-gray-300 text-sm font-semibold">Address
                                2</label>
                            <div class="mt-2.5">
                                <input type="text" name="address2" id="address2"
                                       class="font-semibold w-full rounded-lg py-2 text-black/50 dark:text-gray-300 bg-zinc-300 dark:bg-zinc-700"
                                       value="{{ $primary_address->line_two ?? "" }}"
                                >
                            </div>
                        </div>
                        <div>
                            <label for="city"
                                   class="block text-black/50 dark:text-gray-300 text-sm font-semibold">City</label>
                            <div class="mt-2.5">
                                <input type="text" name="city" id="city"
                                       class="font-semibold w-full rounded-lg py-2 text-black/50 dark:text-gray-300 bg-zinc-300 dark:bg-zinc-700"
                                       value="{{ $primary_address->city ?? "" }}"
                                >
                            </div>
                        </div>
                        <div>
                            <label for="postcode"
                                   class="block text-black/50 dark:text-gray-300 text-sm font-semibold">Postcode</label>
                            <div class="mt-2.5">
                                <input type="text" name="postcode" id="postcode"
                                       class="font-semibold w-full rounded-lg py-2 text-black/50 dark:text-gray-300 bg-zinc-300 dark:bg-zinc-700"
                                       value="{{ $primary_address->postcode ?? "" }}"
                                >
                            </div>
                        </div>
                        <div>
                            <label for="country"
                                   class="block text-black/50 dark:text-gray-300 text-sm font-semibold">Country</label>
                            <div class="mt-2.5">
                                <select name="country" id="country" class="w-full rounded-lg py-2 text-black/50 dark:text-gray-300 bg-zinc-300 dark:bg-zinc-700">
                                    @foreach(App\Utils\CountryCodes::get_codes() as $code => $country)
                                        <option value="{{ $code }}">{{ $country }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @if(!$primary_address)
                        <div>
                            <label for="save_address"
                                   class="block text-black/50 dark:text-gray-300 text-sm font-semibold">Save address?</label>
                            <div class="mt-2.5">
                                <input type="checkbox" name="save_address" id="save_address"
                                       class="font-semibold w-full rounded-lg py-2 text-black/50 dark:text-gray-300 bg-zinc-300 dark:bg-zinc-700"
                                       value=""
                                >
                            </div>
                        </div>
                        @endif
                    </div>
                    <div
                        class="container font-semibold text-center pb-2.5 pt-10 w-3/4 border-b border-orange-500 dark:border-violet-700">
                        <h2>Card Details</h2>
                    </div>
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-6 gap-y-5 w-2/3 pt-5">
                        <div class="lg:col-span-2">
                            <label for="card_holder_name"
                                   class="block text-black/50 dark:text-gray-300 text-sm font-semibold">Card Holder
                                Name</label>
                            <div class="mt-2.5">
                                <input type="text" name="card_holder_name" id="card_holder_name"
                                       class="font-semibold w-full rounded-lg py-2 text-black/50 dark:text-gray-300 bg-zinc-300 dark:bg-zinc-700"
                                       required>
                            </div>
                        </div>
                        <div class="lg:col-span-2">
                            <label for="card_number"
                                   class="block text-black/50 dark:text-gray-300 text-sm font-semibold">Card
                                Number</label>
                            <div class="mt-2.5">
                                <input type="text" name="card_number" id="card_number"
                                       class="font-semibold w-full rounded-lg py-2 text-black/50 dark:text-gray-300 bg-zinc-300 dark:bg-zinc-700"
                                       required>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-6 gap-y-5 w-2/6 pt-5">

                        <div>
                            <label for="expiry_date"
                                   class="block text-black/50 dark:text-gray-300 text-sm font-semibold">Expiry
                                Date</label>
                            <div class="mt-2.5">
                                <input type="text" name="expiry_date" id="expiry_date" placeholder="MM/YY"
                                       class="font-semibold w-full rounded-lg py-2 text-black/50 dark:text-gray-300 bg-zinc-300 dark:bg-zinc-700 text-center"
                                       required>
                            </div>
                        </div>
                        <div>
                            <label for="cvv"
                                   class="block text-black/50 dark:text-gray-300 text-sm font-semibold">CVV</label>
                            <div class="mt-2.5">
                                <input type="text" name="cvv" id="cvv"
                                       class="font-semibold w-full rounded-lg py-2 text-black/50 dark:text-gray-300 bg-zinc-300 dark:bg-zinc-700"
                                       required>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="container flex flex-col items-center w-2/5 bg-stone-200 dark:bg-zinc-900">

                <x-util.logo type="a" href="/" width=300 class="py-10"/>
                @php
                    $user = Auth::user();
                    $cart = $user->cart ?? App\Models\Cart::factory()->forUser($user)->create();
                @endphp

                <div class="container w-4/5 max-h-[398px] overflow-y-auto">
                    @foreach($cart->products()->orderBy("name")->get() as $product)
                        <x-navbar.cart-item class="border-2 border-orange-500 dark:border-violet-700"
                                            :product="$product"/>
                    @endforeach
                </div>
                <div class="flex flex-row w-2/3 pt-5">
                    <div>
                        <label for="discount_code"
                               class="block text-black/50 dark:text-gray-300 text-sm font-semibold">Discount
                            Code</label>
                        <div class="mt-2.5">
                            <input type="text" name="discount_code" id="discount_code"
                                   class="font-semibold w-5/6 rounded-lg py-2 pr-10 text-black/50 dark:text-gray-300 bg-zinc-300 dark:bg-zinc-700">
                        </div>
                    </div>
                    <button type="submit"
                            class="btn btn-secondary mb-1 rounded-lg w-1/3 mt-9 bg-zinc-800 dark:bg-white text-orange-400 dark:text-violet-500 hover:bg-zinc-900 dark:hover:bg-neutral-200">
                        Apply
                    </button>
                </div>

                <div
                    class="container w-2/3 justify-items-center mt-8 max-h-[100px] border-r border-l border-stone-200 dark:border-zinc-900 overflow-y-auto">
                    @foreach($cart->products()->orderBy("name")->get() as $product)
                        <div class="summary-product-{{ $product->id }} flex items-center gap-1">
                            <span class="summary-product-quantity">{{ $product->pivot->quantity }}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                 stroke-linejoin="round">
                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                <line x1="6" y1="6" x2="18" y2="18"></line>
                            </svg>
                            {{ $product->name }}
                        </div>
                    @endforeach
                </div>
                <div
                    class="mt-7 py-3 w-1/2 justify-items-center border-t border-b border-stone-200 dark:border-zinc-900">
                    <p class="flex flex-row gap-1">
                        Items:
                        <span class="cart-total-quantity-count">{{ $cart->products->count() }}</span>
                    </p>
                    <p class="flex flex-row">
                        Total: £
                        <span class="cart-subtotal-price">{{ $cart->getTotalPrice() }}</span>
                    </p>
                </div>
                @vite('resources/ts/checkout.ts')
                <button type="submit"
                        data-checkout-button class="btn btn-primary rounded-lg w-1/3 mt-5 bg-zinc-800 dark:bg-white text-orange-400 dark:text-violet-500 hover:bg-zinc-900 dark:hover:bg-neutral-200">
                    Buy
                </button>
            </div>
        </div>
    </main>
</x-layouts.layout>
