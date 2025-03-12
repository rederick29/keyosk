import { CustomWindow, handle_response, SimpleResponse } from "@ts/utils.ts";
// TODO: rewrite this entire file

declare let window: CustomWindow;
let gCartQuantities = new Map<number, number>();

export const enum CartUpdateAction {
    Increase = 'increase',
    Decrease = 'decrease',
    Remove = 'remove',
    Add = 'add',
}

class CartItem {
    // current item identifiers
    id: number;
    component: HTMLElement;

    // data to send in post request
    fake_action: CartUpdateAction | null;
    fake_dQuantity: number;
    fake_quantityInput: number;
    // marker if a change has been made
    dirty: boolean;

    // elements to update if response is ok
    form: HTMLFormElement;
    action: HTMLInputElement;
    deltaQuantity: HTMLInputElement;
    quantityInput: HTMLInputElement;

    constructor(id: number, component: HTMLDivElement, action: HTMLInputElement, deltaQuantity: HTMLInputElement, quantityInput: HTMLInputElement, form: HTMLFormElement) {
        if (!action || !deltaQuantity || !quantityInput || !form) {
            throw new Error(`Invalid cart product: ${id}`);
        }

        this.id = id;
        this.component = component;
        this.form = form;
        this.action = action;
        this.deltaQuantity = deltaQuantity;
        this.quantityInput = quantityInput;

        this.fake_action = null;
        this.fake_dQuantity = 0;
        this.fake_quantityInput = Number(this.quantityInput.value);
        this.dirty = false;
    }

    resetFake(): void {
        if (!this.dirty) return;
        this.fake_action = null;
        this.fake_dQuantity = 0;
        this.fake_quantityInput = Number(this.quantityInput.value);
        this.dirty = false;
    }

    setDataOnDelta(change: number): void {
        if (this.dirty) return;
        this.fake_action = change > 0 ? CartUpdateAction.Increase : CartUpdateAction.Decrease;
        this.fake_dQuantity = Math.abs(change);
        this.fake_quantityInput = Number(this.fake_quantityInput) + change;
        // if we're going to have 0 quantity after the change, we remove the item
        if (this.fake_quantityInput === 0) {
            this.fake_action = CartUpdateAction.Remove;
        }
        this.dirty = true;
    }

    decreaseQuantity(): void {
        this.setDataOnDelta(-1);
    }

    increaseQuantity(): void {
        this.setDataOnDelta(1);
    }

    setQuantity(newValue: number): void {
        if (this.dirty) return;
        const oldValue = this.fake_quantityInput;
        if (oldValue === undefined) {
            throw new Error(`Initial value of cart item ${this.id} not found`);
        }

        const change = newValue - oldValue;
        if (change === 0) {
            console.log(`No change in quantity for cart item ${this.id}`);
            return;
        }

        this.setDataOnDelta(change);
        this.dirty = true;
    }

    removeItem(): void {
        if (this.dirty) return;
        this.fake_action = CartUpdateAction.Remove;
        this.fake_quantityInput = 0;
        this.dirty = true;
    }

    save(): void {
        if (!this.dirty) return;
        if (this.fake_action === CartUpdateAction.Remove) {
            this.component.remove();
            gCartQuantities.delete(Number(this.id));
        } else {
            this.action.value = this.fake_action!;
            this.deltaQuantity.value = String(this.fake_dQuantity);
            this.quantityInput.value = String(this.fake_quantityInput);
            gCartQuantities.set(this.id, this.fake_quantityInput);
        }
        this.resetFake();
    }

    async submit(): Promise<boolean> {
        if (!this.dirty) return false;
        let ret: boolean | SimpleResponse = false;
        let data = {
            cart_action: this.fake_action!.toString(),
            product_id: this.id,
            quantity: this.fake_action! != CartUpdateAction.Remove ? this.fake_dQuantity : null,
        }
        await window.axios.post<SimpleResponse>(this.form.action, data)
            .then(response => {
                let ret2 = handle_response(response);
                // how cooked is this
                if (typeof ret2 != "boolean") {
                    ret = true;
                } else {
                    ret = ret2;
                }
            })
            .catch(error => console.log(error));
        return ret;
    }
}

