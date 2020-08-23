<?php

namespace App\Http\Controllers\inventory;

use App\Http\Controllers\Controller;
use App\Models\Inventory\Buy;
use App\Models\Inventory\Expense;
use Illuminate\Http\Request;
use App\Models\Inventory\Inventory;
use App\Models\Inventory\Invoice;
use App\Models\Inventory\Supplier;
use App\Models\Stock;
use Carbon\Carbon;

class BuyFromSupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = Supplier::orderBy('id', 'desc')->get();
        $inventories = Inventory::with('brand:name,id')->get();
        return view('inventory.pages.buy.index', compact('inventories','suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        
        if($request->sup_id){
            $request->validate([
                
                "invoice_price_before_discount" => "required",
                "invoice_price_after_discount" => "required",
                'inventory_id.*' => 'required',
                'quantity.*' => 'required',
                'perPrice.*' => 'required',
                'total.*' => 'required'
            ]);
        }else{
            $request->validate([
                "sup_name" => "required",
                "sup_phone" => "required",
                "invoice_price_before_discount" => "required",
                "invoice_price_after_discount" => "required",
                'inventory_id.*' => 'required',
                'quantity.*' => 'required',
                'perPrice.*' => 'required',
                'total.*' => 'required'
            ]);
        }
        
        $supplier = Supplier::find($request->sup_id);


        if(!$supplier){

        

            $typeArray = ['Unknown','Whole Saler','Distributor','Broker'];




            $supplier = new Supplier();
            $supplier->name = $request->sup_name;
            $supplier->email = $request->sup_email;
            $supplier->phone = $request->sup_phone;
            $supplier->address = $request->sup_address;
            $supplier->type = $typeArray[$request->sup_type];
            $supplier->shop_name = $request->sup_shop_name ? $request->sup_shop_name : "Individual";
            $supplier->city = $request->sup_city;
            $supplier->save();


        }

        // after save new supplier create a invoice
   

            $invoice = new Invoice();
            $invoice->supplier()->associate($supplier);

            // if invoice create succesfully
            if($invoice->save()){

                for($i = 0; $i < count($request->inventory_id); $i++){

                    $buy = new Buy();
                    $buy->inventory_id = $request->inventory_id[$i];
                    $buy->supplier()->associate($supplier);
                    $buy->invoice()->associate($invoice);
                    $buy->quantity = $request->quantity[$i];
                    $buy->per_price = $request->perPrice[$i];
                    $buy->total_price =$request->perPrice[$i] * $request->quantity[$i];
                    $buy->expireDate = $request->expire[$i] ? Carbon::now()->addDays($request->expire[$i]): null;
                    $buy->save(); 

                    $inventory = Inventory::find($request->inventory_id[$i]);
                    $inventory->quantity +=  $request->quantity[$i];
                    $inventory->save();



                    $stock = new Stock();
                    $stock->inventory_id = $request->inventory_id[$i];
                    $stock->batch = $buy->id;
                    $stock->quantity = $request->quantity[$i];
                    $stock->expireDate = $request->expire[$i] ? Carbon::now()->addDays($request->expire[$i]): null;
                    $stock->purchase_price = $request->perPrice[$i];
                    $stock->save();
                }


                $expense = new Expense();

                $expense->total_before_discount = $request->invoice_price_before_discount;
                $expense->discount = $request->invoice_price_discount;
                $expense->total_after_discount = $request->invoice_price_after_discount;
                $expense->paid = $request->invoice_price_paid;
                $expense->due = $request->invoice_price_due;
                $expense->invoice()->associate($invoice);
                $expense->save();

                return redirect()->route('buy_from_supplier');
                
            }
       



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
