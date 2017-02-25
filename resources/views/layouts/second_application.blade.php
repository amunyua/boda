<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Meta Tag -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- SEO -->
    <meta name="robots" content="index,follow">


    <title>@yield('title')</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="images/favicon/favicon.ico">
    <link rel="apple-touch-icon" sizes="144x144" type="image/x-icon" href="images/favicon/apple-touch-icon.png">

    <!-- All CSS Plugins -->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('WebRes/css/plugin.css')}} ">

    <!-- Main CSS Stylesheet -->
    {{--<link rel="stylesheet" type="text/css" href="{{ URL::asset('WebRes/css/style.css')}} ">--}}
    <link rel="stylesheet" type="text/css" media="screen" href="{{ URL::asset('WebRes/css/style.css') }}">

    <!-- Google Web Fonts  -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:400,300,500,600,700">


    <!-- HTML5 shiv and Respond.js support IE8 or Older for HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js')}}"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js')}}"></script>


    <![endif]-->


</head>

<body>



<!-- Preloader Start -->
<div class="preloader">
    <p>Loading...</p>
</div>
<!-- Preloader End -->





@yield('content')
<!-- Home Section Start -->







{{--<!-- statistics -->--}}
{{--<section class="statistics-section section-space-padding bg-cover text-center">--}}
    {{--<div class="container">--}}

        {{--<div class="row">--}}

            {{--<div class="col-md-3 col-sm-6 col-xs-6">--}}
                {{--<div class="statistics bg-color-1">--}}
                    {{--<div class="statistics-icon"><i class="icon-mustache"></i>--}}
                    {{--</div>--}}
                    {{--<div class="statistics-content">--}}
                        {{--<h5><span data-count="2025" class="statistics-count">2025</span></h5><span>Projects Done</span>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}

            {{--<div class="col-md-3 col-sm-6 col-xs-6">--}}
                {{--<div class="statistics bg-color-6">--}}
                    {{--<div class="statistics-icon"><i class="icon-emotsmile"></i>--}}
                    {{--</div>--}}
                    {{--<div class="statistics-content">--}}
                        {{--<h5> <span data-count="1200" class="statistics-count">1200</span></h5><span>Happy Clients</span>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}

            {{--<div class="col-md-3 col-sm-6 col-xs-6">--}}
                {{--<div class="statistics bg-color-4">--}}
                    {{--<div class="statistics-icon"><i class="icon-hourglass"></i>--}}
                    {{--</div>--}}
                    {{--<div class="statistics-content">--}}
                        {{--<h5><span data-count="8000" class="statistics-count">8000</span></h5><span>Hours of Work</span>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}

            {{--<div class="col-md-3 col-sm-6 col-xs-6">--}}
                {{--<div class="statistics bg-color-5">--}}
                    {{--<div class="statistics-icon"><i class="icon-cup"></i>--}}
                    {{--</div>--}}
                    {{--<div class="statistics-content">--}}
                        {{--<h5><span data-count="4000" class="statistics-count">4000</span></h5><span>Cup of Coffee</span>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}

        {{--</div>--}}
    {{--</div>--}}
{{--</section>--}}
{{--<!-- statistics end -->--}}




{{--<!-- Services Start -->--}}
{{--<section id="services" class="services-section section-space-padding">--}}
    {{--<div class="container">--}}
        {{--<div class="row">--}}
            {{--<div class="col-sm-12">--}}
                {{--<div class="section-title">--}}
                    {{--<h2>My Services.</h2>--}}
                    {{--<div class="divider dark">--}}
                        {{--<i class="icon-drop"></i>--}}
                    {{--</div>--}}
                    {{--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}

        {{--<div class="row margin-top-30">--}}

            {{--<div class="col-md-4 col-sm-6">--}}
                {{--<div class="services-detail">--}}
                    {{--<i class="icon-screen-smartphone color-1"></i>--}}
                    {{--<h3>Mobile Design</h3>--}}
                    {{--<hr>--}}
                {{--</div>--}}
            {{--</div>--}}

            {{--<div class="col-md-4 col-sm-6">--}}
                {{--<div class="services-detail">--}}
                    {{--<i class="icon-screen-tablet color-2"></i>--}}
                    {{--<h3>Tablet Design</h3>--}}
                    {{--<hr>--}}
                {{--</div>--}}
            {{--</div>--}}

            {{--<div class="col-md-4 col-sm-6">--}}
                {{--<div class="services-detail">--}}
                    {{--<i class="fa fa-code color-3"></i>--}}
                    {{--<h3>Clean Code</h3>--}}
                    {{--<hr>--}}
                {{--</div>--}}
            {{--</div>--}}

            {{--<div class="col-md-4 col-sm-6">--}}
                {{--<div class="services-detail">--}}
                    {{--<i class="icon-support color-4"></i>--}}
                    {{--<h3>Full Support</h3>--}}
                    {{--<hr>--}}
                {{--</div>--}}
            {{--</div>--}}

            {{--<div class="col-md-4 col-sm-6">--}}
                {{--<div class="services-detail">--}}
                    {{--<i class="fa fa-html5 color-5"></i>--}}
                    {{--<h3>HTML5 Design</h3>--}}
                    {{--<hr>--}}
                {{--</div>--}}
            {{--</div>--}}

            {{--<div class="col-md-4 col-sm-6">--}}
                {{--<div class="services-detail">--}}
                    {{--<i class="icon-bulb color-6"></i>--}}
                    {{--<h3>CSS3 Design</h3>--}}
                    {{--<hr>--}}
                {{--</div>--}}
            {{--</div>--}}

        {{--</div>--}}
    {{--</div>--}}
{{--</section>--}}
{{--<!-- Services End -->--}}



<!-- Call to Action Start -->
{{--<section class="call-to-action bg-cover section-space-padding text-center">--}}
    {{--<div class="container">--}}
        {{--<div class="row">--}}
            {{--<div class="col-md-8">--}}
                {{--<h2>Do You Want to Know More About Me?</h2>--}}
            {{--</div>--}}

            {{--<div class="col-md-4">--}}
                {{--<div class="text-center">--}}
                    {{--<a class="button button-style button-style-color-2 smoth-scroll" href="#contact">Contact Me</a>--}}
                {{--</div>--}}

            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</section>--}}
<!-- Call to Action End -->




<!-- Footer End -->


<!-- Back to Top Start -->
<a href="#" class="scroll-to-top"><i class="icon-arrow-up-circle"></i></a>
<!-- Back to Top End -->


<!-- All Javascript Plugins  -->
<script type="text/javascript" src="{{ URL::asset('WebRes/js/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{ URL::asset('WebRes/js/plugin.js')}}"></script>

<!-- Main Javascript File  -->
<script type="text/javascript" src="{{ URL::asset('WebRes/js/scripts.js')}}"></script>


</body>
</html>