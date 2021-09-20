<?php

namespace App\Http\Controllers;

use App\Models\QuotationLine;
use Illuminate\Http\Request;

class QuotationLineController extends Controller
{
    protected $guarded = [
        'id',
    ];

    public function index(Request $request)
    {
        return QuotationLine::orderBy('created_at', 'desc')->get();
    }

    public function show(Request $request, $id)
    {
        return [
            'data' => QuotationLine::findOrFail($id)
        ];
    }

    public function update(Request $request, $id)
    {
        $quotationline = $request -> all();

        QuotationLine::find($id) -> update($quotationline);

        return 'Quotation line updated';
    }

    public function store()
    {
        $attributes = request()->validate([
//            'quotation_id' => 'required',
            'description' => 'required|max:255',
            'amount' => 'required',
            'price' => 'required',
        ]);

        $quotationline = QuotationLine::create($attributes);

        return $quotationline;
    }

    public function delete(QuotationLine $quotationline)
    {
        $quotationline->delete();

        return 'Quotation line deleted';
    }
}
