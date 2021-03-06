<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/logo-icon.png') }}">
        <link href="{{ asset('dashboard') }}/css/style.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.css" />
        <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
        <link rel="stylesheet" href="{{ asset('css') }}/style.css">
        <title>Login Page</title>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mt-5">
                    <h1>{{ $data->heading_1 }}</h1>
                    <h1>{{ $data->heading_2 }}</h1>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-sm-12 col-lg-8 text-center">
                    <!-- Slider main container -->
                    <div class="swiper-container">
                        <!-- Additional required wrapper -->
                        <div class="swiper-wrapper">
                            <!-- Slides -->
                            <div class="swiper-slide">
                                <img src="{{ asset('images') }}/t_1.jpg" class="img-slide"/>
                            </div>
                            {{-- <div class="swiper-slide">
                                <img src="{{ asset('images') }}/t_2.jpg" class="img-slide"/>
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('images') }}/t_3.jpg" class="img-slide"/>
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('images') }}/t_4.jpg" class="img-slide"/>
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('images') }}/t_5.jpg" class="img-slide"/>
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('images') }}/t_6.jpg" class="img-slide"/>
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('images') }}/t_7.jpg" class="img-slide"/>
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('images') }}/t_8.jpg" class="img-slide"/>
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('images') }}/t_9.jpg" class="img-slide"/>
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('images') }}/t_10.jpg" class="img-slide"/>
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('images') }}/t_11.jpg" class="img-slide"/>
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('images') }}/t_12.jpg" class="img-slide"/>
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('images') }}/t_13.jpg" class="img-slide"/>
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('images') }}/t_14.jpg" class="img-slide"/>
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('images') }}/t_15.jpg" class="img-slide"/>
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('images') }}/t_16.jpg" class="img-slide"/>
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('images') }}/t_17.jpg" class="img-slide"/>
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('images') }}/t_18.jpg" class="img-slide"/>
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('images') }}/t_19.jpg" class="img-slide"/>
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('images') }}/t_20.jpg" class="img-slide"/>
                            </div> --}}
                        </div>
                        <!-- If we need pagination -->
                        <div class="swiper-pagination"></div>

                        <!-- If we need navigation buttons -->
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-12 mt-2 justify-content-center text-white content">
                    <div class="card">
                        <div class="card-body">
                            {!! $data->content !!}
                            @if (Auth::check())
                                <a href="{{ route('home') }}" class="btn btn-dark text-light btn-rounded w-100">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-dark text-light btn-rounded w-100">Login</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="{{ asset('dashboard') }}/js/jquery.min.js"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.js"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    @yield('script')

    <script>
        const swiper = new Swiper('.swiper-container', {
            // Optional parameters
            // loop: true,
            autoplay:true,
            // If we need pagination
            pagination: {
                el: '.swiper-pagination',
                dynamicBullets: true,
            },

            // Navigation arrows
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    </script>
    </body>
</html>
