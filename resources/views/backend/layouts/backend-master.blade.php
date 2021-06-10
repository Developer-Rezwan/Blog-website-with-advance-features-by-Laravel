<!DOCTYPE html>
<html lang="{{app()->getLocale()}}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <meta name="author" content="developer-Rezwan">

    <title>{{$title}}</title>
    <!-- Custom styles for this template-->
    <link href="{{mix('backend/css/app.css')}}" rel="stylesheet">
</head>

<body id="page-top" style="background: white !important">

    {{-- Sweet alert --}}
    @include('sweetalert::alert')
    <!-- Page Wrapper -->
    <div id="wrapper" class="app">

        <!-- Sidebar -->
        @includeUnless(request()->is(['login' , 'sign-up' , 'forgotten-password' , 'verify-phone' ,
        'new-password']),'backend.layouts.partials._sitebar')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                @includeUnless(request()->is(['login' , 'sign-up' , 'forgotten-password' , 'verify-phone' ,
                'new-password']),'backend.layouts.partials._navbar')
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    @if (session()->has('message'))
                    <div class="alert {{ session('class') }} text-center">{{session('message')}}</div>
                    @endif
                    @yield('main-content')
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; 2021 | All Rights Reserved By <a href="#">Developer-Rezwan</a></span>
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
                    <a class="btn btn-primary" href="{{route('logout')}}">Logout</a>
                </div>
            </div>
        </div>
    </div>
    {{-- Main Js --}}
    <script src="{{mix('backend/js/app.js')}}"></script>
</body>

</html>
