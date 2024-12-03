<div class="app-menu">

    <!-- Brand Logo -->
    <div class="logo-box">
        <!-- Brand Logo Light -->
        <a href="{{route('adminDashboard')}}" class="logo-light">
            <img src="{{asset('/assets/backend/images/roomzhub-logo.png')}}" alt="logo" class="logo-lg">
            <img src="{{asset('/assets/backend/images/roomzhub-logo.png')}}" alt="small logo" class="logo-sm">
            <h4>Holiday Hub</h4>
        </a>

        <!-- Brand Logo Dark -->
        <a href="{{route('adminDashboard')}}" class="logo-dark">
            <img src="{{asset('/assets/backend/images/roomzhub-logo.png')}}" alt="logo" class="logo-lg">
            <img src="{{asset('/assets/backend/images/roomzhub-logo.png')}}" alt="small logo" class="logo-sm">
            <h4>Holiday Hub</h4>
        </a>
    </div>

    <!-- menu-left -->
    <div class="scrollbar">

        <!-- User box -->
        <div class="user-box text-center">
            <img src="{{asset('/assets/backend/images/users/user-1.jpg')}}" alt="user-img" title="Mat Helme" class="rounded-circle avatar-md">
            <div class="dropdown">
                <a href="javascript: void(0);" class="dropdown-toggle h5 mb-1 d-block" data-bs-toggle="dropdown">{{Auth::guard('web')->user()->name}}</a>
                <div class="dropdown-menu user-pro-dropdown">

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-user me-1"></i>
                        <span>My Account</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-settings me-1"></i>
                        <span>Settings</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-lock me-1"></i>
                        <span>Lock Screen</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-log-out me-1"></i>
                        <span>Logout</span>
                    </a>

                </div>
            </div>
            <p class="text-muted mb-0">Admin Head</p>
        </div>

        <!--- Menu -->
        <ul class="menu">

            <li class="menu-title">Navigation</li>

            <li class="menu-item">
                <a href="{{route('adminDashboard')}}" class="menu-link">
                    <span class="menu-icon"><i data-feather="airplay"></i></span>
                    <span class="menu-text"> Dashboard</span>
                </a>
            </li>

            <li class="menu-title">Users</li>

            <li class="menu-item">
                <a href="#userListings" data-bs-toggle="collapse" class="menu-link">
                    <span class="menu-icon"><i class="fa fa-home"></i></span>
                    <span class="menu-text"> Users Lists </span>
                    <span class="menu-arrow ms-auto"><i class="fa fa-angle-right"></i></span>
                </a>
                <div class="collapse" id="userListings">
                    <ul class="sub-menu">
                        <li class="menu-item">
                            <a href="{{route('allUser')}}" class="menu-link">
                                <span class="menu-text">All Users</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{route('allUser', 'swap')}}" class="menu-link">
                                <span class="menu-text">Swap Property Users</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{route('allUser', 'reservation')}}" class="menu-link">
                                <span class="menu-text">Reservation Property Users</span>
                            </a>
                        </li>


                    </ul>
                </div>
            </li>

            <li class="menu-title">Swap Property</li>

            <li class="menu-item">
                <a href="#swapListings" data-bs-toggle="collapse" class="menu-link">
                    <span class="menu-icon"><i class="fa fa-home"></i></span>
                    <span class="menu-text"> Swap Property Lists </span>
                    <span class="menu-arrow ms-auto"><i class="fa fa-angle-right"></i></span>
                </a>
                <div class="collapse" id="swapListings">
                    <ul class="sub-menu">
                        <li class="menu-item">
                            <a href="{{route('allHomeSwap')}}" class="menu-link">
                                <span class="menu-text">All Swap Properties</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{route('allHomeSwap', 'draft')}}" class="menu-link">
                                <span class="menu-text">Draft Swap Properties</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{route('allHomeSwap', 'completed')}}" class="menu-link">
                                <span class="menu-text">Completed Swap Properties</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{route('allHomeSwap', 'deactivated')}}" class="menu-link">
                                <span class="menu-text">Deactivated Swap Properties</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{route('allHomeSwap', 'suspended')}}" class="menu-link">
                                <span class="menu-text">Suspended Swap Properties</span>
                            </a>
                        </li>


                    </ul>
                </div>
            </li>

            <li class="menu-title">Reservation Property</li>

            <li class="menu-item">
                <a href="#nonswapListings" data-bs-toggle="collapse" class="menu-link">
                    <span class="menu-icon"><i class="fa fa-home"></i></span>
                    <span class="menu-text"> Reserved Property Lists </span>
                    <span class="menu-arrow ms-auto"><i class="fa fa-angle-right"></i></span>
                </a>
                <div class="collapse" id="nonswapListings">
                    <ul class="sub-menu">
                        <li class="menu-item">
                            <a href="{{route('allNonSwap')}}" class="menu-link">
                                <span class="menu-text">All Reserved Properties</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{route('allNonSwap', 'draft')}}" class="menu-link">
                                <span class="menu-text">Draft Reserved Properties</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{route('allNonSwap', 'completed')}}" class="menu-link">
                                <span class="menu-text">Completed Reserved Properties</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{route('allNonSwap', 'deactivated')}}" class="menu-link">
                                <span class="menu-text">Deactivated Reserved Properties</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{route('allNonSwap', 'suspended')}}" class="menu-link">
                                <span class="menu-text">Suspended Reserved Properties</span>
                            </a>
                        </li>


                    </ul>
                </div>
            </li>

            <li class="menu-title">Offers</li>

            <li class="menu-item">
                <a href="#nonswapListings" data-bs-toggle="collapse" class="menu-link">
                    <span class="menu-icon"><i class="fa fa-home"></i></span>
                    <span class="menu-text"> Offers Lists </span>
                    <span class="menu-arrow ms-auto"><i class="fa fa-angle-right"></i></span>
                </a>
                <div class="collapse" id="nonswapListings">
                    <ul class="sub-menu">
                        <li class="menu-item">
                            <a href="{{route('allOffer')}}" class="menu-link">
                                <span class="menu-text">All Offers</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{route('allOffer', 'pending')}}" class="menu-link">
                                <span class="menu-text">Pending Offers</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{route('allOffer', 'upcoming')}}" class="menu-link">
                                <span class="menu-text">Upcoming Offers</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{route('allOffer', 'cancelled')}}" class="menu-link">
                                <span class="menu-text">Cancelled Offers</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{route('allOffer', 'completed')}}" class="menu-link">
                                <span class="menu-text">Completed Offers</span>
                            </a>
                        </li>


                    </ul>
                </div>
            </li>


            <li class="menu-title d-none">Payments</li>

            <li class="menu-item d-none">
                <a href="#allPayment" data-bs-toggle="collapse" class="menu-link">
                    <span class="menu-icon"><i class="fa fa-money"></i></span>
                    <span class="menu-text">All Payments </span>
                    <span class="menu-arrow ms-auto"><i class="fa fa-angle-right"></i></span>
                </a>
                <div class="collapse" id="allPayment">
                    <ul class="sub-menu">
                        <li class="menu-item">
                            <a href="/" class="menu-link">
                                <span class="menu-text">All Payments</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

        </ul>
        <!--- End Menu -->
        <div class="clearfix"></div>
    </div>
</div>
