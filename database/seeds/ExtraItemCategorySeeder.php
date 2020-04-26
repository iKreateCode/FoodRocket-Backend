<?php

use Illuminate\Database\Seeder;

class ExtraItemCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\ItemExtra::class, 25)->create();
    }
}
