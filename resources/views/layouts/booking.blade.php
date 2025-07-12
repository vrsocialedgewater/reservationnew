<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="/assets/images/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="/assets/images/favicon.png" type="image/x-icon">
    <title>{{ env("app_name") }}</title>
    {{-- Google font --}}
    <link href="https://fonts.googleapis.com/css?family=Outfit:400,400i,500,500i,700,700i&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Courgette&amp;family=Montserrat:wght@200;300;400;500;600;700;800&amp;family=Nunito:wght@200;300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Courgette&amp;family=DM+Sans:opsz,wght@9..40,400;9..40,500;9..40,700;9..40,800&amp;family=Montserrat:wght@200;300;400;500;600;700;800&amp;family=Nunito:wght@200;300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/assets/css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/vendors/icofont.css">
    <link rel="icon" href="/assets/svg/landing-icons.svg">
    <link rel="stylesheet" type="text/css" href="/assets/css/vendors/slick.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/vendors/slick-theme.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/vendors/animate.css">
    {{-- Bootstrap css --}}
    <link rel="stylesheet" type="text/css" href="/assets/css/vendors/bootstrap.css">
    {{-- App css --}}
    <link rel="stylesheet" type="text/css" href="/assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/flatpickr/flatpickr.min.css">
    {{-- Responsive css --}}
    <link rel="stylesheet" type="text/css" href="/assets/css/responsive.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/vendors/owlcarousel.css">
    <link rel="stylesheet" type="text/css" href="/style.css?v1.5">
    @yield('styles')
    @livewireStyles
