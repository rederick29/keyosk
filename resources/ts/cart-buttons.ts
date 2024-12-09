let cart_quantities = new Map<number, number>();

const enum CartUpdateAction {
    Increase = 'increase',
    Decrease = 'decrease',
    Remove = 'remove',
    Add = 'add',
}

class CartItem {
    id: number;
    form: HTMLFormElement;
    action: HTMLInputElement;
    deltaQuantity: HTMLInputElement;
    quantityInput: HTMLInputElement;

    constructor(id: number, action: HTMLInputElement, deltaQuantity: HTMLInputElement, quantityInput: HTMLInputElement, form: HTMLFormElement) {
        if (action == null || deltaQuantity == null || quantityInput == null || form == null) {
            throw new Error(`Invalid cart product: ${id}`);
        } else {
            this.id = id;
            this.form = form as HTMLFormElement;
            this.action = action as HTMLInputElement;
            this.deltaQuantity = deltaQuantity as HTMLInputElement;
            this.quantityInput = quantityInput as HTMLInputElement;
        }
    }

    decreaseQuantity(): void {
        this.action.value = CartUpdateAction.Decrease;
        this.deltaQuantity.value = String(1);
        this.quantityInput.value = String(Number(this.quantityInput.value) - 1);
    }

    increaseQuantity(): void {
        this.action.value = CartUpdateAction.Increase;
        this.deltaQuantity.value = String(1);
        this.quantityInput.value = String(Number(this.quantityInput.value) + 1);
    }

    setQuantity(): void {
        const oldValue = cart_quantities.get(Number(this.id));
        if (oldValue === undefined) {
            throw new Error(`Initial value of cart item ${this.id} not found`);
        }

        const newValue = Number(this.quantityInput.value);
        const change = newValue - oldValue;
        if (change === 0) {
            console.log(`No change in quantity for cart item ${this.id}`);
            return;
        }

        this.action.value = change > 0 ? CartUpdateAction.Increase : CartUpdateAction.Decrease;
        this.deltaQuantity.value = String(Math.abs(change));
        cart_quantities.set(this.id, newValue);
    }

    removeItem(): void {
        console.log(`Removing cart item ${this.id}`);
        this.action.value = CartUpdateAction.Remove;
    }

    submit(): void {
        this.form.submit();
    }
}

class CartItemViews {
    cartItems: CartItem[];

    constructor()
    {
        this.cartItems = [];
    }

    push(item: CartItem): void {
        this.cartItems.push(item);
    }

    submit(): void {
        const item = this.cartItems.at(0);
        if (item === undefined) return;
        item.submit();
    }

    forEach(callback: (elem: CartItem) => void): void {
        this.cartItems.forEach(callback);
    }
}

function decreaseCartQuantity(items: CartItemViews): void {
    items.forEach((product) => product.decreaseQuantity());
    items.submit();
}

function increaseCartQuantity(items: CartItemViews): void {
    items.forEach((product) => product.increaseQuantity());
    items.submit();
}

function setCartQuantity(items: CartItemViews): void {
    items.forEach((product) => product.setQuantity());
    items.submit();
}

function removeCartItem(items: CartItemViews): void {
    items.forEach((product) => product.removeItem());
    items.submit();
}

export function setInitialQuantity(id: string, quantity: string): void {
    cart_quantities.set(Number(id), Number(quantity));
}

export function addCartButtonListeners(productId: number): void {
    // Function to add event listeners if not already added
    const addEventListenerIfNotExists = (element: Element, event: any, handler: () => any) => {
        if (element && !element.hasAttribute('data-listener')) {
            element.addEventListener(event, handler);
            element.setAttribute('data-listener', 'true');
        }
    };

    // Select elements by their dynamic IDs
    let items = new CartItemViews();
    let forms = Array.from(document.getElementsByClassName(`cart-${productId}`));

    forms.forEach((form) => {
        // SAFETY: [0] will never be null because we're in a form that will have the elements required
        let quantityInput = form.getElementsByClassName(`cart_quantity_input-${productId}`)[0] as HTMLInputElement;
        let decreaseButton = form.getElementsByClassName(`cart_decrease-${productId}`)[0] as HTMLInputElement;
        let increaseButton = form.getElementsByClassName(`cart_increase-${productId}`)[0] as HTMLInputElement;
        let removeButton = form.getElementsByClassName(`cart_remove-${productId}`)[0] as HTMLInputElement;
        let deltaQuantity = form.getElementsByClassName(`cart_quantity-${productId}`)[0] as HTMLInputElement;
        let action = form.getElementsByClassName(`cart_action-${productId}`)[0] as HTMLInputElement;

        items.push(new CartItem(productId, action, deltaQuantity, quantityInput, form as HTMLFormElement));

        // Add event listeners for buttons, if elements exist
        addEventListenerIfNotExists(quantityInput, 'change', () => setCartQuantity(items));
        addEventListenerIfNotExists(decreaseButton, 'click', () => decreaseCartQuantity(items));
        addEventListenerIfNotExists(increaseButton, 'click', () => increaseCartQuantity(items));
        addEventListenerIfNotExists(removeButton, 'click', () => removeCartItem(items));
    })
}
