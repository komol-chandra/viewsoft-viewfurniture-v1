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
    <link rel="shortcut icon" type="{{ asset('frontend') }}/image/favicon"
        href="{{ asset('frontend') }}/image/fevicon.png">
    @include('frontend.include.css')
    <style>
        #content {
            /* display: none; */
        }

    </style>
</head>

<body class="home-1">
    @include('sweetalert::alert')
    <div id="preloaderss">
        <img src="{{ asset('frontend/Pulse-1s-200px.svg') }}" alt="">
    </div>

    <div id="content">

        @include('frontend.include.header')
        @yield('head')
        @yield('content')


        {{-- @include('frontend.include.modal') --}}
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

        @include('frontend.include.footer')
        <br class="footer-head-br">
        @include('frontend.include.footer-head')
        <a href="javascript:void(0)" class="scroll" id="top">
            <span><i class="fa fa-angle-double-up"></i></span>
        </a>
        <div class="mm-fullscreen-bg"></div>
    </div>
    @include('frontend.include.js')

    <!--========== fixed footer head   ============= -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            window.addEventListener('scroll', function () {
                if (window.scrollY > 250) {
                    document.getElementById('navbar_top').classList.add('fixed-bottom');
                    // add padding top to show content behind navbar
                    navbar_height = document.querySelector('.navbar').offsetHeight;
                    document.body.style.paddingTop = navbar_height + 'px';
                } else {
                    document.getElementById('navbar_top').classList.remove('fixed-bottom');
                    // remove padding top from body
                    document.body.style.paddingTop = '0';
                }
            });
        });

    </script>

    <script>
        $(document).ready(function () {
            cartupload();
            cartcount();
        });

    </script>


    <!--========== add single product to cart data  ============= -->

    <script>
        function detailsToCart() {
            var str = $("#option-choice-form").serialize();
            $('#preloaderss').css("visibility", "visible");
            $.ajax({
                url: "{{url('/addtocart')}}",
                type: 'get',
                data: $("#option-choice-form").serialize(),

                success: function (data) {
                    $('#preloaderss').css("visibility", "hidden");
                    $(".btn-style-asif").html("Loading..");
                    $(".btn-style-asif").html('<i class="fa fa-shopping-bag"></i> Add to cart');
                    if (data.success) {

                        cartupload();
                        cartcount();
                        Swal.fire({
                            toast: true,
                            icon: 'success',
                            title: '' + data.success + '',
                            position: 'top',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal
                                    .stopTimer)
                                toast.addEventListener('mouseleave', Swal
                                    .resumeTimer)
                            }
                        })
                    } else {
                        cartupload();
                        cartcount();
                        Swal.fire({
                            toast: true,
                            icon: 'error',
                            title: 'Add to cart failed',
                            position: 'top',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal
                                    .stopTimer)
                                toast.addEventListener('mouseleave', Swal
                                    .resumeTimer)
                            }
                        })
                    }
                }
            })
        }

        function quickDetailsToCart() {
            $('#preloaderss').css("visibility", "visible");
            var str = $("#option-choice-form-quick-view").serialize();
            $.ajax({
                url: "{{url('/addtocart')}}",
                type: 'get',
                data: $("#option-choice-form-quick-view").serialize(),
                beforeSend: function () {
                    cartcount();
                    setTimeout(function () {}, 2000);
                },
                success: function (data) {
                    $('#preloaderss').css("visibility", "hidden");
                    if (data.success) {
                        cartupload();
                        cartcount();
                        Swal.fire({
                            toast: true,
                            icon: 'success',
                            title: '' + data.success + '',
                            position: 'top',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal
                                    .stopTimer)
                                toast.addEventListener('mouseleave', Swal
                                    .resumeTimer)
                            }
                        })
                    } else {
                        cartupload();
                        cartcount();
                        Swal.fire({
                            toast: true,
                            icon: 'error',
                            title: 'Add to cart failed',
                            position: 'top',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal
                                    .stopTimer)
                                toast.addEventListener('mouseleave', Swal
                                    .resumeTimer)
                            }
                        })
                    }
                }
            })
        }

    </script>

    <script>




    </script>
    <!--========== add single product to wishlist  ============= -->

    <script>
        $(document).ready(function () {
            $(".wishlist").click(function () {
                $('#preloaderss').css("visibility", "visible");
                var str = $("#option-choice-form").serialize();
                $.ajax({
                    url: "{{url('/add-to-wishlist')}}",
                    type: 'get',
                    data: $("#option-choice-form").serialize(),
                    success: function (data) {
                        $('#preloaderss').css("visibility", "hidden");
                        if (data.success) {
                            Swal.fire({
                                toast: true,
                                icon: 'success',
                                title: '' + data.success + '',
                                position: 'top',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal
                                        .stopTimer)
                                    toast.addEventListener('mouseleave', Swal
                                        .resumeTimer)
                                }
                            })
                        } else {
                            Swal.fire({
                                toast: true,
                                icon: 'error',
                                title: 'Add to cart failed',
                                position: 'top',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal
                                        .stopTimer)
                                    toast.addEventListener('mouseleave', Swal
                                        .resumeTimer)
                                }
                            })
                        }
                    }
                })
            });
        });

    </script>
    <!--===================  add to cart from datalist  =============-->
    <script>
        function addtocart(el) {
            var id = el.id;
            var str = $("#cartsection-" + id + "").serialize();
            $.ajax({
                url: "{{url('/addtocart')}}",
                type: 'get',
                data: $("#cartsection-" + id + "").serialize(),
                success: function (data) {
                    if (data.success) {
                        cartupload();
                        cartcount();

                        // cartquantity();
                        // flyingcartupload();

                        Swal.fire({
                            toast: true,
                            icon: 'success',
                            title: '' + data.success + '',
                            position: 'top',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })
                    } else {
                        cartupload();
                        cartcount();

                        // cartquantity();
                        // flyingcartupload();

                        Swal.fire({
                            toast: true,
                            icon: 'error',
                            title: 'Add to cart failed',
                            position: 'top',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })
                    }

                    cartcount();
                }
            })
        }

    </script>
    <!--========== delete cart data data  ============= -->
    <script>
        function deletedata(el) {
            var rowId = el.id;
            $('#preloaderss').css("visibility", "visible");
            $.ajax({
                url: "{{  url('/deletecart/item/') }}/" + rowId,
                type: 'get',
                success: function (data) {
                    $('#preloaderss').css("visibility", "hidden");
                    mainuploadspro();
                    // cartquantity();
                    cartupload();
                    cartcount();

                    // flyingcartupload();
                    // mainCheckoutCart();
                    Swal.fire({
                        toast: true,
                        icon: 'success',
                        title: '' + data.success + '',
                        position: 'top',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    });
                }
            });
            cartupload();
            cartcount();
            mainuploadspro();
        }

    </script>
    <!--========== get cart data  ============= -->
    <script>
        function cartupload() {
            $.ajax({
                url: "{{url('/getcart')}}",
                type: 'get',
                success: function (data) {
                    $("#cart_section").html(data);
                }
            })
        }
        // cartcount();
        cartupload();
        // flyingcartupload();

    </script>
    <script>
        function cartcount() {

            $.ajax({
                url: "{{url('/getcartcount')}}",
                type: 'get',
                success: function (data) {
                    console.log(data);
                    $(".cart_count").html(data);
                }
            });
        }
        cartcount();
        cartupload();

    </script>
    <!--========== main cart page data  ============= -->

    <script>
        function mainuploadspro() {
            $.ajax({
                url: "{{url('/main/getcart/page')}}",
                type: 'get',
                success: function (data) {
                    // console.log(data);
                    $("#maincart_page").html(data);
                }
            });
        }
        mainuploadspro();

    </script>

    <!--========== main cart quantity update  ============= -->

    <script>
        function cartqtyupdate(el) {
            var rowId = el.id;
            var qty = el.value;
            $('#preloaderss').css("visibility", "visible");
            $.ajax({
                url: "{{  url('/increase/item/') }}/" + rowId,
                type: 'get',
                data: {
                    'qty': qty
                },
                success: function (data) {
                    $('#preloaderss').css("visibility", "hidden");
                    mainuploadspro();
                    // cartquantity();
                    cartupload();
                    cartcount();
                    // flyingcartupload();
                    // mainCheckoutCart();
                    Swal.fire({
                        toast: true,
                        icon: 'success',
                        title: '' + data.success + '',
                        position: 'top',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    });


                }
            });
            mainuploadspro();
        }

    </script>
    <!--===================  add to wishlist from datalist  =============-->
    <script>
        function addtowishlist(el) {
            var id = el.id;
            $('#preloaderss').css("visibility", "visible");
            var str = $("#cartsection-" + id + "").serialize();
            $.ajax({
                url: "{{url('/add-to-wishlist')}}",
                type: 'get',
                data: $("#cartsection-" + id + "").serialize(),
                success: function (data) {
                    $('#preloaderss').css("visibility", "hidden");
                    if (data.success) {

                        Swal.fire({
                            toast: true,
                            icon: 'success',
                            title: '' + data.success + '',
                            position: 'top',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })
                    } else {
                        Swal.fire({
                            toast: true,
                            icon: 'error',
                            title: 'Add to cart failed',
                            position: 'top',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })
                    }
                }
            })
        }

    </script>

    <!--========== delete cart data data  ============= -->

    <script>
        function deletewishlistdata(el) {
            $('#preloaderss').css("visibility", "visible");
            var rowId = el.id;
            $.ajax({
                url: "{{  url('/delete-wishlist/item/') }}/" + rowId,
                type: 'get',
                success: function (data) {
                    $('#preloaderss').css("visibility", "hidden");
                    Swal.fire({
                        toast: true,
                        icon: 'success',
                        title: '' + data.success + '',
                        position: 'top',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    });
                    location.reload();
                }
            });
        }

    </script>

    <!--=================== product quick view  =============-->

    <script>
        function quickViewProduct(el) {
            $('#loaderIcon').show();
            var product_id = $(el).data("id");
            // alert(product_id);
            if (product_id) {
                $.ajax({
                    url: "{{  url('/get/product/details/') }}/" + product_id,
                    type: "GET",
                    //dataType: "json",
                    success: function (product) {
                        $("#modalview").html(product);
                    },
                    complete: function () {
                        $('#loaderIcon').hide();
                    }
                });
            }
        }

    </script>

    <!--========== main checkout page data  ============= -->

    <script>
        function mainCheckoutCart() {
            $.ajax({
                url: "{{url('/main/checkout/page')}}",
                type: 'get',
                success: function (data) {
                    $("#checout_cart").html(data);
                }
            });
        }
        mainCheckoutCart();

    </script>
    <link href="{{ asset('frontend') }}/css/summernote.min.css" rel="stylesheet">
    <link href="{{ asset('frontend') }}/js/summernote.min.js" rel="stylesheet">


    {{-- <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script> --}}
    <script>
        $(document).ready(function () {
            $('#summernote').summernote({
                height: 160,
            });
        });

    </script>
    <script src="{{asset('backend')}}/assets/js/spartan-multi-image-picker.js"></script>
    <script>
        $(document).ready(function () {

            $('#container').removeClass('mainnav-lg').addClass('mainnav-sm');
            $("#thumbnail_img").spartanMultiImagePicker({

                fieldName: 'thumbnail_img',
                maxCount: 1,
                rowHeight: '250px',
                groupClassName: 'col-lg-3 col-md-4 col-sm-4 col-xs-6',
                maxFileSize: '',
                dropFileLabel: "Drop Here",
                onExtensionErr: function (index, file) {
                    console.log(index, file, 'extension err');
                    alert('Please only input png or jpg type file')
                },
                onSizeErr: function (index, file) {
                    console.log(index, file, 'file size too big');
                    alert('File size too big');
                }
            });

            $("#photos").spartanMultiImagePicker({
                fieldName: 'photos[]',
                maxCount: 10,
                rowHeight: '200px',
                groupClassName: 'col-xl-3 col-lg-3 col-md-4 col-sm-4 col-xs-6',
                maxFileSize: '',
                dropFileLabel: "Drop Here",
                onExtensionErr: function (index, file) {
                    console.log(index, file, 'extension err');
                    alert('Please only input png or jpg type file')
                },
                onSizeErr: function (index, file) {
                    console.log(index, file, 'file size too big');
                    alert('File size too big');
                }
            });
            $("#product_img").spartanMultiImagePicker({
                fieldName: 'product_img',
                maxCount: 1,
                rowHeight: '250px',
                groupClassName: 'col-xl-12 col-md-12 col-sm-12 col-xs-12',
                maxFileSize: '',
                dropFileLabel: "Drag & Drop",
                onExtensionErr: function (index, file) {
                    console.log(index, file, 'extension err');
                    alert('Please only input png or jpg type file')
                },
                onSizeErr: function (index, file) {
                    console.log(index, file, 'file size too big');
                    alert('File size too big');
                }
            });

        });

    </script>


    <script src="{{asset('backend')}}/assets/plugins/Bootstrap-4-Tag-Input-Plugin-jQuery/tagsinput.js"></script>
    <script src="{{ asset('frontend') }}/js/select2.min.js"></script>

    {{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}
    <script>
        $(document).ready(function () {
            $('.js-example-basic-multiple').select2();
        });

    </script>
</body>

</html>
