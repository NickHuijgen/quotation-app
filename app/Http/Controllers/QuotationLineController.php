<?php

namespace App\Http\Controllers;

use App\Models\Quotation;
use App\Models\QuotationLine;
use Illuminate\Http\Request;

class QuotationLineController extends Controller
{
    protected $guarded = [
        'id',
    ];

    public function index(Request $request)
    {
        return [
            'data' => QuotationLine::all()
        ];
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
    }

    public function store()
    {
        $attributes = request()->validate([
            'description' => 'required|max:255',
            'amount' => 'required',
            'price' => 'required',
        ]);

        $quotationline = QuotationLine::create($attributes);
    }

    public function delete(QuotationLine $quotationline)
    {
        $quotationline->delete();
    }
}
