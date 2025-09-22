    <div class="left-side-menu">

                <div class="h-100" data-simplebar>

                    <!-- User box -->
                

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">

                        <ul id="side-menu">

                            <li class="menu-title">Navigation</li>
                
          <li>
            <a href="{{ url('/dashboard') }}">
               <i class="mdi mdi-view-dashboard-outline"></i>
                <span> Dashboards </span>
            </a>
        </li>


        @if(Auth::user()->can('pos.menu'))
           <li>
            <a href="{{ route('pos') }}">
                <span class="badge bg-pink float-end">Hot</span>
               <i class="mdi mdi-view-dashboard-outline"></i>
                <span> POS </span>
            </a>
        </li>
        @endif




                            <li class="menu-title mt-2">Apps</li>

                           
 @if(Auth::user()->can('employee.menu'))
    <li>
        <a href="#sidebarEcommerce" data-bs-toggle="collapse">
            <i class="mdi mdi-cart-outline"></i>
            <span> Employee Manage  </span>
            <span class="menu-arrow"></span>
        </a>
        <div class="collapse" id="sidebarEcommerce">
            <ul class="nav-second-level">
                @if(Auth::user()->can('employee.all'))
                <li>
                    <a href="{{ route('all.employee') }}">All Employee</a>
                </li>
                @endif
                @if(Auth::user()->can('employee.add'))
                <li>
                    <a href="{{ route('add.employee') }}">Add Employee </a>
                </li>
               @endif
            </ul>
        </div>
    </li>
@endif
                            
 @if(Auth::user()->can('customer.menu'))
            <li>
                <a href="#sidebarCrm" data-bs-toggle="collapse">
                    <i class="mdi mdi-account-multiple-outline"></i>
                    <span> Customer Manage   </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarCrm">
                    <ul class="nav-second-level">
     @if(Auth::user()->can('customer.all'))
    <li>
        <a href="{{ route('all.customer') }}">All Customer</a>
    </li>
    @endif
     @if(Auth::user()->can('customer.add'))
    <li>
        <a href="{{ route('add.customer') }}">Add Customer</a>
    </li>
    @endif
                         
                    </ul>
                </div>
            </li>
      @endif

 @if(Auth::user()->can('supplier.menu'))
        <li>
            <a href="#sidebarEmail" data-bs-toggle="collapse">
                <i class="mdi mdi-email-multiple-outline"></i>
                <span> Supplier Manage </span>
                <span class="menu-arrow"></span>
            </a>
            <div class="collapse" id="sidebarEmail">
                <ul class="nav-second-level">
                    <li>
                        <a href="{{ route('all.supplier') }}">All Supplier</a>
                    </li>
                    <li>
                        <a href="{{ route('add.supplier') }}">Add Supplier</a>
                    </li>
                    <li>
                        <a href="{{ route('details.supplier', ['id' => 1]) }}">Supplier Details</a>
                    </li>
                    
                </ul>
            </div>
        </li>
@endif

 @if(Auth::user()->can('salary.menu'))
        <li>
            <a href="#salary" data-bs-toggle="collapse">
                <i class="mdi mdi-email-multiple-outline"></i>
                <span> Employee Salary </span>
                <span class="menu-arrow"></span>
            </a>
            <div class="collapse" id="salary">
                <ul class="nav-second-level">
                    <li>
                        <a href="{{ route('add.advance.salary') }}">Add Advance Salary</a>
                    </li>
                    <li>
                        <a href="{{ route('all.advance.salary') }}">All Advance Salary</a>
                    </li>

                     <li>
                        <a href="{{ route('pay.salary') }}">Pay Salary</a>
                    </li> 

                    <li>
                        <a href="{{ route('month.salary') }}">Last Month Salary</a>
                    </li>
                    
                </ul>
            </div>
        </li>
@endif


 @if(Auth::user()->can('attendence.menu'))
        <li>
            <a href="#attendence" data-bs-toggle="collapse">
                <i class="mdi mdi-email-multiple-outline"></i>
                <span> Employee Attendence </span>
                <span class="menu-arrow"></span>
            </a>
            <div class="collapse" id="attendence">
                <ul class="nav-second-level">
                    <li>
                        <a href="{{ route('employee.attend.list') }}">Employee Attendence List </a>
                    </li>
                    @if(Auth::user()->can('attendence.add'))
                    <li>
                        <a href="{{ route('add.employee.attend') }}">Add Employee Attendence</a>
                    </li>
                    @endif
                </ul>
            </div>
        </li>

@endif
 @if(Auth::user()->can('category.menu'))
        <li>
            <a href="#category" data-bs-toggle="collapse">
                <i class="mdi mdi-email-multiple-outline"></i>
                <span> Category </span>
                <span class="menu-arrow"></span>
            </a>
            <div class="collapse" id="category">
                <ul class="nav-second-level">
                    <li>
                        <a href="{{ route('all.category') }}">All Category </a>
                    </li>
                    @if(Auth::user()->can('category.add'))
                    <li>
                        <a href="{{ route('all.category') }}">Add Category</a>
                    </li>
                    @endif
                </ul>
            </div>
        </li>
@endif
 @if(Auth::user()->can('product.menu'))
         <li>
            <a href="#product" data-bs-toggle="collapse">
                <i class="mdi mdi-email-multiple-outline"></i>
                <span> Products  </span>
                <span class="menu-arrow"></span>
            </a>
            <div class="collapse" id="product">
                <ul class="nav-second-level">
                    <li>
                        <a href="{{ route('all.product') }}">All Product </a>
                    </li>

                     <li>
                        <a href="{{ route('add.product') }}">Add Product </a>
                    </li>
                     <li>
                        <a href="{{ route('import.product') }}">Import Product </a>
                    </li>
                    @if(Auth::user()->can('product.export'))
                    <li>
                        <a href="{{ route('export') }}">Export Product</a>
                    </li>
                    @endif
                    @if(Auth::user()->can('product.barcode'))
                    <li>
                        <a href="{{ route('barcode.product', ['id' => 1]) }}">Barcode Product</a>
                    </li>
                    @endif
                </ul>
            </div>
        </li>

