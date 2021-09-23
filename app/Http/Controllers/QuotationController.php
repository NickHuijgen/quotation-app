<?php

namespace App\Http\Controllers;

use App\Models\QuotationLine;
use Illuminate\Http\Request;
use App\Models\Quotation;
use App\Models\User;

class QuotationController extends Controller
{
    protected $guarded = [
        'id',
    ];

    public function index(Request $request)
    {
//        return Quotation::orderBy('created_at', 'desc')->get();
        return Quotation::paginate(10);
    }

    public function show(Request $request, $id)
    {
        return [
            'data' => Quotation::findOrFail($id)
        ];
    }

    public function update(Request $request, $id)
    {
        $quotation = $request -> all();

        Quotation::find($id) -> update($quotation);

        return 'Quotation updated';
    }

    public function store()
    {
        $attributes = request()->validate([
            'customer_first_name' => 'required|max:255',
            'customer_last_name' => 'required|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_city' => 'required|max:255',
            'customer_street' => 'required|max:255',
            'customer_house_number' => 'required|max:255',
            'customer_postal_code' => 'required|max:255',
            'status' => 'required|max:255',
        ]);

        //$quotation = Quotation::create($attributes);
        $quotation = Quotation::create(request()->all());

        return $quotation;
    }

    public function destroy(Quotation $quotation)
    {
        $quotation->delete();

        return 'Quotation deleted';
    }

    public function calculatecost($id)
    {
        //Find a quotation with quotationlines by it's id
        $quotation = Quotation::with('quotationlines')->find($id);

        //Make a new $totalprice variable with a default value of 0
        $totalprice = 0;

        //For each quotationline that a quotation has
        foreach($quotation->quotationlines as $quotationline) {
            //Add the price*amount of the quotationline to the $totalprice variable.
            $totalprice = $totalprice + $quotationline->price*$quotationline->amount;
        }

        //Return the total price
        $quotation->update(['total_price' => $totalprice]);
        return $totalprice;
    }


    public function getlines($id)
    {
        $quotation = Quotation::with('quotationlines')->find($id);

        return $quotation->quotationlines;
    }
}
