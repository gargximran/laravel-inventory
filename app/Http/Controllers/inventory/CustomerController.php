<?php

namespace App\Http\Controllers\inventory;

use App\Models\Inventory\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\File;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::orderBy('id', 'desc')->get();
        return view('inventory.pages.customer.index', compact('customers'));
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

        $customer = new Customer();
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->city = $request->city;

        if($request->image){
            $imageName = Str::random(18).uniqid().".png";
            Image::make($request->image)->encode('png', 90)->save(public_path('inventory/images/customer/'.$imageName));

            $customer->image = $imageName;
        }

        if($customer->save()){
            Toastr::success('Congratulation! New customer added..', 'Success!');
            return redirect()->route('customer_view_table');
        }else{
            Toastr::error('Something went wrong! Please try again.', 'Action failed!');
            return redirect()->route('customer_view_table');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        return view('inventory.pages.customer.single_view', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        return view('inventory.pages.customer.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            "name" => "bail|required"
        ]);

     
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->city = $request->city;

        if($request->image){
            if($customer->image != 'demo.png' && File::exists(public_path('inventory/images/customer/'.$customer->image))){
                File::delete(public_path('inventory/images/customer/'.$customer->image));
            }

            $imageName = Str::random(18).uniqid().".png";
            Image::make($request->image)->encode('png', 90)->save(public_path('inventory/images/customer/'.$imageName));

            $customer->image = $imageName;
        }

        if($customer->save()){
            Toastr::success('Congratulation! Customer updated..', 'Success!');
            return redirect()->route('customer_view_table');
        }else{
            Toastr::error('Something went wrong! Please try again.', 'Action failed!');
            return redirect()->route('customer_view_table');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        if($customer->delete()){
            if($customer->image != 'demo.png' && File::exists(public_path('inventory/images/customer/'.$customer->image))){
                File::delete(public_path('inventory/images/customer/'.$customer->image));
            }
            Toastr::error('Customer has been deleted.', 'Deleted!');
            return redirect()->route('customer_view_table');
        }else{
            Toastr::warning('Something went wrong! Please try again.', 'Delete failed!');
            return redirect()->route('customer_view_table');
        }

    
    }
}