</head>
<body class="landing-page">
{{-- tap on top starts --}}
<div class="tap-top"><i data-feather="chevrons-up"></i></div>
{{-- tap on tap ends --}}
{{-- page-wrapper Start --}}
<div>
    {{-- Page Body Start --}}
    <header class="landing-header">
        <div class="custom-container">
            <div class="row">
                <div class="col-12 p-0">
                    <nav class="navbar navbar-light p-0" id="navbar-example2">
                        <livewire:booking.navigate/>

                        <h3 class="mb-0 sub-title text-white d-md-inline">
                            <a class="logo" href="/">
                                <img class="img-fluid for-light" style="width: 75px" src="/assets/images/logo/vrs-logo2.svg" alt="looginpage">
                                <img class="img-fluid for-dark" style="width: 75px" src="/assets/images/logo/vrs-logo2.svg" alt="looginpage">
                            </a>

                        </h3>
                        <div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    {{-- header end --}}
    {{-- landing home start --}}
    @yield('container')
    {{-- landing home end  --}}



    {{--footer start --}}
    <footer class="footer-bg">
        <div class="container-fluid">
            <div class="sub-footer row g-md-2 g-3 pb-2 pt-2 text-center">
                <img class="img-fluid" src="/assets/images/logo/vrs-logo2.svg" style="width: 150px; margin: auto" alt="logo">
                <ul class="uk-child-width-auto uk-grid-small uk-flex-inline uk-flex-middle uk-grid" uk-grid="">
                    <li class="el-item uk-first-column">
                        <a class="el-link uk-icon-link" href="https://www.facebook.com/sharer/sharer.php?u=https://virtualrealitysocial.com" target="_blank" rel="noreferrer"><span uk-icon="icon: facebook; width: 20; height: 20;" class="uk-icon"><svg width="20" height="20" viewBox="0 0 20 20"><path d="M11,10h2.6l0.4-3H11V5.3c0-0.9,0.2-1.5,1.5-1.5H14V1.1c-0.3,0-1-0.1-2.1-0.1C9.6,1,8,2.4,8,5v2H5.5v3H8v8h3V10z"></path></svg></span></a></li>
                    <li class="el-item">
                        <a class="el-link uk-icon-link" href="https://www.instagram.com/vrsocial.colorado/" target="_blank" rel="noreferrer"><span uk-icon="icon: instagram; width: 20; height: 20;" class="uk-icon"><svg width="20" height="20" viewBox="0 0 20 20"><path d="M13.55,1H6.46C3.45,1,1,3.44,1,6.44v7.12c0,3,2.45,5.44,5.46,5.44h7.08c3.02,0,5.46-2.44,5.46-5.44V6.44 C19.01,3.44,16.56,1,13.55,1z M17.5,14c0,1.93-1.57,3.5-3.5,3.5H6c-1.93,0-3.5-1.57-3.5-3.5V6c0-1.93,1.57-3.5,3.5-3.5h8 c1.93,0,3.5,1.57,3.5,3.5V14z"></path><circle cx="14.87" cy="5.26" r="1.09"></circle><path d="M10.03,5.45c-2.55,0-4.63,2.06-4.63,4.6c0,2.55,2.07,4.61,4.63,4.61c2.56,0,4.63-2.061,4.63-4.61 C14.65,7.51,12.58,5.45,10.03,5.45L10.03,5.45L10.03,5.45z M10.08,13c-1.66,0-3-1.34-3-2.99c0-1.65,1.34-2.99,3-2.99s3,1.34,3,2.99 C13.08,11.66,11.74,13,10.08,13L10.08,13L10.08,13z"></path></svg></span></a></li>
                    <li class="el-item">
                        <a class="el-link uk-icon-link" href="https://www.tiktok.com/@vrsocial.colorado" target="_blank" rel="noreferrer"><span uk-icon="icon: tiktok; width: 20; height: 20;" class="uk-icon"><svg width="20" height="20" viewBox="0 0 20 20"><path d="M17.24,6V8.82a6.79,6.79,0,0,1-4-1.28v5.81A5.26,5.26,0,1,1,8,8.1a4.36,4.36,0,0,1,.72.05v2.9A2.57,2.57,0,0,0,7.64,11a2.4,2.4,0,1,0,2.77,2.38V2h2.86a4,4,0,0,0,1.84,3.38A4,4,0,0,0,17.24,6Z"></path></svg></span></a></li>
                    <li class="el-item">
                        <a class="el-link uk-icon-link" href="https://twitter.com/intent/tweet?url=https://virtualrealitysocial.com&amp;text=I'm%20having%20a%20blast%20at%20VR%20Social%20Denver!%20" target="_blank" rel="noreferrer"><span uk-icon="icon: twitter; width: 20; height: 20;" class="uk-icon"><svg width="20" height="20" viewBox="0 0 20 20"><path d="m15.08,2.1h2.68l-5.89,6.71,6.88,9.1h-5.4l-4.23-5.53-4.84,5.53H1.59l6.24-7.18L1.24,2.1h5.54l3.82,5.05,4.48-5.05Zm-.94,14.23h1.48L6,3.61h-1.6l9.73,12.71h0Z"></path></svg></span></a></li>
                    <li class="el-item">
                        <a class="el-link uk-icon-link" href="https://www.linkedin.com/shareArticle?mini=true&amp;url=https://virtualrealitysocial.com" target="_blank" rel="noreferrer"><span uk-icon="icon: linkedin; width: 20; height: 20;" class="uk-icon"><svg width="20" height="20" viewBox="0 0 20 20"><path d="M5.77,17.89 L5.77,7.17 L2.21,7.17 L2.21,17.89 L5.77,17.89 L5.77,17.89 Z M3.99,5.71 C5.23,5.71 6.01,4.89 6.01,3.86 C5.99,2.8 5.24,2 4.02,2 C2.8,2 2,2.8 2,3.85 C2,4.88 2.77,5.7 3.97,5.7 L3.99,5.7 L3.99,5.71 L3.99,5.71 Z"></path><path d="M7.75,17.89 L11.31,17.89 L11.31,11.9 C11.31,11.58 11.33,11.26 11.43,11.03 C11.69,10.39 12.27,9.73 13.26,9.73 C14.55,9.73 15.06,10.71 15.06,12.15 L15.06,17.89 L18.62,17.89 L18.62,11.74 C18.62,8.45 16.86,6.92 14.52,6.92 C12.6,6.92 11.75,7.99 11.28,8.73 L11.3,8.73 L11.3,7.17 L7.75,7.17 C7.79,8.17 7.75,17.89 7.75,17.89 L7.75,17.89 L7.75,17.89 Z"></path></svg></span></a></li>
                    <li class="el-item">
                        <a class="el-link uk-icon-link" href="https://telegram.me/share/url?url=https://virtualrealitysocial.com&amp;text=I'm%20having%20a%20blast%20at%20VR%20Social%20Denver!%20" target="_blank" rel="noreferrer"><span uk-icon="icon: telegram; width: 20; height: 20;" class="uk-icon"><svg width="20" height="20" viewBox="0 0 20 20"><path d="m10,1.09C5.08,1.09,1.09,5.08,1.09,10s3.99,8.91,8.91,8.91,8.91-3.99,8.91-8.91S14.92,1.09,10,1.09Zm4.25,5.8c-.03.36-.23,1.62-.44,2.99-.31,1.93-.64,4.04-.64,4.04,0,0-.05.59-.49.7s-1.16-.36-1.29-.46c-.1-.08-1.93-1.24-2.6-1.8-.18-.15-.39-.46.03-.82.93-.85,2.04-1.91,2.7-2.58.31-.31.62-1.03-.67-.15-1.83,1.26-3.63,2.45-3.63,2.45,0,0-.41.26-1.19.03-.77-.23-1.67-.54-1.67-.54,0,0-.62-.39.44-.8h0s4.46-1.83,6-2.47c.59-.26,2.6-1.08,2.6-1.08,0,0,.93-.36.85.52Z"></path></svg></span></a></li>
                </ul>
                <p class="mb-0">© {{ date("Y") }} <a href="https://virtualrealitysocial.com/" target="_blank" class="text-white"> VirtualReality Social Denver</a>.</p>

            </div>
        </div>
    </footer>
</div>
{{-- latest jquery --}}
<script src="/assets/js/jquery-3.5.1.min.js"></script>
{{-- Bootstrap js --}}
<script src="/assets/js/bootstrap/bootstrap.bundle.min.js"></script>
{{-- feather icon js --}}
<script src="/assets/js/icons/feather-icon/feather.min.js"></script>
<script src="/assets/js/icons/feather-icon/feather-icon.js"></script>
{{-- Plugins JS start --}}
<script src="/assets/js/tooltip-init.js"></script>
<script src="/assets/js/animation/wow/wow.min.js"></script>
<script src="/assets/js/landing_sticky.js"></script>
<script src="/assets/js/landing.js"></script>
<script src="/assets/js/jarallax_libs/libs.min.js"></script>
<script src="/assets/js/slick/slick.min.js"></script>
<script src="/assets/js/slick/slick.js"></script>
<script src="/assets/js/landing-slick.js"></script>

<script src="../assets/js/flat-pickr/flatpickr.js"></script>
<script src="../assets/js/flat-pickr/custom-flatpickr.js"></script>
{{-- Plugins JS Ends --}}
<script src="/assets/js/owlcarousel/owl.carousel.js"></script>
<script src="/assets/js/owlcarousel/owl-custom.js"></script>
@yield('scripts')
@livewireScripts
</body>
</html>
