import { addCartButtonListeners, setInitialQuantity } from '../ts/cart-buttons.ts'

export function setupCartButtons(id, quantity) {
    if (quantity !== null) setInitialQuantity(id, quantity);
    if (id !== null) addCartButtonListeners(id);
}

window.setupCartButtons = setupCartButtons;
