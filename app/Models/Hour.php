<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hour extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    public function quotationLine()
    {
        return $this->morphOne(QuotationLine::class, 'contents');
    }
}
