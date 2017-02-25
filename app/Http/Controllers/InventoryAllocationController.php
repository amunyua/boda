<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InventoryAllocationController extends Controller
{
    public function inventoryAllocations(){
        return view('inventory_allocation.inventory_allocation');
    }
}
