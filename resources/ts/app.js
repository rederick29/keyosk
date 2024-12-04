"use strict";
class DropdownMenu {
    parentElement;
    dropdownElement;
    isOpen;
    otherMenus;
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
        this.act();
    }
    /*
     */
    act() {
        this.parentElement.classList.toggle('bg-white/5');
        this.parentElement.classList.toggle('ring-2');
        this.dropdownElement.classList.toggle('dropdown-hide');
        this.dropdownElement.classList.toggle('dropdown-display');
        this.isOpen = !this.isOpen;
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
        this.otherMenus.forEach((menu) => {
            if (menu !== this && menu.isOpen) {
                menu.act();
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
if (cartMenu.parentElement) {
    cartMenu.parentElement.addEventListener('click', (e) => {
        console.log("Cart menu toggle");
        e.stopPropagation();
        cartMenu.toggle();
    });
}
else {
    throw new Error("CartMenu Parent Element is null");
}
// Get the dropdown element of the menu and stop propagation
if (cartMenu.dropdownElement) {
    cartMenu.dropdownElement.addEventListener('click', (e) => {
        e.stopPropagation();
    });
}
else {
    throw new Error("CartMenu Dropdown Element is null");
}
if (accountMenu.parentElement) {
    accountMenu.parentElement.addEventListener('click', (e) => {
        e.stopPropagation();
        accountMenu.toggle();
    });
}
else {
    throw new Error("AccountMenu Parent Element is null");
}
if (accountMenu.dropdownElement) {
    accountMenu.dropdownElement.addEventListener('click', (e) => {
        e.stopPropagation();
    });
}
else {
    throw new Error("AccountMenu Dropdown Element is null");
}
if (hamburgerMenu.parentElement) {
    hamburgerMenu.parentElement.addEventListener("click", (e) => {
        e.stopPropagation();
        hamburgerMenu.toggle();
    });
}
else {
    throw new Error("HamburgerMenu Parent Element is null");
}
if (hamburgerMenu.dropdownElement) {
    hamburgerMenu.dropdownElement.addEventListener("click", (e) => {
        e.stopPropagation();
    });
}
else {
    throw new Error("HamburgerMenu Dropdown Element is null");
}
// Close dropdown menus when clicking outside
document.body.addEventListener('click', (e) => {
    if (cartMenu.isOpen) {
        cartMenu.act();
    }
    if (accountMenu.isOpen) {
        accountMenu.act();
    }
});
