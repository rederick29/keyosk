import {make_request, SimpleRequest, SimpleResponse} from "@ts/utils.ts";

interface CheckoutRequest extends SimpleRequest {
    address: Address | null;
    contact: {
        first_name: string;
        last_name: string;
        email: string;
    } | null;
    save_address: boolean;
    address_id: number | null;
    card: {
        number: number;
        name: string;
        expiry: number;
        cvv: number;
    };
    discount_code: string;
}

interface Address {
    name: string;
    line_one: string;
    line_two: string;
    city: string;
    postcode: string;
    country: string;
}

document.addEventListener('DOMContentLoaded', () => {
    const checkoutButtons = document.querySelectorAll('[data-checkout-button]');
    const form = document.querySelector<HTMLFormElement>('#checkout-form');
    if (form === null) {
        console.log("Added event listener but missing checkout form!");
        return;
    }

    checkoutButtons.forEach(button => {
        button.addEventListener('click', async (event) => {
            const firstName = form.querySelector<HTMLInputElement>('#first_name')!.value.trim();
            const lastName = form.querySelector<HTMLInputElement>('#last_name')!.value.trim();
            const email = form.querySelector<HTMLInputElement>('#email')!.value.trim();
            const address_id = form.querySelector<HTMLInputElement>('#addressId')!.value;
            let address_db_used = false;
            let address_name = form.querySelector<HTMLInputElement>('#address_name')?.value;
            const address_line_one = form.querySelector<HTMLInputElement>('#address1')!.value.trim();
            const address_line_two = form.querySelector<HTMLInputElement>('#address2')!.value.trim();
            const address_city = form.querySelector<HTMLInputElement>('#city')!.value.trim();
            const address_postcode = form.querySelector<HTMLInputElement>('#postcode')!.value.trim();
            const address_country = form.querySelector<HTMLSelectElement>('#country')!.value.trim();
            let save_address = form.querySelector<HTMLInputElement>('#save_address')?.checked;
            const card_holder_name= form.querySelector<HTMLInputElement>('#card_holder_name')!.value.trim();
            const card_number = form.querySelector<HTMLInputElement>('#card_number')!.value.trim();
            const expiry_date = form.querySelector<HTMLInputElement>('#expiry_date')!.value.trim();
            const cvv = form.querySelector<HTMLInputElement>('#cvv')!.value.trim();
            const discount_code = document.querySelector<HTMLInputElement>('#discount_code')!.value.trim();

            if (Number(address_id) !== -1) {
                address_db_used = true;
            }

            if (!address_name || !(address_name.trim())) {
                address_name = undefined;
            } else {
                address_name.trim();
            }

            if (!save_address) {
                save_address = false;
            }

            event.preventDefault();
            const currentButton = event.currentTarget as HTMLButtonElement;
            currentButton.disabled = true;

            const contact = { first_name: firstName, last_name: lastName, email: email };
            const address = {
                name: address_name ?? firstName + " " + lastName,
                line_one: address_line_one,
                line_two: address_line_two,  // optional
                city: address_city,
                postcode: address_postcode,
                country: address_country,
            };
            const card = {
                name: card_holder_name,
                number: Number(card_number),
                expiry: Number(expiry_date.replace(/\D/g,'')),
                cvv: Number(cvv),
            };

            if (await make_request<CheckoutRequest, SimpleResponse>({
                address: address,
                contact: contact,
                save_address: save_address,
                address_id: address_db_used ? Number(address_id) : null,
                card: card,
                discount_code: discount_code,
            }, '/checkout') === false) {
                currentButton.disabled = false;
            } else {
                window.location.href = '/orders';
            }
        });
    });
});
