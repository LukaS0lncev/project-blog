<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>

    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <!-- Stylesheets
    ============================================= -->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700|Poppins:300,400,500,600,700|PT+Serif:400,400i&display=swap" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="/css/bootstrap.css" type="text/css" />
    <link rel="stylesheet" href="/css/style.css" type="text/css" />
    <link rel="stylesheet" href="/css/swiper.css" type="text/css" />
    <link rel="stylesheet" href="/css/dark.css" type="text/css" />
    <link rel="stylesheet" href="/css/font-icons.css" type="text/css" />
    <link rel="stylesheet" href="/css/animate.css" type="text/css" />
    <link rel="stylesheet" href="/css/magnific-popup.css" type="text/css" />
    <link rel="stylesheet" href="/vendor/prism/css/prism.css" type="text/css" />
    <link rel="stylesheet" href="/css/custom.css" type="text/css" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- Document Title
    ============================================= -->
    <title>Блог о Web разработке | Paimon Project</title>

</head>

<body class="stretched">

<!-- Document Wrapper
============================================= -->
<div id="wrapper" class="clearfix">

    <!-- Top Bar
============================================= -->
    <div id="top-bar">
        @include('layouts.top-bar')
    </div><!-- #top-bar end -->

    <!-- Header
    ============================================= -->
    <header id="header" class="full-header">
        @include('layouts.header')
    </header><!-- #header end -->

        @yield('slider')

        @yield('page-title')

<!-- Content ============================================= -->
    <section id="content">

        @yield('content')

    </section><!-- #content end -->

    <!-- Footer
    ============================================= -->
    <footer id="footer" class="dark">
            @include('layouts.copyrights')
    </footer><!-- #footer end -->
</div><!-- #wrapper end -->

<!-- Go To Top
============================================= -->
<div id="gotoTop" class="icon-angle-up"></div>

<!-- JavaScripts
============================================= -->
<script src="/js/jquery.js"></script>
<script src="/js/plugins.min.js"></script>

<!-- Footer Scripts
============================================= -->
<script src="/js/functions.js"></script>

<script src="/vendor/prism/js/prism.js"></script>
<script src="/js/likes.js"></script>


</body>
</html>
