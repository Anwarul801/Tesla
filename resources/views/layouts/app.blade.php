<!doctype html>

{{--
 @Author: Anwarul
 @Date: 2025-11-17 15:04:07
 @LastEditors: Anwarul
 @LastEditTime: 2025-11-17 18:36:57
 @Description: Innova IT
 --}}
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

      <link rel="shortcut icon" href="{{ asset('backend')}}/images/favicon.ico">
      <link rel="stylesheet" type="text/css" href="{{ asset('backend/libs/toastr/build/toastr.min.css') }}">

        <!-- jquery.vectormap css -->
        <link href="{{ asset('backend')}}/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />

        <!-- DataTables -->
        <link href="{{ asset('backend')}}/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />

        <!-- Responsive datatable examples -->
        <link href="{{ asset('backend')}}/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

        <!-- Bootstrap Css -->
        <link href="{{ asset('backend')}}/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{ asset('backend')}}/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{ asset('backend')}}/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
            @yield('css')

</head>
<body data-topbar="dark">
      <!-- <body data-layout="horizontal" data-topbar="dark"> -->
        <!-- Begin page -->
        <div id="layout-wrapper">
             @include('layouts.header')
            <!-- ========== Left Sidebar Start ========== -->
           @include('layouts.left_sidebar')
            <!-- Left Sidebar End -->
            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">
                <div class="page-content">
                    <div class="container-fluid">
                        <main>
                           {{ $slot ?? '' }}
                       </main>
                    @yield('content')
                        <!-- end row -->
                    </div>

                </div>
                <!-- End Page-content -->
                 @include('layouts.footer')

            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

        <!-- Right Sidebar -->
        @include('layouts.right_sidebar')

        <!-- /Right-bar -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>
           @stack('modals')


       <!-- JAVASCRIPT -->
        <script src="{{ asset('backend')}}/libs/jquery/jquery.min.js"></script>
        <script src="{{ asset('backend')}}/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('backend')}}/libs/metismenu/metisMenu.min.js"></script>
        <script src="{{ asset('backend')}}/libs/simplebar/simplebar.min.js"></script>
        <script src="{{ asset('backend')}}/libs/node-waves/waves.min.js"></script>


        <!-- apexcharts -->
        <script src="{{ asset('backend')}}/libs/apexcharts/apexcharts.min.js"></script>

        <!-- jquery.vectormap map -->
        <script src="{{ asset('backend')}}/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js"></script>
        <script src="{{ asset('backend')}}/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-us-merc-en.js"></script>

        <!-- Required datatable js -->
        <script src="{{ asset('backend')}}/libs/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="{{ asset('backend')}}/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>

        <!-- Responsive examples -->
        <script src="{{ asset('backend')}}/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="{{ asset('backend')}}/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

        <script src="{{ asset('backend')}}/js/pages/dashboard.init.js"></script>

        <!-- App js -->
        <script src="{{ asset('backend')}}/js/app.js"></script>

 <!-- toastr plugin -->
        <script src="{{ asset('backend/libs/toastr/build/toastr.min.js') }}"></script>
        @stack('footer_script')
        <script> toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": 300,
                "hideDuration": 1000,
                "timeOut": 5000,
                "extendedTimeOut": 1000,
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }</script>
            @if($errors->any())
            @foreach ($errors->all() as $error)
                <script>
                    var msg = '{{ $error }}';
                    toastr.info(msg);
                </script>
            @endforeach
        @endif

        @if(session('fail'))
            <script>
                var msg = '{{ session('fail') }}';

                toastr.error(msg);
            </script>
        @endif
        @if(session('success'))
            <script>
                var msg = '{{ session('success') }}';
                toastr.success(msg);
            </script>
        @endif
        @stack('scripts')

      <script>
          document.addEventListener('input', function (e) {
              if (e.target.classList.contains('number')) {
                  let value = e.target.value;
                  value = value.replace(/[^0-9.]/g, '');
                  const parts = value.split('.');
                  if (parts.length > 2) {
                      value = parts[0] + '.' + parts.slice(1).join('');
                  }

                  e.target.value = value;
              }
          });
      </script>

</body>
</html>
