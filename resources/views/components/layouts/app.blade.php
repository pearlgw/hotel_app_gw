<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{ $title ?? 'Hotel App GW' }}</title>

    <!-- Custom fonts for this template-->
    <link href="/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="/assets/css/sb-admin-2.min.css" rel="stylesheet">

    <link href="/assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    @livewireStyles
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/dashboard" wire:navigate>
                <div class="sidebar-brand-text mx-3">Hotel App</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a wire:navigate class="nav-link" href="/dashboard">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">


            @role('super_admin')
                <!-- Heading -->
                <div class="sidebar-heading">
                    Super Admin
                </div>
                <!-- User Management -->
                <li class="nav-item">
                    <a wire:navigate class="nav-link" href="/user">
                        <i class="fas fa-user-cog fa-fw"></i>
                        <span>User</span>
                    </a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Admin & Staff -->
                <div class="sidebar-heading">
                    Admin & Staff
                </div>

                <li class="nav-item">
                    <a wire:navigate class="nav-link" href="/category">
                        <i class="fas fa-tags fa-fw"></i>
                        <span>Category Bedroom (Admin)</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a wire:navigate class="nav-link" href="/bedroom">
                        <i class="fas fa-bed fa-fw"></i>
                        <span>Bedroom</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a wire:navigate class="nav-link" href="/create-user-order">
                        <i class="fas fa-user-plus fa-fw"></i>
                        <span>Create User Order</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a wire:navigate class="nav-link" href="/reservation-order">
                        <i class="fas fa-calendar-check fa-fw"></i>
                        <span>Reservation Order</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a wire:navigate class="nav-link" href="/transaction">
                        <i class="fas fa-calendar-check fa-fw"></i>
                        <span>Cashier</span>
                    </a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Order Section -->
                <div class="sidebar-heading">
                    Order
                </div>

                <li class="nav-item">
                    <a wire:navigate class="nav-link" href="/bedrooms">
                        <i class="fas fa-door-open fa-fw"></i>
                        <span>Bedroom Available</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a wire:navigate class="nav-link" href="/reservation/select">
                        <i class="fas fa-clipboard-check fa-fw"></i>
                        <span>Selected Reservation</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a wire:navigate class="nav-link" href="/payment">
                        <i class="fas fa-credit-card fa-fw"></i>
                        <span>Payment</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a wire:navigate class="nav-link" href="/detail-payment">
                        <i class="fas fa-file-invoice-dollar fa-fw"></i>
                        <span>Detail Payment</span>
                    </a>
                </li>
            @endrole

            @role('admin')
                <div class="sidebar-heading">
                    Admin
                </div>
                <li class="nav-item">
                    <a wire:navigate class="nav-link" href="/category">
                        <i class="fas fa-tags fa-fw"></i>
                        <span>Category Bedroom</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a wire:navigate class="nav-link" href="/bedroom">
                        <i class="fas fa-bed fa-fw"></i>
                        <span>Bedroom</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a wire:navigate class="nav-link" href="/create-user-order">
                        <i class="fas fa-user-plus fa-fw"></i>
                        <span>Create User Order</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a wire:navigate class="nav-link" href="/reservation-order">
                        <i class="fas fa-calendar-check fa-fw"></i>
                        <span>Reservation Order</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a wire:navigate class="nav-link" href="/transaction">
                        <i class="fas fa-calendar-check fa-fw"></i>
                        <span>Cashier</span>
                    </a>
                </li>
            @endrole

            @role('staff')
                <div class="sidebar-heading">
                    Staff
                </div>
                <li class="nav-item">
                    <a wire:navigate class="nav-link" href="/bedroom">
                        <i class="fas fa-bed fa-fw"></i>
                        <span>Bedroom</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a wire:navigate class="nav-link" href="/create-user-order">
                        <i class="fas fa-user-plus fa-fw"></i>
                        <span>Create User Order</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a wire:navigate class="nav-link" href="/reservation-order">
                        <i class="fas fa-calendar-check fa-fw"></i>
                        <span>Reservation Order</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a wire:navigate class="nav-link" href="/transaction">
                        <i class="fas fa-calendar-check fa-fw"></i>
                        <span>Cashier</span>
                    </a>
                </li>
            @endrole

            @role('order')
                <div class="sidebar-heading">
                    Order
                </div>
                <li class="nav-item">
                    <a wire:navigate class="nav-link" href="/bedrooms">
                        <i class="fas fa-door-open fa-fw"></i>
                        <span>Bedroom Available</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a wire:navigate class="nav-link" href="/reservation/select">
                        <i class="fas fa-clipboard-check fa-fw"></i>
                        <span>Selected Reservation</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a wire:navigate class="nav-link" href="/payment">
                        <i class="fas fa-credit-card fa-fw"></i>
                        <span>Payment</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a wire:navigate class="nav-link" href="/detail-payment">
                        <i class="fas fa-file-invoice-dollar fa-fw"></i>
                        <span>Detail Payment</span>
                    </a>
                </li>
            @endrole

            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

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
                    {{-- <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small"
                                placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-info" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form> --}}

                    <div class="d-none d-sm-inline-block ml-md-3 my-2 my-md-0 text-gray-800" id="current-time">
                        <!-- JavaScript akan mengisi ini -->
                    </div>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span
                                    class="mr-2 d-none d-lg-inline text-gray-600 small">{{ auth()->user()->name }}</span>
                                <img class="img-profile rounded-circle" src="/assets/img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                {{-- <a class="dropdown-item" href="#">
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
                                </a> --}}
                                {{-- <div class="dropdown-divider"></div> --}}
                                <a class="dropdown-item" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    {{ $slot }}

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Hotel App 2025</span>
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
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="btn btn-danger" type="submit">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Bootstrap core JavaScript-->
    <script src="/assets/vendor/jquery/jquery.min.js"></script>
    <script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="/assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="/assets/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="/assets/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="/assets/js/demo/chart-area-demo.js"></script>
    <script src="/assets/js/demo/chart-pie-demo.js"></script>

    <!-- Page level plugins -->
    <script src="/assets/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="/assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="/assets/js/demo/datatables-demo.js"></script>

    <script>
        function updateTime() {
            const now = new Date();
            const options = {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
            };
            const timeString = now.toLocaleDateString('id-ID', options);
            document.getElementById('current-time').textContent = timeString;
        }

        // Update waktu setiap detik
        setInterval(updateTime, 1000);
        updateTime(); // Inisialisasi pertama
    </script>
</body>

</html>
