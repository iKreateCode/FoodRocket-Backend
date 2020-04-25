<?php

use Illuminate\Database\Seeder;

class ItemCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\ItemCategory::class, 1)->create()->each(function($category){
            foreach (factory(\App\MenuItem::class, 10)->make() as $item) {
                $item->category_id = $category->id;
                $item->save();
            }
        });
    }
}
