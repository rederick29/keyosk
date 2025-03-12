import {make_request, SimpleRequest, SimpleResponse} from "@ts/utils.ts";

interface AddressRequest extends SimpleRequest {
    priority: number;
}

interface AddressResponse extends SimpleResponse {
    address: Address | undefined;
}

interface CheckoutRequest extends SimpleRequest {
    address: Address | undefined;
    contact: {
        first_name: string;
        last_name: string;
        email: string;
    } | undefined;
    save_address: boolean;
    address_id: number | undefined;
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
    const addressButtons = form.querySelectorAll<HTMLInputElement>('.address-button');

    const enableInputs = (inputs: Array<HTMLInputElement | HTMLSelectElement>) => {
        for (let input of inputs) {
            input.removeAttribute('disabled');
            input.removeAttribute('readonly');
        }
    };

    const disableInputs = (inputs: Array<HTMLInputElement | HTMLSelectElement>) => {
        for (let input of inputs) {
            input.setAttribute('disabled', '');
            input.setAttribute('readonly', '');
        }
    };

    addressButtons.forEach(button => {
        button.addEventListener('click', async (_) => {
            const address_priority = Number(button.value);
            let address_id = form.querySelector<HTMLInputElement>('#addressId')!;
            let address_name = form.querySelector<HTMLInputElement>('#address_name')!;
            let address_line_one = form.querySelector<HTMLInputElement>('#address1')!;
            let address_line_two = form.querySelector<HTMLInputElement>('#address2')!;
            let address_city = form.querySelector<HTMLInputElement>('#city')!;
            let address_postcode = form.querySelector<HTMLInputElement>('#postcode')!;
            let address_country = form.querySelector<HTMLSelectElement>('#country')!;
            let save_address = form.querySelector<HTMLInputElement>('#save_address')!;

            if (address_priority < 0) {
                address_name.value = '';
                address_line_one.value = '';
                address_line_two.value = '';
                address_city.value = '';
                address_postcode.value = '';
                address_country.value = '';
                save_address.style.visibility = 'visible';
                save_address.labels!.forEach(label => label.style.visibility = 'visible');
                save_address.checked = false;

                enableInputs([address_name, address_line_one, address_line_two, address_city, address_postcode, address_country, save_address]);
                address_id.value = String(address_priority);
                return;
            }

            let ret = await make_request<AddressRequest, AddressResponse>({priority: address_priority}, '/api/v1/address');
            if (typeof ret === 'boolean') {
                return;
            }

            address_name.value = ret.address!.name;
            address_line_one.value = ret.address!.line_one;
            address_line_two.value = ret.address!.line_two;
            address_city.value = ret.address!.city;
            address_postcode.value = ret.address!.postcode;
            address_country.value = ret.address!.country;
            save_address.checked = false;
            save_address.style.visibility = 'hidden';
            save_address.labels?.forEach(label => label.style.visibility = 'hidden');

            disableInputs([address_name, address_line_one, address_line_two, address_city, address_postcode, address_country, save_address]);
            address_id.value = String(address_priority);
        })
    })

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
                address_id: address_db_used ? Number(address_id) : undefined,
                card: card,
                discount_code: discount_code,
            }, '/cart/checkout') === false) {
                currentButton.disabled = false;
            } else {
                window.location.href = '/orders';
            }
        });
    });
});
