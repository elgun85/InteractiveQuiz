<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title','Home page')</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{asset('front/')}}/assets/img/favicon.png" rel="icon">
    <link href="{{asset('front/')}}/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{asset('front/')}}/assets/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="{{asset('front/')}}/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{asset('front/')}}/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="{{asset('front/')}}/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="{{asset('front/')}}/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="{{asset('front/')}}/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="{{asset('front/')}}/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">


    <!-- Template Main CSS File -->
    <link href="{{asset('front/')}}/assets/css/style.css" rel="stylesheet">

</head>

<body>

<!-- ======= Header ======= -->
<header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center">

        <h1 class="logo me-auto"><a href="{{route('home')}}">Sailor</a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
{{--
         <a href="index.html" class="logo me-auto"><img src="{{asset('front/')}}/assets/img/logo.png" alt="" class="img-fluid"></a>
--}}


        <!-- .navbar -->
        @if (Route::has('login'))
            <livewire:welcome.navigation />
        @endif
    </div>
</header>
<!-- End Header -->
