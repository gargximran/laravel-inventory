@extends('inventory.layout.app') 

@section('per_page_css')
<link href="{{ asset('inventory/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css')}}" rel="stylesheet"/>
<link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
@endsection 



@section('per_page_js')
<script src="{{ asset('inventory/assets/extra-libs/DataTables/datatables.min.js') }}"></script>

<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
<script>
    $("#zero_config").DataTable();
</script>




@endsection 

@section('create_new_button')

<a class="nav-link" href="#" role="button" data-toggle="modal" data-target="#exampleModalCenter">
    <span >Add Brand</span>
</a>

 

@endsection 

@section('main_card_content')
<!-- ============================================================== -->
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Brand</h4>
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('inventory_index')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Brand
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <div class="card">
            <div class="card-body">
                <h5 class="card-title m-b-0">Add Brand</h5>
                <form action="" method="POST">
                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <div class="form-group m-t-20">
                                <label>Brand Name <small class="text-muted">(required)</small></label>
                                <input name="name" type="text" required class="form-control" placeholder="Ex: John Doe">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 text-right">
                            <hr>
                            <input type="reset" class="d-none" id="resetAction">
                            @csrf
                            <button type="button" id="resetTrigger" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                    
                    
                </form>
            </div>
          </div>
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
                    <div class="table-responsive">
                        <table
                            id="zero_config"
                            class="table table-bordered table-hover text-center"
                        >
                            <thead>
                                <tr>
                                    
                                    <th>Brand Name</th>
                                    <th>Action's</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($brands as $brand)
                                <tr>
                                    <td>{{ $brand->name }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <a href="" class="btn btn-primary  btn-sm"><i class="mdi mdi-eye"></i> View</a> 
                                            <button data-toggle="modal" data-target="#edit_brand_{{$brand->id}}" class="btn btn-warning btn-sm"><i class="mdi mdi-account-edit"></i> Edit</button> 
                                            <div class="btn-group">
                                                <button
                                                    type="button"
                                                    class="btn btn-danger dropdown-toggle btn-sm"
                                                    data-toggle="dropdown"
                                                    aria-haspopup="true"
                                                    aria-expanded="false"
                                                >
                                                    <i class="mdi mdi-delete-forever"></i> Delete
                                                </button>
                                                <div
                                                    class="dropdown-menu text-center position-absolute" 
                                                    x-placement="bottom-start"
                                                
                                                >

                                                <form action="{{route('brand_delete', $brand->id)}}" method="POST">
                                                    @method('delete')
                                                    @csrf
                                                    <button class="dropdown-item bg-danger" type="submit">Confirm Delete?</button>
                                                </form>

                                                    <a
                                                        class="dropdown-item bg-secondary"
                                                        href="#"
                                                        >Cancel</a
                                                    >
                                                
                                                </div>
                                            </div>
                                        </div>
                                                                               
                                    </td>
                                </tr>

                                <!-- Modal -->
<div class="modal fade" id="edit_brand_{{$brand->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <div class="card">
            <div class="card-body">
                <h5 class="card-title m-b-0">Edit Brand</h5>
                <form action="{{route('brand_update', $brand->id)}}" method="POST">
                    @method('put')
                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <div class="form-group m-t-20">
                                <label>Brand Name <small class="text-muted">(required)</small></label>
                                <input name="name" value="{{$brand->name}}" type="text" required class="form-control" placeholder="Ex: John Doe">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 text-right">
                            <hr>
                            <input type="reset" class="d-none" id="resetAction">
                            @csrf
                            <button type="button" id="resetTrigger" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                    
                    
                </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<!-- ============================================================== -->
                                @endforeach
                            </tbody>
                        </table>
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
