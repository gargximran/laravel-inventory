<?php

namespace App\Http\Controllers\inventory;

use App\Http\Controllers\Controller;
use App\Models\Inventory\Buy;
use App\Models\Inventory\DamageProduct;
use App\Models\Inventory\Inventory;
use App\Models\Stock;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;

class DamageController extends Controller
{
    public function all_damage(Request $request){
        $damages = DamageProduct::orderBy('id', 'desc')->get();
        return view('inventory.pages.damage.index', compact('damages'));
    }




    public function add_damage(Request $request){
     
        
        $stock = Stock::where('batch', $request->batch)->first();

        
        $buy = Buy::find($request->batch);


        if(!Buy::find($request->batch)){
            Toastr::error('Please input correct batch code!', 'Batch Not Found!');
            return redirect()->back();
        }

        $stock = Stock::where('batch', $request->batch)->first();

        if($stock->quantity < $request->quantity){
            Toastr::error('Please input correct quantity!', 'Quantity is over stock!');
            return redirect()->back();
        }
        $inventory = Inventory::find($stock->inventory_id);



        $damage = DamageProduct::where('batch', $request->batch)->first();

        if($damage){
            $damage->quantity += $request->quantity;
        }else{
            $damage = new DamageProduct();
            $damage->inventory()->associate($inventory);
            $damage->batch = $request->batch;
            $damage->quantity = $request->quantity;
        }


        

        if($damage->save()){

            $buy->damage += $request->quantity;
            $buy->save();
            $inventory->quantity -= $request->quantity;
            $inventory->save();

            $stock->quantity -= $request->quantity;
            $stock->save();

            Toastr::warning('Damage Inventory Added!');
            return redirect()->back();
        }else{
            Toastr::error('Please Try Again', 'Something Wrong!');
            return redirect()->back();
        }

        
    }




    public function return(Buy $buy, $damage, Request $request){




        $dam = DamageProduct::find($damage);


        if(!$dam){
            Toastr::warning('Damage Not Found!');
            return redirect()->back();
        }

        if($dam->quantity < $request->quantity){
            Toastr::warning('Invalid danage quantity!');
            return redirect()->back();
        }




        $buy->damage -= $request->quantity;
        $buy->save();

        if($dam->quantity == $request->quantity){
            $dam->delete();
        }else{
            $dam->quantity -= $request->quantity;
            $dam->save();
        }



        $return = new Buy();
        $return->inventory_id = $buy->inventory_id;
        $return->supplier_id = $buy->supplier_id;
        $return->invoice_id = $buy->invoice_id;
        $return->quantity = $request->quantity ?$request->quantity : null ;
        $return->per_price = $buy->per_price;
        $return->expireDate = $request->expire ? Carbon::now()->addDays($request->expire): null;
        $return->total_price = 0;
        $return->returnFrom = $buy->id;
        if($return->save()){
            $stock = new Stock();
            $stock->inventory_id = $buy->inventory_id;
            $stock->batch = $return->id;
            $stock->quantity = $request->quantity;
            $stock->expireDate = $request->expire ? Carbon::now()->addDays($request->expire): null;
            $stock->purchase_price = $buy->per_price;
            $stock->save();

            $inventory = Inventory::find($buy->inventory_id);
            $inventory->quantity+= $request->quantity;
            $inventory->save();
        }
        Toastr::success('Return Successfully!');
        return redirect()->back();





       
    }
}
