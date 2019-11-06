<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <!-- Styles -->
        @include('partials.welcome.styles') 
        @yield('styles')

        <title>@yield('title') | {{env('APP_NAME')}}</title>
    </head>
<body>
    <!-- Preloader -->
    <div class="preLoader">
        <div class="preload-inner">
            <div class="sk-cube-grid">
                <div class="sk-cube sk-cube1"></div>
                <div class="sk-cube sk-cube2"></div>
                <div class="sk-cube sk-cube3"></div>
                <div class="sk-cube sk-cube4"></div>
                <div class="sk-cube sk-cube5"></div>
                <div class="sk-cube sk-cube6"></div>
                <div class="sk-cube sk-cube7"></div>
                <div class="sk-cube sk-cube8"></div>
                <div class="sk-cube sk-cube9"></div>
            </div>
        </div>
    </div>
    <!-- End Of Preloader -->

    <!-- Main header -->
         @include('partials.welcome.header')
    <!-- End of Main header -->
    
    <!-- home banner area -->
         @include('partials.welcome.banner') 
    <!-- End of home banner area -->

    <!-- feature area -->
         @include('partials.welcome.features')
    <!-- End of feature area -->

    <!-- Counter up area -->
         @include('partials.welcome.counter')
    <!-- /.End of Counter up area -->

    <!-- interact user -->
    <section class="bg-2 pt-120 pb-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-sm-7">
                    <!-- user interact image -->
                    <div class="user-interact-image">
                        <img src="assets/img/feature/user-interact.png"  alt="">
                    </div>
                    <!-- End of user interact image -->
                </div>
                <div class="col-lg-5 col-sm-5">
                    <!-- user ineract text -->
                    <div class="user-interact-inner">
                        <div class="interact-icon">
                            <img src="assets/img/icons/teamwork.svg" class="svg" alt="">
                        </div>
                        <h2>Interact With Your Users On Every Single Platform</h2>
                        <p>
                            There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form,
                            by injected humour.
                        </p>
                        <a href="#" class="btn">Get Started</a>
                    </div>
                    <!--End of user ineract text -->
                </div>
            </div>
        </div>
    </section>
    <!-- interact user -->

    <!-- interact user -->
    <section class="pt-120 pb-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-sm-5">
                    <!-- user ineract text -->
                    <div class="user-interact-inner">
                        <div class="interact-icon">
                            <img src="assets/img/icons/solution1.svg" class="svg" alt="">
                        </div>
                        <h2>Interact With Your Users On Every Single Platform</h2>
                        <p>
                            There are many variations of passages of Lorem Ipsum available, but the majority have suffered
                            alteration in some form,
                            by injected humour.
                        </p>
                        <a href="#" class="btn">Get Started</a>
                    </div>
                    <!--End of user ineract text -->
                </div>
                <div class="col-lg-7 col-sm-7">
                    <!-- user interact image -->
                    <div class="user-interact-image type2">
                        <img src="assets/img/feature/user-interact2.png"  alt="">
                    </div>
                    <!-- End of user interact image -->
                </div>
            </div>
        </div>
    </section>
    <!-- interact user -->

    <!-- app video -->
    <section class="app-video">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- why bottle video -->
                    <div class="theme-video-wrap">
                        <a href="https://www.youtube.com/watch?v=SZEflIVnhH8" class="video-btn" data-popup="video"><i class="fa fa-play"></i></a>
                    </div>
                    <!-- end of why bottle video -->
                </div>
            </div>
        </div>
    </section>
    <!-- End of why bottol water -->
    
    <!-- app screen -->
         @include('partials.welcome.screenshots')
    <!-- End of app screen -->

    <!-- app pricing plan -->
         @include('partials.welcome.pricing') 
    <!-- End of app pricing plan -->

    <!-- testimonial area -->
         @include('partials.welcome.testimonials')
    <!--End of testimonial area -->

    <!-- our partner -->
         @include('partials.welcome.partners')
    <!-- End of our partner -->
    
    <!-- footer -->
         @include('partials.welcome.footer')

    <!-- back to top -->
    <div class="back-to-top">
        <a href="#"><i class="fa fa-chevron-up"></i></a>
    </div>
    <!-- back to top -->


    <!-- JS Files -->
    @include('partials.welcome.scripts') 

</body>
</html>
