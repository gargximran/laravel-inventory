<?php

namespace App\Http\Controllers\inventory;

use App\Http\Controllers\Controller;
use App\Models\Inventory\Brand;
use App\Models\Inventory\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Brian2694\Toastr\Facades\Toastr;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inventories = Inventory::with('brand:name,id')->get();
        return view('inventory.pages.inventory.index', compact('inventories'));
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
            "name" => "bail|required|unique:App\Models\Inventory\Inventory,name",
            "brand" => "bail|required",
            "size" => "bail|required",
            "code" => "bail|required|unique:App\Models\Inventory\Inventory,code",
            'image' => "bail|required|image"
     
        ]);

        $brand = Brand::where('name', $request->brand)->first();
        if(is_null($brand)){
            $brand = new Brand();
            $brand->name = $request->brand;
            $brand->save();
        }

        $inventory = new Inventory();
        $inventory->name = $request->name;
        $inventory->size = $request->size;
        $inventory->code = $request->code;
        $inventory->quantity = 0;
        $inventory->brand()->associate($brand);
        
        $imageName = time().Str::random(12).uniqid().'.png';
        Image::make($request->image)->encode('png',90)->save(public_path('inventory/images/inventory/'.$imageName));

        $inventory->image = $imageName;

        

        if($inventory->save()){
            Toastr::success('Congratulation! You just add a new inventory.', 'Inventory Added!');
            return redirect()->route('inventory_view');
        }else{
            Toastr::error('Something went wrong! Please try again.', 'Action failed!');
            return redirect()->route('inventory_view');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Inventory\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function show(Inventory $inventory)
    {
        return view('inventory.pages.inventory.single_view', compact('inventory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Inventory\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function edit(Inventory $inventory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Inventory\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inventory $inventory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inventory\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inventory $inventory)
    {
        //
    }
}
