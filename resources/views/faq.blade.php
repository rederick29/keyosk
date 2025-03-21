{{--
    FAQ Page

    Author(s): intns
--}}

<x-layouts.layout>
    <x-slot:title>Keyosk | FAQ</x-slot:title>
    <div class="about-us bg-white dark:bg-zinc-950 pt-32 text-zinc-800 dark:text-white anim-up">
        <h1 class="misc-page-header">
            Frequently Asked Questions
        </h1>

        <div class="p-8 mt-12 mx-auto max-w-4xl space-y-4">
            @php
                $faqs = [
                    [
                        'question' => 'What products does Keyosk offer?',
                        'answer' =>
                            'Keyosk specializes in high-quality peripherals such as keyboards, mice, headphones, and other accessories that elevate your experience with cutting-edge technology and sleek designs.',
                    ],
                    [
                        'question' => 'How do I place an order?',
                        'answer' =>
                            'Simply browse our catalog, add items to your cart, and proceed to checkout. Our streamlined interface makes ordering fast and easy.',
                    ],
                    [
                        'question' => 'What is Keyosk\'s return policy?',
                        'answer' =>
                            'We offer a 30-day return policy on all our products. If you\'re not satisfied with your purchase, contact our support team, and we\'ll guide you through the return process.',
                    ],
                    [
                        'question' => 'Do you ship internationally?',
                        'answer' =>
                            'Yes, Keyosk ships to a wide range of countries. Shipping fees and delivery times may vary depending on your location.',
                    ],
                    [
                        'question' => 'How can I track my order?',
                        'answer' =>
                            'Once your order is shipped, you\'ll receive a tracking number via email. You can use it to track your shipment on our website or the courier\'s platform.',
                    ],
                    [
                        'question' => 'Does Keyosk offer warranty coverage?',
                        'answer' =>
                            'Yes, all Keyosk products come with a standard one-year warranty. For details on coverage and claims, please contact us. You can find our contact link at the bottom of the page.',
                    ],
                    [
                        'question' => 'How can I contact customer support?',
                        'answer' =>
                            'Our support team is available 24/7 to assist you. You can find our contact link at the bottom of the page.',
                    ],
                    [
                        'question' => 'Does Keyosk offer customization services?',
                        'answer' =>
                            'Yes, Keyosk offers customization services for select products. We are currently developing a custom 3D keyboard editing tool that can help you with this.',
                    ],
                ];
            @endphp

            {{-- Loop through the FAQs --}}
            @foreach ($faqs as $faq)
                <div class="bg-stone-200 dark:bg-zinc-900 p-6 rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold text-orange-500 dark:text-violet-700">{{ $faq['question'] }}</h3>
                    <p class="mt-2 text-zinc-800 dark:text-gray-300 leading-relaxed">
                        {!! $faq['answer'] !!}
                    </p>
                </div>
            @endforeach

            <br>
        </div>
    </div>
</x-layouts.layout>
