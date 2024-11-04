<?php

use Illuminate\Support\Facades\Route;

// Default route for site.
Route::get('/', function() {
    return view('index');
});


