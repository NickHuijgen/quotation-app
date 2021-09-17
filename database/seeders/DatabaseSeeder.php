<?php

namespace Database\Seeders;

use Database\Factories\QuotationFactory;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Quotation;
use App\Models\QuotationLine;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         QuotationLine::factory(10)->create();
//        Quotation::factory(20)->create();
    }
}
