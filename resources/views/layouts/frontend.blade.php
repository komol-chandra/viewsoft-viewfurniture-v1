<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ $Seo->meta_title }}">
    <meta name="keywords" content="{{ $Seo->meta_keyword }}">
    <meta name="author" content="{{ $Seo->meta_author }}">
    <link rel="icon" href="{{ asset('uploads/logo/'.$companyInformation->favicon) }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('uploads/logo/'.$companyInformation->favicon) }}" type="image/x-icon">
    @yield('product_share')
    <title>{{ $companyInformation->company_name }} | @yield('title')</title>
    <link rel="shortcut icon" type="{{ asset('uploads/logo/'.$companyInformation->favicon) }}"
        href="{{ asset('uploads/logo/'.$companyInformation->favicon) }}">

    @include('frontend.include.css')
    <style>
        #content {
            /* display: none; */
        }

    </style>
    <script type='text/javascript'
        src='https://platform-api.sharethis.com/js/sharethis.js#property=6285e6409b97c100194c8a09&product=sop'
        async='async'></script>
</head>

<body>
    @include('sweetalert::alert')
    <div id="preloaderss">
        <img src="{{ asset('frontend/Pulse-1s-200px.svg') }}" alt="">
    </div>
    <div id="content">
        @include('frontend.include.header')
        @yield('head')
        @yield('content')
        @include('frontend.include.footer')


        <!--=================== order track modal ===================-->
        <div class="modal fade" id="order_track" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="{{ url('/track-order') }}" method="get">
                        <div class="modal-body ">
                            <h5 class="modal-title" id="exampleModalLabel"> Track your Order</h5>


                            <div class="col-md-12 mt-1">
                                <input type="text" id="order_id" name="order_id" class="form-control order_id"
                                    name="order_id" placeholder="Enter your Order Id" required>
                            </div>
                            <div class="col-md-12 mt-2">
                                <button type="submit" class="btn btn-primary btn-sm " id="orderTrackBtn">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--=================== quick view modal ===================-->

        <section class="quick-view">
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content" id="modalview">

                    </div>
                </div>
            </div>
        </section>
        <!--=================== Custom Choose modal ===================-->

        <section class="quick-view">
            <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModal2Label"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content" id="custom_choose">

                    </div>
        </section>

        @include('frontend.include.footer-head')

        <a href="javascript:void(0)" class="scroll" id="top">
            <span><i class="fa fa-angle-double-up"></i></span>
        </a>
        <div class="mm-fullscreen-bg"></div>
    </div>
    @include('frontend.include.js')
    @include('frontend.include.custom_js')

</body>

</html>
