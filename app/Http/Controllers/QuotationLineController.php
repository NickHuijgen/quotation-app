<?php

namespace App\Http\Controllers;

use App\Models\QuotationLine;
use Illuminate\Http\Request;

class QuotationLineController extends Controller
{
    protected $guarded = [
        'id',
    ];

    public function store()
    {
        $attributes = request()->validate([
            'description' => 'required|max:255',
            'amount' => 'required',
            'price' => 'required',
        ]);

        $quotationline = QuotationLine::create($attributes);
    }
}
