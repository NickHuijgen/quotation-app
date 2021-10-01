<?php

namespace App\Http\Controllers;

use App\Models\QuotationLine;
use Illuminate\Http\Request;

class QuotationLineController extends Controller
{
    public function index(Request $request)
    {
        //Return all quotationlines, newest first
        return QuotationLine::orderby('id', 'desc')->paginate(10);
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
        $quotationline = $request->all();

        //Find a quotationline by it's id and update it's data with the new $quotationline data
        QuotationLine::find($id)->update($quotationline);

        $this->calculatecost($id);

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
        $this->calculatecost($quotationline->id);

        //Return the new quotationline
        return $quotationline;
    }

    public function destroy(QuotationLine $quotationline)
    {
        //Delete a quotationline
        $quotationline->delete();

        return 'Quotation line deleted';
    }

    public function getcontents(Request $request, $id)
    {
        $quotationline = QuotationLine::with(['contents'])->find($id);

        return $quotationline->contents;
    }

    public function calculatecost($id)
    {
        //Find a quotationline with contents by its id
        $quotationline = QuotationLine::with(['contents'])->find($id);

        //Make a new $totalprice variable with a default value of 0
        $totalprice = 0;

        //Add the price*amount of the contents to the $totalprice variable.
        $totalprice = $totalprice + $quotationline->contents->price*$quotationline->amount;

        //Update the totalprice variable in the database with the calculated total price
        $quotationline->update(['total_price' => $totalprice]);

        app('App\Http\Controllers\QuotationController')->calculatecost($quotationline->quotation_id);

        //Return the total price
        return $totalprice;
    }
}
