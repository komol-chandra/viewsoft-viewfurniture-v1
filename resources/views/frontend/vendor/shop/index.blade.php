@extends('layouts.frontend')
@section('title', 'Vendor Shops')
@section('content')

<section class="order-histry-area section-tb-padding">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="order-history">
                    @include('frontend.customerDashboard.include.sidebar')
                    <div class="order-info">
                        <!-- ===============  card start ==============-->
                        <div class="continer">
                            <div class="col-md-12">
                                <div class="row ">
                                    <div class="col-md-4 mb-4 mt-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="col-md-12 card_start">
                                                    <div class="col-md-5 card_col_5">
                                                        <img src="{{ asset('frontend/image/dashbord/sale.png') }}"
                                                            alt="">
                                                    </div>
                                                    <div class="col-md-7 card_col_7">
                                                        <h2>{{ $countShops }}</h2>
                                                        <h5>Total Shops</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-4 mt-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="col-md-12 card_start">
                                                    <div class="col-md-5 card_col_5">
                                                        <img src="{{ asset('frontend/image/dashbord/homework.png') }}"
                                                            alt="">
                                                    </div>
                                                    <div class="col-md-7 card_col_7">
                                                        <h2>{{ $countUnapprovedShops }}</h2>
                                                        <h5>Unapproved Shops</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-4 mt-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="col-md-12 card_start">
                                                    <div class="col-md-5 card_col_5">
                                                        <img src="{{ asset('frontend/image/dashbord/order.png') }}"
                                                            alt="">
                                                    </div>
                                                    <div class="col-md-7 card_col_7">
                                                        <h2>{{ $countActiveShops }}</h2>
                                                        <h5>Active Shops</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-2 mt-2">
                                        <a class="btn btn-success" style="margin-bottom:10px" data-bs-toggle="modal"
                                            data-bs-target="#kt_modal_new_address">Add Shop</a>
                                    </div>
                                    @foreach($allShop as $key => $shop)

                                    <div class="col-md-4 mb-4 mt-4">
                                        <div class="card">
                                            <a>
                                                <div class="card-body">
                                                    <div class="col-md-12" style="display: flex;">

                                                        <div class="col-md-12 shop_div">
                                                            <h2 class="shop_product_h2"><span
                                                                    class="shop_product">{{ $shop->product_count }}</span>
                                                                Active Products</h2>
                                                            <h5 class="shop_product_h5">{{ $shop->shop_name }}
                                                            </h5>
                                                            <h6 class="shop_product_h6">
                                                                Category:{{ $shop->ShopCategory->name }}

                                                            </h6>
                                                            <h6 class="shop_product_h6">
                                                                commission: {{ $shop->commission_percent }} %

                                                            </h6>
                                                            <p class="mt-1 mb-1 text-info">
                                                                @if($shop->is_approve==1)
                                                                <span class="text-success">Approve</span>@else
                                                                <span class="text-danger">Not Approve</span>@endif
                                                            </p>
                                                            <div style="display: flex">
                                                                <a id=""
                                                                    href="{{ url('/vendor/shop/product/'.$shop->id) }}"><i
                                                                        class="fa fa-eye ms-1" aria-hidden="true"
                                                                        style="margin-right: 10px"></i></a>

                                                                <a class="editshop" data-id="{{ $shop->id }}"
                                                                    aria-hidden="true" data-bs-toggle="modal"
                                                                    data-bs-target="#kt_modal_new_address_update"><i
                                                                        class="fa fa-pencil-square-o me-1"></i></a>


                                                                <a id="delete"
                                                                    href="{{ url('vendor/shop/delete/'.$shop->id) }}"><i
                                                                        class="fa fa-trash-o ms-1"
                                                                        aria-hidden="true"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>

                                    @endforeach



                                </div>
                            </div>
                        </div>
                        <!-- ===============  card end ==============-->

                        {{-- <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Shop Name</th>
                                    <th>Shop Category</th>
                                    <th>Status</th>
                                    <th>Manage</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($allShop as $key => $shop)
                                <tr>
                                    <th scope="row">{{ ++$key }}</th>
                        <td>{{ $shop->shop_name }}</td>
                        <td>{{ $shop->ShopCategory->name }}</td>
                        <td>@if($shop->is_approve==1) <span class="btn-sm btn-success">Approve</span>@else
                            <span class="btn-sm btn-danger">Not Approve</span>@endif</td>
                        <td>
                            <i class="fa fa-pencil-square-o me-1 editshop" data-id="{{ $shop->id }}" aria-hidden="true"
                                data-bs-toggle="modal" data-bs-target="#kt_modal_new_address_update"></i>
                            <a id="delete" href="{{ url('vendor/shop/delete/'.$shop->id) }}"><i
                                    class="fa fa-trash-o ms-1" aria-hidden="true"></i></a>
                        </td>
                        </tr>
                        @endforeach
                        </tbody>
                        </table> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="kt_modal_new_address" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Form-->
            <form class="form" action="{{ url('vendor/shop') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-header" id="kt_modal_new_address_header">
                    <h4>Add New Shop</h4>
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <!--begin::Svg Icon | path: icons/duotone/Navigation/Close.svg-->
                        <span class="svg-icon svg-icon-1">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g transform="translate(12.000000, 12.000000) rotate(-45.000000) translate(-12.000000, -12.000000) translate(4.000000, 4.000000)"
                                    fill="#000000">
                                    <rect fill="#000000" x="0" y="7" width="16" height="2" rx="1" />
                                    <rect fill="#000000" opacity="0.5"
                                        transform="translate(8.000000, 8.000000) rotate(-270.000000) translate(-8.000000, -8.000000)"
                                        x="0" y="7" width="16" height="2" rx="1" />
                                </g>
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </div>
                </div>
                <div class="modal-body py-10 px-lg-17">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="name">Shop Name: <span style="color:red">*</span></label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Enter Shop Name"
                                required>
                        </div>
                        <div class="col-md-12">
                            <label for="name">Shop Category: <span style="color:red">*</span></label>
                            <select name="shop_category" class="form-control">
                                @foreach($allShopcategory as $shop)
                                <option value="{{ $shop->id }}">{{ $shop->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12" style="margin-top:10px">
                            <label for="name">Shop Address: <span style="color:red">*</span></label>
                            <input type="text" name="shop_address" id="" class="form-control"
                                placeholder="Enter Shop Address" required>
                        </div>
                        <br>
                    </div>
                </div>
                <div class="modal-footer flex-center">
                    <button type="submit" class="btn btn-white me-3">Submit</button>
                </div>
            </form>

        </div>
    </div>
</div>
<div class="modal fade" id="kt_modal_new_address_update" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Form-->
            <form class="form" action="{{ url('vendor/shop/update') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-header" id="kt_modal_new_address_header">
                    <h4>Update Shop</h4>
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <!--begin::Svg Icon | path: icons/duotone/Navigation/Close.svg-->
                        <span class="svg-icon svg-icon-1">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g transform="translate(12.000000, 12.000000) rotate(-45.000000) translate(-12.000000, -12.000000) translate(4.000000, 4.000000)"
                                    fill="#000000">
                                    <rect fill="#000000" x="0" y="7" width="16" height="2" rx="1" />
                                    <rect fill="#000000" opacity="0.5"
                                        transform="translate(8.000000, 8.000000) rotate(-270.000000) translate(-8.000000, -8.000000)"
                                        x="0" y="7" width="16" height="2" rx="1" />
                                </g>
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </div>
                </div>
                <div class="modal-body py-10 px-lg-17">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="name">Shop Name: <span style="color:red">*</span></label>
                            <input type="text" name="name" id="shop_name" class="form-control"
                                placeholder="Enter Shop Name" required>
                            <input type="hidden" name="id" id="id">
                        </div>
                        <div class="col-md-12">
                            <label for="name">Shop Category: <span style="color:red">*</span></label>
                            <select name="shop_category" id="shop_category" class="form-control">
                                @foreach($allShopcategory as $shop)
                                <option value="{{ $shop->id }}">{{ $shop->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12" style="margin-top:10px">
                            <label for="name">Shop Address: <span style="color:red">*</span></label>
                            <input type="text" name="shop_address" id="shop_address" class="form-control"
                                placeholder="Enter Shop Address" required>
                        </div>
                        <br>
                    </div>
                </div>
                <div class="modal-footer flex-center">
                    <button type="submit" class="btn btn-white me-3">Update</button>
                </div>
            </form>

        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
    $('.editshop').on('click', function () {
        var id = $(this).data('id');

        $("#shop_name").val("");
        $("#shop_address").val("");
        $("#id").val("");
        if (id) {
            $.ajax({
                url: "{{ url('vendor/shop/edit/') }}" + '/' + id,
                type: "GET",
                dataType: "json",
                success: function (data) {
                    console.log(data);
                    $("#shop_name").val(data.shop_name);
                    $("#id").val(data.id);
                    $("#shop_address").val(data.address);
                    $('#shop_category option[value="' + data.shopcategory_id + '"]').prop(
                        'selected', true);

                }
            });
        } else {
            // alert('danger');
        }

    });

</script>
@endsection
