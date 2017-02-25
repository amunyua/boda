<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = new \App\Category();
        $category->category_name = 'Bike';
        $category->code = 'BIKE';
        $category->status = 1;
        $category->save();
        $parent_category = $category->id;

        $category = new \App\Category();
        $category->category_name = 'Mortobike';
        $category->parent_category = $parent_category;
        $category->code = 'MORTOBIKE';
        $category->status = 1;
        $category->save();
    }
}
