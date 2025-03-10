
<x-layouts.admin-layout currentPage="Orders">
    <section class="w-11/12 py-10 flex flex-col items-center">
        <div
            class="w-full h-fit py-5 px-5 flex justify-center bg-stone-100 dark:bg-zinc-900 text-zinc-800 dark:text-gray-400 rounded-lg"
            id="search"
        >
            <x-util.search class="w-full" placeholder="Search Orders" />
        </div>
        <div class="w-full py-5 flex flex-col gap-y-5">
            @foreach(\App\Models\Order::all() as $order)
                <a href="">
                    <div class="w-full bg-stone-100 dark:bg-zinc-900 rounded-md p-6 hover:ring-4 flex flex-row justify-between items-center hover:ring-orange-500 dark:hover:ring-violet-700/75 transition-all duration-300">
                        <div>
                            <p class="font-semibold ml-1 text-xl">#{{ $order->id }}</p>
                            <p class="font-semibold ml-1 text-black/70 dark:text-white/70">{{ $order->created_at }}</p>
                        </div>
                        <p class="font-semibold mr-1 text-black dark:text-white text-2xl">{{ strtoupper($order->status->value) }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </section>
</x-layouts.admin-layout>
