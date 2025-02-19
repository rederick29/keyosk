{{--
Order-card component.

Author(s): Toms Xavi: Developer, Kai Chima: Sub-Developer
--}}

@props(['oproducts', 'date', 'status', 'price', 'id'])

<div class="product-card bg-stone-100 dark:bg-zinc-900 border-2 border-orange-500 dark:border-violet-700 rounded-md p-6 flex flex-col gap-4 shadow-lg mb-6 lg:mx-20">
    <!-- Info Container -->
    <div class="flex items-center gap-4">
    
        <!-- Order Details -->
        <div class="flex-grow">
            <h3 class="product-title text-xl font-semibold text-zinc-800 dark:text-gray-300 mb-2">Status:
                {{ $status }}</h3>
            <p class="product-description text-md text-black/50 dark:text-gray-300 leading-relaxed">
                {{ $date }}
            </p>
        </div>

        <!-- Total Price -->
        <div class="flex-shrink-0">
            <span class="product-price text-2xl font-bold text-zinc-800 dark:text-gray-300">
                Total: £{{ number_format($price, 2) }}
            </span>
        </div>
    </div>

    <!-- Button -->
    <div class="flex items-center justify-end gap-4 mt-4">
        <!-- View Products Button -->
        <button onclick="view({{ $id }})"
            class="buy-now-btn border border-orange-500 dark:border-violet-700 text-orange-500 dark:text-violet-700 px-5 py-2 rounded-md font-semibold hover:bg-orange-500 dark:hover:bg-violet-700 hover:text-zinc-800 dark:hover:text-white transition duration-300">
            View Products
        </button>
    </div>
    <!-- Displays each product in order -->
    <div id="{{ $id }}" style="display: none;">
    @foreach ($oproducts as $oprod)
        <x-util.order-subcard 
            :productId="$oprod->id" :productname="$oprod->name" :desc="$oprod->description" :prodprice="$oprod->price" :prodimg="$oprod->primaryImageLocation() ?? 'Undefined'">
        </x-util.order-subcard>
    @endforeach
    </div>    
    
</div>

<script>
    //For the view products button
    function view(id){
        var v = document.getElementById(id)
        if(v.style.display === "none"){
            v.style.display="block";
        } else{
            v.style.display="none";
        }
        
    }
</script>

<style>
    #viewprod {
        display: none;
    }

    /* Styling for Quantity Selector */
    .quantity-selector input {
        appearance: none;
        /* Removes browser default styles */
        padding: 0.25rem 0;
        font-size: 1rem;
        text-align: center;
        /* Centers the text */
        height: 2rem;
        /* Adjusted height */
        width: 3rem;
        /* Adjusted width */
        margin: 0;
        /* Ensures no extra space inside input */
    }

    /* Prevents scroll arrows in the input for all browsers */
    input[type="number"]::-webkit-outer-spin-button,
    input[type="number"]::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    input[type="number"] {
        -moz-appearance: textfield;
        /* Firefox */
        -webkit-appearance: none;
        /* Chrome, Safari */
        appearance: none;
        /* All other browsers */
    }

    /* Styling for Buttons */
    .add-to-cart-btn,
    .buy-now-btn {
        font-size: 1rem;
        font-weight: bold;
        padding: 0.75rem 1.5rem;
        /* Ensure equal padding */
        height: 2.75rem;
        /* Adjust the height of the buttons to be equal */
        min-width: 8rem;
        /* Ensure buttons have the same minimum width */
        text-align: center;
        /* Center the text inside */
        display: inline-flex;
        justify-content: center;
        /* Center the content horizontally */
        align-items: center;
        /* Center the content vertically */
        transition: all 0.3s ease;
    }
</style>
