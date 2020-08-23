<aside class="left-sidebar" data-sidebarbg="skin5">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav" class="p-t-30">
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{route('inventory_index')}}" aria-expanded="false">
                                <i class="mdi mdi-view-dashboard"></i>
                                <span class="hide-menu">Dashboard</span>
                            </a>
                        </li>


                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('employee_view_table') }}" aria-expanded="false">
                                <i class="mdi mdi-human-male"></i>
                                <span class="hide-menu">Employee</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('customer_view_table') }}" aria-expanded="false">
                                <i class="mdi mdi-cart-outline"></i>
                                <span class="hide-menu">Manage Customers</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('supplier_view') }}" aria-expanded="false">
                                <i class="mdi mdi-truck-delivery"></i>
                                <span class="hide-menu">Manage Supplier</span>
                            </a>
                        </li>


                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('brand_view') }}" aria-expanded="false">
                                <i class="mdi mdi-tag"></i>
                                <span class="hide-menu">Manage Brand</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('inventory_view') }}" aria-expanded="false">
                                <i class="mdi mdi-umbrella"></i>
                                <span class="hide-menu">Inventories</span>
                            </a>
                        </li>
                       

                        
                        <li class="sidebar-item"> 
                            <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                                <i class="mdi mdi-receipt"></i>
                                <span class="hide-menu">Buy Action </span>
                            </a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item ml-3">
                                    <a href="{{route('buy_from_supplier')}}" class="sidebar-link">
                                        <i class="mdi mdi-note-outline"></i>
                                        <span class="hide-menu"> Import Inventory </span>
                                    </a>
                                </li>
                                
                            </ul>
                        </li>



                        <li class="sidebar-item"> 
                            <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                                <i class="mdi mdi-receipt"></i>
                                <span class="hide-menu">Buy History </span>
                            </a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item ml-3">
                                    <a href="{{route('buy_history')}}" class="sidebar-link">
                                        <i class="mdi mdi-note-outline"></i>
                                        <span class="hide-menu"> Inventory Buy History </span>
                                    </a>
                                </li>

                                <li class="sidebar-item ml-3">
                                    <a href="{{route('invoice_history')}}" class="sidebar-link">
                                        <i class="mdi mdi-note-outline"></i>
                                        <span class="hide-menu"> Invoices </span>
                                    </a>
                                </li>
                                
                            </ul>
                        </li>



                        <li class="sidebar-item"> 
                            <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                                <i class="mdi mdi-receipt"></i>
                                <span class="hide-menu">Stock Management </span>
                            </a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item ml-3">
                                    <a href="{{route('all_stock')}}" class="sidebar-link">
                                        <i class="mdi mdi-note-outline"></i>
                                        <span class="hide-menu"> All Stock Available </span>
                                    </a>
                                </li>

                                <li class="sidebar-item ml-3">
                                    <a href="{{route('expired_stock')}}" class="sidebar-link">
                                        <i class="mdi mdi-note-outline"></i>
                                        <span class="hide-menu"> Expired Stock </span>
                                    </a>
                                </li>


                                <li class="sidebar-item ml-3">
                                    <a href="{{route('finished_stock')}}" class="sidebar-link">
                                        <i class="mdi mdi-note-outline"></i>
                                        <span class="hide-menu"> Finished Stock </span>
                                    </a>
                                </li>


                                
                            </ul>
                        </li>
                        
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>