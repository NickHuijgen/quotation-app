<?php

namespace App\Http\Controllers;

use App\Models\Quotation;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{

    public function index(Request $request)
    {
        //Return users ordered by the creation date. Newest first.
        return User::orderBy('created_at', 'desc')->get();
    }

    public function show(Request $request, $id)
    {
        return [
            //Find (or fail) a specific user by their id and return their data.
            'data' => User::findOrFail($id)
        ];
    }

    public function update(Request $request, $id)
    {
        //Request all new data and save in the $user variable
        $user = $request -> all();

        //Update the current user (defined by id) with the new $user data
        User::find($id) -> update($user);

        //Return the updated user
        return $user;
    }

    public function store()
    {
        //Make a new $attributes variable with all the new user data.
//        $attributes = request()->validate([
//           'first_name' => 'required|max:255',
//           'last_name' => 'required|max:255',
//           'city' => 'required|max:255',
//           'country' => 'required|max:255',
//           'street' => 'required|max:255',
//           'postal_code' => 'required|max:255',
//           'house_number' => 'required|max:255',
//           'email' => 'required|max:255',
//           'password' => 'required|max:255',
//        ]);
//
//        //Make a new User with the $attributes data and save it as $user
//        $user = User::create($attributes);

        $user = User::create(request()->all());

        //Login the new user
        auth()->login($user);

        //Return the new $user data
        return $user;
    }

    public function destroy(User $user)
    {
        //Delete the user
        $user->delete();

        return 'User deleted';
    }

    public function getquotations($id)
    {
        //Find a user with quotations by their id
        $user = User::with(['quotations'])->find($id);

        //Return the quotations of that user
        return $user->quotation = Quotation::orderby('id', 'desc')->paginate(10);
    }
}
