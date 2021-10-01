<?php

namespace Database\Seeders;

use App\Models\Hour;
use App\Models\Product;
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
         User::factory(1)->create();
         Quotation::factory(10)->create();

         Product::factory(10)->create();
         Hour::factory(10)->create();

         QuotationLine::factory(50)->create();
//        Quotation::factory(20)->create();
    }
}
