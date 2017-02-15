@extends('layouts.second_application')
@section('content')

    <!-- Menu Section Start -->
    <header id="home">

        <div class="header-top-area">
            <div class="container">
                <div class="row">

                    <div class="col-sm-3">
                        <div class="logo">
                            @php
                                $sys = \App\SystemConfig::whereNotNull('id')->first();
                            @endphp
                            {{--<a href="index-2.html">WebRes</a>--}}
                            <img src="{{ URL::asset($sys->company_logo) }}" style="width: 246px; height: 52px; margin-top: -16px;" alt="BODA SQUARED">

                            <!-- PLACE YOUR LOGO HERE -->
                            {{--<span id="logo">  </span>--}}
                        </div>
                    </div>

                    <div class="col-sm-9">
                        <div class="navigation-menu">
                            <div class="navbar">
                                <div class="navbar-header">
                                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                        <span class="sr-only">Toggle navigation</span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </button>
                                </div>
                                <div class="navbar-collapse collapse">
                                    <ul class="nav navbar-nav navbar-right">
                                        <li class="active"><a class="smoth-scroll" href="#home">Home <div class="ripple-wrapper"></div></a>
                                        </li>
                                        <li><a class="smoth-scroll" href="#about">Upload Documents</a>
                                        </li>

                                        {{--<div class="dropdown">--}}
                                        <li>
                                            <a class="   dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                <?php echo \Illuminate\Support\Facades\Auth::user()->name;      ?>
                                                <span class="caret"></span>
                                            </a>

                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                                <li><a href="#">Action</a></li>
                                                <li role="separator" class="divider"></li>
                                                <li><a href="#">Sign Out</a></li>
                                            </ul>
                                        </li>
                                        {{--</div>--}}

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Menu Section End -->
    <section class="home-section">
        <div class="container">
            <div class="row">

                <div class="col-sm-offset-2 col-md-4 col-sm-6 margin-left-setting">
                    <div class="margin-top-150">
                        <div class="panel-blue">
                            welcome alex please select the button below to upload photos
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- Home Section End -->




    <!-- About Start -->
    <section id="about" class="about section-space-padding">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="section-title">
                        <h2>Uploa .</h2>
                        <div class="divider dark">
                            <i class="icon-emotsmile"></i>
                        </div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>
                    </div>
                </div>
            </div>


            <div class="row">



                <div class="col-md-6 col-md-offset-3">
                    <div class="about-me-text pattern-bg margin-top-50 margin-bottom-50">
                        <div class="text-center">
                            <a class="button button-style button-style-dark button-style-color-2" data-toggle="modal" data-target="#subscribemodal" href="#">Upload Documents</a>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>





    <!-- Subscribe Modal Start -->
    <div class="modal fade subscribe padding-top-120" id="subscribemodal" role="dialog">
        <div class="modal-dialog">


            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="section-title margin-top-30">
                                <button type="button" class="btn pull-right" data-dismiss="modal"><i class="fa fa-close"></i></button>
                                <h2>Subscribe.</h2>
                                <div class="divider dark">
                                    <i class="icon-envelope-letter"></i>
                                </div>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-offset-2 col-xs-offset-0 col-md-8 col-sm-8">

                            <div class="margin-bottom-50">
                                <form id="mc-form" method="post" action="http://uipasta.us14.list-manage.com/subscribe/post?u=854825d502cdc101233c08a21&amp;id=86e84d44b7">

                                    <div class="subscribe-form">
                                        <input id="mc-email" type="email" placeholder="Email Address" class="text-input">
                                        <button class="submit-btn" type="submit">Submit</button>
                                    </div>
                                    <label for="mc-email" class="mc-label"></label>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Subscribe Modal End -->
    <!-- About End -->


@endsection