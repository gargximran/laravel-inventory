<?php

namespace App\Http\Controllers\inventory;

use App\Http\Controllers\Controller;
use App\Models\Inventory\Buy;
use App\Models\Inventory\DamageProduct;
use App\Models\Inventory\Inventory;
use App\Models\Stock;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class DamageController extends Controller
{
    public function all_damage(Request $request){
        $damages = DamageProduct::orderBy('id', 'desc')->get();
        return view('inventory.pages.damage.index', compact('damages'));
    }




    public function add_damage(Request $request){
     
        
        $stock = Stock::where('batch', $request->batch)->first();

        $inventory = Inventory::find($stock->inventory_id);
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
}