@endif
 @if(Auth::user()->can('orders.menu'))
 <li>
    <a href="#orders" data-bs-toggle="collapse">
        <i class="mdi mdi-email-multiple-outline"></i>
        <span> Orders  </span>
        <span class="menu-arrow"></span>
    </a>
    <div class="collapse" id="orders">
        <ul class="nav-second-level">
            <li>
                <a href="{{ route('pending.order') }}">Pending Orders </a>
            </li>

             <li>
                <a href="{{ route('complete.order') }}">Complete Orders </a>
            </li>

            <li>
                <a href="{{ route('pending.due') }}">Pending Due </a>
            </li>
            @if(Auth::user()->can('orders.view'))
            <li>
                <a href="{{ route('order.details', ['order_id' => 1]) }}">Order Details</a>
            </li>
            @endif
            @if(Auth::user()->can('orders.download'))
            <li>
                <a href="{{ route('order.invoice-download', ['order_id' => 1]) }}">Download Invoice</a>
            </li>
            @endif
        </ul>
    </div>
</li>
@endif
 @if(Auth::user()->can('stock.menu'))
 <li>
    <a href="#stock" data-bs-toggle="collapse">
        <i class="mdi mdi-email-multiple-outline"></i>
        <span> Stock Manage   </span>
        <span class="menu-arrow"></span>
    </a>
    <div class="collapse" id="stock">
        <ul class="nav-second-level">
            <li>
                <a href="{{ route('stock.manage') }}">Stock </a>
            </li>
 
        
        </ul>
    </div>
</li>
@endif
 @if(Auth::user()->can('roles.menu'))
 <li>
    <a href="#permission" data-bs-toggle="collapse">
        <i class="mdi mdi-email-multiple-outline"></i>
        <span> Roles And Permission    </span>
        <span class="menu-arrow"></span>
    </a>
    <div class="collapse" id="permission">
        <ul class="nav-second-level">
            <li>
                <a href="{{ route('all.permission') }}">All Permission </a>
            </li>

            <li>
                <a href="{{ route('all.roles') }}">All Roles </a>
            </li>

             <li>
                <a href="{{ route('add.roles.permission') }}">Roles in Permission </a>
            </li>

             <li>
                <a href="{{ route('all.roles.permission') }}">All Roles in Permission </a>
            </li>
            @if(Auth::user()->can('permission.add'))
            <li>
                <a href="{{ route('add.permission') }}">Add Permission</a>
            </li>
            @endif
            @if(Auth::user()->can('permission.edit'))
            <li>
                <a href="{{ route('edit.permission', ['id' => 1]) }}">Edit Permission</a>
            </li>
            @endif
            @if(Auth::user()->can('roles.add'))
            <li>
                <a href="{{ route('add.roles') }}">Add Roles</a>
            </li>
            @endif
            @if(Auth::user()->can('roles.edit'))
            <li>
                <a href="{{ route('edit.roles', ['id' => 1]) }}">Edit Roles</a>
            </li>
            @endif
        </ul>
    </div>
</li>

@endif
 @if(Auth::user()->can('admin.menu'))
 <li>
    <a href="#admin" data-bs-toggle="collapse">
        <i class="mdi mdi-email-multiple-outline"></i>
        <span> Setting Admin User    </span>
        <span class="menu-arrow"></span>
    </a>
    <div class="collapse" id="admin">
        <ul class="nav-second-level">
            <li>
                <a href="{{ route('all.admin') }}">All Admin </a>
            </li>

            <li>
                <a href="{{ route('add.admin') }}">Add Admin </a>
            </li>
            @if(Auth::user()->can('admin.edit'))
            <li>
                <a href="{{ route('edit.admin', ['id' => 1]) }}">Edit Admin</a>
            </li>
            @endif
        </ul>
    </div>
</li>
@endif

                             
                          

                            <li class="menu-title mt-2">Custom</li>

 @if(Auth::user()->can('expense.menu'))
                        <li>
                            <a href="#sidebarAuth" data-bs-toggle="collapse">
                                <i class="mdi mdi-account-circle-outline"></i>
                                <span>Expense </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebarAuth">
    <ul class="nav-second-level">
        <li>
            <a href="{{ route('add.expense') }}">Add Expense</a>
        </li>
        <li>
            <a href="{{ route('today.expense') }}">Today Expense</a>
        </li>
        <li>
            <a href="{{ route('month.expense') }}">Monthly Expense</a>
        </li>
        <li>
            <a href="{{ route('year.expense') }}">Yearly Expense</a>
        </li>
        @if(Auth::user()->can('expense.edit'))
        <li>
            <a href="{{ route('edit.expense', ['id' => 1]) }}">Edit Expense</a>
        </li>
        @endif
    </ul>
                            </div>
                        </li>

@endif

    <li>
                            <a href="#backup" data-bs-toggle="collapse">
                                <i class="mdi mdi-account-circle-outline"></i>
                                <span>Database Backup  </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="backup">
    <ul class="nav-second-level">
        <li>
            <a href="{{ route('database.backup') }}">Database Backup </a>
        </li>
    </ul>
           </div>
          </li>



                         

                         
 
                          

                               
                                    </ul>
                                </div>
                            </li>
                        </ul>

                    </div>
                    <!-- End Sidebar -->

                    <div class="clearfix"></div>

                </div>
                <!-- Sidebar -left -->

            </div>