<?php

namespace App\Http\Controllers\inventory;

use App\Http\Controllers\Controller;
use App\Models\Inventory\Brand;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::orderBy('id','desc')->get();
        return view('inventory.pages.brand.index', compact('brands'));
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
            'name' => 'required|unique:brands'
        ]);

        $brand = new Brand();
        $brand->name = $request->name;
        if($brand->save()){
            Toastr::success('Congratulation! Brand added..', 'Success!');
            return redirect()->route('brand_view');
        }else{
            Toastr::error('Something went wrong! Please try again.', 'Action failed!');
            return redirect()->route('brand_view');
        }

        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Inventory\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Inventory\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Inventory\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
        $request->validate([
            'name' => "required|unique:brands,name,$brand->id"
        ]);

        $brand->name = $request->name;
        if($brand->save()){
            Toastr::success('Congratulation! Brand updated..', 'Success!');
            return redirect()->route('brand_view');
        }else{
            Toastr::error('Something went wrong! Please try again.', 'Action failed!');
            return redirect()->route('brand_view');
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inventory\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        if($brand->delete()){
            Toastr::error('Congratulation! Brand deleted..', 'Success!');
            return redirect()->route('brand_view');
        }else{
            Toastr::error('Something went wrong! Please try again.', 'Action failed!');
            return redirect()->route('brand_view');
        }
    }
}
