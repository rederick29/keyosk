// this kinda sucks but what can I do if tailwind won't work correctly
const openCss = "block md:block lg:block bg-stone-100 dark:bg-zinc-800".split(' ');
const closedCss = "scale-0 border-2 border-neutral-400 bg-white dark:bg-zinc-900 rounded".split(' ');

export class DropdownMenu {
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
        this.parentElement = document.getElementById(parentId)!;
        if (!this.parentElement) {
            throw new Error(`Parent element with ID ${parentId} not found`);
        }

        this.dropdownElement = document.getElementById(dropdownId)!;
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
        this.act();
    }

    /*
     */
    act(): void {
        this.parentElement.classList.toggle('dark:bg-white/5');
        this.parentElement.classList.toggle('bg-black/5');
        this.parentElement.classList.toggle('[&>.arrow]:rotate-180')
        this.parentElement.classList.toggle('ring-2');
        this.toggleCssStyle();
        this.isOpen = !this.isOpen;
    }

    toggleCssStyle(): void {
        if (this.isOpen) {
            openCss.forEach((s) => this.dropdownElement.classList.remove(s));
            closedCss.forEach((s) => this.dropdownElement.classList.add(s));
        } else {
            closedCss.forEach((s) => this.dropdownElement.classList.remove(s));
            openCss.forEach((s) => this.dropdownElement.classList.add(s));
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
                menu.act();
            }
        });
    }
}

export function setupMenus(menus: [DropdownMenu, boolean][]): void {
    // Initialize dropdown menus
    menus.forEach(([menu, closeOnOutsideClick]): void => {
        menus
            .filter(([other_menu, _]) => menu !== other_menu)
            .forEach(([other_menu, _]) => menu.registerOtherMenu(other_menu));

        menu.parentElement.addEventListener('click', (e: Event): void => {
            e.stopPropagation();
            menu.toggle();
        })

        menu.dropdownElement.addEventListener('click', (e: Event) => e.stopPropagation());

        // Close dropdown menus when clicking outside
        if (closeOnOutsideClick) {
            document.body.addEventListener('click', (_) => { if (menu.isOpen) menu.act() });
        }
    });
}
