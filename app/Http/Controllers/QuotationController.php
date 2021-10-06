<?php

namespace App\Http\Controllers;

use App\Mail\QuotationMade;
use Illuminate\Http\Request;
use App\Models\Quotation;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class QuotationController extends Controller
{
    public function index(Request $request)
    {
        //Return all quotations without pagination. Ordered by newest first.
//        return Quotation::orderBy('created_at', 'desc')->get();

        //Return all quotations, newest first
        return Quotation::orderby('id', 'desc')->get();
    }

    public function show(Request $request, $id)
    {
        return [
            //Find (or fail) a user by their id and return their data.
            'data' => Quotation::findOrFail($id)
        ];
    }

    public function update(Request $request, $id)
    {
        //Request new data and save it to $quotation
        $quotation = $request->all();

        //Find a quotation by its id and update it with the new $quotation data
        Quotation::find($id)->update($quotation);

        //Return the updated quotation
        return $quotation;
    }

    public function store()
    {
        //Request new data and save it in the $attributes variable
//        $attributes = request()->validate([
////            'user_id' => 'required',
//            'customer_first_name' => 'required|max:255',
//            'customer_last_name' => 'required|max:255',
//            'customer_email' => 'required|email|max:255',
//            'customer_city' => 'required|max:255',
//            'customer_street' => 'required|max:255',
//            'customer_house_number' => 'required|max:255',
//            'customer_postal_code' => 'required|max:255',
//            'status' => 'required|max:255',
//        ]);
//
//        //Create a new quotation with the $attributes data
//        $quotation = Quotation::create($attributes);

        //Create a new quotation with the requested attributes and return it
        return Quotation::create(request()->all());
    }

    public function destroy(Quotation $quotation)
    {
        //Delete a quotation
        $quotation->delete();

        return 'Quotation deleted';
    }

    public function calculatecost($id)
    {
        //Find a quotation with quotationlines by its id
        $quotation = Quotation::with('quotationlines')->find($id);

        //Make a new $totalprice variable with a default value of 0
        $totalprice = 0;

        //For each quotationline that a quotation has
        foreach($quotation->quotationlines as $quotationline) {
            //Add the price*amount of the quotationline to the $totalprice variable.
            $totalprice = $totalprice + $quotationline->total_price;
        }

        //Update the totalprice variable in the database with the calculated total price
        $quotation->update(['total_price' => $totalprice]);

        //Return the total price
        return $totalprice;
    }

    public function getlines($id)
    {
        //Find a quotation with quotationlines by its id
        $quotation = Quotation::with('quotationlines')->find($id);

        //Return all of it's quotationlines
        return $quotation->quotationlines;
    }

    public function updatestatus(Quotation $quotation, $status)
    {
        //Update the quotation status with the $status variable
        $quotation->update(['status' => $status]);

        //Return the updated quotation
        return $quotation;
    }

    public function mailquotation(Quotation $quotation, User $user)
    {
        //Queue a mail to the customer
        Mail::to($quotation->customer_email)
            ->send(new QuotationMade($quotation, $user));
    }
}
