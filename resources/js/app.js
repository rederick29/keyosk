import './bootstrap';
import '../ts/app.ts';
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

localStorage.theme = 'dark';

// This is for 'npm run build' so vite can find the images, helps with caching.
import.meta.glob([
    '../images/**'
]);

console.log("Connection");
