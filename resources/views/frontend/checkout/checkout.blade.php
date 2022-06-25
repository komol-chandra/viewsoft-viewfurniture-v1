@extends('layouts.frontend')
@section('title', 'Checkout Page')
@section('css')
<style>
    .form-custom {
        margin-top: 10px;
        margin-bottom: 10px;
    }

</style>
@endsection

@section('content')


<section class="section-tb-padding">
    <form method="post" action="{{ route('checkout.save') }}">@csrf
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="checkout-area">
                        <div class="billing-area">
                            <div style="padding: 20px">
                                <h2>Billing details</h2>
                                <div class="billing-form">
                                    <ul class="billing-ul input-2" style="display: flex">
                                        <li class="billing-li col-md-6">
                                            <label>Name</label>
                                            <input type="text" name="shipping_name" class="form-control form-custom"
                                                placeholder="your name " value="{{ auth()->user()->name }}">
                                            @error('shipping_name')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </li>
                                        <li class="billing-li col-md-6" style="margin-left: 10px">
                                            <label>Phone</label>
                                            <input type="text" name="shipping_phone" class="form-control form-custom"
                                                value="{{ $user->phone}}">
                                            @error('shipping_phone')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </li>
                                    </ul>
                                    <ul class="billing-ul" style="display: flex">
                                        <li class="billing-li col-md-6">
                                            <label>Email</label>
                                            <input type="text" name="shipping_email" class="form-control form-custom"
                                                value="{{ $user->email }}" placeholder="your email">
                                            @error('shipping_email')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </li>

                                        <li class="billing-li col-md-6" style="margin-left: 10px">
                                            <label>Division</label>
                                            <select name="shipping_division" id="division"
                                                class="form-control border-form-control form-custom">
                                                <option value="" disabled selected>Select Division</option>
                                                @foreach($divisions as $division)
                                                <option value="{{$division->id}}" @if($user->division ==
                                                    $division->id) selected @endif>{{$division->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('shipping_division')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </li>
                                    </ul>
                                    <ul class="billing-ul" style="display: flex">
                                        <li class="billing-li col-md-6">
                                            <label>City</label>
                                            @php
                                            $alldistrict=Devfaysal\BangladeshGeocode\Models\District::where('division_id',$user->division)->get();
                                            @endphp
                                            <select name="shipping_city" id="city"
                                                class="form-control border-form-control form-custom">
                                                @if($alldistrict->count() >0)
                                                @foreach ($alldistrict as $district)
                                                <option value="{{$district->id}}" @if($user->city ==
                                                    $district->id) selected @endif>{{$district->name}}</option>
                                                @endforeach
                                                @else
                                                <option value="" disabled selected>Select District</option>
                                                @endif
                                            </select>
                                            @error('shipping_city')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </li>

                                        <li class="billing-li col-md-6" style="margin-left: 10px">
                                            <label>Zip Code</label>
                                            <input type="text" name="shipping_zip" class="form-control form-custom"
                                                value="{{ $user->zip_code??''}}" placeholder="">
                                            @error('shipping_zip')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </li>
                                    </ul>
                                    <ul class="billing-ul">
                                        <li class="billing-li">
                                            <label>Address</label>
                                            <textarea name="shipping_address" class="form-control"
                                                class="form-control form-custom" cols="30"
                                                rows="4">{{ $user->main_address}}</textarea>
                                            @error('shipping_address')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </li>
                                    </ul>
                                    @php
                                    $wallet=davitBalance(auth()->user()->id) + wallet(auth()->user()->id) -
                                    paidAmount(auth()->user()->id)- creditBalance(auth()->user()->id);
                                    @endphp
                                    @if ($wallet != null && $wallet > 500)
                                    <ul class="billing-ul">
                                        <li class="billing-li" style="margin-left: 20px; display: flex;">
                                            <input type="checkbox" name="wallet" id="wallet"
                                                style="height: 20px; width: 20px; margin-top: 10px">
                                            <label for="wallet" style="margin-left: 10px; margin-top: 12px">Use 500 taka
                                                from
                                                wallet</label>
                                        </li>
                                    </ul>



                                    @endif
                                    <ul class="billing-ul" id="hidden_wallet" style="display: none">
                                        <li class="billing-li"
                                            style="margin-top: 10px; margin-bottom: 10px ;margin-left: 20px;">
                                            <label for="free-shipping" id=""> (-500) from your wallet</label>
                                        </li>
                                    </ul>
                                    <ul class="billing-ul" id="">
                                        <li class="order-details">

                                            <span class="billing-li" style="margin-left: 20px; display: flex;"
                                                class="text-danger">If your paid full amount then you can get
                                                {{ fullPaidOffer() }} % discount
                                            </span>
                                        </li>
                                        <li class="billing-li" style="margin-left: 20px; display: flex;">

                                            <input type="checkbox" name="full_paid_offer" id="full_paid_offer"
                                                style="height: 20px; width: 20px; margin-top: 10px">
                                            <input type="hidden" name="" id="full_paid_offer_percent"
                                                value="{{ fullPaidOffer() }}">

                                            <label for="full_paid_offer" style="margin-left: 10px; margin-top: 12px">Use
                                                Full Paid</label>
                                        </li>
                                    </ul>
                                    <ul class="billing-ul" id="hidden_full_paid_offer" style="display: none">
                                        <li class="billing-li"
                                            style="margin-top: 10px; margin-bottom: 10px ;margin-left: 20px;">
                                            <label for="free-shipping" id=""> ({{ fullPaidOffer() }}) % off for full
                                                paid offer</label>
                                        </li>
                                    </ul>
                                    @if (str_replace(',', '', Cart::subtotal()) > 500)
                                    <ul class="billing-ul" id="">
                                        <li class="billing-li"
                                            style="margin-top: 10px; margin-bottom: 10px ;margin-left: 20px;">
                                            <input type="text" class="form-group" name="cuppon" id="cuppon"
                                                placeholder="Use Cupon Code" />
                                            <a onclick="applyCupon(this)" href="javascript:void(0)"
                                                class="btn-sm btn-primary ">Apply
                                                Cupon</a>
                                        </li>
                                    </ul>
                                    <ul class="billing-ul" id="remove_cupon" style="display: none">
                                        <li class="billing-li"
                                            style="margin-top: 10px; margin-bottom: 10px ;margin-left: 20px;">
                                            <a class="btn-sm btn-danger " onclick="removeCuppon()"
                                                href="javascript:void(0)">Remove
                                                Cuppon</a>
                                        </li>
                                    </ul>

                                    @endif


                                </div>
                            </div>
                        </div>
                        <div class="order-area" id="checout_cart">

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </form>
</section>
@include('frontend.include.shopping_head')


<input type="hidden" value="{{ shoppingChargeDhaka() }}" id="dhaka_charge">
<input type="hidden" value="{{ shoppingChargeOutOfDhaka() }}" id="out_of_dhaka_charge">
<input type="hidden" value="{{round( str_replace(',', '',Cart::subtotal())) }}" id="cart_total_amount">
<script src="{{ asset('frontend') }}/js/jquery-3.6.0.min.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $('select[name="shipping_division"]').on('change', function () {
            var division_id = $(this).val();
            if (division_id) {
                $.ajax({
                    url: "{{  url('/get/district/all/') }}/" + division_id,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('#city').empty();
                        $('#city').append(' <option value="">--select--</option>');
                        $.each(data, function (index, districtObj) {
                            $('#city').append('<option value="' + districtObj.id +
                                '">' + districtObj.name + '</option>');
                        });

                    }
                });
            } else {}
        });
    });

