{{--
Product view page to be used as a view on website.

Author(s): Kai Chima : Main Developer

--}}

<x-layouts.layout>
    <x-slot:title>Keyosk | Product View</x-slot:title>
    <div class="bg-zinc-900/75 py-28 px-10 max-w-4xl lg:max-w-7xl lg:mx-14">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
            <div class="pt-10 sm:flex">
                <img class="flex lg:pl-10 w-70 rounded-sm object-cover"
                    src="https://th.bing.com/th/id/R.2dd71b9661e8f903644f7e681f5fa6d6?rik=QGpKKR64kRogrQ&pid=ImgRaw&r=0"
                    alt="Product image">
            </div>
            <div class="text-white lg:pl-2 space-y-3">
                <h2 id="productName" class="pt-10 font-semibold text-4xl">Black RGB Keyboard</h2>
                <p id="price" class="text-3xl">£60</p>
                <div id="ratingContainer" class="flex space-x-1">
                    <svg class="w-8 h-8 fill-yellow-400" viewBox="0 -19 550 550" xmlns="https://www.w3.org.2000/svg">
                        <path
                            d="M181 286L64 188 218 176 275 30 333 176 486 188 369 286 407 436 275 354 144 440 181 286Z" />
                    </svg>
                    <svg class="w-8 h-8 fill-yellow-400" viewBox="0 -19 550 550" xmlns="https://www.w3.org.2000/svg">
                        <path
                            d="M181 286L64 188 218 176 275 30 333 176 486 188 369 286 407 436 275 354 144 440 181 286Z" />
                    </svg>
                    <svg class="w-8 h-8 fill-yellow-400" viewBox="0 -19 550 550" xmlns="https://www.w3.org.2000/svg">
                        <path
                            d="M181 286L64 188 218 176 275 30 333 176 486 188 369 286 407 436 275 354 144 440 181 286Z" />
                    </svg>
                    <svg class="w-8 h-8 fill-yellow-400" viewBox="0 -19 550 550" xmlns="https://www.w3.org.2000/svg">
                        <path
                            d="M181 286L64 188 218 176 275 30 333 176 486 188 369 286 407 436 275 354 144 440 181 286Z" />
                    </svg>
                    <svg class="w-8 h-8 fill-yellow-400" viewBox="0 -19 550 550" xmlns="https://www.w3.org.2000/svg">
                        <path
                            d="M181 286L64 188 218 176 275 30 333 176 486 188 369 286 407 436 275 354 144 440 181 286Z" />
                    </svg>
                    <p id="rating" class="text-white text-xl">&ensp;4.9 &ensp;⋅</p>
                    <p id="stars" class="text-white text-xl pl-4 underline">50 Reviews</p>
                </div>
                <div class="">
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Asperiores ipsam esse harum non,
                        nesciunt odio cupiditate dolores officiis provident vero nihil, facilis modi maiores magni eaque
                        dolorem libero nostrum consequuntur.</p>
                </div>
                <div class="flex flex-wrap pt-3 gap-6 w-25">
                    <button
                        class="w-2/5 px-7 py-2 rounded-sm bg-white hover:bg-zinc-200 text-md text-violet-700 text-xl shadow-md ">Add
                        to cart</button>
                    <button
                        class="w-2/5 px-7 py-2 rounded-sm bg-violet-700 hover:bg-violet-500 text-md text-white text-xl shadow-md ">Buy
                        now</button>
                </div>

            </div>
        </div>
        <div class="text-white lg:pl-10 pt-10">
            <h3 class="text-violet-500 text-xl font-semibold pb-3">More Details</h3>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quaerat suscipit numquam eum, eligendi expedita
                mollitia consequuntur recusandae quos velit necessitatibus nisi pariatur labore adipisci soluta ducimus
                natus aliquam fuga. Cumque.
                Corporis, ipsam! Voluptates, possimus sed laborum quam facilis consectetur minima eveniet cupiditate.
                Laudantium voluptatem doloribus corrupti ex nulla, consequatur ut voluptatibus ea aliquam culpa fuga
                dolore iusto, enim eveniet reiciendis.
                Voluptatum quia et sapiente ut, aliquid quaerat voluptate eaque tempore odio ea itaque accusamus ipsam
                sed! Quae rerum quia facere eos incidunt officia fugiat nisi. Fugit porro impedit excepturi eos.
                Numquam voluptas exercitationem ipsam a modi similique quibusdam, officia optio dolorum quia delectus
                adipisci pariatur ipsa deserunt aperiam? In iure saepe perspiciatis et pariatur quidem nisi accusamus
                sit, odit deserunt?
                Reprehenderit molestias odit suscipit dolorem nostrum illum cupiditate eligendi tenetur saepe ipsum quo,
                quod nesciunt asperiores esse vero eius maiores quaerat, fuga consequuntur eveniet! Dolor, deserunt
                excepturi? Quos, architecto ut.</p>
        </div>
        <div class="text-white lg:pl-10 pt-7">
            <h3 class="text-violet-500 text-xl font-semibold">Reviews</h3>
            <p class="py-4">Review 1 - Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt debitis ex nostrum
                dignissimos recusandae at voluptatibus distinctio esse laboriosam corporis accusantium architecto qui
                consequatur explicabo temporibus, cum officia possimus reiciendis!
                Praesentium nihil accusantium id mollitia rem dolores laboriosam excepturi perferendis ut omnis
                distinctio hic nam quo molestiae nulla saepe quos quis porro illum, quaerat, corrupti dolore
                voluptatibus? Architecto, esse amet.</p>
            <p class="py-4">Review 2 - Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt debitis ex nostrum
                dignissimos recusandae at voluptatibus distinctio esse laboriosam corporis accusantium architecto qui
                consequatur explicabo temporibus, cum officia possimus reiciendis!
                Praesentium nihil accusantium id mollitia rem dolores laboriosam excepturi perferendis ut omnis
                distinctio hic nam quo molestiae nulla saepe quos quis porro illum, quaerat, corrupti dolore
                voluptatibus? Architecto, esse amet.</p>
            <p class="py-4">Review 3 - Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt debitis ex nostrum
                dignissimos recusandae at voluptatibus distinctio esse laboriosam corporis accusantium architecto qui
                consequatur explicabo temporibus, cum officia possimus reiciendis!
                Praesentium nihil accusantium id mollitia rem dolores laboriosam excepturi perferendis ut omnis
                distinctio hic nam quo molestiae nulla saepe quos quis porro illum, quaerat, corrupti dolore
                voluptatibus? Architecto, esse amet.</p>
            <a href="" class="text-violet-700 underline">More Reviews -></a>
        </div>
    </div>



</x-layouts.layout>