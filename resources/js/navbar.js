import { DropdownMenu, setupMenus } from "../ts/dropdown-menu.ts";

setupMenus([
    [new DropdownMenu('cart-icon', 'cart-dropdown'), true],
    [new DropdownMenu('account-icon', 'account-dropdown'), true],
    [new DropdownMenu('hamburger', 'hamburger-dropdown'), false],
    [new DropdownMenu('shop', 'shop-dropdown'), true]
]);
