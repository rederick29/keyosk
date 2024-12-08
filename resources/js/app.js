import './bootstrap';
import '../ts/app.ts';
import '../ts/cart-buttons.js';
import { setInitialQuantity, decreaseCartQuantity, increaseCartQuantity, removeCartItem, setCartQuantity } from '../ts/cart-buttons'
import 'toastr/build/toastr.min.css';
import toastr from 'toastr';

toastr.options = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": true,
    "progressBar": true,
    "positionClass": "toast-bottom-center",
    "preventDuplicates": true,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
};

window.toastr = toastr;

window.setInitialQuantity = setInitialQuantity;
window.decreaseCartQuantity = decreaseCartQuantity;
window.increaseCartQuantity = increaseCartQuantity;
window.setCartQuantity = setCartQuantity;
window.removeCartItem = removeCartItem;

// This is for 'npm run build' so vite can find the images, helps with caching.
import.meta.glob([
    '../images/**'
]);

console.log("Connection");
