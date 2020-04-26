<?php

use Illuminate\Database\Seeder;

class OfferItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\OfferItem::class, 20)->create();
    }
}
