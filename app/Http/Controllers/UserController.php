<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{

    public function index(Request $request)
    {
        return User::orderBy('created_at', 'desc')->get();
    }

    public function show(Request $request, $id)
    {
        return [
            'data' => User::findOrFail($id)
        ];
    }

    public function update(Request $request, $id)
    {
        $user = $request -> all();

        User::find($id) -> update($user);

        return 'User updated';
    }

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

        return $user;
    }

    public function destroy(User $user)
    {
        $user->delete();

        return 'User deleted';
    }
}
