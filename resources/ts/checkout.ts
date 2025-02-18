import axios from 'axios';
import toastr from 'toastr';

document.addEventListener('DOMContentLoaded', () => {

    const checkoutButton = document.querySelector('[data-checkout-button]');
    if (checkoutButton) {
        checkoutButton.addEventListener('click', (event) => {
            event.preventDefault();
            const button = event.currentTarget as HTMLButtonElement;
            button.disabled = true;

            axios.post('/cart/checkout', {
                address: {
                    line_one: '123 Main Street',
                    line_two: 'Apt 4B',  // optional
                    city: 'London',
                    postcode: 'SW1A 1AA'
                }
            }, {
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            }).then((response) => {
                if (response.status === 200) {
                    const data = response.data;
                    if (data.success) {
                        toastr.success(data.success);
                        window.location.href = '/orders';
                    }

                    if (data.error) {
                        toastr.error(data.error);
                        button.disabled = false;
                    }
                }
            }).catch((error) => {
                console.error(error);
                toastr.error('An error occurred. Please try again.');
                button.disabled = false;
            });
        });
    }
});
