<!-- =========== defult theme css files =============== -->
<link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/simple-line-icons.css">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/themify-icons.css">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/ionicons.min.css">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/owl.carousel.min.css">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/owl.theme.default.min.css">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/swiper.min.css">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/animate.css">



<!-- =================== style home-1 ================= -->
{{-- <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/style.css">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/responsive.css"> --}}

<!-- =================== style home-9 ================= -->
<link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/style.css">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/responsive.css">

<link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/style9.css">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/responsive9.css">

<!-- =================== custom style files ================= -->
<link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/custom-size-color.css">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/custom-style.css">
<!-- preloader csss -->
<style>
    img.img-fluid.asif {
        height: 40px;
    }

    #preloaderss {
        visibility: hidden;
        position: absolute;
        z-index: +100 !important;
        width: 100%;
        height: 100%;
    }

    #preloaderss img {
        position: relative;
        top: 50%;
        left: 40%;
    }

</style>
<!-- =================== plugin css files ================= -->

{{-- <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}

<link rel="stylesheet" type="text/css" href="{{asset('backend/assets/izitost.css')}}">
<link href="{{ asset('frontend') }}/css/select2.min.css" rel="stylesheet" />
<link href="{{ asset('frontend') }}/css/summernote-lite.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{asset('backend')}}/assets/datatabels/dataTables.min.css">
<link href="{{asset('backend')}}/assets/css/bootstrap-tagsinput.css" rel="stylesheet" type="text/css" />
<style type="text/css">
    .img_laz {
        width: 100%;
        /* height: 350px; */
        border: 1px solid #e1e1e1;
    }

    .img_laz_logo {
        width: 100%;
        height: 60px;
        border: 1px solid #e1e1e1;
    }

</style>
@yield('css')
