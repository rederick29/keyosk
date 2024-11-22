
{{--
    About us page to be used as a view on website.

    Author(s): Mohamed Ahmed

    TODO: -Add visuals
          -Add a new font
--}}

<x-layouts.layout>
    <x-slot:title>Keyosk | About us</x-slot:title>
    <div class = "about-us bg-zinc-950 pt-32 text-white font-sans">

        <h1 class = "text-center text-4xl font-semibold">About Us</h1>
        
        <div class="bg-zinc-900 p-6 rounded-lg mt-10 mx-auto max-w-2xl">
            <h1 class = "text-center text-2xl">The Keyosk Mission</h1>
            <br>
            <p class="text-center mx-auto w-3/4 text-wrap">Our mission at Keyosk is a dedication to providing an unforgettable experience to our customers. We take pride in the quality of our products and always strive towards innovation in the many markets we pursue, especially peripherals. We have a strong focus on sustainability and want to make sure <strong>we</strong> contribute to saving the environment. </p>
        <br>
        <hr class = "border-2 border-violet-700 bg-violet-700">
        <br>
        <h1 class = "text-center text-2xl">The Keyosk Vision</h1>
        <br>
        <p class = "text-center mx-auto w-3/4 text-wrap">The vision at Keyosk has always been to redefine how people connect with technology, as we look towards designing our products through progressive, ergonomic and sustainable methods. We visualise a future where we become leading innovators in the peripherals industry, as Keyosk products encourage a higher quality of life, productivity and satisfication for our customers. </p>
        </div>
        <div class="bg-zinc-900 p-6 rounded-lg mt-10 mx-auto">
            <h1 class = "text-center text-2xl">Meet The Team</h1>
            <div class = "grid grid-cols-2 md:grid-cols-4 gap-7 size-4/5 md:size-3/5 text-center mx-auto mt-6">
                <div>
                    <p class ="text-sm font-semibold">Arun</p>
                    <img src="https://i.ibb.co/XfQgwQp/Unknown-person.jpg">
                    <p class ="text-sm">Backend Developer</p>
                    <p class ="text-xs">Security Support</p>
                </div>
                <div>
                    <p class ="text-sm font-semibold">Ben</p>
                    <img src="https://i.ibb.co/XfQgwQp/Unknown-person.jpg">
                    <p class ="text-sm">Frontend Developer</p>
                    <p class ="text-xs">Backend Support</p>
                </div>
                <div>
                    <p class ="text-sm font-semibold">Erick</p>
                    <img src="https://i.ibb.co/XfQgwQp/Unknown-person.jpg">
                    <p class ="text-sm">Backend Developer</p>
                </div>
                <div>
                    <p class ="text-sm font-semibold">Josh</p>
                    <img src="https://i.ibb.co/XfQgwQp/Unknown-person.jpg">
                    <p class ="text-sm">Reporter</p>
                </div>
                <div>
                    <p class ="text-sm font-semibold">Kai</p>
                    <img src="https://i.ibb.co/XfQgwQp/Unknown-person.jpg">
                    <p class ="text-sm">Frontend Developer</p>
                    <p class ="text-xs">Backend Support<br>Design Support</p>
                </div>
                <div>
                    <p class ="text-sm font-semibold">Mohamed</p>
                    <img src="https://i.ibb.co/XfQgwQp/Unknown-person.jpg">
                    <p class ="text-sm">Designer</p>
                    <p class ="text-xs">Frontend Support</p>
                </div>
                <div>
                    <p class ="text-sm font-semibold">Mousa</p>
                    <img src="https://i.ibb.co/XfQgwQp/Unknown-person.jpg">
                    <p class ="text-sm">Manager</p>
                    <p class ="text-xs">Design Support</p>
                </div>
                <div>
                    <p class ="text-sm font-semibold">Nauman</p>
                    <img src="https://i.ibb.co/XfQgwQp/Unknown-person.jpg">
                    <p class ="text-sm">Reporter</p>
                    <p class ="text-xs">Management Support<br>Design Support</p>
                </div>
                <div class="hidden md:block"></div> <!-- This blank space is visible only on larger screens -->
                <div>
                    <p class="text-sm font-semibold">Toms</p>
                    <img src="https://i.ibb.co/XfQgwQp/Unknown-person.jpg">
                    <p class="text-sm">Manager</p>
                    <p class="text-xs">Reports Support</p>
                </div>
                <div>
                    <p class="text-sm font-semibold">Suktirath</p>
                    <img src="https://i.ibb.co/XfQgwQp/Unknown-person.jpg">
                    <p class="text-sm">Frontend Developer</p>
                    <p class="text-xs">Reports Support<br>Design Support</p>
                </div>
        </div>
    </div>
</x-layouts.layout>
