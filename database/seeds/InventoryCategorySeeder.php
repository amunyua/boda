<?php

use Illuminate\Database\Seeder;
use App\Category;

class InventoryCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('categories')->delete();

        $category = new Category();
        $category->category_name = 'Motorbike';
        $category->code = 'MTBK';
        $category->status = True;

        $category->save();
    }
}