class CartItemViews {
    cartItems: CartItem[] = [];

    push(item: CartItem): void {
        this.cartItems.push(item);
    }

    submit(): Promise<boolean> | undefined {
        return this.cartItems[0]?.submit();
    }

    pendingAction(): CartUpdateAction | undefined {
        if (!this.cartItems[0]?.dirty) return undefined;
        return this.cartItems[0]?.fake_action!;
    }

    pendingQuantity(): number | undefined {
        if (!this.cartItems[0]?.dirty) return undefined;
        return this.cartItems[0]?.fake_quantityInput;
    }

    id(): number {
        return this.cartItems[0]?.id;
    }

    setQuantity() {
        // if one input was updated, change the rest as well
        let resetValue = gCartQuantities.get(this.id())!;
        let update_input = -1;

        this.forEach((product) => {
            let newValue = Number(product.quantityInput.value);
            let change = resetValue - newValue;
            if (change != 0) {
                update_input = newValue;
            }
        });

        if (update_input !== -1) {
            this.forEach((product) => {
                product.setQuantity(update_input);
            });
        }
    }

    forEach(callback: (elem: CartItem) => void): void {
        this.cartItems.forEach(callback);
    }

    any(callback: (elem: CartItem) => boolean): boolean {
        for (let i = 0; i < this.cartItems.length; i++) {
            if (callback(this.cartItems[i])) { return true; }
        }
        return false;
    }

    all(callback: (elem: CartItem) => boolean): boolean {
        return !this.cartItems.map((item) => { return callback(item); }).includes(false);
    }
}

async function updateCartItemView(items: CartItemViews): Promise<void> {
    const updateSummaryPrice = () => {
        let product_price = document.querySelector(`.cart-item-price-${items.id()}`);
        let summary_price = document.querySelector('.cart-subtotal-price');
        let summary_quantity = document.querySelector(`.summary-product-${items.id()} .summary-product-quantity`);
        if (product_price && summary_quantity && summary_price) {
            let deltaQuantity = items.pendingQuantity()! - parseInt(summary_quantity.textContent!);
            let deltaPrice = deltaQuantity * parseFloat(product_price.textContent!);
            summary_price.textContent = String((parseFloat(summary_price.textContent!) + deltaPrice).toFixed(2));
        }
    }

    const status = await items.submit();
    if (status === true) {
        if (items.pendingAction() === CartUpdateAction.Remove) {
            // update total items count
            let total_in_cart = document.querySelectorAll('.cart-total-quantity-count');
            total_in_cart.forEach((elem) => {
                elem.textContent = String(parseInt(elem.textContent!) - 1);
            })

            updateSummaryPrice();
            // remove from cart summary
            let summary_entry = document.querySelectorAll(`.summary-product-${items.id()}`);
            summary_entry.forEach((elem) => {
                elem.remove();
            })
        } else if (items.pendingAction() === CartUpdateAction.Increase || items.pendingAction() === CartUpdateAction.Decrease) {
            // update quantity and price in cart summary
            updateSummaryPrice();
            let summary_entry = document.querySelectorAll(`.summary-product-${items.id()}`);
            summary_entry.forEach((elem) => {
                let summary_quantity = elem.querySelector('.summary-product-quantity')!;
                summary_quantity.textContent = String(items.pendingQuantity());
            })
        }

        items.forEach((product) => product.save());
    } else {
        if (items.any((p) => p.fake_quantityInput !== Number(p.quantityInput.value))) {
            items.forEach((product) => product.quantityInput.value = String(gCartQuantities.get(Number(items.id()))!));
        }
        items.forEach((product) => product.resetFake());
    }
}
function decreaseCartQuantity(items: CartItemViews): void {
    items.forEach((product) => product.decreaseQuantity());
    updateCartItemView(items);
}

function increaseCartQuantity(items: CartItemViews): void {
    items.forEach((product) => product.increaseQuantity());
    updateCartItemView(items);
}

function setCartQuantity(items: CartItemViews): void {
    items.setQuantity();
    updateCartItemView(items);
}

