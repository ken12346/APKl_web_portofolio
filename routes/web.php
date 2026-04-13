<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;

Route::get('/', function () {
    $user = User::with([
        'about',
        'skills',
        'experiences',
        'projects',
        'contacts'
    ])->find(1); // ambil user id 1

    return view('welcome', compact('user'));
});
