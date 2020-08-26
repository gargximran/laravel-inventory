@extends('inventory.layout.app') 

@section('per_page_css')
<link href="{{ asset('inventory/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css')}}" rel="stylesheet"/>

@endsection 



@section('create_new_button')

<a class="nav-link" href="#" role="button" data-toggle="modal" data-target="#exampleModalCenter">
    <span >Add Damage Inventory</span>
</a>

 

@endsection


@section('per_page_js')
<script src="{{ asset('inventory/assets/extra-libs/DataTables/datatables.min.js') }}"></script>


<script>
    /****************************************
     *       Basic Table                   *
     ****************************************/
    $("#zero_config").DataTable();

    
</script>

@endsection 



@section('main_card_content')




<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <div class="card">
            <div class="card-body">
                <h5 class="card-title m-b-0">Insert Damage</h5>
                <form action="" method="POST">
                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <div class="form-group m-t-20">
                                <label>Batch Code <small class="text-muted">(required)</small></label>
                                <input name="batch" type="text" required class="form-control" placeholder="Ex: 123">
                            </div>

                            <div class="form-group m-t-20">
                                <label>Quantity <small class="text-muted">(required)</small></label>
                                <input name="quantity" type="number" required class="form-control" placeholder="Ex: 12">
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
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Damaged Product</h4>
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('inventory_index')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Damaged Product
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>


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
                                    <th>Image</th>
                                    <th>Batch No.</th>
                                    <th>Name</th>
                                    <th>Code</th>
                                    <th>Quantity</th>
                                    <th>Buy Date</th>
                                    <th>Damage Date</th>
                                    <th>Supplier Name</th>
                                    <th>Action</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($damages as $damage)
                                <tr>
                                    <td>
                                        <p>
                                            <img
                                                src="{{ asset('inventory/images/inventory/'.$damage->inventory->image) }}"
                                                class="table_image"
                                            />
                                        </p>
                                    </td>
                                    <td>{{ $damage->batch}}</td>
                                    <td>{{ $damage->inventory->name}}</td>
                                    <td>{{ $damage->inventory->code}}</td>
                                    <td>{{ $damage->quantity}}</td>
                                    <td>{{ $damage->buy->created_at}}</td>
                                    <td>{{ $damage->created_at}}</td>
                                    <td>{{ $damage->buy->supplier->name}}</td>   
                                    <td>
                                        <div class="d-flex">                                            
                                            <div class="btn-group">
                                                <button
                                                    type="button"
                                                    class="btn btn-danger dropdown-toggle btn-sm"
                                                    data-toggle="dropdown"
                                                    aria-haspopup="true"
                                                    aria-expanded="false"
                                                >
                                                    <i class="mdi mdi-delete-forever"></i> Return
                                                </button>
                                                <div
                                                    class="dropdown-menu text-center position-absolute" 
                                                    x-placement="bottom-start"
                                                
                                                >

                                                    <form action="{{route('return_damage',[ $damage->batch, $damage->id])}}" method="POST">
                                               
                                                        @csrf
                                                   
                                                        <input placeholder="Quantity" value="{{ $damage->quantity}}" type="number" class="form-control" name="quantity">
                                                        <br>
                                                        <input placeholder="Expire Day" type="number" class="form-control" name="expire">
                                                        <br>
                                                        <hr>

                                                        <button class="dropdown-item bg-warning" type="submit">Confirm Return?</button>
                                                    </form>

                                                    
                                                
                                                </div>
                                            </div>
                                        </div>
                                    </td>                              
                                   
                                </tr>
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
