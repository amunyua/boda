@extends('layouts.second_application')
@section('content')
    <!-- Subscribe Modal Start -->
    <div class="modal fade subscribe padding-top-120" data-backdrop="static" data-keyboard="false" id="subscribemodal1" role="dialog">
        <div class="modal-dialog">


            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="section-title margin-top-30">
                                {{--<button type="button" class="btn pull-right" data-dismiss="modal"><i class="fa fa-close"></i></button>--}}
                                <h3>Thank You {{ \Illuminate\Support\Facades\Auth::user()->name }} for stopping by.</h3>
                                <div class="divider dark">
                                    {{--<i class="icon-envelope-letter"></i>--}}
                                    <i class="fa fa-spinner fa-spin" style="font-size:24px ;color:black"></i>
                                </div>
                                <p>Your application is still being processed.</p>
                                <p style="text-align: center">Make sure to check sometime later</p>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-offset-2 col-xs-offset-0 col-md-8 col-sm-8">

                            <div class="margin-bottom-50">
                                <form id="mc-form" method="post" action="">

                                    <div class="subscribe-form">
                                       <button class="btm btn-block" type="submit">Logout</button>
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