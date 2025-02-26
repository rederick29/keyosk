
{{--
    About us page to be used as a view on website.

    Author(s): Mohamed Ahmed

    TODO: -Add visuals
          -Add a new font
--}}

<x-layouts.layout>
    <x-slot:title>Keyosk | About us</x-slot:title>
    <div class="about-us bg-white dark:bg-zinc-950 pt-32 text-zinc-800 dark:text-white font-sans">

        <h1 class = "misc-page-header">About Us</h1>
        
        <div class="misc-page-container animate-fade-up">
            <h1 class = "text-center text-2xl font-semibold text-orange-500 dark:text-violet-700 tracking-wide">The Keyosk Mission</h1>
            <br>
            <p class="text-center mx-auto w-3/4 text-wrap">Our mission at Keyosk is a dedication to providing an unforgettable experience to our customers. We take pride in the quality of our products and always strive towards innovation in the many markets we pursue, especially peripherals. We have a strong focus on sustainability and want to make sure we contribute to saving the environment. </p>
        <br>
        <hr class = "border-2 border-orange-500 dark:border-violet-700 bg-orange-500 dark:bg-violet-700">
        <br>
        <h1 class = "text-center text-2xl font-semibold text-orange-500 dark:text-violet-700 tracking-wide">The Keyosk Vision</h1>
        <br>
        <p class = "text-center mx-auto w-3/4 text-wrap">The vision at Keyosk has always been to redefine how people connect with technology, as we look towards designing our products through progressive, ergonomic and sustainable methods. We visualise a future where we become leading innovators in the peripherals industry, as Keyosk products encourage a higher quality of life, productivity and satisfication for our customers. </p>
        </div>
        <div class="bg-stone-100 dark:bg-zinc-900 p-6 rounded-lg shadow-lg mt-10 mx-auto max-w-(--breakpoint-lg)">
            <h1 class = "text-center text-2xl font-semibold text-orange-500 dark:text-violet-700 tracking-wide">Meet The Team</h1>
            <div class = "grid grid-cols-2 md:grid-cols-4 gap-7 items-center text-center mx-auto mt-6">
                <x-util.team-card name="Arun" role="Backend Developer" support="Security Support" initials="AW"/>
                <x-util.team-card name="Ben" role="Frontend Developer" support="Backend Support" initials="BS"/>
                <x-util.team-card name="Erick" role="Backend Developer" support="" initials="EV"/>
                <x-util.team-card name="Josh" role="Reporter" support="Design Support" initials="JK"/>
                <x-util.team-card name="Kai" role="Frontend Developer" support="Backend Support Design Support" initials="KC"/>
                <x-util.team-card name="Mohamed" role="Designer" support="Frontend Support" initials="MA"/>
                <x-util.team-card name="Mousa" role="Manager" support="Design Support" initials="MM"/>
                <x-util.team-card name="Nauman" role="Reporter" support="Design Support Management Support" initials="NA"/>
                <div class= "hidden md:block"></div>
                <x-util.team-card name="Suktirath" role="Frontend Developer" support="Design Support" initials="SB"/>
                <x-util.team-card name="Toms" role="Frontend Developer" support="Management Support" initials="TX"/>
        </div>
    </div>
</x-layouts.layout>


