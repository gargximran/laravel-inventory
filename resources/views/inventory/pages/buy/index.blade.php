@extends('inventory.layout.app') 

@section('per_page_css')
<link href="{{ asset('inventory/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css')}}" rel="stylesheet"/>
<link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
<style>
   

    .inputNumber::-webkit-outer-spin-button,
    .inputNumber::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
        -moz-appearance: textfield;
    }
</style>
@endsection 



@section('per_page_js')
<script src="{{ asset('inventory/assets/extra-libs/DataTables/datatables.min.js') }}"></script>

    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
<script>
    /****************************************
     *       Basic Table                   *
     ****************************************/
    $("#zero_config").DataTable();

    const imagePath = "{{asset('inventory/images/logo/upload.png')}}"

    document.getElementById('imageUpload').addEventListener('change', e=>{
        let image = e.target.files[0]
        if(image){
            let reader = new FileReader();
                reader.readAsDataURL(image);
                reader.onload = e => {
                    return document.getElementById('showUploadImage').src = e.target.result
                };
        }else{
            return document.getElementById('showUploadImage').src = imagePath
        }

        
    })


  
</script>

<script>
    const selectedItems = [];
    const SelectedItem = document.getElementsByClassName('selectInventoryToBuy');
    for(let i in SelectedItem){
        SelectedItem[i].onclick = e => {
          
           
            if(e.target.checked == true){
                if(selectedItems.indexOf(e.target.dataset) < 0){
                    selectedItems.push(e.target.dataset)
                    document.getElementById('Selected_itemShow').innerHTML = ''
                    document.getElementById('Selected_invoice').innerHTML = ''
                    selectedItems.forEach(v =>{
                        document.getElementById('Selected_itemShow').innerHTML += `<tr>
                                        <td><p><img src="/inventory/images/inventory/${v.image}" class="img-fluid table_image"></p></td>
                                        <td>${v.name}-${v.brandName}-${v.size}-${v.code}</td>
                                        <td><input class="inputNumber selectqty" style="width:45px;" type="number"  value="${v.qty}" min='1' data-inventory="${v.inventory}" ></td>
                                        <td><input class="inputNumber selectprice" style="width:45px;" type="number"></td>
                                        <td class="perItemPrice" style="width:25px;">100 tk</td>
                                    </tr>`


                        document.getElementById('Selected_invoice').innerHTML += `<tr>
                            <td><p><img src="/inventory/images/inventory/${v.image}" class="img-fluid table_image"></p></td>
                            <td>${v.name} | ${v.brandName} | ${v.size} | ${v.code}</td>
                            <td>1</td>
                            <td>1</td>
                            <td>100 tk</td>
                        </tr>`


                                    
                    })
                }
                
            }

            if(e.target.checked == false){
                let index = selectedItems.indexOf(e.target.dataset)
                selectedItems.splice(index,1)
                document.getElementById('Selected_itemShow').innerHTML = ''
                document.getElementById('Selected_invoice').innerHTML = ''
                    selectedItems.forEach(v =>{
                        document.getElementById('Selected_itemShow').innerHTML += `<tr>
                                        <td><p><img src="/inventory/images/inventory/${v.image}" class="img-fluid table_image"></p></td>
                                        <td>${v.name}-${v.brandName}-${v.size}-${v.code}</td>
                                        <td><input class="inputNumber selectqty" style="width:45px;" type="number"  value="${v.qty}" min='1' data-inventory="${v.inventory}"></td>
                                        <td><input class="inputNumber selectprice" style="width:45px;" type="number"></td>
                                        <td class="perItemPrice" style="width:25px;">100 tk</td>
                                    </tr>`


                        document.getElementById('Selected_invoice').innerHTML += `<tr>
                            <td><p><img src="/inventory/images/inventory/${v.image}" class="img-fluid table_image"></p></td>
                            <td>${v.name} | ${v.brandName} | ${v.size} | ${v.code}</td>
                            <td>1</td>
                            <td>1</td>
                            <td>100 tk</td>
                        </tr>`
                    })
                
            }



            const quantityInput = document.getElementsByClassName('selectqty');
            const selectprice = document.getElementsByClassName('selectprice');
            const perItemPrice = document.getElementsByClassName('perItemPrice');

          

            for(let index in quantityInput){
                quantityInput[index].oninput = e => {
                 let itemPrice = selectprice[index].value

                    
                  

                    selectedItems.filter((v, i) => {
                                if(v.inventory == e.target.dataset.inventory){
                                    selectedItems[i].qty = e.target.value
                                }
                            })                           

                            perItemPrice[index].innerHTML = itemPrice*e.target.value+ " tk"
                  
                
                }
            }
                
            
        }
    }
