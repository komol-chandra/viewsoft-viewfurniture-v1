<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
    integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script src="{{asset('backend')}}/assets/plugins/global/plugins.bundle.js"></script>
<script src="{{asset('backend')}}/assets/js/scripts.bundle.js"></script>
<script src="{{asset('backend')}}/assets/js/custom/modals/new-card.js"></script>

<script src="{{asset('backend')}}/assets/js/custom/widgets.js"></script>
<script src="{{asset('backend')}}/assets/datatabels/dataTables.min.js"></script>
<script src="{{asset('backend')}}/assets/datatabels/dataTables-active.js"></script>
<script src="{{asset('backend')}}/assets/js/custom/pages/projects/settings/settings.js"></script>

{{-- <script src="{{asset('backend')}}/assets/js/custom/apps/chat/chat.js"></script> --}}
<script src="{{asset('backend')}}/assets/js/custom/modals/create-app.js"></script>
<script src="{{asset('backend')}}/assets/js/custom/modals/upgrade-plan.js"></script>
<script src="{{ asset('https://unpkg.com/sweetalert/dist/sweetalert.min.js')}}"></script>



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
<script src="{{asset('backend')}}/assets/izitost.js"></script>
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
<!-- include libraries(jQuery, bootstrap) -->

<script src="{{asset('backend')}}/assets/js/spartan-multi-image-picker.js"></script>
<!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script src="{{asset('backend')}}/assets/plugins/ckeditor/ckeditor.js"></script>
<script src="{{asset('backend')}}/assets/plugins/ckeditor/ckeditor-active.js"></script>
<script src="{{asset('backend')}}/assets/plugins/Bootstrap-4-Tag-Input-Plugin-jQuery/tagsinput.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-tagsinput/1.3.6/jquery.tagsinput.min.js"></script>
<script src="{{asset('backend')}}/assets/plugins/Bootstrap-4-Tag-Input-Plugin-jQuery/tagsinput.js"></script>
<script>
    $("input[data-role=tagsinput], select[multiple][data-role=tagsinput]").tagsinput();

</script>

<script>
    $(document).ready(function () {
        $(".tags").tagsinput('items');
        $("#searchitem").select2({
            minimumResultsForSearch: Infinity
        });
    });

</script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function () {
        $('.js-example-basic-multiple').select2();
    });

</script>


<script>
    CKEDITOR.replace('editor1');

</script>
<script>
    $(document).ready(function () {

        $('#container').removeClass('mainnav-lg').addClass('mainnav-sm');
        $("#thumbnail_img").spartanMultiImagePicker({
            fieldName: 'thumbnail_img',
            maxCount: 1,
            rowHeight: '200px',
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
            rowHeight: '450px',
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
<script>
    $(document).ready(function () {
        $('#summernote').summernote({
            height: 300,
        });
    });

</script>
@yield('js')
