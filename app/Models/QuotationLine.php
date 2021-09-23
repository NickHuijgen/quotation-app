<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuotationLine extends Model
{
    use HasFactory;

    //Make sure the user can't change the id
    protected $guarded = [
        'id',
    ];

    //Define a belongsTo relation with quotations, a quotationline belongs to a quotation
    public function quotations()
    {
        $this->belongsTo(Quotation::class);
    }
}
