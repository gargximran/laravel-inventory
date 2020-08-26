@extends('inventory.layout.app')

@section('main_card_content')


            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Sales Cards  -->
                <!-- ============================================================== -->
                <div class="row">
                    <!-- Column -->

                    <div class="col-md-6">
                        <div class="card card-hover">
                            <div class="box bg-success text-center">
                               
                                <h6 class="text-white">Expire Warning</h6>
                                <table class="table table-sm">
                                    <thead>
                                      <tr>
                                        <th scope="col">Image</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Batch</th>
                                        <th scope="col">Expire Date</th>                                     
                                        <th scope="col">Day Left</th>
                                        <th scope="col">Available Quantity</th>
                                        <th scope="col">Supplier Name</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <tr>
                                        @foreach ($warningExpireStock as $expireWarningProduct)
                                          <td>
                                            <p class="text-center">
                                              <img style="width:30px;" src="{{asset('inventory/images/inventory/'.$expireWarningProduct->inventory->image)}}" alt="">
                                            </p>
                                          </td>
                                          <td>{{$expireWarningProduct->inventory->name}}</td>
                                          <td>{{$expireWarningProduct->batch}}</td>
                                          <td>{{$expireWarningProduct->expireDate}}</td>
                                    
                                          @php
                                    

                                            $exp = $expireWarningProduct->expireDate;
      
                                            $datework = Carbon\Carbon::createFromDate($exp);
                                            $now = Carbon\Carbon::now();
                                       
                                          @endphp
                                          <td>{{ $datework->diffInDays($now)}} days</td>

                                      
                                          <td>{{$expireWarningProduct->quantity}}</td>
                                          <td>{{$expireWarningProduct->buy->supplier->name}}</td>
                                        
                                        
                                        
                                      </tr>
                                      @endforeach
                                      
                                    </tbody>
                                  </table>
                            </div>
                        </div>
                    </div>
                     <!-- Column -->
                    <div class="col-md-6">
                        <div class="card card-hover">
                            <div class="box bg-warning text-center">
                                <h6 class="text-white">Store Age Warning</h6>
                                <table class="table table-sm">
                                    <thead>
                                      <tr>
                                        <th scope="col">Image</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Batch</th>
                                        <th scope="col">Store Age</th>
                                        <th scope="col">Import Date</th>
                                        <th scope="col">Supplier Name</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      @foreach ($stockAges as $age)
                                      <tr>
                                        <td>
                                          <p class="text-center">
                                            <img style="width:30px;" src="{{asset('inventory/images/inventory/'.$age->inventory->image)}}" alt="">
                                          </p>
                                        </td>
                                        <td>{{$age->inventory->name}}</td>
                                        <td>{{$age->batch}}</td>
                                        @php
                                    

                                        $exp = $age->created_at;
   
                                        $datework = Carbon\Carbon::createFromDate($exp);
                                        $now = Carbon\Carbon::now();
                                       
                                        @endphp
                                        <td>{{$datework->diffInDays($now)}} days</td>
                                        <td>{{$age->created_at}}</td>
                                        <td>{{$age->buy->supplier->name}}</td>

                                      </tr>
                                      @endforeach
                                      
                                      
                                    </tbody>
                                  </table>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <div class="col-md-6">
                        <div class="card card-hover">
                            <div class="box bg-danger text-center">
                                <h6 class="text-white">Damaged Product</h6>
                                <table class="table table-sm">
                                    <thead>
                                      <tr>
                                        <th scope="col">Image</th>
                                        <th scope="col">Batch</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Code</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Damage Date</th>
                                        <th scope="col">Supplier Name</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      @foreach ($damages as $damage)
                                      <tr>
                                        
                                        <td>
                                          <p class="text-center">
                                            <img style="width:30px;" src="{{asset('inventory/images/inventory/'.$damage->inventory->image)}}" alt="">
                                          </p>
                                        </td>
                                        <td>{{$damage->batch}}</td>
                                        <td>{{$damage->inventory->name}}</td>
                                        <td>{{$damage->inventory->code}}</td>
                                        <td>{{$damage->quantity}}</td>
                                        <td>{{$damage->created_at}}</td>
                                        <td>{{$damage->buy->supplier->name}}</td>
                              
                                      </tr>
                                      @endforeach
                                      
                                      
                                    </tbody>
                                  </table>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <div class="col-md-6">
                        <div class="card card-hover">
                            <div class="box bg-warning text-center">
                                <h6 class="text-white">Expired Product</h6>
                                <table class="table table-sm">
                                    <thead>
                                      <tr>
                                        <th scope="col">Image</th>
                                        <th scope="col">Batch</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Size</th>
                                        <th scope="col">Code</th>
                                        <th scope="col">Supplier Name</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      @foreach ($expiredStocks as $expireProduct)
                                        <tr>
                                          <td>
                                            <p class="text-center">
                                              <img style="width:30px;" src="{{asset('inventory/images/inventory/'.$expireProduct->inventory->image)}}" alt="">
                                            </p>
                                          </td>
                                          <td>{{$expireProduct->batch}}</td>
                                          <td>{{$expireProduct->inventory->name}}</td>
                                          <td>{{$expireProduct->inventory->size}}</td>
                                          <td>{{$expireProduct->inventory->code}}</td>
                                          <td>{{$expireProduct->buy->supplier->name}}</td>
                                         
                                        </tr>
                                      @endforeach
                                     
                                     
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-md-6">
                        <div class="card card-hover">
                            <div class="box bg-danger text-center">
                                <h6 class="text-white">Zero Stock</h6>
                                <table class="table table-sm">
                                    <thead>
                                      <tr>
                                        <th scope="col">Image</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Brand</th>
                                        <th scope="col">Size</th>
                                        <th scope="col">Code</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      @foreach ($OutOfStockInventories as $inventory)
                                          
                                      
                                        <tr>
                                          <td>
                                            <p class="text-center">
                                              <img style="width:30px;" src="{{asset('inventory/images/inventory/'.$inventory->image)}}" alt="">
                                            </p>
                                          </td>
                                          <td>{{$inventory->name}}</td>
                                          <td>{{$inventory->brand->name}}</td>
                                          <td>{{$inventory->size}}</td>
                                          <td>{{$inventory->code}}</td>
                                        </tr>
                                      @endforeach
                                      
                                    </tbody>
                                  </table>
                            </div>
                        </div>
                    </div>
                    
                </div>
     
            </div>
@endsection