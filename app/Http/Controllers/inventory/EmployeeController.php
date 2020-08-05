<?php

namespace App\Http\Controllers\inventory;

use App\Http\Controllers\Controller;
use App\Models\Inventory\Employee;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::all();
        return view('inventory.pages.employee.index', compact('employees'));
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
            "name" => "bail|required",
            "position" => "bail|required",
            "phone" => "bail|required",
            "address" => "bail|required",
            "salary" => "bail|required",       
           
        ]);

        $employee = new Employee();
        $employee->name = $request->name;
        $employee->salary = $request->salary;
        $employee->address = $request->address;
        $employee->yearly_vacation = $request->vacation;
        $employee->exprience = $request->experience;
        $employee->phone = $request->phone;
        $employee->email = $request->email;
        $employee->position = $request->position;
        
        if($request->image){
            $imageName = Str::random(12).uniqid().".png";
            Image::make($request->image)->encode('png', 100)->save(public_path('inventory/images/employee/'.$imageName));
            $employee->image = $imageName;
        }

        if($employee->save()){
            Toastr::success('Congratulation! You just add a new employee.', 'Employee Added!');
            return redirect()->route('employee_view_table');
        }else{
            Toastr::error('Something went wrong! Please try again.', 'Action failed!');
            return redirect()->route('employee_view_table');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Inventory\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
      
        return view('inventory.pages.employee.single_view', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Inventory\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        return view('inventory.pages.employee.edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Inventory\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            "name" => "bail|required",
            "position" => "bail|required",
            "phone" => "bail|required",
            "address" => "bail|required",
            "salary" => "bail|required",       
           
        ]);

      
        $employee->name = $request->name;
        $employee->salary = $request->salary;
        $employee->address = $request->address;
        $employee->yearly_vacation = $request->vacation;
        $employee->exprience = $request->experience;
        $employee->phone = $request->phone;
        $employee->email = $request->email;
        $employee->position = $request->position;
        
        if($request->image){

            if($employee->image != 'demo.png' && File::exists(public_path('inventory/images/employee/'.$employee->image))){
                File::delete(public_path('inventory/images/employee/'.$employee->image));
            }


            $imageName = Str::random(12).uniqid().".png";
            Image::make($request->image)->encode('png', 100)->save(public_path('inventory/images/employee/'.$imageName));
            $employee->image = $imageName;
        }

        if($employee->save()){
            Toastr::success('Success! You just update employee detail.', 'Employee Updated!');
            return redirect()->route('employee_view_table');
        }else{
            Toastr::error('Something went wrong! Please try again.', 'Action failed!');
            return redirect()->route('employee_edit', $employee->id);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inventory\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        

        if($employee->delete()){
            if($employee->image != 'demo.png' && File::exists(public_path('inventory/images/employee/'.$employee->image))){
                File::delete(public_path('inventory/images/employee/'.$employee->image));
            }
            Toastr::error('Employee has been deleted.', 'Deleted!');
            return redirect()->route('employee_view_table');
        }else{
            Toastr::warning('Something went wrong! Please try again.', 'Delete failed!');
            return redirect()->route('employee_view_table');
        }
    }

   
}
