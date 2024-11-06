import './bootstrap';

// This is for 'npm run build' so vite can find the images, helps with caching.
import.meta.glob([
    '../images/**'
]);

console.log("Connection");

//
// CART AND CART DROPDOWN BEHAVIOUR
//

let cartIcon = document.getElementById('cart-icon');
let cartDropdown = document.getElementById('cart-dropdown');
let bridge = document.getElementById('bridge');
let cartToggle = false;

document.body.addEventListener("click", function(e) {
    console.log("body (propagation)")
    if(cartToggle) {
        hideCartMenu();
    }
});

cartIcon.addEventListener("mouseenter", function(event) {
    if(!cartToggle) {
        showCartMenu();
        hideAccountMenu();
    }
    // stopPropagation must be called on the parent / spawner element.
    event.stopPropagation();
});

cartIcon.addEventListener("mouseleave", function(event) {
    hideCartMenu();
})

const showCartMenu = () => {
    cartIcon.classList.add("bg-white/5", "ring-2")
    cartDropdown.classList.remove('dropdown-hide-desktop');
    cartDropdown.classList.add('dropdown-display-desktop');
    bridge.classList.remove("hidden")
    cartToggle = true;
}

const hideCartMenu = () => {
    cartIcon.classList.remove("bg-white/5", "ring-2")
    cartDropdown.classList.remove('dropdown-display-desktop');
    cartDropdown.classList.add('dropdown-hide-desktop');
    bridge.classList.add("hidden")
    cartToggle = false;
}

//
// ACCOUNT AND ACCOUNT DROPDOWN BEHAVIOUR
//

let accountIcon = document.getElementById('account-icon');
let accountDropdown = document.getElementById('account-dropdown');
let accountToggle = false;

document.body.addEventListener("click", function(e) {
    if(accountToggle) {
        hideAccountMenu();
    }
});

accountIcon.addEventListener("click", function(event) {
    if(!accountToggle) {
        showAccountMenu();
        hideCartMenu();
    }
    else {
        hideAccountMenu();
    }

    // stopPropagation must be called on the parent / spawner element.
    event.stopPropagation();
});

const showAccountMenu = () => {
    accountIcon.classList.add("bg-white/5", "ring-2")
    accountDropdown.classList.remove('dropdown-hide-desktop');
    accountDropdown.classList.add('dropdown-display-desktop');
    accountToggle = true;
}

const hideAccountMenu = () => {
    accountIcon.classList.remove("bg-white/5", "ring-2")
    accountDropdown.classList.remove('dropdown-display-desktop');
    accountDropdown.classList.add('dropdown-hide-desktop');
    accountToggle = false;
}


