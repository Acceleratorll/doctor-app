<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin</title>
    
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script defer src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    
    {{-- CSS --}}
    {{-- Include CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css">
    <!-- Google Font: Source Sans Pro -->

    @yield('css')
    <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.1.2/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/icheck-bootstrap/3.0.1/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqvmap/1.5.1/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/overlayscrollbars/2.1.1/styles/overlayscrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs4.min.css"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/image-zoom.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <style>
        .select2 {
            width: 100%!important;
        }
        .tfoot::placeholder {
            color: black !important;
        }

        ::placeholder {
            color: white;
        }
            
/* Additional specificity if needed */
.form-control::placeholder {
    color: white;
}

    .modal-body {
        max-height: 60vh;
        overflow-y: auto;
    }
    </style>
    
</head>

<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-dark">
            <!-- Left navbar links -->
            {{-- <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="" class="nav-link">Home</a>
            </li>
            </ul> --}}
            <ul class="navbar-nav">
                <a href="" class="nav-link">
                    <li class="nav-item">
                        <p>Welcome back, {{ auth()->user()->name }}</p>
                    </li>
                </a>
            </ul>
                
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link">
                    <div id="datetime"></div>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="#" class="brand-link" style="text-align:center;">
                KLINIK
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="true">
                        <!-- Add icons to the links using the .nav-icon class
                        with font-awesome or any other icon font library -->

                        {{-- <li class="nav-item">
                            <a href="{{ url('/dashboard') }}" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li> --}}
                        <li class="nav-item">
                            <a href="{{ route('admin.dashboard.index') }}" class="nav-link">
                                <i class="nav-icon fa fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        @if(auth()->user()->role_id === 1)
                        <li class="nav-item">
                            <a href="{{ route('admin.dokter.index') }}" class="nav-link">
                                <i class="nav-icon fa fa-users"></i>
                                <p>
                                    Dokter
                                </p>
                            </a>
                        </li>
                        @endif
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-users"></i>
                                <p>
                                    Pegawai
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/admin/pegawai/create" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Tambah Pegawai</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/admin/pegawai" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Master Pegawai</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-users"></i>
                                <p>
                                    Pasien
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/admin/pasien/create" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Tambah Pasien</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/admin/pasien" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Master Pasien</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-retweet"></i>
                                <p>
                                    Tempat Praktik
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/admin/tempat/create" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Tambah Tempat</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/admin/tempat" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Master Tempat</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-retweet"></i>
                                <p>
                                    Pengumuman
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/admin/pengumuman/create" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Tambah Pengumuman</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/admin/pengumuman" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Master Pengumuman</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-retweet"></i>
                                <p>
                                    Jadwal
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/admin/jadwal/create" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Tambah Jadwal</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/admin/jadwal" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Master Jadwal</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-tags"></i>
                                <p>
                                    Reservasi
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/admin/waiting-list" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Wait to Approve</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.reservation.create') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Tambah Reservasi</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/admin/list-cancel" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Cancel Reservation</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.reservation.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Master Resevasi</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link ">
                                <i class="nav-icon fa fa-briefcase"></i>
                                <p>
                                    Rekam Medis
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/admin/medis/create" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Tambah Rekam Medis</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/admin/medis" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Master Rekam Medis</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('icd.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>ICD</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <form action="{{ route('logout') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <li class="nav-item">
                                <a href="" class="nav-link">
                                    <button type="submit" class="btn btn-danger">Logout</button>
                                </a>
                            </li>
                        </form>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        @yield('header') 
                        <!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container">
                    <!-- Main row -->
                    @yield('container')
                    
                    <!-- /.row (main row) -->
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery UI 1.11.4 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        function updateDatetime() {
            const now = new Date();
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit', second: '2-digit'};
            const formattedDatetime = now.toLocaleString('en-US', options);
        
            document.getElementById('datetime').textContent = formattedDatetime;
        }
        
        // Update the datetime every second
        setInterval(updateDatetime, 1000);
        
        // Initial update
        updateDatetime();
            
        $('select[data-role="select2"]').select2({
            theme: 'bootstrap',
            width: '100%'
        });
        $.widget.bridge('uibutton', $.ui.button)

    </script>
    <script src="{{ asset('js/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('js/image-zoom.js') }}"></script>

    <!-- Bootstrap 4 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.3.0/chart.min.js"></script>
    <!-- Sparkline -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-sparklines/2.1.2/jquery.sparkline.js"></script>
    <!-- JQVMap -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqvmap/1.0.1/jquery.vmap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqvmap/1.0.1/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-Knob/1.2.13/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.1.2/js/tempusdominus-bootstrap-4.min.js">
    </script>
    <!-- Summernote -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/overlayscrollbars/2.1.1/overlayscrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/js/demo.min.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/js/pages/dashboard2.min.js"></script>

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>
    <!-- Script Icon -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    
</body>
@yield('js')
</html>
