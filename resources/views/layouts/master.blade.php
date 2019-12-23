<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Rita</title>

    <!-- Bootstrap -->
    <link href="cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link href="{{asset(url('public/vendors/bootstrap/dist/css/bootstrap.min.css'))}}" rel="stylesheet">


    <link href="{{url(asset('public/vendors/datatables.net-bs/css/dataTables.bootstrap.css'))}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{asset(url('public/vendors/font-awesome/css/font-awesome.min.css'))}}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{asset(url('public/vendors/nprogress/nprogress.css'))}}" rel="stylesheet">
    <!-- bootstrap-wysiwyg -->
    <link href="{{asset(url('public/vendors/google-code-prettify/bin/prettify.min.css'))}}" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="{{asset(url('public/build/css/custom.min.css'))}}" rel="stylesheet">
    <link href="{{asset(url('public/resource/customization.css'))}}" rel="stylesheet">


    <style>

        .nav .navbar-nav{

        }
    </style>
</head>



<!-- ============================================================== -->
<body class="nav-md">
<div class="container body">
    <div class="main_container">


        @include('partials.left_sidebar_top_navbar')

        <!-- page content -->
        <div class="right_col" role="main">

            <div class="">

                <div class="clearfix"></div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="x_panel">
                            <div class="x_title">


{{--                                <h2>Info</h2>--}}

                                @yield('heading-title')

                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">

                                    @yield('content')


                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
            <div class="pull-right">
                Rita @2019</a>
            </div>
            <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->

    </div>
</div>


<!-- jQuery -->
<script src="{{asset(url('public/vendors/jquery/dist/jquery.min.js'))}}"></script>
<!-- Bootstrap -->
<script src="{{asset(url('public/vendors/bootstrap/dist/js/bootstrap.bundle.min.js'))}}"></script>



<script src="{{asset(url('public/vendors/datatables.net/js/jquery.dataTables.min.js'))}}"></script>
<script src="{{asset(url('public/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js'))}}"></script>

<!-- FastClick -->
<script src="{{asset(url('public/vendors/fastclick/lib/fastclick.js'))}}"></script>
<!-- NProgress -->
<script src="{{asset(url('public/vendors/nprogress/nprogress.js'))}}"></script>
<!-- bootstrap-wysiwyg -->
<script src="{{asset(url('public/vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js'))}}"></script>
<script src="{{asset(url('public/vendors/jquery.hotkeys/jquery.hotkeys.js'))}}"></script>
<script src="{{asset(url('public/vendors/google-code-prettify/src/prettify.js'))}}"></script>


{{--chart js--}}


<script src="{{asset(url('public/vendors/Chart.js/dist/Chart.min.js'))}}"></script>

<!-- Custom Theme Scripts -->
<script src="{{asset(url('public/build/js/custom.js'))}}"></script>
<script src="{{asset(url('public/resource/customization.js'))}}"></script>



</body>
</html>
