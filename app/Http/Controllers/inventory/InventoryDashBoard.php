<?php

namespace App\Http\Controllers\inventory;

use App\Http\Controllers\Controller;
use App\Models\Inventory\Inventory;
use App\Models\Stock;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Inventory\DamageProduct;

class InventoryDashBoard extends Controller
{
    public function index(){
        $warningExpireStock = Stock::orderBy('expireDate', 'asc')->where('quantity', '!=', 0)->whereBetween('expireDate', [Carbon::now(),Carbon::now()->addDays(30)])->get();


        $OutOfStockInventories = Inventory::where('quantity', 0)->get();

        $stockAges = Stock::orderBy('created_at', 'desc')->where('quantity', '!=', 0)->take(20)->get();

        $damages = DamageProduct::orderBy('quantity', 'desc')->take(20)->get();

        $expiredStocks = Stock::orderBy('expireDate', 'asc')->where('expireDate', '<=', Carbon::now()->subDays(1))->where('quantity', '!=', 0)->take(20)->get();
     
        return view('inventory.pages.home', compact('warningExpireStock', 'OutOfStockInventories', 'stockAges', 'damages', 'expiredStocks'));
    }
}