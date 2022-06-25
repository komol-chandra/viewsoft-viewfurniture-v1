<!--======= defult theme script files ============== -->
<script src="{{ asset('frontend') }}/js/modernizr-2.8.3.min.js"></script>
<script src="{{ asset('frontend') }}/js/jquery-3.6.0.min.js"></script>
<script src="{{ asset('frontend') }}/js/imagesloaded.pkgd.min.js"></script>
<script src="{{ asset('frontend') }}/js/jquery.isotope.min.js"></script>
<script src="{{ asset('frontend') }}/js/bootstrap.min.js"></script>
<script src="{{ asset('frontend') }}/js/popper.min.js"></script>
<script src="{{ asset('frontend') }}/js/fontawesome.min.js"></script>
<script src="{{ asset('frontend') }}/js/owl.carousel.min.js"></script>
<script src="{{ asset('frontend') }}/js/swiper.min.js"></script>
<script src="{{ asset('frontend') }}/js/custom.js"></script>
@yield('before_js')

<!--======= plugin script files ============== -->
<script src="{{ asset('frontend') }}/js/jquery.lazyload.js"></script>
<script src="{{ asset('frontend') }}/js/sweetalert.min.js"></script>
<script src="{{ asset('frontend') }}/js/sweetalert2@11.js"></script>
<script>
    $(document).ready(function () {
        $(".img_laz").lazyload({
            effect: "fadeIn"
        });
    })

</script>

<script>
    $(document).on("click", "#delete", function (e) {
        e.preventDefault();
        var link = $(this).attr("href");
        swal({
                title: "Are you Want to delete?",
                text: "Once Delete, This will be Permanently Delete!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    window.location.href = link;
                } else {
                    swal("Safe Data!");
                }
            });
    });

</script>

<script src="{{asset('backend/assets/izitost.js')}}"></script>

<script>
    @if(Session::has('messege'))
    var type = "{{Session::get('alert-type','info')}}"
    switch (type) {
        case 'success':
            iziToast.success({
                message: '{{ Session::get('
                messege ') }}',
                'position': 'topRight'
            });
            break;
        case 'info':
            iziToast.info({
                message: '{{ Session::get('
                messege ') }}',
                'position': 'topRight'
            });
            break;
        case 'warning':
            iziToast.warning({
                message: '{{ Session::get('
                messege ') }}',
                'position': 'topRight'
            });
            break;
        case 'error':
            iziToast.error({
                message: '{{ Session::get('
                messege ') }}',
                'position': 'topRight'
            });
            break;
    }
    @endif

</script>

<script src="{{asset('backend')}}/assets/plugins/ckeditor/ckeditor.js"></script>
<script src="{{asset('backend')}}/assets/plugins/ckeditor/ckeditor-active.js"></script>
<script src="{{asset('backend')}}/assets/datatabels/dataTables.min.js"></script>
<script src="{{asset('backend')}}/assets/datatabels/dataTables-active.js"></script>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script type="text/javascript" src="{{asset('backend')}}/assets/js/image-uploader.min.js"></script>
<script src="{{asset('backend')}}/assets/js/spartan-multi-image-picker.js"></script>
{{-- <script>
    $('.input-images').imageUploader();

</script> --}}

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.min.js"></script>
<script>
    $(document).ready(function () {
        $('.select2-multi').select2();
    });

</script>
<script>
    $(document).ready(function () {
        $('#summernote').summernote({
            height: 300,
        });
    });

</script>
@yield('js')
