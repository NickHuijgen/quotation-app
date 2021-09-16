<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    public function store()
    {
        $attributes = request()->validate([
           'first_name' => 'required|max:255',
           'last_name' => 'required|max:255',
           'city' => 'required|max:255',
           'country' => 'required|max:255',
           'street' => 'required|max:255',
           'postal_code' => 'required|max:255',
           'house_number' => 'required|max:255',
           'email' => 'required|max:255',
           'password' => 'required|max:255',
        ]);

        $user = User::create($attributes);
    }
}
