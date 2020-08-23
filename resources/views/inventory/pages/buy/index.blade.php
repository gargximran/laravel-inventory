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
    $("#zero_config1").DataTable();

    


  
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

                                                                                        <td>
                                                                                            <p>
                                                                                                <img src="/inventory/images/inventory/${v.image}" class="img-fluid table_image">
                                                                                            </p>
                                                                                        </td>
                                                                                        <td>
                                                                                            ${v.name}-${v.brandName}-${v.size}-${v.code}
                                                                                        </td>
                                                                                        <td>
                                                                                            <input class="inputNumber selectqty" style="width:45px;" type="number"  value="${v.qty}" min='1' data-inventory="${v.inventory}" >
                                                                                        </td>
                                                                                        <td>
                                                                                            <input class="inputNumber selectprice" value="${v.perPrice}" data-inventory="${v.inventory}" style="width:45px;" type="number">
                                                                                        </td>
                                                                                        <td>
                                                                                            <input data-inventory="${v.inventory}" class="inputNumber expireDay" style="width:45px;" value="${v.expireDay}" type="number"> day
                                                                                        </td>
                                                                                        <td class="perItemPrice" style="width:25px;">
                                                                                            ${v.total}
                                                                                        </td>
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
                                                                                        <td>
                                                                                            <p>
                                                                                                <img src="/inventory/images/inventory/${v.image}" class="img-fluid table_image">
                                                                                            </p>
                                                                                        </td>
                                                                                        <td>
                                                                                            ${v.name}-${v.brandName}-${v.size}-${v.code}
                                                                                        
                                                                                        </td>
                                                                                        <td>
                                                                                            <input class="inputNumber selectqty" style="width:45px;" type="number"  value="${v.qty}" min='1' data-inventory="${v.inventory}">
                                                                                        </td>
                                                                                        <td>
                                                                                            <input data-inventory="${v.inventory}" class="inputNumber selectprice" style="width:45px;" value="${v.perPrice}" type="number">
                                                                                        </td>

                                                                                        <td>
                                                                                            <input data-inventory="${v.inventory}" class="inputNumber expireDay" style="width:45px;" value="${v.expireDay}" type="number"> day
                                                                                        </td>
                                                                                        <td class="perItemPrice" style="width:25px;">
                                                                                            ${v.total}
                                                                                        </td>
                                                                                    </tr>`


                        
                    })
                
            }



            const quantityInput = document.getElementsByClassName('selectqty');
            const selectprice = document.getElementsByClassName('selectprice');
            const perItemPrice = document.getElementsByClassName('perItemPrice');
            const expireDay = document.getElementsByClassName('expireDay');


            for(let ind in expireDay){
                expireDay[ind].oninput = e => {
                    

                    selectedItems.filter((v, i) => {
                                if(v.inventory == e.target.dataset.inventory){
                                    selectedItems[i].expireDay = e.target.value
                                }
                                
                            }) 

                                                

                     
                  
                
                }
            }

          

            for(let index in quantityInput){
                quantityInput[index].oninput = e => {
                 let itemPrice = selectprice[index].value

                    
                  

                    selectedItems.filter((v, i) => {
                                if(v.inventory == e.target.dataset.inventory){
                                    selectedItems[i].qty = e.target.value
                                    selectedItems[i].total = e.target.value * selectedItems[i].perPrice
                                }
                                
                            }) 

                                                

                            perItemPrice[index].innerHTML = itemPrice * e.target.value+ " tk"
                  
                
                }
            }

            for(let ind in selectprice){
                selectprice[ind].oninput = e =>{
                    let quantity = quantityInput[ind].value
                    selectedItems.filter((v,i) => {
                        if(v.inventory == e.target.dataset.inventory){
                            selectedItems[i].perPrice = e.target.value
                            selectedItems[i].total = e.target.value * selectedItems[i].qty
                            perItemPrice[ind].innerHTML = quantity * e.target.value+ " tk"
                        }
                            
                    })

                }
            }
                
            
        }
    }
</script>
<script>
    const supplierTypeSelection = document.getElementById('supplier_selector_display');
    const newSupplierButton = document.getElementById('newSupplierbutton');


    const newSupplierForm = document.getElementById('new_supplier_form');
    const fromNewSupplierFormTo = document.getElementById('fromNewSupplierFormTo');
    const fromNewSupplierFormBack = document.getElementById('fromNewSupplierFormBack');

    const inventorySelection = document.getElementById('inventory_selection');
    const fromNewInventorySelectionBack = document.getElementById('fromNewInventorySelectionBack');
    const fromNewInventorySelectionTo = document.getElementById('fromNewInventorySelectionTo');

    const invoice_selection = document.getElementById('invoice_selection');
    const fromInvoiceSelectionBack = document.getElementById('fromInvoiceSelectionBack');
    const fromInvoiceSelectionTo = document.getElementById('fromInvoiceSelectionTo');


    const existingSupplierButton = document.getElementsByClassName('selectSupplier');
    for(let i in existingSupplierButton){
        existingSupplierButton[i].onclick = e =>{
            document.getElementById('sup_id').value = e.target.dataset.id

            document.getElementById('supplierNameShow1').innerHTML = e.target.dataset.name
            document.getElementById('supplierShopNameshow1').innerHTML = e.target.dataset.shop
            document.getElementById('supplierAddressShow1').innerHTML = e.target.dataset.address
            document.getElementById('supplierCityShow1').innerHTML = e.target.dataset.city
            document.getElementById('supplierPhoneShow1').innerHTML = e.target.dataset.phone
            document.getElementById('supplierEmailShow1').innerHTML = e.target.dataset.email



            document.getElementById('supplierNameShow2').innerHTML = e.target.dataset.name
            document.getElementById('supplierShopNameshow2').innerHTML = e.target.dataset.shop
            document.getElementById('supplierAddressShow2').innerHTML = e.target.dataset.address
            document.getElementById('supplierCityShow2').innerHTML = e.target.dataset.city
            document.getElementById('supplierPhoneShow2').innerHTML = e.target.dataset.phone
            document.getElementById('supplierEmailShow2').innerHTML = e.target.dataset.email


            supplierTypeSelection.style.display = 'none';
            newSupplierForm.style.display = 'none';
            inventorySelection.style.display = 'block';
            invoice_selection.style.display = 'none';
        }
    }



    supplierTypeSelection.style.display = 'block';
    newSupplierForm.style.display = 'none';
    inventorySelection.style.display = 'none';
    invoice_selection.style.display = 'none';


    newSupplierButton.onclick = ()=>{
        document.getElementById('sup_id').value = 0
        supplierTypeSelection.style.display = 'none';
        newSupplierForm.style.display = 'block';
        inventorySelection.style.display = 'none';
        invoice_selection.style.display = 'none';
    }

    fromNewSupplierFormTo.onclick = ()=>{
        if(!document.getElementById('supplierName').value || !document.getElementById('supplierPhone').value){
            return
        }
        supplierTypeSelection.style.display = 'none';
        newSupplierForm.style.display = 'none';
        inventorySelection.style.display = 'block';
        invoice_selection.style.display = 'none';
    }

    fromNewInventorySelectionTo.onclick = ()=>{
        let allTotal = 0;
        

        document.getElementById('inventories').innerHTML = ''
        document.getElementById('Selected_invoice').innerHTML = ''
        for(let r in selectedItems){

            document.getElementById('Selected_invoice').innerHTML += `<tr>
                                        <td><p><img src="/inventory/images/inventory/${selectedItems[r].image}" class="img-fluid table_image"></p></td>
                                        <td>${selectedItems[r].name}-${selectedItems[r].brandName}-${selectedItems[r].size}-${selectedItems[r].code}</td>
                                        <td>${selectedItems[r].qty}</td>
                                        <td>${selectedItems[r].perPrice}</td>
                                        <td>${selectedItems[r].expireDay} day</td>
                                        <td>${selectedItems[r].total}</td>
                                    </tr>`

            for(let xx in selectedItems[r]){

                if(xx != 'expireDay' && selectedItems[r][xx] == 0){
                    return
                }
               
                   
               


                if(xx == 'inventory'){
                    document.getElementById('inventories').innerHTML += `<input type="hidden" name="inventory_id[]" value="${selectedItems[r][xx]}">`
                }

                if(xx == 'qty'){
                    document.getElementById('inventories').innerHTML += `<input type="hidden" name="quantity[]" value="${selectedItems[r][xx]}">`
                }

                if(xx == 'perPrice'){
                    document.getElementById('inventories').innerHTML += `<input type="hidden" name="perPrice[]" value="${selectedItems[r][xx]}">`
                }

                if(xx == 'expireDay'){
                    document.getElementById('inventories').innerHTML += `<input type="hidden" name="expire[]" value="${selectedItems[r][xx]}">`
                }

                if(xx == 'total'){
                    allTotal += parseFloat(selectedItems[r][xx])
                    document.getElementById('inventories').innerHTML += `<input type="hidden" name="total[]" value="${selectedItems[r][xx]}">`
                }


            }
        }
      
        document.getElementById('invoice_price_before_discount').value = allTotal
        document.getElementById('invoice_price_before_discount1').innerHTML = allTotal
        document.getElementById('invoice_after_price_discount').value = allTotal
        document.getElementById('invoice_after_price_due').value = allTotal
        document.getElementById('totalToPay').innerHTML = allTotal
        document.getElementById('due').innerHTML = allTotal



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
        document.getElementById('Selected_invoice').innerHTML = ''

        document.getElementById('invoice_price_discount').value = 0
        document.getElementById('invoice_after_price_discount').value = 0
        document.getElementById('invoice_price_paid').value = 0
        document.getElementById('invoice_after_price_due').value = 0
        document.getElementById('inputOfDiscountfield').value= 0
        document.getElementById('paidInputField').value= 0
        document.getElementById('totalToPay').innerHTML = ''
        document.getElementById('due').innerHTML = ''



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
                      <div class="col-2 offset-5">
                        <div class="card card-hover" id="newSupplierbutton" style="cursor: pointer;">
                            <div class="box bg-success text-center">
                                <h1 class="font-light text-white"><i class="mdi mdi-chart-areaspline"></i></h1>
                                <h6 class="text-white">New Supplier</h6>
                            </div>
                        </div>
                      </div>
                  </div>

                  <div class="row">
                      <div class="col-12">
                          <h2 class="text-center">Choose From Existing Supplier</h2>
                        <div class="table-responsive">
                            <table
                                id="zero_config1"
                                class="table table-bordered table-hover text-center"
                            >
                                <thead>
                                    <tr>
                                        
                                        <th>Name</th>
                                        <th>Type</th>
                                        <th>Shop Name</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th>City</th>
                                        <th>Action's</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($suppliers as $supplier)
                                    <tr>
                                       
                                        <td>{{ $supplier->name }}</td>
                                        <td>{{ $supplier->type }}</td>
                                        <td>{{ $supplier->shop_name }}</td>
                                        <td>{{ $supplier->phone }}</td>
                                        <td>{{ $supplier->address }}</td>
                                        <td>{{ $supplier->city }}</td>
                                        <td>
                                            <button class="btn btn-info selectSupplier" data-id="{{ $supplier->id }}" data-name="{{ $supplier->name }}" data-type="{{ $supplier->type }}" data-shop="{{ $supplier->shop_name }}" data-phone="{{ $supplier->phone }}" data-address="{{ $supplier->address }}" data-city="{{ $supplier->city }}" data-email="{{ $supplier->email }}">Select Supplier</button>
                                                                                   
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
                                    <input name="name" id="supplierName" type="text" oninput="document.getElementById('sup_name').value = this.value; document.getElementById('supplierNameShow1').innerHTML = this.value; document.getElementById('supplierNameShow2').innerHTML = this.value;" required class="form-control" placeholder="Ex: John Doe">
                                </div>

                                <div class="form-group m-t-20">
                                    <label>Shop Name <small class="text-muted"></small></label>
                                    <input name="shop_name" oninput="document.getElementById('sup_shop_name').value = this.value; document.getElementById('supplierShopNameshow1').innerHTML = this.value; document.getElementById('supplierShopNameshow2').innerHTML = this.value;" type="text" class="form-control" placeholder="Ex: SST tech">
                                </div>

                                <div class="form-group m-t-20">
                                    <label>Supplier type <small class="text-muted"></small></label>
                                    <select onchange="document.getElementById('sup_type').value = this.value;" name="type" class="form-control">
                                        <option value="0">Select Supplier Type</option>
                                        <option value='1'>Whole Saler</option>
                                        <option value='2'>Distributor</option>
                                        <option value='3'>Broker</option>
                                    </select>
                                </div>


                                <div class="form-group m-t-20">
                                    <label>Address Line <small class="text-muted"></small></label>
                                    <input oninput="document.getElementById('sup_address').value = this.value; document.getElementById('supplierAddressShow1').innerHTML = this.value; document.getElementById('supplierAddressShow2').innerHTML = this.value; " name="address" type="text"  class="form-control" placeholder="Ex: Uttara-11, house-2, road-12">
                                </div>

                                <div class="form-group m-t-20">
                                    <label>City <small class="text-muted"></small></label>
                                    <input oninput="document.getElementById('sup_city').value = this.value;document.getElementById('supplierCityShow1').innerHTML = this.value; document.getElementById('supplierCityShow2').innerHTML = this.value; " name="city" type="text"  class="form-control" placeholder="Ex: Uttara">
                                </div>


                                


                            </div>
                            <div class="col-md-6">
                                <div class="form-group m-t-20">
                                    <label>Email Address</label>
                                    <input oninput="document.getElementById('sup_email').value = this.value; document.getElementById('supplierEmailShow1').innerHTML = this.value; document.getElementById('supplierEmailShow2').innerHTML = this.value;" name="email" type="text"  class="form-control" placeholder="Ex: example@mail.com">
                                </div>

                                <div class="form-group m-t-20">
                                    <label>Phone <small class="text-muted"></small></label>
                                    <input id="supplierPhone" oninput="document.getElementById('sup_phone').value = this.value; document.getElementById('supplierPhoneShow1').innerHTML = this.value; document.getElementById('supplierPhoneShow2').innerHTML = this.value;" name="phone" type="text"  class="form-control" placeholder="Ex: 01734567898">
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
                        <div class="col-12">
                            <h2>Supplier Name : <span class="font-weight-light" id="supplierNameShow1">N/A</span> </h2>
                            <h3>Shop Name : <span class="font-weight-light" id="supplierShopNameshow1">N/A</span></h3>
                            <h4>Address : <span class="font-weight-light" id="supplierAddressShow1">N/A</span></h4>
                            <h4>City : <span class="font-weight-light" id="supplierCityShow1">N/A</span></h4>
                            <h4>Phone : <span class="font-weight-light" id="supplierPhoneShow1">N/A</span></h4>
                            <h4>Email : <span class="font-weight-light" id="supplierEmailShow1">N/A</span></h4>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6 border border-secondary">
                            <h3 class="text-center border-bottom">Selected Inventory</h3>
                            <table class="table table-hover">
                                <thead>
                                    <th>Image</th>
                                    <th>Name-Brand-Size-Code</th>
                                    <th>Qty.</th>
                                    <th>Price Per Item</th>
                                    <th>Expire Day</th>
                                    <th>Total price</th>
                                </thead>
                                <tbody id="Selected_itemShow">
                                    
                                </tbody>
                            </table>
                        </div>


                        <div class="col-md-6">
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
                                                <input type="checkbox" data-inventory="{{$inventory->id}}"  data-name="{{$inventory->name}}" data-image="{{$inventory->image}}" data-brand-name="{{$inventory->brand->name}}" data-size="{{$inventory->size}}" data-code="{{$inventory->code}}" data-qty="0" data-per-price="0" data-total="0" data-expire-day="0"  class="selectInventoryToBuy">
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





                <!-- invoice  start -->
                <div class="card-body" id="invoice_selection">
                    <div class="row">
                        <div class="col-12">
                            <h2>Supplier Name : <span class="font-weight-light" id="supplierNameShow2">N/A</span> </h2>
                            <h3>Shop Name : <span class="font-weight-light" id="supplierShopNameshow2">N/A</span></h3>
                            <h4>Address : <span class="font-weight-light" id="supplierAddressShow2">N/A</span></h4>
                            <h4>City : <span class="font-weight-light" id="supplierCityShow2">N/A</span></h4>
                            <h4>Phone : <span class="font-weight-light" id="supplierPhoneShow2">N/A</span></h4>
                            <h4>Email : <span class="font-weight-light" id="supplierEmailShow2">N/A</span></h4>
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
                                    <th>Expire Day</th>
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
                            <h4>Total Price Before Discount : <span id="invoice_price_before_discount1"></span></h4>
                            <h4>Discount : <input id="inputOfDiscountfield" type="number" class="inputNumber"  oninput="document.getElementById('totalToPay').innerHTML = parseFloat(document.getElementById('invoice_price_before_discount1').innerHTML) - this.value;document.getElementById('invoice_price_discount').value = this.value;document.getElementById('invoice_after_price_discount').value = parseFloat(document.getElementById('invoice_price_before_discount1').innerHTML) - this.value; " value="0"></h4>

                            <h4>Total Price To Pay : <span id="totalToPay"></span></h4>

                            <h4>Paid : <input id="paidInputField" type="number" class="inputNumber" oninput="document.getElementById('due').innerHTML = parseFloat(document.getElementById('totalToPay').innerHTML) - this.value; document.getElementById('invoice_after_price_due').value = parseFloat(document.getElementById('totalToPay').innerHTML) - this.value; document.getElementById('invoice_price_paid').value = this.value" value="0"></h4>

                            <h4>Due : <span id="due"></span></h4>
                            <hr>
                        </div>
                    </div>
                    <form action="{{route('buy_form_supplier_store')}}" method="POST" id="invoiceForm" class="d-none">

                        @csrf
                        <div class="d-none" id="supplier_detail">
                            <input type="hidden" name="sup_name" id="sup_name">
                            <input type="hidden" name="sup_id" id="sup_id">
                            <input type="hidden" name="sup_email" id="sup_email">
                            <input type="hidden" name="sup_shop_name" id="sup_shop_name">
                            <input type="hidden" value="0" name="sup_type" id="sup_type">
                            <input type="hidden" name="sup_address" id="sup_address">
                            <input type="hidden" name="sup_city" id="sup_city">
                            <input type="hidden" name="sup_phone" id="sup_phone">
                        </div>
                        <div class="d-none" id="invoice">
                            <input type="hidden" name="invoice_price_before_discount"  id="invoice_price_before_discount">
                            <input type="hidden" name="invoice_price_discount" value="0"  id="invoice_price_discount">
                            <input type="hidden" name="invoice_price_after_discount" required value="0" id="invoice_after_price_discount">
                            <input type="hidden" name="invoice_price_paid" value="0"  id="invoice_price_paid">
                            <input type="hidden" name="invoice_price_due" value="0"  id="invoice_after_price_due">
                        </div>
                        <div class="d-none" id="inventories">

                        </div>
                    </form>

                    <div class="row">
                            <div class="col-12 text-right">
                                <hr>
                               
                            
                                <button type="button" id="fromInvoiceSelectionBack" class="btn btn-secondary" >back</button>
                                <button type="button" onclick="document.getElementById('invoiceForm').submit();" class="btn btn-primary">Confirm</button>
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
