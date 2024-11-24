@extends('backend.layouts.design')
@section('title')Dashboard @endsection

@section('extra_css')@endsection

@section('content')
<div class="content">

    <!-- Start Content-->
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <form class="d-flex align-items-center mb-3">
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control border" id="dash-daterange">
                                <span class="input-group-text bg-blue border-blue text-white">
                                    <i class="mdi mdi-calendar-range"></i>
                                </span>
                            </div>
                            <a href="javascript: void(0);" class="btn btn-blue btn-sm ms-2">
                                <i class="mdi mdi-autorenew"></i>
                            </a>
                            <a href="javascript: void(0);" class="btn btn-blue btn-sm ms-1">
                                <i class="mdi mdi-filter-variant"></i>
                            </a>
                        </form>
                    </div>
                    <h4 class="page-title">Dashboard</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 col-xl-3">
                <div class="widget-rounded-circle card">
                    <div class="card-body">
                        <div class="row">

                            <div class="col-12">
                                <div class="text-center">
                                    <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $users }}</span></h3>
                                    <p class="text-muted mb-1 text-truncate">Total Users</p>
                                </div>
                            </div>
                        </div> <!-- end row-->
                    </div>
                </div> <!-- end widget-rounded-circle-->
            </div> <!-- end col-->

            <div class="col-md-6 col-xl-3">
                <div class="widget-rounded-circle card">
                    <div class="card-body">
                        <div class="row">

                            <div class="col-12">
                                <div class="text-center">
                                    <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $homeSwapUsers }}</span></h3>
                                    <p class="text-muted mb-1 text-truncate">Home-Swap Users</p>
                                </div>
                            </div>
                        </div> <!-- end row-->
                    </div>
                </div> <!-- end widget-rounded-circle-->
            </div> <!-- end col-->

            <div class="col-md-6 col-xl-3">
                <div class="widget-rounded-circle card">
                    <div class="card-body">
                        <div class="row">

                            <div class="col-12">
                                <div class="text-center">
                                    <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $wishlists }}</span></h3>
                                    <p class="text-muted mb-1 text-truncate">Total Wishlists</p>
                                </div>
                            </div>
                        </div> <!-- end row-->
                    </div>
                </div> <!-- end widget-rounded-circle-->
            </div> <!-- end col-->

            <div class="col-md-6 col-xl-3">
                <div class="widget-rounded-circle card">
                    <div class="card-body">
                        <div class="row">

                            <div class="col-12">
                                <div class="text-center">
                                    <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $homeSwaps }}</span></h3>
                                    <p class="text-muted mb-1 text-truncate">Home-Swap Properties </p>
                                </div>
                            </div>
                        </div> <!-- end row-->
                    </div>
                </div> <!-- end widget-rounded-circle-->
            </div> <!-- end col-->

            <div class="col-md-6 col-xl-3">
                <div class="widget-rounded-circle card">
                    <div class="card-body">
                        <div class="row">

                            <div class="col-12">
                                <div class="text-center">
                                    <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $homeSwaps }}</span></h3>
                                    <p class="text-muted mb-1 text-truncate">Home-Swap Properties </p>
                                </div>
                            </div>
                        </div> <!-- end row-->
                    </div>
                </div> <!-- end widget-rounded-circle-->
            </div> <!-- end col-->

            <div class="col-md-6 col-xl-3">
                <div class="widget-rounded-circle card">
                    <div class="card-body">
                        <div class="row">

                            <div class="col-12">
                                <div class="text-center">
                                    <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $draftHomeSwaps }}</span></h3>
                                    <p class="text-muted mb-1 text-truncate">Draft Home-Swap Properties </p>
                                </div>
                            </div>
                        </div> <!-- end row-->
                    </div>
                </div> <!-- end widget-rounded-circle-->
            </div> <!-- end col-->

            <div class="col-md-6 col-xl-3">
                <div class="widget-rounded-circle card">
                    <div class="card-body">
                        <div class="row">

                            <div class="col-12">
                                <div class="text-center">
                                    <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $completedHomeSwaps }}</span></h3>
                                    <p class="text-muted mb-1 text-truncate">Completed Home-Swap Properties </p>
                                </div>
                            </div>
                        </div> <!-- end row-->
                    </div>
                </div> <!-- end widget-rounded-circle-->
            </div> <!-- end col-->

            <div class="col-md-6 col-xl-3">
                <div class="widget-rounded-circle card">
                    <div class="card-body">
                        <div class="row">

                            <div class="col-12">
                                <div class="text-center">
                                    <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $deactivatedHomeSwaps }}</span></h3>
                                    <p class="text-muted mb-1 text-truncate">Deactivated Home-Swap Properties </p>
                                </div>
                            </div>
                        </div> <!-- end row-->
                    </div>
                </div> <!-- end widget-rounded-circle-->
            </div> <!-- end col-->


            <div class="col-md-6 col-xl-3">
                <div class="widget-rounded-circle card">
                    <div class="card-body">
                        <div class="row">

                            <div class="col-12">
                                <div class="text-center">
                                    <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $suspendedHomeSwaps }}</span></h3>
                                    <p class="text-muted mb-1 text-truncate">Suspended Home-Swap Properties</p>
                                </div>
                            </div>
                        </div> <!-- end row-->
                    </div>
                </div> <!-- end widget-rounded-circle-->
            </div> <!-- end col-->

            <div class="col-md-6 col-xl-3">
                <div class="widget-rounded-circle card">
                    <div class="card-body">
                        <div class="row">

                            <div class="col-12">
                                <div class="text-center">
                                    <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $nonSwaps }}</span></h3>
                                    <p class="text-muted mb-1 text-truncate">Reservations</p>
                                </div>
                            </div>
                        </div> <!-- end row-->
                    </div>
                </div> <!-- end widget-rounded-circle-->
            </div> <!-- end col-->

            <div class="col-md-6 col-xl-3">
                <div class="widget-rounded-circle card">
                    <div class="card-body">
                        <div class="row">

                            <div class="col-12">
                                <div class="text-center">
                                    <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $draftNonSwaps }}</span></h3>
                                    <p class="text-muted mb-1 text-truncate">Draft Reservations</p>
                                </div>
                            </div>
                        </div> <!-- end row-->
                    </div>
                </div> <!-- end widget-rounded-circle-->
            </div> <!-- end col-->

            <div class="col-md-6 col-xl-3">
                <div class="widget-rounded-circle card">
                    <div class="card-body">
                        <div class="row">

                            <div class="col-12">
                                <div class="text-center">
                                    <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $completedNonSwaps }}</span></h3>
                                    <p class="text-muted mb-1 text-truncate">Completed Reservations</p>
                                </div>
                            </div>
                        </div> <!-- end row-->
                    </div>
                </div> <!-- end widget-rounded-circle-->
            </div> <!-- end col-->

            <div class="col-md-6 col-xl-3">
                <div class="widget-rounded-circle card">
                    <div class="card-body">
                        <div class="row">

                            <div class="col-12">
                                <div class="text-center">
                                    <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $listOffers }}</span></h3>
                                    <p class="text-muted mb-1 text-truncate">All Offers</p>
                                </div>
                            </div>
                        </div> <!-- end row-->
                    </div>
                </div> <!-- end widget-rounded-circle-->
            </div> <!-- end col-->

            <div class="col-md-6 col-xl-3">
                <div class="widget-rounded-circle card">
                    <div class="card-body">
                        <div class="row">

                            <div class="col-12">
                                <div class="text-center">
                                    <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $listOfferPending }}</span></h3>
                                    <p class="text-muted mb-1 text-truncate">Pending Offers</p>
                                </div>
                            </div>
                        </div> <!-- end row-->
                    </div>
                </div> <!-- end widget-rounded-circle-->
            </div> <!-- end col-->

            <div class="col-md-6 col-xl-3">
                <div class="widget-rounded-circle card">
                    <div class="card-body">
                        <div class="row">

                            <div class="col-12">
                                <div class="text-center">
                                    <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $listOfferUpcoming }}</span></h3>
                                    <p class="text-muted mb-1 text-truncate">Upcoming Offers</p>
                                </div>
                            </div>
                        </div> <!-- end row-->
                    </div>
                </div> <!-- end widget-rounded-circle-->
            </div> <!-- end col-->

            <div class="col-md-6 col-xl-3">
                <div class="widget-rounded-circle card">
                    <div class="card-body">
                        <div class="row">

                            <div class="col-12">
                                <div class="text-center">
                                    <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $listOfferCancelled }}</span></h3>
                                    <p class="text-muted mb-1 text-truncate">Cancelled Offers</p>
                                </div>
                            </div>
                        </div> <!-- end row-->
                    </div>
                </div> <!-- end widget-rounded-circle-->
            </div> <!-- end col-->

            <div class="col-md-6 col-xl-3">
                <div class="widget-rounded-circle card">
                    <div class="card-body">
                        <div class="row">

                            <div class="col-12">
                                <div class="text-center">
                                    <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $listOfferCompleted }}</span></h3>
                                    <p class="text-muted mb-1 text-truncate">Completed Offers</p>
                                </div>
                            </div>
                        </div> <!-- end row-->
                    </div>
                </div> <!-- end widget-rounded-circle-->
            </div> <!-- end col-->

        </div>
        <!-- end row-->

    </div> <!-- container -->

</div>
@endsection

@section('extra_js')@endsection
