<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    use HasFactory;

    //Make sure the user can't change the id
    protected $guarded = [
        'id',
    ];

    //Define a belongsTo relation with users, a quotation belongs to a user
    public function users()
    {
        return $this->belongsTo(User::class);
    }

    //Define a hasMany relation with quotationlines, a quotation can have many quotationlines
    public function quotationLines()
    {
        return $this->hasMany(QuotationLine::class);
    }
}
