<?php

namespace App\Http\Controllers\inventory;

use App\Http\Controllers\Controller;
use App\Models\Inventory\Buy;
use App\Models\Inventory\Invoice;
use App\Models\Stock;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
   

    public function buy_hostory(){
        $buys = Buy::orderBy('expireDate', 'asc')->get();
        return  view('inventory.pages.buy_history.index', compact('buys'));
    }


    public function invoice_history(){
        $invoices = Invoice::orderBy('id', 'desc')->get();
        return view('inventory.pages.buy_history.invoice', compact('invoices'));
    }

   

    public function all_stock(){
       
        $stocks = Stock::orderBy('expireDate', 'asc')->orWhere('expireDate', '>=', Carbon::now()->subDays(1))->orWhere('expireDate', null)->where('quantity', '!=', 0)->get();

        return view('inventory.pages.Stock.all_stock', compact('stocks'));

        
        
    }

    public function expired_stock(){
       
        $stocks = Stock::orderBy('expireDate', 'asc')->orWhere('expireDate', '<=', Carbon::now()->subDays(1))->where('quantity', '!=', 0)->get();

        return view('inventory.pages.Stock.expired', compact('stocks'));

        
        
    }


    public function finished_stock(){
       
        $stocks = Stock::orderBy('expireDate', 'asc')->where('quantity', 0)->get();

        return view('inventory.pages.Stock.finished', compact('stocks'));

        
        
    }



}
