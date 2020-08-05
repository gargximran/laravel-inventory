<?php

namespace App\Http\Controllers\inventory;

use App\Http\Controllers\Controller;
use App\Models\Inventory\Supplier;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Brian2694\Toastr\Facades\Toastr;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = Supplier::orderBy('id', 'desc')->get();
        return view('inventory.pages.supplier.index', compact('suppliers'));
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
       

        $request->validate([
            "name" => "bail|required"
        ]);
        $typeArray = ['Unknown','Whole Saler','Distributor','Broker'];

        $supplier = new Supplier();
        $supplier->name = $request->name;
        $supplier->email = $request->email;
        $supplier->phone = $request->phone;
        $supplier->address = $request->address;
        $supplier->type =$typeArray[$request->type];
        $supplier->shop_name = $request->shop_name ? $request->shop_name : 'Individual';
        $supplier->city = $request->city;


        if($request->image){
            $imageName = Str::random(30).uniqid().'.png';
            Image::make($request->image)->encode('png', 80)->save(public_path('inventory/images/supplier/'.$imageName));
            $supplier->image = $imageName;
        }

        if($supplier->save()){
            Toastr::success('Congratulation! New supplier added..', 'Success');
            return redirect()->route('supplier_view');
        }else{
            Toastr::error('Something went wrong! Please try again.', 'Action failed!');
            return redirect()->route('supplier_view');
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Inventory\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        return view('inventory.pages.supplier.single_view', compact('supplier'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Inventory\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        return view('inventory.pages.supplier.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Inventory\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {
        $request->validate([
            "name" => "bail|required"
        ]);
        $typeArray = ['Unknown','Whole Saler','Distributor','Broker'];

        $supplier->name = $request->name;
        $supplier->email = $request->email;
        $supplier->phone = $request->phone;
        $supplier->address = $request->address;
        $supplier->type =$typeArray[$request->type];
        $supplier->shop_name = $request->shop_name ? $request->shop_name : 'Individual';
        $supplier->city = $request->city;


        if($request->image){


            if($supplier->image != 'demo.png' && File::exists(public_path('inventory/images/supplier/'.$supplier->image))){
                File::delete(public_path('inventory/images/supplier/'.$supplier->image));
            }

            $imageName = Str::random(30).uniqid().'.png';
            Image::make($request->image)->encode('png', 80)->save(public_path('inventory/images/supplier/'.$imageName));
            $supplier->image = $imageName;
        }

        if($supplier->save()){
            Toastr::success('Congratulation! Supplier updated..', 'Success');
            return redirect()->route('supplier_view');
        }else{
            Toastr::error('Something went wrong! Please try again.', 'Action failed!');
            return redirect()->route('supplier_view');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inventory\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        if($supplier->delete()){
            if($supplier->image != 'demo.png' && File::exists(public_path('inventory/images/supplier/'.$supplier->image))){
                File::delete(public_path('inventory/images/supplier/'.$supplier->image));
            }

            Toastr::error('Supplier has been deleted..', 'Delete Success!');
            return redirect()->route('supplier_view');
        }else{
            Toastr::warning('Something went wrong! Please try again.', 'Action failed!');
            return redirect()->route('supplier_view');
        }
    }
}
