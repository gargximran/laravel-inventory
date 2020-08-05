@extends('inventory.layout.app') 



@section('main_card_content')
<!-- ============================================================== -->
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Employee Details</h4>
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('inventory_index')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"> 
                            <a href="{{route('employee_view_table')}}">Employee</a>
                        </li>

                        <li class="breadcrumb-item active" aria-current="page"> 
                            {{$employee->name}}
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- End Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Container fluid  -->
<!-- ============================================================== -->
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-10">
                            
                            <h3>Name : <span class="text-secondary font-weight-light">{{$employee->name}}</span></h3>
                            <br>

                            <h5>Position : <span class="text-secondary font-weight-light">{{$employee->position}}</span></h5>
                            <hr>
                            <br>
                            <h6>Email : <span class="text-secondary font-weight-light">{{$employee->email}}</span></h6>
                            <h6>Phone : <span class="text-secondary font-weight-light">{{$employee->phone}}</span></h6>
                            <h6>Address : <span class="text-secondary font-weight-light">{{$employee->address}}</span></h6>

                            <h6>Salary : <span class="text-secondary font-weight-light">{{$employee->salary}} taka</span></h6>

                            <h6>Yearly Vacation : <span class="text-secondary font-weight-light">{{$employee->yearly_vacation}} days</span></h6>

                            <h6>Experience : <span class="text-secondary font-weight-light">{{$employee->exprience}}</span></h6>
                        </div>
                        <div class="col-md-2">
                            

                            <img id="showUploadImage" src="{{asset('inventory/images/employee/'.$employee->image)}}" alt="" class="img-fluid border border-secondary p-1">
                           
                        </div>
                    </div>
                </div>
                   
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Sales chart
                <!-- ============================================================== -->
</div>
@endsection
