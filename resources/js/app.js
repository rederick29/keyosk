import './bootstrap';
//import '../ts/app.ts';

// This is for 'npm run build' so vite can find the images, helps with caching.
import.meta.glob([
    '../images/**'
]);

console.log("Connection");

class DropdownMenu {
    /*
     * Create a new dropdown menu
     * param parentId: ID of the parent element that will open the dropdown
     * param dropdownId: ID of the dropdown element to show/hide
     * throws Error if parent or dropdown elements are not found
     */
    constructor(parentId, dropdownId) {
        this.parentElement = document.getElementById(parentId);
        if (!this.parentElement) {
            throw new Error(`Parent element with ID ${parentId} not found`);
        }

        this.dropdownElement = document.getElementById(dropdownId);
        if (!this.dropdownElement) {
            throw new Error(`Dropdown element with ID ${dropdownId} not found`);
        }

        this.isOpen = false;
        this.otherMenus = [];
    }

    /*
     * Toggle the dropdown menu open or closed
     */
    toggle() {
        // Close other menus before opening this one
        this.closeOtherMenus();

        if (this.isOpen) {
            this.hide();
        } else {
            this.show();
        }
    }

    /*
     * Open the dropdown menu
     */
    show() {
        // If the menu is already open, don't do anything
        if (this.isOpen) {
            return;
        }

        this.parentElement.classList.add('bg-white/5', 'ring-2');
        this.dropdownElement.classList.remove('dropdown-hide');
        this.dropdownElement.classList.add('dropdown-display');
        this.isOpen = true;
    }

    /*
     * Close the dropdown menu
     */
    hide() {
        // If the menu is already closed, don't do anything
        if (!this.isOpen) {
            return;
        }

        this.parentElement.classList.remove('bg-white/5', 'ring-2');
        this.dropdownElement.classList.remove('dropdown-display');
        this.dropdownElement.classList.add('dropdown-hide');
        this.isOpen = false;
    }

    /*
     * Register another menu to close when this one is opened
     */
    registerOtherMenu(menu) {
        this.otherMenus.push(menu);
    }

    /*
     * Close other menus when opening this one
     */
    closeOtherMenus() {
        this.otherMenus.forEach(menu => {
            if (menu !== this && menu.isOpen) {
                menu.hide();
            }
        });
    }
}

// Initialize dropdown menus
const cartMenu = new DropdownMenu('cart-icon', 'cart-dropdown');
const accountMenu = new DropdownMenu('account-icon', 'account-dropdown');
const hamburgerMenu = new DropdownMenu('hamburger', 'hamburger-dropdown');

// Register menus with each other
cartMenu.registerOtherMenu(accountMenu);
cartMenu.registerOtherMenu(hamburgerMenu);
accountMenu.registerOtherMenu(cartMenu);
accountMenu.registerOtherMenu(hamburgerMenu);
hamburgerMenu.registerOtherMenu(accountMenu);
hamburgerMenu.registerOtherMenu(cartMenu);

// Add click listeners
// TODO: Pressing on the dropdown menu of the element causes it to also me toggled, must fix.
cartMenu.parentElement.addEventListener('click', (e) => {
    e.stopPropagation();
    cartMenu.toggle();
});

accountMenu.parentElement.addEventListener('click', (e) => {
    e.stopPropagation();
    accountMenu.toggle();
});

hamburgerMenu.parentElement.addEventListener("click", (e) => {
    e.stopPropagation();
    hamburgerMenu.toggle();
})
// Close dropdown menus when clicking outside
document.body.addEventListener('click', () => {
    console.log("propagation");
    if (cartMenu.isOpen) {
        cartMenu.hide();
    }

    if (accountMenu.isOpen) {
        accountMenu.hide();
    }
});
