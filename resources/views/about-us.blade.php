
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
            <div class = "grid grid-cols-2 md:grid-cols-4 gap-7 size-3/5 md:size-3/5 text-center mx-auto mt-6">
                <x-util.team-card name="Arun" role="Backend Developer" support="Security Support" initials="AW"/>
                <x-util.team-card name="Ben" role="Frontend Developer" support="Backend Support" initials="BS"/>
                <x-util.team-card name="Erick" role="Backend Developer" support="" initials="EV"/>
                <x-util.team-card name="Josh" role="Reporter" support="Designs Support" initials="JK"/>
                <x-util.team-card name="Kai" role="Frontend Developer" support="Backend Support Designs Support" initials="KC"/>
                <x-util.team-card name="Mohamed" role="Designer" support="Frontend Support" initials="MA"/>
                <x-util.team-card name="Mousa" role="Manager" support="Designs Support" initials="MM"/>
                <x-util.team-card name="Nauman" role="Reporter" support="Designs Support Management Support" initials="NA"/>
                <div class= "hidden md:block"></div>
                <x-util.team-card name="Suktirath" role="Frontend Developer" support="Designs Support" initials="SB"/>
                <x-util.team-card name="Toms" role="Frontend Developer" support="Management Support" initials="TX"/>
        </div>
    </div>
</x-layouts.layout>
