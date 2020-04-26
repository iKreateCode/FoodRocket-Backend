<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(UserSeeder::class);
         $this->call(ItemCategorySeeder::class);
        $this->call(OffersSeeder::class);
        $this->call(OfferItemSeeder::class);
        $this->call(ExtraCategorySeeder::class);
        $this->call(ExtraSeeder::class);
        $this->call(ExtraItemCategorySeeder::class);
    }
}