</script>
<script>
    const supplierTypeSelection = document.getElementById('supplier_selector_display');
    const newSupplierButton = document.getElementById('newSupplierbutton');
    const existingSupplierButton = document.getElementById('existingSupplierbutton');

    const newSupplierForm = document.getElementById('new_supplier_form');
    const fromNewSupplierFormTo = document.getElementById('fromNewSupplierFormTo');
    const fromNewSupplierFormBack = document.getElementById('fromNewSupplierFormBack');

    const inventorySelection = document.getElementById('inventory_selection');
    const fromNewInventorySelectionBack = document.getElementById('fromNewInventorySelectionBack');
    const fromNewInventorySelectionTo = document.getElementById('fromNewInventorySelectionTo');

    const invoice_selection = document.getElementById('invoice_selection');
    const fromInvoiceSelectionBack = document.getElementById('fromInvoiceSelectionBack');
    const fromInvoiceSelectionTo = document.getElementById('fromInvoiceSelectionTo');



    supplierTypeSelection.style.display = 'block';
    newSupplierForm.style.display = 'none';
    inventorySelection.style.display = 'none';
    invoice_selection.style.display = 'none';


    newSupplierButton.onclick = ()=>{
        supplierTypeSelection.style.display = 'none';
        newSupplierForm.style.display = 'block';
        inventorySelection.style.display = 'none';
        invoice_selection.style.display = 'none';
    }

    fromNewSupplierFormTo.onclick = ()=>{
        supplierTypeSelection.style.display = 'none';
        newSupplierForm.style.display = 'none';
        inventorySelection.style.display = 'block';
        invoice_selection.style.display = 'none';
    }

    fromNewInventorySelectionTo.onclick = ()=>{
        supplierTypeSelection.style.display = 'none';
        newSupplierForm.style.display = 'none';
        inventorySelection.style.display = 'none';
        invoice_selection.style.display = 'block';
    }

    //---------------------------------------------//

    fromNewSupplierFormBack.onclick = ()=>{
        supplierTypeSelection.style.display = 'block';
        newSupplierForm.style.display = 'none';
        inventorySelection.style.display = 'none';
        invoice_selection.style.display = 'none';
    }

    fromNewInventorySelectionBack.onclick = ()=>{
        supplierTypeSelection.style.display = 'none';
        newSupplierForm.style.display = 'block';
        inventorySelection.style.display = 'none';
        invoice_selection.style.display = 'none';
    }

    fromInvoiceSelectionBack.onclick = ()=>{
        supplierTypeSelection.style.display = 'none';
        newSupplierForm.style.display = 'none';
        inventorySelection.style.display = 'block';
        invoice_selection.style.display = 'none';
    }



    




    
</script>

@endsection 



@section('main_card_content')

