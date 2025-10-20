<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>VetCare - Klinik Hewan</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    {{-- Favicon --}}
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('petcare-master/assets/img/favicon.ico') }}">

    <!-- CSS here -->
    <link rel="stylesheet" href="{{ asset('petcare-master/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('petcare-master/assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('petcare-master/assets/css/slicknav.css') }}">
    <link rel="stylesheet" href="{{ asset('petcare-master/assets/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('petcare-master/assets/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('petcare-master/assets/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('petcare-master/assets/css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('petcare-master/assets/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('petcare-master/assets/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('petcare-master/assets/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('petcare-master/assets/css/style.css') }}">
</head>

<body>

    {{-- Navbar --}}
    @include('web.layouts.partials.navbar')

    {{-- Content --}}
    @yield('content')

    {{-- Footer --}}
    @include('web.layouts.partials.footer')

    {{-- JS here --}}
    <script src="{{ asset('petcare-master/assets/js/vendor/modernizr-3.5.0.min.js') }}"></script>
    <script src="{{ asset('petcare-master/assets/js/vendor/jquery-1.12.4.min.js') }}"></script>
    <script src="{{ asset('petcare-master/assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('petcare-master/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('petcare-master/assets/js/jquery.slicknav.min.js') }}"></script>
    <script src="{{ asset('petcare-master/assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('petcare-master/assets/js/slick.min.js') }}"></script>
    <script src="{{ asset('petcare-master/assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('petcare-master/assets/js/animated.headline.js') }}"></script>
    <script src="{{ asset('petcare-master/assets/js/jquery.magnific-popup.js') }}"></script>
    <script src="{{ asset('petcare-master/assets/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('petcare-master/assets/js/jquery.sticky.js') }}"></script>
    <script src="{{ asset('petcare-master/assets/js/contact.js') }}"></script>
    <script src="{{ asset('petcare-master/assets/js/jquery.form.js') }}"></script>
    <script src="{{ asset('petcare-master/assets/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('petcare-master/assets/js/mail-script.js') }}"></script>
    <script src="{{ asset('petcare-master/assets/js/jquery.ajaxchimp.min.js') }}"></script>
    <script src="{{ asset('petcare-master/assets/js/plugins.js') }}"></script>
    <script src="{{ asset('petcare-master/assets/js/main.js') }}"></script>

</body>
</html>