</script>
<script>
    $(document).ready(function () {
        $('select[name="shipping_city"]').on('change', function () {
            alltotal();
        });

        $('[name="wallet"]').change(function () {
            if ($(this).is(':checked')) {
                $('#hidden_wallet').show();
                alltotal();
            } else if ($(this).prop("checked") == false) {

                $('#hidden_wallet').hide();
                alltotal();
            };
        });

        $('[name="full_paid_offer"]').change(function () {
            if ($(this).is(':checked')) {
                $('#hidden_full_paid_offer').show();
                alltotal();
            } else if ($(this).prop("checked") == false) {

                $('#hidden_full_paid_offer').hide();
                alltotal();
            };
        });


    });

</script>
<script>
    function removeCuppon() {
        $('#cupon_hidden').hide();
        $('#cupon_discounted_hidden').hide();
        $('#cupon_amount_hidden').val(0);
        $('#remove_cupon').hide();
        alltotal();
        $('#cupponsection').show();
    }

</script>

<script>
    function alltotal() {

        let qty_price = $('#total_price_hidden').val();
        let cupon_amount = $('#cupon_amount_hidden').val();
        let cupon_type = $('#cupon_type_hidden').val();

        if (cupon_amount > 0 && cupon_type == 'taka') {
            qty_price = Math.round(qty_price - cupon_amount);
            $('#cupon_discounted_amount').text(cupon_amount);
            $('#cupon_discounted_amount_hidden').val(cupon_amount);
            $('#cupon_discounted_hidden').show();
        } else if (cupon_amount > 0 && cupon_type == 'parcent') {
            let cuppon_discount = Math.round(qty_price * cupon_amount / 100);
            qty_price = Math.round(qty_price - cuppon_discount);
            $('#cupon_discounted_amount').text(cuppon_discount);
            $('#cupon_discounted_amount_hidden').val(cuppon_discount);
            $('#cupon_discounted_hidden').show();
        }


        var city_id = $('#city').children("option:selected").val();
        var dhaka_charge = $('#dhaka_charge').val();
        var out_of_dhaka_charge = $('#out_of_dhaka_charge').val();
        var simbol = '৳';
        var cart_total_amount = $('#cart_total_amount').val();
        if (city_id == 47) {
            // shopping charge related data
            var shopping_charge_amount = Math.round(parseFloat(cart_total_amount) * parseFloat((dhaka_charge / 100)));
            $('#shipping_percent').text("% " + dhaka_charge);
            $('#shopping_amount').text("৳ " + shopping_charge_amount);
            var grand_total = Math.round(parseFloat(shopping_charge_amount) + parseFloat(qty_price));

            if ($('#wallet').is(':checked')) {
                let wallet = $('input[name="wallet"]:checked');
                grand_total = Math.round(grand_total - 500);
                var minimum_pay_amount = Math.round(parseFloat(grand_total) * parseFloat((15 / 100)));
                $('#minimum_pay').text("৳ " + Math.round(parseInt(minimum_pay_amount)));
                $('.check_minimum_pay').val(Math.round(parseInt(minimum_pay_amount)));

                $('#delfult_grand_total_amount').text("৳ " + grand_total);
                $('#delfult_grand_total_amount_2').val(grand_total);
            } else {
                var minimum_pay_amount = parseFloat(grand_total) * parseFloat((15 / 100));
                $('#minimum_pay').text("৳ " + Math.round(parseInt(minimum_pay_amount)));
                $('.check_minimum_pay').val(Math.round(parseInt(minimum_pay_amount)));

                $('#delfult_grand_total_amount').text("৳ " + grand_total);
                $('#delfult_grand_total_amount_2').val(grand_total);
            }


            //full_paid_offer check

            if ($('#full_paid_offer').is(':checked')) {
                let wallet = $('input[name="full_paid_offer"]:checked');
                //komol
                var full_paid_offer = $('#full_paid_offer_percent').val();

                var full_paid_amount = Math.round(grand_total * (full_paid_offer / 100));
                $('#fullPaidAmount').text("৳ " + full_paid_amount);
                $('.paid_value').val(full_paid_amount);
                grand_total = Math.round(grand_total - full_paid_amount);

                $('#full_paid_offer_hidden').show();
                $('#min_payment_text').hide();
                $('#max_payment_text').show();


                var minimum_pay_amount = Math.round(parseFloat(grand_total) * parseFloat((15 / 100)));
                $('#minimum_pay').text("৳ " + Math.round(parseInt(grand_total)));
                $('.check_minimum_pay').val(Math.round(parseInt(grand_total)));

                $('#delfult_grand_total_amount').text("৳ " + grand_total);
                $('#delfult_grand_total_amount_2').val(grand_total);
            } else {
                var minimum_pay_amount = parseFloat(grand_total) * parseFloat((15 / 100));
                $('#minimum_pay').text("৳ " + Math.round(parseInt(minimum_pay_amount)));
                $('.check_minimum_pay').val(Math.round(parseInt(minimum_pay_amount)));

                $('#delfult_grand_total_amount').text("৳ " + grand_total);
                $('#delfult_grand_total_amount_2').val(grand_total);
                $('#min_payment_text').show();
                $('#max_payment_text').hide();

            }




        } else {
            var shopping_charge_amount = Math.round(parseFloat(cart_total_amount) * parseFloat((out_of_dhaka_charge /
                100)));
            $('#shipping_percent').text("% " + out_of_dhaka_charge);
            $('#shopping_amount').text("৳ " + shopping_charge_amount);
            var grand_total = Math.round(parseFloat(shopping_charge_amount) + parseFloat(qty_price));



            //wallet check

            if ($('#wallet').is(':checked')) {
                let wallet = $('input[name="wallet"]:checked');
                grand_total = grand_total - 500;
                var minimum_pay_amount = Math.round(parseFloat(grand_total) * parseFloat((15 / 100)));
                $('#minimum_pay').text("৳ " + parseInt(minimum_pay_amount));
                $('.check_minimum_pay').val(parseInt(minimum_pay_amount));

                $('#delfult_grand_total_amount').text("৳ " + grand_total);
                $('#delfult_grand_total_amount_2').val(grand_total);
            } else {
                var minimum_pay_amount = Math.round(parseFloat(grand_total) * parseFloat((15 / 100)));
                $('#minimum_pay').text("৳ " + parseInt(minimum_pay_amount));
                $('.check_minimum_pay').val(parseInt(minimum_pay_amount));

                $('#delfult_grand_total_amount').text("৳ " + grand_total);
                $('#delfult_grand_total_amount_2').val(grand_total);
            }


            //full_paid_offer check

            if ($('#full_paid_offer').is(':checked')) {
                let wallet = $('input[name="full_paid_offer"]:checked');
                //komol
                var full_paid_offer = $('#full_paid_offer_percent').val();


                var full_paid_amount = Math.round(grand_total * (full_paid_offer / 100));
                $('#fullPaidAmount').text("৳ " + full_paid_amount);
                $('.paid_value').val(full_paid_amount);
                grand_total = Math.round(grand_total - full_paid_amount);

                $('#full_paid_offer_hidden').show();
                $('#min_payment_text').hide();
                $('#max_payment_text').show();


                var minimum_pay_amount = Math.round(parseFloat(grand_total) * parseFloat((15 / 100)));
                $('#minimum_pay').text("৳ " + Math.round(parseInt(grand_total)));
                $('.check_minimum_pay').val(Math.round(parseInt(grand_total)));

                $('#delfult_grand_total_amount').text("৳ " + grand_total);
                $('#delfult_grand_total_amount_2').val(grand_total);

            } else {
                var minimum_pay_amount = parseFloat(grand_total) * parseFloat((15 / 100));
                $('#minimum_pay').text("৳ " + Math.round(parseInt(minimum_pay_amount)));
                $('.check_minimum_pay').val(Math.round(parseInt(minimum_pay_amount)));

                $('#delfult_grand_total_amount').text("৳ " + grand_total);
                $('#delfult_grand_total_amount_2').val(grand_total);
                $('#min_payment_text').show();
                $('#max_payment_text').hide();

            }

        }
    }

    alltotal();