<!-- ============================================================== -->
<!-- Container fluid  -->
<!-- ============================================================== -->
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">

                <!-- Supplier selector display start -->
                <div class="card-body" id="supplier_selector_display">
                  <div class="row">
                      <div class="col-2 offset-4">
                        <div class="card card-hover" id="newSupplierbutton" style="cursor: pointer;">
                            <div class="box bg-success text-center">
                                <h1 class="font-light text-white"><i class="mdi mdi-chart-areaspline"></i></h1>
                                <h6 class="text-white">New Supplier</h6>
                            </div>
                        </div>
                      </div>

                      <div class="col-2">
                        <div class="card card-hover" id="existingSupplierbutton" style="cursor: pointer;">
                            <div class="box bg-success text-center">
                                <h1 class="font-light text-white"><i class="mdi mdi-chart-areaspline"></i></h1>
                                <h6 class="text-white">Existing Supplier</h6>
                            </div>
                        </div>
                      </div>
                  </div>
                </div>
                <!-- Supplier selector displey end -->



                <!-- new supplier form start -->
                <div class="card-body" id="new_supplier_form">
                    <h5 class="card-title m-b-0">Add Supplier</h5>
                    <form onsubmit="return false;" id="new_supplier_form_tag">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group m-t-20">
                                    <label>Supplier Name <small class="text-muted">(required)</small></label>
                                    <input name="name" type="text" required class="form-control" placeholder="Ex: John Doe">
                                </div>

                                <div class="form-group m-t-20">
                                    <label>Shop Name <small class="text-muted"></small></label>
                                    <input name="shop_name" type="text" class="form-control" placeholder="Ex: SST tech">
                                </div>

                                <div class="form-group m-t-20">
                                    <label>Supplier type <small class="text-muted"></small></label>
                                    <select name="type" class="form-control">
                                        <option value="0">Select Supplier Type</option>
                                        <option value='1'>Whole Saler</option>
                                        <option value='2'>Distributor</option>
                                        <option value='3'>Broker</option>
                                    </select>
                                </div>


                                <div class="form-group m-t-20">
                                    <label>Address Line <small class="text-muted"></small></label>
                                    <input name="address" type="text"  class="form-control" placeholder="Ex: Uttara-11, house-2, road-12">
                                </div>

                                <div class="form-group m-t-20">
                                    <label>City <small class="text-muted"></small></label>
                                    <input name="city" type="text"  class="form-control" placeholder="Ex: Uttara">
                                </div>


                                


                            </div>
                            <div class="col-md-6">
                                <div class="form-group m-t-20">
                                    <label>Email Address</label>
                                    <input name="email" type="text"  class="form-control" placeholder="Ex: example@mail.com">
                                </div>

                                <div class="form-group m-t-20">
                                    <label>Phone <small class="text-muted"></small></label>
                                    <input name="phone" type="text"  class="form-control" placeholder="Ex: 01734567898">
                                </div>


                                <div class="form-group m-t-20">
                                    <label for="imageUpload" class="text-center d-block">Upload Image <small class="text-muted"></small></label>
                                    <input accept="image/*" type="file" name="image" id="imageUpload" class="d-none">

                                    <label for="imageUpload"  class=' row' >
                                    <img id="showUploadImage" src="{{asset('inventory/images/logo/upload.png')}}" alt="" class="img-fluid border border-secondary p-1 col-md-6 offset-md-3"></label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 text-right">
                                <hr>
                                <input type="reset" value="Reset" class="btn btn-warning" id="resetAction">
                             
                                <button type="button" id="fromNewSupplierFormBack" class="btn btn-secondary" >back</button>
                                <button type="button" id="fromNewSupplierFormTo" class="btn btn-primary">Next</button>
                            </div>
                        </div>
                        
                        
                    </form>
                </div>
                <!-- new supplier form end -->



                <!-- inventory selector start -->
                <div class="card-body" id="inventory_selection">
                    <div class="row">
                        <div class="col-10">
                            <h2>Supplier Name : <span class="font-weight-light">Shahajan Electronic</span> </h2>
                            <h3>Shop Name : <span class="font-weight-light">Shahajan Electronic</span></h3>
                            <h4>Address : <span class="font-weight-light">Shahajan Electronic</span></h4>
                            <h4>City : <span class="font-weight-light">City</span></h4>
                            <h4>Phone : <span class="font-weight-light">01993039484</span></h4>
                            <h4>Email : <span class="font-weight-light">example@gmail.com</span></h4>
                        </div>

                        <div class="col-2">
                            <img src="" alt="" class="img-fluid border border-secondary p-1">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5 border border-secondary">
                            <h3 class="text-center border-bottom">Selected Inventory</h3>
                            <table class="table table-hover">
                                <thead>
                                    <th>Image</th>
                                    <th>Name-Brand-Size-Code</th>
                                    <th>Qty.</th>
                                    <th>Price Per Item</th>
                                    <th>Total price</th>
                                </thead>
                                <tbody id="Selected_itemShow">
                                    
                                </tbody>
                            </table>
                        </div>


                        <div class="col-md-7">
                            <div class="table-responsive">
                                <table
                                    id="zero_config"
                                    class="table table-bordered table-hover text-center"
                                >
                                    <thead>
                                        <tr>
                                            <th>Select</th>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Size</th>
                                            <th>Brand</th>
                                            <th>Code</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($inventories as $inventory)
                                        <tr>
                                            <td>
                                                <input type="checkbox" data-inventory="{{$inventory->id}}"  data-name="{{$inventory->name}}" data-image="{{$inventory->image}}" data-brand-name="{{$inventory->brand->name}}" data-size="{{$inventory->size}}" data-code="{{$inventory->code}}" data-qty="0"  class="selectInventoryToBuy">
                                            </td>
                                            <td>
                                                <p>
                                                    <img
                                                        src="{{ asset('inventory/images/inventory/'.$inventory->image) }}"
                                                        class="table_image"
                                                    />
                                                </p>
                                            </td>
                                            <td>{{ $inventory->name }}</td>
                                            <td>{{ $inventory->size }}</td>
                                            <td>{{ $inventory->brand->name }}</td>
                                            <td>{{ $inventory->code }}</td>
                                            
                                        </tr>
                                            @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                        <div class="row">
                            <div class="col-12 text-right">
                                <hr>
                               
                            
                                <button type="button" id="fromNewInventorySelectionBack" class="btn btn-secondary" >back</button>
                                <button type="button" id="fromNewInventorySelectionTo" class="btn btn-primary">Next</button>
                            </div>
                        </div>
                </div>
                <!-- inventory selection form end -->





                <!-- inventory selector start -->
                <div class="card-body" id="invoice_selection">
                    <div class="row">
                        <div class="col-10">
                            <h2>Supplier Name : <span class="font-weight-light">Shahajan Electronic</span> </h2>
                            <h3>Shop Name : <span class="font-weight-light">Shahajan Electronic</span></h3>
                            <h4>Address : <span class="font-weight-light">Shahajan Electronic</span></h4>
                            <h4>City : <span class="font-weight-light">City</span></h4>
                            <h4>Phone : <span class="font-weight-light">01993039484</span></h4>
                            <h4>Email : <span class="font-weight-light">example@gmail.com</span></h4>
                        </div>

                        <div class="col-2">
                            <img src="" alt="" class="img-fluid border border-secondary p-1">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-10 offset-md-1 border border-secondary">
                            <h3 class="text-center border-bottom">Invoice</h3>
                            <table class="table table-hover">
                                <thead>
                                    <th>Image</th>
                                    <th>Name | Brand | Size | Code</th>
                                    <th>Qty.</th>
                                    <th>Price Per Item</th>
                                    <th>Total price</th>
                                </thead>
                                <tbody id="Selected_invoice">
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-12 text-right">
                            <hr>
                            <h4>Total Price Before Discount : 100</h4>
                            <h4>Discount : 100</h4>
                            <h4>Total Price To Pay : 100</h4>
                            <h4>Paid : 100</h4>
                            <h4>Due : 100</h4>
                            <hr>
                        </div>
                    </div>

                    <div class="row">
                            <div class="col-12 text-right">
                                <hr>
                               
                            
                                <button type="button" id="fromInvoiceSelectionBack" class="btn btn-secondary" >back</button>
                                <button type="button" id="fromInvoiceSelectionTo" class="btn btn-primary">Next</button>
                            </div>
                        </div>
                </div>
                <!-- invoice end -->



            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Sales chart
                <!-- ============================================================== -->
</div>
@endsection
