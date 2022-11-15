<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title')</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('backend/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('backend/css/sb-admin-2.min.css') }}" rel="stylesheet">
    @yield('css')

</head>

<body id="page-top">
<style>
    a:hover{
        text-decoration: none
    }
</style>
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-shopping-cart "></i>
                    {{-- <i class="fas fa-laugh-wink"></i> --}}
                </div>
                <div class="sidebar-brand-text mx-3">{{ config("app.name") }}</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item  {{ (url()->current() == route('dashboard')) ? 'active' : ''  }}">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            <li
                class="nav-item {{ (url()->current() == route('product.index') || url()->current() == route('category.index') || url()->current() == route('brand.index') ) ? 'active' : '' }}">

                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="false" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Product Mangement</span>
                </a>
                <div id="collapseTwo"
                    class="collapse {{ (url()->current() == route('product.index') || url()->current() == route('category.index') || url()->current() == route('brand.index') ) ? 'show' : '' }}"
                    aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Product Mangement:</h6>
                        <a class="collapse-item {{ (url()->current() == route('product.index')) ? 'active' : '' }}"
                            href="{{ route('product.index') }}">Product</a>
                        <a class="collapse-item {{ (url()->current() == route('category.index')) ? 'active' : '' }}"
                            href="{{ route('category.index') }}">Category</a>
                        <a class="collapse-item {{ (url()->current() == route('brand.index')) ? 'active' : '' }}"
                            href="{{ route('brand.index') }}">Brand</a>
                    </div>
                </div>

            </li>
            <li
                class="nav-item {{ (url()->current() == route('supplier.index') || url()->current() == route('supplier.index') || url()->current() == route('supplier.index') ) ? 'active' : '' }}">

                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#supplier"
                    aria-expanded="false" aria-controls="supplier">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Supplier</span>
                </a>
                <div id="supplier"
                    class="collapse {{ (url()->current() == route('supplier.index') || url()->current() == route('supplier.index') || url()->current() == route('supplier.index') ) ? 'show' : '' }}"
                    aria-labelledby="supplier" data-parent="#accordionSidebar" style="">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Supplier:</h6>
                        <a class="collapse-item {{ (url()->current() == route('supplier.index')) ? 'active' : '' }}"
                            href="{{ route('supplier.index') }}">Supplier</a>
                        <a class="collapse-item {{ (url()->current() == route('supplier.index')) ? 'active' : '' }}"
                            href="{{ route('supplier.index') }}">Due Supplier</a>
                        <a class="collapse-item {{ (url()->current() == route('supplier.index')) ? 'active' : '' }}"
                            href="{{ route('supplier.index') }}">Paid Supplier</a>
                    </div>
                </div>

            </li>
            {{-- <li class="nav-item  {{ (url()->current() == route('accounttype.index')) ? 'active' : ''  }}">
                <a class="nav-link" href="{{ route('accounttype.index') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Account Type</span></a>
            </li>
            <li class="nav-item  {{ (url()->current() == route('AllTranaction')) ? 'active' : ''  }}">
                <a class="nav-link" href="{{ route('AllTranaction') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>All Transaction</span></a>
            </li> --}}

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->


        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->

                        <!-- Nav Item - Alerts -->


                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ auth()->user()->name
                                    }}</span>
                                <img class="img-profile rounded-circle"
                                    src="{{ Avatar::create(auth()->user()->name)->toBase64() }}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a onclick="event.preventDefault();document.getElementById('from_logout').submit()"
                                    class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                                <form action="{{ route('logout') }}" id="from_logout" method="POST">
                                    @csrf
                                </form>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->
                <!-- Begin Page Content -->
                <div @class(['container-fluid','refresh']) id="refresh">
                    @yield('content')

                </div>
                <!-- /.container-fluid -->



            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; {{ config('app.name') }} {{ now()->format('Y') }}</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" id="Modal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    
</div>


    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('backend/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('backend/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ ('backend/js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('backend/vendor/chart.js/Chart.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('backend/js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('backend/js/demo/chart-pie-demo.js') }}"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script> --}}

    @yield('script_js')

</body>

</html>