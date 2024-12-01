
console.log("Connection: TS");

class DropdownMenu {
    parentElement: HTMLElement;
    dropdownElement: HTMLElement;
    isOpen: boolean;
    otherMenus: DropdownMenu[];

    /*
     * Create a new dropdown menu
     * param parentId: ID of the parent element that will open the dropdown
     * param dropdownId: ID of the dropdown element to show/hide
     * throws Error if parent or dropdown elements are not found
     */
    constructor(parentId: string, dropdownId: string) {
        this.parentElement = document.getElementById(parentId) as HTMLElement;
        if (!this.parentElement) {
            throw new Error(`Parent element with ID ${parentId} not found`);
        }

        this.dropdownElement = document.getElementById(dropdownId) as HTMLElement;
        if (!this.dropdownElement) {
            throw new Error(`Dropdown element with ID ${dropdownId} not found`);
        }

        this.isOpen = false;
        this.otherMenus = [];
    }

    /*
     * Toggle the dropdown menu open or closed
     */
    toggle(): void {
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
    show(): void {
        // If the menu is already open, don't do anything
        if (this.isOpen) {
            return;
        }

        if(this.parentElement && this.dropdownElement) {
            this.parentElement.classList.add('bg-white/5', 'ring-2');
            this.dropdownElement.classList.remove('dropdown-hide');
            this.dropdownElement.classList.add('dropdown-display');
            this.isOpen = true;
        }
        else {
            throw new Error("Parent or Dropdown element is null")
        }
    }

    /*
     * Close the dropdown menu
     */
    hide(): void {
        // If the menu is already closed, don't do anything
        if (!this.isOpen) {
            return;
        }

        if(this.parentElement && this.dropdownElement) {
            this.parentElement.classList.remove('bg-white/5', 'ring-2');
            this.dropdownElement.classList.remove('dropdown-display');
            this.dropdownElement.classList.add('dropdown-hide');
            this.isOpen = false;
        }
        else {
            throw new Error("Parent or Dropdown element is null")
        }
    }

    /*
     * Register another menu to close when this one is opened
     */
    registerOtherMenu(menu: DropdownMenu): void {
        this.otherMenus.push(menu);
    }

    /*
     * Close other menus when opening this one
     */
    closeOtherMenus(): void {
        this.otherMenus.forEach((menu: DropdownMenu): void => {
            if (menu !== this && menu.isOpen) {
                menu.hide();
            }
        });
    }
}

// Initialize dropdown menus
const cartMenu: DropdownMenu = new DropdownMenu('cart-icon', 'cart-dropdown');
const accountMenu: DropdownMenu = new DropdownMenu('account-icon', 'account-dropdown');
const hamburgerMenu: DropdownMenu = new DropdownMenu('hamburger', 'hamburger-dropdown');

// Register menus with each other
cartMenu.registerOtherMenu(accountMenu);
cartMenu.registerOtherMenu(hamburgerMenu);
accountMenu.registerOtherMenu(cartMenu);
accountMenu.registerOtherMenu(hamburgerMenu);
hamburgerMenu.registerOtherMenu(accountMenu);
hamburgerMenu.registerOtherMenu(cartMenu);

// Add click listeners
// TODO: Pressing on the dropdown menu of the element causes it to also me toggled, must fix.
if(cartMenu.parentElement) {
    cartMenu.parentElement.addEventListener('click', (e: Event): void => {
        e.stopPropagation();
        cartMenu.toggle();
    });
}
else {
    throw new Error("CartMenu Parent Element is null");
}

if(accountMenu.parentElement) {
    accountMenu.parentElement.addEventListener('click', (e: Event): void => {
        e.stopPropagation();
        accountMenu.toggle();
    });
}
else {
    throw new Error("AccountMenu Parent Element is null");
}

if(hamburgerMenu.parentElement) {
    hamburgerMenu.parentElement.addEventListener("click", (e): void => {
        e.stopPropagation();
        hamburgerMenu.toggle();
    })
}
else {
    throw new Error("HamburgerMenu Parent Element is null");
}

// Close dropdown menus when clicking outside
document.body.addEventListener('click', (): void => {
    console.log("propagation");

    if (cartMenu.isOpen) {
        cartMenu.hide();
    }

    if (accountMenu.isOpen) {
        accountMenu.hide();
    }
});
