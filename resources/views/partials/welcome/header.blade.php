    <header class="header">
        <!-- Start Header Navbar-->
        <div class="main-header">
            <div class="main-menu-wrap">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-xl-3 col-lg-3 col-md-4 col-6">
                            <!-- Logo -->
                            <div class="logo">
                                <a href="/">
                                    <img src="assets/img/logo.png" data-rjs="2" alt="{{env('APP_NAME')}}">
                                </a>
                            </div>
                            <!-- End of Logo -->
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-4 col-6 menu-button">
                            <div class="menu--inner-area clearfix">
                                <div class="menu-wraper">
                                    <nav>
                                        <!-- Header-menu -->
                                        <div class="header-menu dosis">
                                            <ul>
                                                <li class="active"><a href="#">Home</a>
                                                    <ul>
                                                        <li class="active"><a href="index.html">Home 1</a></li>
                                                        <li><a href="index2.html">Home 2</a></li>
                                                    </ul>
                                                </li>
                                                <li><a href="#features">Features</a></li>
                                                <li><a href="#app">App Screens</a></li>
                                                <li><a href="#pricing  ">Pricing</a></li>
                                            </ul>
                                        </div>
                                        <!-- End of Header-menu -->
                                    </nav>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-5 d-md-block d-none">
                            @auth
                             <div class="urgent-call text-right">
                                <a href="{{ url('/dashboard') }}">DashBoard</a>
                            </div>
                            @else
                            <div class="urgent-call text-right">
                                <a href="{{ route('login') }}">Login</a>
                            </div>
        {{--                    <a href="{{ route('register') }}">Register</a>--}}
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Header Navbar-->
    </header>