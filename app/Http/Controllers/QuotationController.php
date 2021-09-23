<?php

namespace App\Http\Controllers;

use App\Mail\QuotationMade;
use Illuminate\Http\Request;
use App\Models\Quotation;
use Illuminate\Support\Facades\Mail;

class QuotationController extends Controller
{
    protected $guarded = [
        'id',
    ];

    public function index(Request $request)
    {
//        return Quotation::orderBy('created_at', 'desc')->get();
//        $data = Quotation::paginate(request()->all());
//        return Response::json($data, 10);

        return Quotation::paginate(10);
    }

    public function show(Request $request, $id)
    {
        return [
            'data' => Quotation::findOrFail($id)
        ];
//        $quotation = Quotation::findOrFail($id);
//
//        Mail::to('customer@email.com')->send(new QuotationMade($quotation));
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
//            'user_id' => 'required',
            'customer_first_name' => 'required|max:255',
            'customer_last_name' => 'required|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_city' => 'required|max:255',
            'customer_street' => 'required|max:255',
            'customer_house_number' => 'required|max:255',
            'customer_postal_code' => 'required|max:255',
            'status' => 'required|max:255',
        ]);

        $quotation = Quotation::create($attributes);

        Mail::to('customer@email.com')->send(new QuotationMade($quotation));

        return $quotation;
    }

    public function destroy(Quotation $quotation)
    {
        $quotation->delete();

        return 'Quotation deleted';
    }

    public function calculatecost($id)
    {
        $quotation = Quotation::with('quotationlines')->find($id);

        $var = 0;

        foreach($quotation->quotationlines as $quotationline) {
            $var = $var + $quotationline->price*$quotationline->amount;
        }

        return $var;
    }

    public function getlines($id)
    {
        $quotation = Quotation::with('quotationlines')->find($id);

        return $quotation->quotationlines;
    }
}
