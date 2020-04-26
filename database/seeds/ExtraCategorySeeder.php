<?php

use Illuminate\Database\Seeder;

class ExtraCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\ExtraCategory::class, 10)->create();
    }
}
