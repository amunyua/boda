<?php

namespace App\Http\Controllers;

use App\Category;
use App\InventoryItem;
use Illuminate\Database\QueryException as e;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
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


    public function storeCategory(Request $request){
        $this->validate($request, array(
//            'parent_category'=>'required',
            'category_name'=>'required|unique:categories,category_name',
            'code'=>'required|unique:categories,code'
        ));


        $category = new Category();
        $category->parent_category = Null;
        $category->category_name = $request->category_name;
        $category->code = strtoupper($request->code);
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
        $categories = Category::where('status','=',true)->get();
        return view('inventory.all_inventory_items',array(
            'categories'=> $categories
        ));
    }

    public function storeInventory(Request $request){

        $this->validate($request,array(
            'item_name'=>'required|unique:inventory_items,item_name',
            'category_id'=>'required',
            'item_code'=>'required'
        ));

           $item = new InventoryItem();
           $item->item_name = $request->item_name;
           $item->category_id = $request->category_id;
           $item->item_code = $request->item_code;

           try{
               $item->save();
               Session::flash('success','Inventory Item has been added');
           }catch (QueryException $e){
               Session::flash("warning",$e->errorInfo[2]);
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
                Session::flash('success','Inventory Item has been added');
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

            ->editColumn('category_id',
                '@if(!empty($category_id))
            {{ App\Category::find($category_id)->category_name}}
            @endif
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
        $type = Category::find($inv->category_id)->category_name;


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

    public function loadInventoryCategories(){
        $cats = Category::all();
        return Datatables::of($cats)
            ->editColumn('status', function ($sa){
                if($sa->status == 0){
                    return '<span class="label label-warning">Inactive</span>' ;
                }else{
                    return'<span class="label label-success">Active</span>';
                }
            })

            ->make(true);
    }
    public function deleteInventoryCategory(Request $request){

        try{
            $dest = Category::destroy($request->CategoryId);
            Session::flash('success','The category has been deleted');
        }catch (QueryException $e){
            Session::flash('warning',"Failed to delete, this record is reffered somewhere else");
        }
       return redirect()->back();

    }
    public function getCatEdit($id){
        $cat = Category::find($id);
        return Response::json($cat);
    }

    public function editInventoryCat(Request $request){
        $this->validate($request, [
            'category_name' => 'required',
            'status' => 'required',
            'code' => 'required',
            'edit_id' => 'required|numeric'
        ]);

        Category::where('id', $request->edit_id)
            ->update([
                'category_name' => $request->category_name,
                'status' => $request->status,
                'code' => $request->code
            ]);

        Session::flash('success','Category has been updated');
        return redirect()->back();
    }

    public function editInventoryItem(Request $request){
        $this->validate($request,array(
           'item_code'=>'required',
            'category_id'=>'required',
            'item_name'=>'required'
        ));

        InventoryItem::where('id',$request->edit_id)
            ->update([
                'item_code'=>$request->item_code,
                'item_name'=>$request->item_name,
                'category_id'=> $request->category_id
            ]);

        Session::flash('success','Inventory Item has been updated');
        return redirect()->back();

    }
}
