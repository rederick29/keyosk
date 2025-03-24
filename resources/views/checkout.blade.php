@php
    use Illuminate\Support\Facades\Auth;
    use App\Models\User;
    $user = new User;
    $addresses = [];
    $primary_address = null;
    $cart = null;
    if (Auth::check()) {
        $user = Auth::user();
        $addresses = $user->addresses;
        $primary_address = $addresses->where('priority', 0)->first();
        $cart = $user->cart ?? App\Models\Cart::factory()->forUser($user)->create();
    } else {
        $user->first_name = "";
        $user->last_name = "";
        $user->email = "";
        $user->id = -1;
    }

    $cartService = app(\App\Services\CartService::class);
    $hasProducts = $cartService->hasProducts();
    $cart_component = $cart ? "navbar.cart-item" : "navbar.guest-cart-item";
@endphp
<x-layouts.layout>
    <x-slot:title>Keyosk | Checkout</x-slot:title>
    <span class="hidden user-id">{{ $user->id }}</span>
    <main class="pt-[96px] w-full min-h-screen h-full flex justify-center">
        <section class="w-full px-14 py-12">
            <form method="POST" action="{{ route('cart.checkout') }}" id="checkout-form" class="w-full px-2 py-5 gap-y-5 flex flex-col">

                <!-- contact info -->

                <div>
                    <p class="font-semibold text-xl">Contact Information</p>
                </div>
                <hr class="w-full mx-auto border-2 rounded-xl border-stone-300 dark:border-zinc-800" />
                <div class="flex flex-col gap-y-5">
                    <div class="flex gap-x-5">
                        <div class="flex flex-col space-y-2 w-1/2">
                            <x-util.form.label for="first_name">First name *</x-util.form.label>
                            <x-util.form.input type="text" name="first_name" id="first_name" value="{{ $user->first_name }}" required></x-util.form.input>
                        </div>
                        <div class="flex flex-col space-y-2 w-1/2">
                            <x-util.form.label for="last_name">Last name *</x-util.form.label>
                            <x-util.form.input type="text" name="last_name" id="last_name" value="{{ $user->last_name }}" required></x-util.form.input>
                        </div>
                    </div>
                    <div class="">
                        <div class="flex flex-col space-y-2">
                            <x-util.form.label for="email">Email *</x-util.form.label>
                            <x-util.form.input type="email" name="email" id="email" value="{{ $user->email }}" required></x-util.form.input>
                        </div>
                    </div>
                </div>

                <!-- shipping info -->

                <div class="mt-5">
                    <p class="font-semibold text-xl">Shipping Address</p>
                </div>
                <hr class="w-full mx-auto border-2 rounded-xl border-stone-300 dark:border-zinc-800" />
                <div class="flex flex-col items-center">
                    <p class="font-semibold text-xl">Select an address:</p>
                    <div class="w-1/3 mt-5 flex flex-col gap-y-5">
                        @foreach($addresses as $address)
                            <div class="w-full h-18 px-5 flex justify-between bg-stone-300 dark:bg-zinc-900 rounded-md">
                                <label class="flex items-center gap-x-1 font-bold" for="address-{{ $address->priority }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                                    {{ $address->line_one }}
                                </label>
                                <input class="address-button" type="radio" id="address-{{ $address->priority }}" name="addressId" value="{{ $address->priority }}" {{ $primary_address->id == $address->id ? "checked" : "" }}>
                            </div>
                        @endforeach
                        <div class="w-full h-18 px-5 flex justify-between bg-stone-300 dark:bg-zinc-900 rounded-md">
                            <label class="w-full h-full flex items-center gap-x-1 font-bold" for="new-address">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                New Address
                            </label>
                            <input class="address-button" type="radio" id="new-address" name="addressId" value="-1" {{ empty($addresses) ? "checked" : "" }}>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col gap-y-5">
                    <input type="hidden" name="addressId" id="addressId" value="{{ $primary_address->priority ?? -1 }}">

                    <div class="flex flex-col space-y-2">
{{--                        <label for="address_name"--}}
{{--                               class="block text-black/50 dark:text-gray-300 text-sm font-semibold">Recipient's Name</label>--}}
{{--                        <div class="mt-2.5">--}}
{{--                            <input type="text" name="address_name" id="address_name" {{ $primary_address ? "disabled readonly" : "" }}--}}
{{--                                   class="font-semibold w-full rounded-lg py-2 text-black/50 dark:text-gray-300 bg-zinc-300 dark:bg-zinc-700"--}}
{{--                                   value="{{ $primary_address->name ?? "" }}"--}}
{{--                            >--}}
{{--                        </div>--}}
                        <x-util.form.label for="address_name">Recipient's Name</x-util.form.label>
                        <x-util.form.input type="text" name="address_name" :disabled="!empty($primary_address)" :readonly="!empty($primary_address)" id="address_name" :value="$primary_address->name ?? ''"></x-util.form.input>
                    </div>

                    <div class="flex gap-x-5">
                        <div class="flex flex-col space-y-2 w-1/2">
    {{--                        <label for="address1"--}}
    {{--                               class="block text-black/50 dark:text-gray-300 text-sm font-semibold">Address 1*</label>--}}
    {{--                        <div class="mt-2.5">--}}
    {{--                            <input type="text" name="address1" id="address1" {{ $primary_address ? "disabled readonly" : "" }}--}}
    {{--                                   class="font-semibold w-full rounded-lg py-2 text-black/50 dark:text-gray-300 bg-zinc-300 dark:bg-zinc-700"--}}
    {{--                                   value="{{ $primary_address->line_one ?? "" }}"--}}
    {{--                            >--}}
    {{--                        </div>--}}
                            <x-util.form.label for="address1">Address 1 *</x-util.form.label>
                            <x-util.form.input type="text" name="address1" id="address1" :disabled="!empty($primary_address)" :readonly="!empty($primary_address)" :value="$primary_address->line_one ?? ''"></x-util.form.input>
                        </div>

                        <div class="flex flex-col space-y-2 w-1/2">
    {{--                        <label for="address2"--}}
    {{--                               class="block text-black/50 dark:text-gray-300 text-sm font-semibold">Address line two</label>--}}
    {{--                        <div class="mt-2.5">--}}
    {{--                            <input type="text" name="address2" id="address2" {{ $primary_address ? "disabled readonly" : "" }}--}}
    {{--                                   class="font-semibold w-full rounded-lg py-2 text-black/50 dark:text-gray-300 bg-zinc-300 dark:bg-zinc-700"--}}
    {{--                                   value="{{ $primary_address->line_two ?? "" }}"--}}
    {{--                            >--}}
    {{--                        </div>--}}
                            <x-util.form.label for="address2">Address 2 *</x-util.form.label>
                            <x-util.form.input type="text" name="address2" id="address2" :disabled="!empty($primary_address)" :readonly="!empty($primary_address)" :value="$primary_address->line_two ?? ''"></x-util.form.input>
                        </div>
                    </div>

                    <div class="flex gap-x-5">
                        <div class="flex flex-col space-y-2 w-1/2">
    {{--                        <label for="city"--}}
    {{--                               class="block text-black/50 dark:text-gray-300 text-sm font-semibold">City*</label>--}}
    {{--                        <div class="mt-2.5">--}}
    {{--                            <input type="text" name="city" id="city" {{ $primary_address ? "disabled readonly" : "" }}--}}
    {{--                                   class="font-semibold w-full rounded-lg py-2 text-black/50 dark:text-gray-300 bg-zinc-300 dark:bg-zinc-700"--}}
    {{--                                   value="{{ $primary_address->city ?? "" }}"--}}
    {{--                            >--}}
    {{--                        </div>--}}
                            <x-util.form.label for="city">City *</x-util.form.label>
                            <x-util.form.input type="text" name="city" id="city" :disabled="!empty($primary_address)" :readonly="!empty($primary_address)" :value="$primary_address->city ?? ''"></x-util.form.input>
                        </div>
                        <div class="flex flex-col space-y-2 w-1/2">
    {{--                        <label for="postcode"--}}
    {{--                               class="block text-black/50 dark:text-gray-300 text-sm font-semibold">Postcode*</label>--}}
    {{--                        <div class="mt-2.5">--}}
    {{--                            <input type="text" name="postcode" id="postcode" {{ $primary_address ? "disabled readonly" : "" }}--}}
    {{--                                   class="font-semibold w-full rounded-lg py-2 text-black/50 dark:text-gray-300 bg-zinc-300 dark:bg-zinc-700"--}}
    {{--                                   value="{{ $primary_address->postcode ?? "" }}"--}}
    {{--                            >--}}
    {{--                        </div>--}}
                            <x-util.form.label for="postcode">Postcode *</x-util.form.label>
                            <x-util.form.input type="text" name="postcode" id="postcode" :disabled="!empty($primary_address)" :readonly="!empty($primary_address)" :value="$primary_address->postcode ?? ''"></x-util.form.input>
                        </div>
                    </div>

                    <div class="flex flex-col space-y-2">
                        <x-util.form.label for="country">Country *</x-util.form.label>
                        <div>
                            <select {{ $primary_address ? "readonly" : "" }} name="country" id="country" {{ $primary_address ? "disabled readonly" : "" }}
                            class="h-14 p-3 text-xl rounded-lg bg-stone-200 dark:bg-zinc-800 w-full ring-0 focus:ring-4 focus:ring-orange-500/50 dark:focus:ring-violet-700/75 focus:outline-hidden transition-shadow duration-500">
                                @php
                                    $selected_code = \App\Models\Country::where('id', $primary_address->country_id ?? \App\Models\Country::where('code', 'GB')->first()->id)->first()->code;
                                @endphp
                                @foreach(App\Utils\CountryCodes::get_codes() as $code => $country)
                                    <option value="{{ $code }}" {{ $selected_code == $code ? "selected" : "" }}>{{ $country }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="w-full flex items-center justify-end gap-x-5">
                        <label for="save_address" class="{{ $cart ? $primary_address ? "invisible" : "visible" : "invisible" }} text-black/50 dark:text-gray-300 text-sm font-semibold">Save address?</label>
                        <input type="checkbox" name="save_address" id="save_address" class="{{ $cart ? $primary_address ? "invisible" : "visible" : "invisible" }}">
                    </div>
                </div>

                <!-- card details -->

                <div>
                    <p class="font-semibold text-xl">Card Details</p>
                </div>
                <hr class="w-full mx-auto border-2 rounded-xl border-stone-300 dark:border-zinc-800" />

                <div class="flex flex-col gap-y-5 ">
                    <div class="flex flex-col space-y-2">
                        <x-util.form.label for="card_holder_name">Cardholder Name *</x-util.form.label>
                        <x-util.form.input type="text" name="card_holder_name" id="card_holder_name" required></x-util.form.input>
                    </div>

                    <div class="flex flex-col space-y-2">

                        <x-util.form.label for="card_number">Card Number *</x-util.form.label>
                        <x-util.form.input type="text" name="card_number" id="card_number" minlength="16" maxlength="16" required></x-util.form.input>
                    </div>

                    <div class="flex gap-x-5">
                        <div class="flex flex-col space-y-2 w-1/2">
                            <x-util.form.label for="expiry_date">Expiry Date *</x-util.form.label>
                            <x-util.form.input class="text-center" type="text" name="expiry_date" id="expiry_date" minlength="4" maxlength="4" placeholder="MM/YY" required></x-util.form.input>
                        </div>
                        <div class="flex flex-col space-y-2 w-1/2">
                            <x-util.form.label for="cvv">CVV *</x-util.form.label>
                            <x-util.form.input type="text" name="cvv" id="cvv" minlength="3" maxlength="3" required></x-util.form.input>
                        </div>
                    </div>
                </div>

            </form>
        </section>

        <!-- side bar -->
        <aside class="w-3/5 min-h-full px-14 py-12 bg-stone-100 dark:bg-zinc-900" id="totals">

            <h1 class="pb-3 ml-2 font-bold text-2xl">Checkout</h1>

            <hr class="w-full mx-auto border-2 rounded-xl border-stone-300 dark:border-zinc-800" />

            <div class="h-fit max-h-[425px] overflow-y-scroll px-3 py-3 my-7 flex flex-col gap-y-2 bg-stone-300 dark:bg-zinc-950 rounded-lg">
                @foreach($cart ? $cart->products()->orderBy("name")->get() : $cartService->getProducts() as $product)
                    <x-dynamic-component :component="$cart_component"
                                         :product="$product"/>
                @endforeach
            </div>

            <hr class="w-full mx-auto border-2 rounded-xl border-stone-300 dark:border-zinc-800" />

            <div class="py-7 mx-2">
                <x-util.form.input type="text" name="discount_code" id="discount_code" placeholder="Discount Code"></x-util.form.input>
            </div>

            <hr class="w-full mx-auto border-2 rounded-xl border-stone-300 dark:border-zinc-800" />

            <div class="hidden">
                @if(Auth::check())
                    @foreach($cart->products()->orderBy("name")->get() as $product)
                        <p><span class="summary-product-quantity-{{ $product->id }}">{{ $product->pivot->quantity }}</span></p>
                    @endforeach
                @else
                    @foreach($cartService->getProducts() as $product)
                        <p><span class="summary-product-quantity-{{ $product['id'] }}">{{ $product['quantity'] }}</span></p>
                    @endforeach
                @endif
            </div>
            <div class="py-7 mx-2 flex flex-col">
                <p class="mb-2 flex flex-row justify-between font-bold text-xl">
                    SUBTOTAL
                    <span class="flex flex-row">£
                       <span class="cart-subtotal-price">{{ number_format($cartService->getTotalPrice(), 2, '.', '') }}</span>
                    </span>
                </p>
                <p class="flex flex-row justify-between font-bold text-base text-black/50 dark:text-white/50">
                    SHIPPING
                    <span class="">TBD.</span>
                </p>
            </div>

            <hr class="w-full mx-auto border-2 rounded-xl border-stone-300 dark:border-zinc-800" />

            <p class="py-7 mx-2 flex flex-row justify-between font-bold text-xl">
                TOTAL
                <span class="flex flex-row">£
                    <span class="cart-subtotal-price">{{ number_format($cartService->getTotalPrice(), 2, '.', '') }}</span>
                </span>
            </p>

            <hr class="w-full mx-auto border-2 rounded-xl border-stone-300 dark:border-zinc-800" />

            @vite('resources/ts/checkout.ts')
            <div class="py-7 mx-2">
                <x-util.button type="button" data-checkout-button class="bg-transparent ring-2 ring-orange-500 dark:ring-violet-700 text-orange-500 dark:text-violet-700 hover:bg-orange-500 dark:hover:bg-violet-800 hover:text-zinc-800 dark:hover:text-white">Buy</x-util.button>
            </div>

            <hr class="w-full mx-auto border-2 rounded-xl border-stone-300 dark:border-zinc-800" />
        </aside>
    </main>
</x-layouts.layout>
