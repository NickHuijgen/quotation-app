<?php

namespace App\Http\Controllers;

use App\Models\QuotationLine;
use Illuminate\Http\Request;

class QuotationLineController extends Controller
{
    public function index(Request $request)
    {
        //Return all quotationlines, newest first
        return QuotationLine::orderBy('created_at', 'desc')->get();
    }

    public function show(Request $request, $id)
    {
        return [
            //Find (or fail) a quotationline by it's id and return it's data
            'data' => QuotationLine::findOrFail($id)
        ];
    }

    public function update(Request $request, $id)
    {
        //Request all new  data and save it to the $quotationline variable
        $quotationline = $request -> all();

        //Find a quotationline by it's id and update it's data with the new $quotationline data
        QuotationLine::find($id) -> update($quotationline);

        //Return the updated quotationline data
        return $quotationline;
    }

    public function store()
    {
//        //Request all data and save it to the $attributes variable
//        $attributes = request()->validate([
////            'quotation_id' => 'required',
//            'description' => 'required|max:255',
//            'amount' => 'required',
//            'price' => 'required',
//        ]);
//
//        //Create a new QuotationLine with the $attributes data
//        $quotationline = QuotationLine::create($attributes);

        $quotationline = QuotationLine::create(request()->all());

        //Update the totalcost line of the quotation in the database with a newly calculated cost.
        app('App\Http\Controllers\QuotationController')->calculatecost($quotationline->quotation_id);

        //Return the new quotationline
        return $quotationline;
    }

    public function delete(QuotationLine $quotationline)
    {
        //Delete a quotationline
        $quotationline->delete();

        return 'Quotation line deleted';
    }
}