function removeCartItem(items: CartItemViews): void {
    items.forEach((product) => product.removeItem());
    updateCartItemView(items);
}

export function setInitialQuantity(id: string, quantity: string): void {
    gCartQuantities.set(Number(id), Number(quantity));
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
    let productComponents = document.querySelectorAll<HTMLDivElement>(`.cart-item-${productId}`);

    productComponents.forEach((productComponent) => {
        let form = productComponent.querySelector<HTMLFormElement>(`.cart-form-${productId}`)!;
        let quantityInput = form.querySelector<HTMLInputElement>(`.cart_quantity_input-${productId}`)!;
        let decreaseButton = form.querySelector<HTMLInputElement>(`.cart_decrease-${productId}`)!;
        let increaseButton = form.querySelector<HTMLInputElement>(`.cart_increase-${productId}`)!;
        let removeButton = form.querySelector<HTMLInputElement>(`.cart_remove-${productId}`)!;
        let deltaQuantity = form.querySelector<HTMLInputElement>(`.cart_quantity-${productId}`)!;
        let action = form.querySelector<HTMLInputElement>(`.cart_action-${productId}`)!;

        items.push(new CartItem(productId, productComponent, action, deltaQuantity, quantityInput, form));

        // Add event listeners for buttons, if elements exist
        addEventListenerIfNotExists(quantityInput, 'change', () => setCartQuantity(items));
        addEventListenerIfNotExists(decreaseButton, 'click', () => decreaseCartQuantity(items));
        addEventListenerIfNotExists(increaseButton, 'click', () => increaseCartQuantity(items));
        addEventListenerIfNotExists(removeButton, 'click', () => removeCartItem(items));
    })
}

export async function updateCart(cart_action: CartUpdateAction, productId: number, quantity: number | null): Promise<void> {
    let productComponents = document.querySelectorAll<HTMLDivElement>(`.cart-item-${productId}`);
    let items = new CartItemViews();
    productComponents.forEach((productComponent) => {
        let form = productComponent.querySelector<HTMLFormElement>(`.cart-form-${productId}`)!;
        let quantityInput = form.querySelector<HTMLInputElement>(`.cart_quantity_input-${productId}`)!;
        let deltaQuantity = form.querySelector<HTMLInputElement>(`.cart_quantity-${productId}`)!;
        let action = form.querySelector<HTMLInputElement>(`.cart_action-${productId}`)!;
        let stockError = productComponent.querySelectorAll<HTMLParagraphElement>(`.product-stock-error`);
        const cart = new CartItem(productId, productComponent, action, deltaQuantity, quantityInput, form)!;

        switch (cart_action) {
            case CartUpdateAction.Increase:
            case CartUpdateAction.Decrease:
                // TODO: when decreasing a product with a stock error, check if the new quantity OK
            case CartUpdateAction.Add:
                if (quantity === null) {
                    throw new TypeError("Quantity is required.");
                }
                cart.setDataOnDelta(quantity);
                break;
            case CartUpdateAction.Remove:
                cart.removeItem();
                // TODO: replace warning with checkout button instead of refreshing
                if (stockError.length > 0) {
                    window.location.reload();
                }
                break;
        }
        items.push(cart);
    });
    updateCartItemView(items);

    // in the case we are adding a new item to the cart, the form and all other elements won't exist already
    if (productComponents.length === 0 && (cart_action === CartUpdateAction.Add || cart_action === CartUpdateAction.Increase)) {
        if (quantity === null) {
            throw new TypeError("Quantity is required.");
        } else if (quantity < 1) {
            throw new Error("Quantity needs to be greater than 0.");
        }

        await window.axios
            .post<SimpleResponse>(window.location.origin + "/cart/update",
                { cart_action: cart_action, quantity: quantity, product_id: productId },
                {
                    adapter: "fetch",
                }
            )
            .then(response => handle_response(response))
            .catch(error => console.error(error));

        // TODO: get the required html for the new cart items from the server and add it in the correct places
        // for now, just reload the whole page and let the server render it
        window.location.reload();
    } else if (productComponents.length === 0) {
        throw new TypeError("This item is not present in the cart.");
    }
}
