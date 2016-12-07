<?php

namespace App\Http\Controllers;

use App\InventoryItem;
use App\StockTransaction;
use Illuminate\Database\QueryException as e;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Yajra\Datatables\Facades\Datatables;

class StockTransactionController extends Controller
{
    private $_new_stock_level = 0;
    private $_transaction_errors = array();
    public function createTransaction(Request $request){
        $this->validate($request, array(
            'inventory_item'=>'required',
            'transaction_type'=>'required',
            'transaction_category'=>'required',
            'quantity'=>'required'
        ));
        $available_stock_level = InventoryItem::find($request->inventory_item)->available_stock;
        //set new array for errors
        $errors = array();
        switch ($request->transaction_type){
            case 'add':
                $this->_new_stock_level = $available_stock_level + $request->quantity;
                break;
            case 'subtract':
                if($available_stock_level < $request->quantity){
                    $this->setWarning('Quantity to reduce may not be greater than the available stock');
                    $this->_transaction_errors = 'quantity greater than avaible stock';
                }else {
                    $this->_new_stock_level = $available_stock_level - $request->quantity;
                }
                break;
        }
//        var_dump($errors);die;
        if(count($this->_transaction_errors) == 0){
           DB::transaction(function (){
                //if no error occured record a transaction
               $user = Auth::user();
               $stock_transaction = new StockTransaction();
                $stock_transaction->item_id = Input::get('inventory_item');
                $stock_transaction->transaction_category = Input::get('transaction_category');
                $stock_transaction->transaction_type = Input::get('transaction_type');
                $stock_transaction->new_level = $this->_new_stock_level;
                $stock_transaction->quantity = Input::get('quantity');
                $stock_transaction->running_stock = $this->_new_stock_level;
                $stock_transaction->created_by = $user->id;
                // save the transaction

                $this->tryTransaction($stock_transaction);

                $item_stock = InventoryItem::find(Input::get('inventory_item'));
                $item_stock->available_stock = $this->_new_stock_level;
                $this->tryTransaction($item_stock);


           });
        }
        if(count($this->_transaction_errors) == 0){
            Session::flash('success','The transaction has been recorded');
        }
        return redirect()->back();
    }

    public function setWarning($message){
        Session::flash('warning',$message);
    }


    public function tryTransaction($tranc_name){
        try{
            $tranc_name->save();
            return true;
        }catch (e $e){
            $this->_transaction_errors[] = 'error';
            return  Session::flash('failed','Encountered an error');
        }
    }

    public function loadTransactions(){
        $transactions = StockTransaction::all();
        return Datatables::of($transactions)
            ->editColumn('item_id',
                '<?php
                $inventory_cat = App\InventoryItem::find($item_id)->parent_category_id;
                echo $item_name = App\Category::find($inventory_cat)->category_name;
                ?>')
            ->editColumn('transaction_category',
                '{{ ucfirst($transaction_category) }}')
            ->editColumn('transaction_type',
                '{{ ucfirst($transaction_type) }}')
            ->editColumn('created_by',
                '@if(!empty($created_by))
                    {{ App\User::find($created_by)->name}}
                @endif
                ')
            ->make(true);
    }
}
