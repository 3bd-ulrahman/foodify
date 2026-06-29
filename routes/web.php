<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // return view('welcome');
    return unserialize('a:3:{s:3:"otp";s:60:"$2y$12$SI8FswHQhb98CcXr/eNEZ.FuNAHLj9e9k74niaNgrj4EneGc1cSfC";s:8:"attempts";i:0;s:10:"expires_at";O:25:"Illuminate\Support\Carbon":3:{s:4:"date";s:26:"2026-06-29 15:02:29.210407";s:13:"timezone_type";i:3;s:8:"timezone";s:3:"UTC";}}');
});
