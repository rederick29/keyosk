<div class="relative w-[190px] h-[235px] p-4 absolute inset-0 flex bg-orange-500 border-stone-400 dark:bg-violet-700 rounded-xl dark:border-black border">


    <div class="relative flex flex-col text-center pb-4">
        <p class="font-semibold text-white text-xs sm:text-sm lg:text-base">
            {{ $name }}
        </p>

        <img src="{{ asset('images/initials/' . $initials . '.svg') }}"  class="">

        <div class="pt-4">
            <p class="text-white text-xs sm:text-sm lg:text-sm 2xl:text-base">
                {{ $role }}
            </p>
            <p class="text-white text-[10px] sm:text-xs lg:text-xs 2xl:test-sm p-4">
                {{ $support }}
            </p>
        </div>
    </div>
</div>
