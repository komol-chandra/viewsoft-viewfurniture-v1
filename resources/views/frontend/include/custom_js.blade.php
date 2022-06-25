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
<script>
    function adClickCount() {
        var id = $('.ads_click').attr("data-id");
        // alert(id);
        $.ajax({
            url: "{{ url('/ads_click') }}/" + id,
            type: 'get',
            success: function (data) {
                if (data) {
                    console.log('increased');
                } else {
                    console.log(error)
                }
            }
        })
    }

    function categoryHeadCount() {
        var id = $('.category_head_click').attr("data-id");
        $.ajax({
            url: "{{ url('/ads_click') }}/" + id,
            type: 'get',
            success: function (data) {
                if (data) {
                    console.log('increased');
                } else {
                    console.log(error)
                }
            }
        })
    }

    function categoryFooterCount() {
        var id = $('.category_footer_click').attr("data-id");
        $.ajax({
            url: "{{ url('/ads_click') }}/" + id,
            type: 'get',
            success: function (data) {
                if (data) {
                    console.log('increased');
                } else {
                    console.log(error)
                }
            }
        })
    }

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

<script>
    function customChooseProduct(el) {
        $('#loaderIcon').show();
        var product_id = $(el).data("id");
        // alert(product_id);
        if (product_id) {
            $.ajax({
                url: "{{  url('/get/product/customchoose/') }}/" + product_id,
                type: "GET",
                //dataType: "json",
                success: function (product) {
                    $("#custom_choose").html(product);
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