</script>

<script>
    function paymentCheck() {
        $("#order_btn").prop('disabled', true);
        var user = $("#advance_pay").val();
        var min = $('#check_minimum_pay').val();
        var max = $('#delfult_grand_total_amount_2').val();

        if ($('#full_paid_offer').is(':checked')) {
            if (min == user) {
                $('#order_btn').removeAttr("disabled");
                successMessage(user);
            } else {
                fullPaidMessage();
            }
        } else if (min <= user) {
            $('#order_btn').removeAttr("disabled");
            successMessage(user);

        } else {
            errorMessage();
        }

    }

    function fullPaidMessage() {
        Swal.fire({
            toast: true,
            icon: 'error',
            title: 'please enter a full amount',
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

    function successMessage(user) {
        Swal.fire({
            toast: true,
            icon: 'success',
            title: 'your payment amount is ' + user + 'taka',
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

    function errorMessage() {
        Swal.fire({
            toast: true,
            icon: 'error',
            title: 'please enter a valid amount',
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

</script>
<script>
    function applyCupon() {
        var cupon = $("#cuppon").val();
        if (cupon != null) {
            $.ajax({
                url: "{{ url('/cupon/check') }}/" + cupon,
                type: 'get',
                success: function (data) {
                    // console.log(data.data.amount);
                    if (data.success) {
                        $('#cupponsection').hide();
                        $('#cupon_hidden').show();
                        $('#remove_cupon').show();
                        $('#cupon_amount').text(data.data.amount);
                        if (data.data.amount_type == 'taka') {
                            $('#cupon_type').text('taka');
                        } else {
                            $('#cupon_type').text('%');
                        }
                        $('#cupon_amount_hidden').val(data.data.amount);
                        $('#cupon_type_hidden').val(data.data.amount_type);

                        $('#cupon_id_hidden').val(data.data.id);
                        alltotal();
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
                    } else {
                        Swal.fire({
                            toast: true,
                            icon: 'error',
                            title: '' + data.error + '',
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
            });
        }
    }

</script>
@endsection
