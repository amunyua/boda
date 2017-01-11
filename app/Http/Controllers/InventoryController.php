<?php

namespace App\Http\Controllers;

use App\Category;
use App\InventoryItem;
use Illuminate\Database\QueryException as e;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use phpDocumentor\Reflection\Types\Null_;
use Yajra\Datatables\Facades\Datatables;

class InventoryController extends Controller
{
    public function getCategories(){
//        $parent_categories = Category::where('parent_category','=',NULL)->get();
        $parent_categories = Category::all();
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
            $parent_code = '';
        }else{
            $parent_category = $request->parent_category;
            $parent_code_d = Category::find($parent_category);
//            print_r($parent_code_d);die;
            $parent_code = $parent_code_d->code.'-';
        }
        $category = new Category();
        $category->parent_category = $parent_category;
        $category->category_name = $request->category_name;
        $category->code = strtoupper($parent_code.$request->code);
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
        $mk = Category::where('category_name','Motorbike')->first();
        $non_bikes_cats = Category::where([
            ['parent_category','=',Null],
            ['category_name','!=','Motorbike']
        ])->get();
        $categories = Category::where('parent_category','=',$mk->id)->get();
        return view('inventory.all_inventory_items',array(
            'categories'=>$categories,
            'non_bikes_cats'=>$non_bikes_cats
        ));
    }

    public function storeInventory(Request $request){

        $this->validate($request,array(
            'inventory_type'=> 'required'));

            if($request->inventory_type == 'motorbike'){
                $this->storeMotorbikeDetails($request);
            }else{
                $this->storeOtherInventory($request);
            }


        return redirect('manage_inventory');
    }
    public function getSubCat($id){
        $models = Category::where('parent_category',$id)->get();
        return Response::json($models);
    }

    public function storeMotorbikeDetails($request){
        $this->validate($request, array(
            'make'=>'required',
            'model'=>'required',
            'vin'=>'required|unique:inventory_items,vin',
            'chassis_number'=>'required|unique:inventory_items,chassis_number',
            'cost_price'=>'required'
        ));
        $mk = Category::where('category_name','Motorbike')->first();
        $motorbike = new InventoryItem();
        $motorbike->parent_category_id = $request->make;
        $motorbike->subcategory_id =$request->model;
        $motorbike->vin = strtoupper($request->vin);
        $motorbike->chassis_number = $request->chassis;
        $motorbike->cost_price = $request->cost_price;
        $motorbike->inventory_type = $mk->id;

        try{
            $motorbike->save();
            Session::flash('success','Motorbike ('.$request->vin.') has been added');
        }catch (e $e){
            $message = $this->handleException($e);
            Session::flash('warning',$message);
        }
    }
    public function storeOtherInventory($request){
//        var_dump($_POST);die;
        $this->validate($request,array(
            'parent_category'=>'required',
//            'code'=>'required|unique:inventory_items,code',
            'quantity'=>'required',
        ));
        //check whether the item already exists
        $inv_items = InventoryItem::where('parent_category_id',$request->parent_category)->first();
//        var_dump($inv_items);die;
        if(empty($inv_items)) {
            $category = Category::find($request->parent_category);
            $item = new InventoryItem();
            $item->inventory_type = $request->inventory_type;
            $item->parent_category_id = $request->parent_category;
            $item->code = $category->code;
            $item->quantity = $request->quantity;
            $item->cost_price = $request->cost_price;
            $item->initial_stock = $request->quantity;
            $item->available_stock = $request->quantity;

            try {
                $item->save();
                Session::flash('success', 'Inventory Item has been added');
            } catch (e $e) {
                $this->handleException2($e);
            }
        }else{
            Session::flash('warning','The inventory item already exists, please create a transaction to add or subtract its stock');
        }
    }

    public function loadInventoryItems(){
        $inventory = InventoryItem::all();
        return Datatables::of($inventory)
            ->editColumn('inventory_type',
            '@if(!empty($inventory_type))
            {{ App\Category::find($inventory_type)->category_name}}
            @endif
            ')
            ->editColumn('parent_category_id',
                '@if(!empty($parent_category_id))
            {{ App\Category::find($parent_category_id)->category_name}}
            @endif
            ')
            ->editColumn('subcategory_id',
                '@if(!empty($subcategory_id))
            {{ App\Category::find($subcategory_id)->category_name}}
            @endif
            ')
            ->editColumn('status',
                '@if($status)
                    Active 
                @else
                    Inactive
                @endif')
            ->editColumn('cost_price','
                {{ number_format($cost_price,2)}}
            ')
            ->make(true);
    }

    public function deleteInventory(Request $request){
        $delete_ids = [$request->edit_ids];
        try{
            InventoryItem::destroy($delete_ids);
            Session::flash('success','The Inventory item have has deleted');
        }catch (e $e){
            $this->handleException2($e);
        }
        return redirect()->back();
    }

    public function getIEditDetails($id){
        $inv = InventoryItem::find($id);
        $type = Category::find($inv->inventory_type)->category_name;
        if($type == 'Motorbike'){
            $type = 'motorbike';
        }else{
            $type = 'others';
        }

        $response = array(
            'type'=>$type,
            'inventory_details'=>$inv
        );
        return Response::json($response);
    }

    public function stockTransactions(){
        $items = InventoryItem::all();

        return view('inventory.stock_transactions',array(
            'items'=>$items
        ));
    }
}
