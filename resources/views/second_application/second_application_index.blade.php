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
                                        <li><a class="smoth-scroll" href="#about">Upload Documents</a>
                                        </li>

                                        {{--<div class="dropdown">--}}
                                        <li>
                                            <a class="   dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                <?php  $user_name = \Illuminate\Support\Facades\Auth::user();echo $user_name->name;      ?>
                                                <span class="caret"></span>
                                            </a>

                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                                <li><a href="#">Action</a></li>
                                                <li role="separator" class="divider"></li>
                                                <li><form method="post" action="{{ url('/logout') }}">
                                                        {{ csrf_field() }}
                                                        <input type="submit" value="logout">
                                                        {{--<a id="logout-btn" href="">Sign Out</a>--}}
                                                    </form></li>
                                                <li><a id="logout-btn" href="">Sign Out</a></li>
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



    <!-- About Start -->
    <section id="about" class="about section-space-padding">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="section-title">
                        <h2>Welcome <?php echo (isset($user_name->name))? $user_name->name: ''; ?> </h2>
                        <div class="divider dark">
                            <i class="icon-emotsmile fa-spin"></i>
                        </div>
                        @include('layouts.includes._messages')
                        <?php $status = \App\SecondApplication::where('first_application_id',$user_name->id)->get();
                        if(count($status)>0){
                            $upload_status = true;
                        }else{
                            $upload_status = false;
                            ?>
                        <p>Please click on the button below to upload photocopies of the required documents as stated</p>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>


            <div class="row">



                <div class="col-md-6 col-md-offset-3">
                    <?php if($upload_status){
                        ?>
                        <p>Thank you for stopping by, your application is still being processed. We will let you know once it gets approved</p>


                    <?php
                    }else{
                        ?>

                        <div class="about-me-text pattern-bg margin-top-50 margin-bottom-50">
                            <div class="text-center">

                                <a class="button button-style button-style-dark button-style-color-2" data-toggle="modal" data-target="#subscribemodal" href="#">Upload Documents</a>
                            </div>
                        </div>


                    <?php
                    } ?>

                </div>

            </div>
        </div>
    </section>





    <!-- Subscribe Modal Start -->
    <div class="modal fade subscribe padding-top-120" id="subscribemodal" role="dialog">
        <div class="modal-dialog">


            <div class="modal-content">
                <form id="" method="post" action="{{ url('upload-documents') }}" enctype="multipart/form-data">

                    {{ csrf_field() }}
                <div class="modal-body">
                    <div class="row">
                        <div class="">
                            <div class="section-title margin-top-30">
                                <button type="button" class="btn pull-right" data-dismiss="modal"><i class="fa fa-close"></i></button>
                                <h2>Upload Documents.</h2>
                                <p>Upload Character reference documents from the following institutions.</p>
                            </div>
                        </div>
                    </div>
                 <div class= row-fluid">
                        <label for="school-cert" class="control-label">Last School Attended </label>
                        <div class="controls">
                                    <input type="file" name="school_cert" class="form-control" >
                        </div>
                    </div>
                 <div class= row-fluid">
                        <label for="school-cert" class="control-label">Religious Leader</label>
                        <div class="controls">
                                    <input type="file" name="religious_reference" class="form-control" >
                        </div>
                    </div>
                 <div class= row-fluid">
                        <label for="school-cert" class="control-label">Government Official</label>
                        <div class="controls">
                                    <input type="file" name="government_character_reference" class="form-control" >
                        </div>
                    </div>
                 <div class= row-fluid">
                        <label for="school-cert" class="control-label">Identification Card</label>
                        <div class="controls">
                                    <input type="file" name="identification_card" class="form-control" >
                        </div>
                    </div>
                  <div class= row-fluid">
                        <label for="school-cert" class="control-label">Good Conduct from CID</label>
                        <div class="controls">
                                    <input type="file" name="good_conduct" class="form-control" >
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <div class="actions">
                        <input type="submit" class="btn btn-primary">
                    </div>
                </div>

                </form>

            </div>
        </div>
    </div>
    <!-- Subscribe Modal End -->
    <!-- About End -->


@endsection
<script>
//    $(document).ready(function () {
//alert("clicked");
        $("#logout-btn").on("click",function () {
            alert("clicked");
        })
//    })
</script>