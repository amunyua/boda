<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use phpDocumentor\Reflection\Types\Null_;

class InventoryController extends Controller
{
    public function getCategories(){
        $parent_categories = Category::where('parent_category','=',NULL)->get();
        $categories = Category::where('status',true)->get();
        return view('inventory.inventory_categories',array(
            'categories'=>$categories,
            'parent_categories'=>$parent_categories
        ));
    }
    public function loadCategories($parent_id){
        $categories = (is_null($parent_id) || empty($parent_id)) ? Category::whereNull('parent_category')->where([['status', '=', 1]])->get() : Category::where([['parent_category', '=', $parent_id], ['status', '=', 1]])->get();
        echo '<ul>';
//        echo '<li href="#"><span><i class="fa fa-lg fa-folder-open"></i>Add Category</span></li>';
        if(count($categories)){
            foreach ($categories as $category) {
                echo '<li><span><i class="fa fa-lg fa-folder-open"></i>'.$category->category_name.'</span>';
                echo '<ul>';
                $this->loadSubCategories($category->id);
                echo '</ul>';
                echo '</li>';
            }
        }
            echo '</ul>';
    }
    public function arrangeTree($parent_id){
        echo '<ul><li><span><i class="fa fa-lg fa-folder-open"></i> All Inventory Categories</span>';
        $this->loadCategories($parent_id);

        echo '</li></ul>';
    }

    public function loadSubCategories($parent_id){
        $sub_categories = (is_null($parent_id) || empty($parent_id)) ? Category::whereNull('parent_category')->where([['status', '=', 1]])->get() : Category::where([['parent_category', '=', $parent_id], ['status', '=', 1]])->get();

//        echo '<li><span><i class=""></i>Add subcategory</span></li>';
        if(count($sub_categories)){
            foreach ($sub_categories as $sub_category) {
                echo '<li><span><i class=""></i>'.$sub_category->category_name.'</span></li>';
            }

        }

    }

    public function storeCategory(Request $request){
        $this->validate($request, array(
            'parent_category'=>'required',
            'category_name'=>'required|unique:categories,category_name',
            'code'=>'required|unique:categories,code'
        ));

        if($request->parent_category == 'Null'){
            $parent_category = Null;
        }else{
            $parent_category = $request->parent_category;
        }
        $category = new Category();
        $category->parent_category = $parent_category;
        $category->category_name = $request->category_name;
        $category->code = $request->code;
        $category->status = '1';
        try{
            $category->save();
            Session::flash('success','The categoty ('.$request->category_name.') has been added');
        }catch (QueryException $e){
            $message = $this->handleException($e);
            Session::flash('warning',$message);
        }
        return redirect()->back();


    }
    public function allInventoryItems(){
        return view('inventory.all_inventory_items');
    }

    public function storeInventory(){

    }
}
