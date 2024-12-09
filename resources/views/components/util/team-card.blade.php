<div class="relative w-full max-w-[190px] min-w-full aspect-w-4 aspect-h-5 bg-transparent p-4">

    <svg class="absolute inset-0 w-full h-full" viewBox="0 0 204 258" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
        <path d="M4 28C4 12.536 16.536 0 32 0H172C187.464 0 200 12.536 200 28V222C200 237.464 187.464 250 172 250H32C16.536 250 4 237.464 4 222V28Z" fill="#6D28D9"/>
        <path d="M4.5 28C4.5 12.8122 16.8122 0.5 32 0.5H172C187.188 0.5 199.5 12.8122 199.5 28V222C199.5 237.188 187.188 249.5 172 249.5H32C16.8122 249.5 4.5 237.188 4.5 222V28Z" stroke="black"/>
    </svg>

    <div class="relative flex flex-col text-center pb-4">
        <p class="font-semibold text-white text-xs sm:text-sm lg:text-base">
            {{ $name }}
        </p>

        <img src="{{ asset('images/initials/' . $initials . '.svg') }}"  class="pt-4">

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
