<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="/assets/images/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="/assets/images/favicon.png" type="image/x-icon">
    <title>VRSR - Virtual Reality Social Reservation System</title>
    {{-- Google font  --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@200;300;400;600;700;800;900&amp;display=swap"
          rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap"
          rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/assets/css/font-awesome.css">
    {{-- ico-font --}}
    <link rel="stylesheet" type="text/css" href="/assets/css/vendors/icofont.css">
    {{-- Themify icon --}}
    <link rel="stylesheet" type="text/css" href="/assets/css/vendors/themify.css">
    {{-- Flag icon --}}
    <link rel="stylesheet" type="text/css" href="/assets/css/vendors/flag-icon.css">
    {{-- Feather icon --}}
    <link rel="stylesheet" type="text/css" href="/assets/css/vendors/feather-icon.css">
    {{-- Plugins css start --}}
    <link rel="stylesheet" type="text/css" href="/assets/css/vendors/slick.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/vendors/slick-theme.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/vendors/scrollbar.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/vendors/animate.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/vendors/datatables.css">
    {{-- Plugins css Ends --}}
    {{-- Bootstrap css --}}
    <link rel="stylesheet" type="text/css" href="/assets/css/vendors/bootstrap.css">

    <link id="color" rel="stylesheet" href="/assets/css/color-1.css" media="screen">
    {{-- Responsive css --}}
    <link rel="stylesheet" type="text/css" href="/assets/css/responsive.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    {{-- App css --}}
    <link rel="stylesheet" type="text/css" href="/assets/css/style.css">
    {{--  Custom CSS  --}}
    <link rel="stylesheet" type="text/css" href="/style.css">

    @livewireStyles

    <script>
        function openToast(t,m){
            const toastEl = document.getElementById(t + '-toast');
            toastEl.querySelector('.toast-body').innerText = m
            const toast = new bootstrap.Toast(toastEl);
            toast.show();
        }
    </script>
</head>
<body>
{{-- loader starts --}}
<div class="loader-wrapper">
    <div class="theme-loader">
        <div class="loader-p"></div>
    </div>
</div>
{{-- loader ends --}}
{{-- tap on top starts --}}
<div class="tap-top"><i data-feather="chevrons-up"></i></div>
{{-- tap on tap ends --}}
{{-- page-wrapper Start --}}
<div class="page-wrapper compact-wrapper" id="pageWrapper">
    {{-- Page Header Start --}}
    @include('admin.common.navbar')
    {{-- Page Header Ends                               --}}
    {{-- Page Body Start --}}
    <div class="page-body-wrapper">
        {{-- Page Sidebar Start --}}
        @include('admin.common.sidebar')
        {{-- Page Sidebar Ends --}}
        <div class="page-body">
            {{-- Breadcrumbs start --}}
            @include('admin.common.breadcrumbs')
            {{--   Breadcrumbs end  --}}
            {{-- Container-fluid starts --}}
            {{ $slot }}
            {{-- Container-fluid Ends --}}
        </div>

        {{--  footer start --}}
        @include('admin.common.footer')
        {{--   Footer end     --}}
        @include('admin.common.toast')
    </div>
</div>
{{-- latest jquery --}}
<script src="/assets/js/jquery.min.js"></script>
{{-- Bootstrap js --}}
<script src="/assets/js/bootstrap/bootstrap.bundle.min.js"></script>
{{-- feather icon js --}}
<script src="/assets/js/icons/feather-icon/feather.min.js"></script>
<script src="/assets/js/icons/feather-icon/feather-icon.js"></script>
{{-- scrollbar js --}}
<script src="/assets/js/scrollbar/simplebar.js"></script>
<script src="/assets/js/scrollbar/custom.js"></script>
{{-- Sidebar jquery --}}
<script src="/assets/js/config.js"></script>
{{-- Plugins JS start --}}
<script src="/assets/js/sidebar-menu.js"></script>
<script src="/assets/js/sidebar-pin.js"></script>
<script src="/assets/js/slick/slick.js"></script>
<script src="/assets/js/header-slick.js"></script>
<script src="/assets/js/datatable/datatables/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

{{-- Plugins JS Ends --}}
{{-- Theme js --}}
<script src="/assets/js/script.js"></script>
{{-- Plugin used --}}

@livewireScripts
</body>
</html>
