let cart_quantities = new Map<number, number>();

export function setInitialQuantity(id: string, quantity: string): void {
    cart_quantities.set(Number(id), Number(quantity));
}

const enum CartUpdateAction
{
    Increase = 'increase',
    Decrease = 'decrease',
    Remove = 'remove',
    Add = 'add',
}

class CartItem
{
    id: number;
    form: HTMLFormElement;
    action: HTMLInputElement;
    deltaQuantity: HTMLInputElement;
    quantityInput: HTMLInputElement;

    constructor(id: number) {
        const action = document.getElementById("cart_action-" + id);
        const deltaQuantity = document.getElementById("cart_quantity-" + id);
        const quantityInput = document.getElementById("cart_quantity_input-" + id);
        const form = document.getElementById("cart-" + id);

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

    decreaseQuantity(): void
    {
        this.action.value = CartUpdateAction.Decrease;
        this.deltaQuantity.value = String(1);
        this.quantityInput.value = String(Number(this.quantityInput.value) - 1);
        this.form.submit();
    }

    increaseQuantity(): void
    {
        this.action.value = CartUpdateAction.Increase;
        this.deltaQuantity.value = String(1);
        this.quantityInput.value = String(Number(this.quantityInput.value) + 1);
        this.form.submit();
    }

    setQuantity(): void
    {
        const oldValue = cart_quantities.get(this.id);
        if (oldValue == undefined) {
            throw new Error(`Initial value of cart item ${this.id} not found`);
        }
        const change = Number(this.quantityInput.value) - oldValue;
        if (change > 0) {
            this.action.value = CartUpdateAction.Increase;
        } else if (change < 0) {
            this.action.value = CartUpdateAction.Decrease;
        } else {
            return;
        }
        cart_quantities.set(this.id, Number(this.quantityInput.value));
        this.deltaQuantity.value = String(change);
        this.form.submit();
    }

    removeItem(): void
    {
        this.action.value = CartUpdateAction.Remove;
        this.form.submit();
    }
}

export function decreaseCartQuantity(id: number): void
{
    let product = new CartItem(id);
    product.decreaseQuantity();
}

export function increaseCartQuantity(id: number): void
{
    let product = new CartItem(id);
    product.increaseQuantity();
}

export function setCartQuantity(id: number): void
{
    let product = new CartItem(id);
    product.setQuantity();
}

export function removeCartItem(id: number): void
{
    let product = new CartItem(id);
    product.removeItem();
}
