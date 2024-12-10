<div class="relative  w-full max-w-[190px] max-h-[235px] min-w-full aspect-w-4 aspect-h-5  p-4">

    <svg class="absolute inset-0 w-full h-full flex bg-orange-500 dark:bg-violet-700 rounded-xl border-black border" viewBox="0 0 204 258" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
        <path d="28C4 12.536 16.536 0 32 0H172C187.464 0 200 12.536 200 28V222C200 237.464 187.464 250 172 250H32C16.536 250 4 237.464 4 222V28Z" fill="#6D28D9"/>
    </svg>

    <div class="relative flex flex-col text-center pb-4">
        <p class="font-semibold text-white text-xs sm:text-sm lg:text-base">
            {{ $name }}
        </p>

        <img src="{{ asset('images/initials/' . $initials . '.svg') }}"  class="">

        <div class="pt-4">
            <p class="text-white text-xs sm:text-sm lg:text-sm">
                {{ $role }}
            </p>
            <p class="text-white text-[10px] sm:text-xs lg:text-xs ">
                {{ $support }}
            </p>
        </div>
    </div>
</div>
