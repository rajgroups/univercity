@extends('layouts.admin.app')
@section('content')
    <!-- content @s
        -->
        <div class="nk-content ">
            <style>
                .nk-order-ovwg-ck {
                    height: 100%;
                }

                .card-stats .col-icon {
                    width: 90px;
                    height: 65px;
                    /* margin-left: 15px; */
                }

                .card-stats .icon-big.icon-secondary {
                    background: #367DFF;
                }

                .card-stats .icon-big {
                    width: 100%;
                    height: 100%;
                    font-size: 2.2em;
                    min-height: 64px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                }

                .card-stats .icon-big.icon-success {
                    background: #35cd3a;
                }

                .card-stats .icon-big.icon-danger {
                    background: #f3545d;
                }

                .card-stats .icon-big.icon-info {
                    background: #36a3f7;
                }

                .card {
                    border-radius: 5px;
                    background-color: #fff;
                    margin-bottom: 30px;
                    -webkit-box-shadow: 0 1px 15px 1px rgba(69, 65, 78, .08);
                    -moz-box-shadow: 0 1px 15px 1px rgba(69, 65, 78, .08);
                    box-shadow: 0 1px 15px 1px rgba(69, 65, 78, .08);
                    border: 0;
                }
            </style>
            <div class="container-fluid">
                <div class="nk-content-inner">
                    <div class="nk-content-body">
                        <div class="nk-block">
                            <div class="row g-gs">
                                <div class="nk-block nk-block-lg">
                                    <div class="card mb-4">
                                        <h3 class="mb-0 px-3 py-4"><b>Dashboard</b></h3>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="card card-bordered h-100">
                                            <div class="card-inner">
                                                <div class="nk-order-ovwg">
                                                    <div class="row">


                                                        <!-- Pending Requests Card Example -->


                                                        <div class="col-xl-4 col-md-6">
                                                            <div class="card card-stats card-round">
                                                                <div class="card-body ">
                                                                    <div class="row align-items-center">
                                                                        <div class="col-icon">
                                                                            <div
                                                                                class="icon-big text-center icon-info bubble-shadow-small">
                                                                                <i class="fa fa-check-circle text-white"></i>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col col-stats ml-3 ml-sm-0">
                                                                            <div class="numbers">
                                                                                <p class="mb-0"><b>Total Customers</b></p>
                                                                                <h4 class="card-title">{{$user}}</h4>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>


                                                        <div class="col-xl-4 col-md-6">
                                                            <div class="card card-stats card-round">
                                                                <div class="card-body ">
                                                                    <div class="row align-items-center">
                                                                        <div class="col-icon">
                                                                            <div
                                                                                class="icon-big text-center icon-info bubble-shadow-small">
                                                                                <i class="fa fa-check-circle text-white"></i>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col col-stats ml-3 ml-sm-0">
                                                                            <div class="numbers">
                                                                                <p class="mb-0"><b>Paid Customers</b></p>
                                                                                <h4 class="card-title">{{$paiduser}}</h4>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-md-6">
                                                            <div class="card card-stats card-round">
                                                                <div class="card-body ">
                                                                    <div class="row align-items-center">
                                                                        <div class="col-icon">
                                                                            <div
                                                                                class="icon-big text-center icon-info bubble-shadow-small">
                                                                                <i class="fa fa-check-circle text-white"></i>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col col-stats ml-3 ml-sm-0">
                                                                            <div class="numbers">
                                                                                <p class="mb-0"><b>Unpaid Customers</b></p>
                                                                                <h4 class="card-title">{{$unpaiduser}}</h4>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                    </div>
                                                </div><!-- .nk-order-ovwg -->
                                            </div><!-- .card-inner -->
                                        </div><!-- .card -->
                                    </div>
                                </div> <!-- nk-block -->
                            </div><!-- .row -->
                        </div><!-- .nk-block -->
                    </div>
                </div>
            </div>
        </div>
        <!-- content @e -->
    @endsection
