<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="multikart">
    <meta name="keywords" content="multikart">
    <meta name="author" content="multikart">
    <link rel="icon" href="{{ asset('frontend/assets') }}/images/favicon/1.png" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('frontend/assets') }}/images/favicon/1.png" type="image/x-icon">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Multikart - Multi-purpopse E-commerce Html Template</title>

    <!--Google font-->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets') }}/css/vendors/fontawesome.css">

    <!-- Animate icon -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets') }}/css/vendors/animate.css">

    <!-- Themify icon -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets') }}/css/vendors/themify-icons.css">

    <!-- Bootstrap css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets') }}/css/vendors/bootstrap.css">

    <!-- Theme css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets') }}/css/style.css">


</head>

<body class="theme-color-1 bg-light">


    <!-- invoice start -->
    <section class="theme-invoice-3 section-b-space">
        <div class="container">
            <div class="row">
                <div class="col-xl-9 m-auto">
                    <div class="invoice-wrapper">
                        <div class="invoice-header">
                            <ul>
                                <li>
                                    <img src="../assets/images/icon/logo.png" class="img-fluid" alt="logo">
                                </li>
                                <li>
                                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                                    <h4>multikart demo store</h4>
                                </li>
                                <li>
                                    <i class="fa fa-envelope" aria-hidden="true"></i>
                                    <h4>support@multikart.com</h4>
                                </li>
                            </ul>
                        </div>
                        <div class="invoice-body">
                            <div class="top-sec">
                                <div class="row">
                                    <div class="col-lg-8 col-sm-6">
                                        <div class="address-detail">
                                            <h2>invoice</h2>
                                            <div class="mt-3">
                                                <h4 class="mb-2">
                                                    2664 Tail Ends Road, ORADELL
                                                </h4>
                                                <h4 class="mb-0">New Jersey, 07649</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-6 mt-md-0 mt-2">
                                        <ul class="date-detail">
                                            <li><span>issue date :</span>
                                                <h4> 20 march, 2020</h4>
                                            </li>
                                            <li><span>invoice no :</span>
                                                <h4> 908452</h4>
                                            </li>
                                            <li><span>email :</span>
                                                <h4> user@gmail.com</h4>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive-md">
                                <table class="table table-borderless mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">name</th>
                                            <th scope="col">price</th>
                                            <th scope="col">quantity.</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($product as $key => $obj)
                                        @php $product_image =
                                        App\Models\Product::where('id',$obj->id)->select(['image'])->first();@endphp
                                        <tr>
                                            <th scope="row">{{$key+1}}</th>
                                            <td>{{Str::limit($obj->product_name,20)}}</td>
                                            <td>${{$obj->price}}</td>
                                            <td>{{$obj->qty}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>

                                            <td colspan="2"></td>
                                            <td class="font-bold text-dark" colspan="2">GRAND TOTAL</td>
                                            <td class="font-bold text-theme">$$@php echo str_replace(',', '',
                                                $data->total_amount) +
                                                70;@endphp</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="invoice-footer pt-0">
                            <div class="row">
                                <div class="col-6">
                                    <a href="#" class="btn black-btn btn-solid rounded-2"
                                        onclick="window.print();">export as PDF</a>
                                </div>
                                <div class="col-6 text-end">
                                    <a href="#" class="btn btn-solid rounded-2" onclick="window.print();">print</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- invoice end -->


    <!-- latest jquery-->
    <script src="{{ asset('frontend/assets') }}/js/jquery-3.3.1.min.js"></script>

    <!-- Bootstrap js-->
    <script src="{{ asset('frontend/assets') }}/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.print/1.6.2/jQuery.print.min.js"
        integrity="sha512-t3XNbzH2GEXeT9juLjifw/5ejswnjWWMMDxsdCg4+MmvrM+MwqGhxlWeFJ53xN/SBHPDnW0gXYvBx/afZZfGMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>

</html>