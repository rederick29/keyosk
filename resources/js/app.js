import './bootstrap';

// This is for 'npm run build' so vite can find the images, helps with caching.
import.meta.glob([
    '../images/**'
]);

console.log("Connection");

class MenuItem {
    parent;
    childDropdown;
    toggle = false;

    constructor(parent, childDropdown) {
        this.parent = document.getElementById(parent);
        this.childDropdown = document.getElementById(childDropdown);
        this.toggle = false;
    }

    getParent() {
        return this.parent;
    }

    getChildDropdown() {
        return this.childDropdown;
    }

    getToggle() {
        return this.toggle;
    }

    handleInteraction() {
        if(this.getToggle()) {
            this.hideChildDropdownMenu()
        }
        else {
            this.showChildDropdownMenu()
        }
    }

    showChildDropdownMenu() {
        this.parent.classList.add("bg-white/5", "ring-2")
        this.childDropdown.classList.remove('dropdown-hide-desktop');
        this.childDropdown.classList.add('dropdown-display-desktop');
        // bridge.classList.remove("hidden")
        this.toggle = true;
    }

    hideChildDropdownMenu() {
        this.parent.classList.remove("bg-white/5", "ring-2")
        this.childDropdown.classList.remove('dropdown-display-desktop');
        this.childDropdown.classList.add('dropdown-hide-desktop');
        this.toggle = false;
    }
}

let cartMenu = new MenuItem('cart-icon', 'cart-dropdown');
let accountMenu = new MenuItem('account-icon', 'account-dropdown');

cartMenu.getParent().addEventListener("click", function(e) {
    console.log("cart menu");
    cartMenu.handleInteraction();

    e.stopPropagation();
});

// duplication will be changed later when fixed for hover.
accountMenu.getParent().addEventListener("click", function(e) {
    console.log("account menu");
    accountMenu.handleInteraction();

    e.stopPropagation();
});

document.body.addEventListener("click", function() {
    console.log("body (propagation)")

    handleDocumentBodyClick(accountMenu);
    handleDocumentBodyClick(cartMenu);
});

const handleDocumentBodyClick = (menuItem) => {
    if(menuItem.getToggle()) {
        menuItem.hideChildDropdownMenu();
    }
}
