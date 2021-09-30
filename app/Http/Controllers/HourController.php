<?php

namespace App\Http\Controllers;

use App\Models\Hour;
use Illuminate\Http\Request;

class HourController extends Controller
{
    public function index(Request $request)
    {
        //Return all hours, newest first
        return Hour::orderby('id', 'desc')->paginate(10);
    }

    public function show(Request $request, $id)
    {
        return [
            //Find (or fail) an hour by its id and return its data
            'data' => Hour::findOrFail($id)
        ];
    }

    public function update(Request $request, $id)
    {
        //Request all new  data and save it to the $hour variable
        $hour = $request->all();

        //Find an hour by its id and update its data with the new $hour data
        Hour::find($id)->update($hour);

        //Return the updated hour data
        return $hour;
    }

    public function store()
    {
        //Create a new hour with the requested data
        return Hour::create(request()->all());
    }

    public function delete(Hour $hour)
    {
        //Delete an hour
        $hour->delete();

        return 'Hour deleted';
    }
}
