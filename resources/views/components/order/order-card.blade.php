{{--
Order-card component.

Author(s): Toms Xavi: Developer, Kai Chima: Sub-Developer
--}}

@props(['order'])
@php
    $user = \App\Models\User::find($order->user_id);
    $address = \App\Models\Address::withTrashed()->where('id', $order->address_id)->first();
    $products = $order->products;
    $date = $order->created_at;
    $status = $order->status;
    $price = $order->total_price;
    $id = $order->id;
@endphp
@vite("resources/ts/orders.ts")
<div
    class="order-card bg-stone-100 dark:bg-zinc-900 rounded-md p-6 flex flex-col shadow-lg hover:ring-4 hover:ring-orange-500 dark:hover:ring-violet-700/75 transition-all duration-300">
    <!-- Product Image and Info Container -->
    <section class="flex items-center justify-between gap-4 font-bold">

        <p class="w-[30px] font-bold">#{{ $id }}</p>

        @switch($status)
            @case(\App\Models\Order\OrderStatus::Completed)
                <p class="w-32 p-1 flex justify-center bg-green-700 rounded-md font-bold text-white">{{ strtoupper($status->value) }}</p>
                @break
            @case(\App\Models\Order\OrderStatus::Shipped)
                <p class="w-32 p-1 flex justify-center bg-orange-600 rounded-md font-bold text-white">{{ strtoupper($status->value) }}</p>
                @break
            @case(\App\Models\Order\OrderStatus::Dispatched)
                <p class="w-32 p-1 flex justify-center bg-blue-700 rounded-md font-bold text-white">{{ strtoupper($status->value) }}</p>
                @break
            @case(\App\Models\Order\OrderStatus::Processing)
                <p class="w-32 p-1 flex justify-center bg-pink-700 rounded-md font-bold text-white">{{ strtoupper($status->value) }}</p>
                @break
            @case(\App\Models\Order\OrderStatus::Pending)
                <p class="w-32 p-1 flex justify-center bg-yellow-400 rounded-md font-bold text-white">{{ strtoupper($status->value) }}</p>
                @break
            @case(\App\Models\Order\OrderStatus::Cancelled)
                <p class="w-32 p-1 flex justify-center bg-red-700 rounded-md font-bold text-white">{{ strtoupper($status->value) }}</p>
                @break
            @case(\App\Models\Order\OrderStatus::Refunded)
                <p class="w-32 p-1 flex justify-center bg-teal-500 rounded-md font-bold text-white">{{ strtoupper($status->value) }}</p>
                @break
        @endswitch

        <!-- admin sees user for sorting purposes, user doesnt need to, they know who they are -->
        @if(Auth::user()->is_admin && Request::is('*manage-orders*'))
            <p class="min-w-[200px] w-[200px] max-w-[200px] flex flex-row items-center gap-1 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                </svg>
                <span
                    class="{{ $user ? $user->subscription ? $user->subscription->getTierGradient() . " bg-linear-to-r text-transparent bg-clip-text" : "" : "text-gray-500" }}">
                    {{ $user ? Str::title($user->name) : "Guest" }}
                </span>
            </p>

        @endif

        <p class="min-w-[200px] w-[200px] max-w-[200px] flex flex-row items-center gap-1">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                <line x1="16" y1="2" x2="16" y2="6"></line>
                <line x1="8" y1="2" x2="8" y2="6"></line>
                <line x1="3" y1="10" x2="21" y2="10"></line>
            </svg>
            {{ $date->format('d M Y, h:i') }}
        </p>

        <p class="min-w-[200px] w-[200px] max-w-[200px] flex flex-row items-center gap-1">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                <line x1="16" y1="2" x2="16" y2="6"></line>
                <line x1="8" y1="2" x2="8" y2="6"></line>
                <line x1="3" y1="10" x2="21" y2="10"></line>
            </svg>
            TBD
        </p>

        <!-- Price -->
        <p class="min-w-[100px] w-[100px]">
            £{{ number_format($price, 2) }}
        </p>

        <x-util.button type="button" onclick="view({{ $id }})"
                       class="toggle toggle-closed w-fit bg-stone-200 dark:bg-zinc-800 hover:bg-black/10 dark:hover:bg-white/10">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M6 9l6 6 6-6"/>
            </svg>
        </x-util.button>
    </section>

    <!-- dropdown content -->
    <section class="w-full items-center content content-closed overflow-hidden">
        <div class="w-full px-1 pb-1 flex flex-col gap-y-5 pt-10">
            <hr class="w-full mx-auto border-2 rounded-xl border-stone-300 dark:border-zinc-800"/>

            <div class="mx-2 flex gap-x-20">
                <div class="w-1/2 p-5 flex flex-col gap-y-1 bg-black rounded-md">
                    <!-- products -->
                    @foreach ($products as $oprod)
                        <x-order.order-subcard
                            :productname="$oprod->name" :desc="$oprod->description" :prodprice="$oprod->price"
                            :prodimg="$oprod->primaryImageLocation() ?? 'Undefined'" :prodstatus="$status" :prodquant="$oprod->pivot->quantity">
                        </x-order.order-subcard>
                    @endforeach
                </div>

                <!-- addr / email / buttons -->
                <div class="w-1/2 p-5 flex flex-col justify-between">
                    <div class="flex flex-col gap-y-5 font-bold">
                        <p class="flex items-center gap-x-5">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                 stroke-linejoin="round">
                                <path
                                    d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                <polyline points="22,6 12,13 2,6"></polyline>
                            </svg>
                            {{ $order->email }}
                        </p>

                        <div class="flex items-start gap-x-5">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                 stroke-linejoin="round">
                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                <polyline points="9 22 9 12 15 12 15 22"></polyline>
                            </svg>
                            <div>
                                <p>{{ $address->name }}</p>
                                <p>{{ $address->line_one }}</p>
                                <p>{{ $address->line_two }}</p>
                                <p>{{ $address->city }}</p>
                                <p>{{ $address->postcode }}</p>
                                <p>{{ \App\Utils\CountryCodes::get_codes()[\App\Models\Country::find($address->country_id)->code] }}</p>
                            </div>
                        </div>
                    </div>

                    @if(Auth::user()->is_admin && Request::is('*manage-orders*'))
                        <form class="my-5 flex gap-5" method="POST" action="{{ route("orders.update", ['orderId' => $id]) }}"> @csrf
                            <select name="status"
                                class="dropdown h-10 px-5 rounded-lg bg-stone-200 dark:bg-zinc-800 w-full ring-0 focus:ring-4 focus:ring-orange-500/50 dark:focus:ring-violet-700/75 outline-hidden transition-shadow duration-500"
                                style="-webkit-appearance: none;">
                                <option value="{{ \App\Models\Order\OrderStatus::Pending }}">Pending</option>
                                <option value="{{ \App\Models\Order\OrderStatus::Processing }}">Processing</option>
                                <option value="{{ \App\Models\Order\OrderStatus::Dispatched }}">Dispatched</option>
                                <option value="{{ \App\Models\Order\OrderStatus::Shipped }}">Shipped</option>
                            </select>

                            <x-util.button type="button"
                                           class="w-1/3 bg-orange-500 dark:bg-violet-700 text-white hover:bg-orange-600 dark:hover:bg-violet-800">
                                Update
                            </x-util.button>
                        </form>
                    @endif

                    <div class="flex flex-col gap-y-5">
                        @if(Auth::user()->is_admin && Request::is('*manage-orders*'))
                            <form method="POST" action="{{ route("orders.update", ['orderId' => $id]) }}"> @csrf
                                <input type="hidden" name="status" value="{{ \App\Models\Order\OrderStatus::Completed }}">
                                <x-util.button type="button"
                                               class="bg-green-500 hover:bg-green-600 dark:bg-green-600 dark:hover:bg-green-800 text-white font-bold  overflow-hidden [&>span]:translate-x-4 hover:[&>span]:translate-x-0 [&>svg]:translate-y-10 hover:[&>svg]:translate-y-0 [&>*]:transition">
                                    <span>Mark Completed</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                         stroke-linejoin="round">
                                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                    </svg>
                                </x-util.button>
                            </form>
                        @endif

                        @if($status != \App\Models\Order\OrderStatus::Completed && $status != \App\Models\Order\OrderStatus::Shipped && $status != \App\Models\Order\OrderStatus::Refunded && $status != \App\Models\Order\OrderStatus::Cancelled)
                            <form method="POST" action="{{ route("orders.cancel", ['orderId' => $id]) }}"> @csrf
                                <x-util.button type="button"
                                               class="bg-red-500 hover:bg-red-600 dark:bg-red-600 dark:hover:bg-red-800 text-white font-bold  overflow-hidden [&>span]:translate-x-4 hover:[&>span]:translate-x-0 [&>svg]:translate-y-10 hover:[&>svg]:translate-y-0 [&>*]:transition">
                                    <span>Cancel</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                         stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <line x1="15" y1="9" x2="9" y2="15"></line>
                                        <line x1="9" y1="9" x2="15" y2="15"></line>
                                    </svg>
                                </x-util.button>
                            </form>
                        @endif

                        @if($status == \App\Models\Order\OrderStatus::Completed)
                            <form method="POST" action="{{ route("orders.refund", ['orderId' => $id]) }}"> @csrf
                                <x-util.button type="button"
                                               class="bg-red-500 hover:bg-red-600 dark:bg-red-600 dark:hover:bg-red-800 text-white font-bold  overflow-hidden [&>span]:translate-x-4 hover:[&>span]:translate-x-0 [&>svg]:translate-y-10 hover:[&>svg]:translate-y-0 [&>*]:transition">
                                    <span>Request a refund</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                         stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <line x1="15" y1="9" x2="9" y2="15"></line>
                                        <line x1="9" y1="9" x2="15" y2="15"></line>
                                    </svg>
                                </x-util.button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<style>
    .content {
        display: flex;
        flex-direction: column;
        overflow: hidden;
        transition: max-height 300ms ease;
    }

    .content-closed {
        max-height: 0px;
    }

    .content-open {
    }

    .toggle {
        transition: transform 300ms ease;
    }

    .toggle-closed svg {
        transform: rotate(0deg);
        transition: transform 300ms ease;
    }

    .toggle-open svg {
        transform: rotate(180deg);
        transition: transform 300ms ease;
    }

    .dropdown {
    }
</style>
