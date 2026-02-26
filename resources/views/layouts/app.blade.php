<!DOCTYPE html>
<html>

<head>
    <title>Motokloz</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="apple-mobile-web-app-title" content="Motokloz" />
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Swiper -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <!-- Anime JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/user-auth.css') }}">
    <!-- Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Geist:wght@100..900&family=Lato:wght@100..900&family=Vend+Sans:wght@300..700&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Urbanist:wght@100..900&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Yeh div jahan widget aayega -->



</head>

<body>
    @include('partials.header')
    @yield('content')
    @include('partials.footer')
    @include('partials.script')
</body>

</html>