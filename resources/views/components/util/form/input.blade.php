@props(['checked' => false])
<input {{ $attributes->get("type") === "checkbox" ? $checked ? "checked" : ""  : "" }} {{ $attributes->merge([ 'class' => 'w-full h-14 p-3 text-xl rounded-lg bg-stone-200 dark:bg-zinc-800 ring-0 focus:ring-4 focus:ring-orange-500/50 dark:focus:ring-violet-700/75 focus:outline-hidden transition-shadow duration-500']) }}/>
