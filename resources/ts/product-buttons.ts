import {CustomWindow} from "@ts/utils.ts";
import {CartUpdateAction, updateCart} from "@ts/cart-buttons.ts";

declare let window: CustomWindow;
export function setupProductButtons(id: number) {
    const input = document.querySelector<HTMLInputElement>(`#quantity-${id}`)!;
    const form = document.querySelector<HTMLFormElement>(`#product-buy-form-${id}`)!;

    input.addEventListener('input', function() {
        this.value = this.value.replace(/[^1-9]/g, '');
        if (this.value === '' || parseInt(this.value) < 1 || parseInt(this.value) > 99) {
            this.value = String(0);
        }
    });

    input.addEventListener('keydown', function(event) {
        if (event.keyCode === 38 || event.keyCode === 40) {
            event.preventDefault();
        }
    });

    // + and -
    document.getElementById(`decrease-quantity-${id}`)!.addEventListener('click', function() {
        let qtyInput = document.querySelector<HTMLInputElement>(`#quantity-${id}`)!;
        let currentQty = parseInt(qtyInput.value);
        if (currentQty > 1) {
            qtyInput.value = String(currentQty - 1);
        }
    });

    document.getElementById(`increase-quantity-${id}`)!.addEventListener('click', function() {
        let qtyInput = document.querySelector<HTMLInputElement>(`#quantity-${id}`)!;
        let currentQty = parseInt(qtyInput.value);
        qtyInput.value = String(currentQty + 1);
    });

    document.querySelectorAll(`.add-to-cart-btn-${id}, .buy-now-btn-${id}`).forEach((element) =>
        element.addEventListener('click', function (event) {
                event.preventDefault();
                event.stopPropagation();
                const data = new FormData(form);
                updateCart(data.get('cart_action')! as CartUpdateAction, parseInt(data.get('product_id')!.toString()), parseInt(data.get('quantity')!.toString()));
            }
        ));
}

window.setupProductButtons = setupProductButtons;
