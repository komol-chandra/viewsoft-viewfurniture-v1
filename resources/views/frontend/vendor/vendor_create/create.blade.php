@extends('layouts.frontend')
@section('title', 'Vendor-Create')
@section('content')

<section class="order-histry-area section-tb-padding">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="order-history">
                    @include('frontend.customerDashboard.include.sidebar')
                    <div class="profile-form">
                        <form action="{{ route('user.vendor-store') }}" method="post">
                            @csrf
                            <ul class="pro-input-label">
                                <li>
                                    <label>Company Name </label>
                                    <input type="text" name="name" placeholder="Enter Your name"
                                        value="{{ old('name') ?? auth()->user()->name }}">
                                    @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </li>
                                <li>
                                    <label>Email</label>
                                    <input type="text" name="email" id="email" placeholder="Email"
                                        value="{{ old('email') ?? auth()->user()->email }}">
                                    @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </li>
                            </ul>
                            <ul class="pro-input-label">
                                <li>
                                    <label>Phone</label>
                                    <input type="text" name="phone" class="form-control" id="review"
                                        placeholder="Enter your Number"
                                        value="{{ old('phone') ?? auth()->user()->phone }}">
                                    @error('phone')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </li>
                                <li>
                                    <label>Divission</label>
                                    <select name="division" id="division" class="form-control">
                                        <option disabled selected>Select Division</option>
                                        @foreach($divisions as $division)
                                        <option value="{{$division->id}}" @if(Auth::user()->division ==
                                            $division->id) selected @endif>{{$division->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('division')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </li>
                            </ul>
                            <ul class="pro-input-label">
                                <li>
                                    <label>City</label>
                                    @php
                                    $alldistrict=Devfaysal\BangladeshGeocode\Models\District::where('division_id',Auth::user()->division)->get();
                                    @endphp
                                    <select name="city" id="city" class="form-control">
                                        @if($alldistrict->count() >0)
                                        @foreach ($alldistrict as $district)
                                        <option value="{{$district->id}}" @if(Auth::user()->city ==
                                            $district->id) selected @endif>{{$district->name}}</option>
                                        @endforeach
                                        @else
                                        <option value="" disabled selected>Select District</option>
                                        @endif
                                    </select>
                                    @error('city')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </li>
                                <li>
                                    <label>Zip Code</label>
                                    <input type="text" name="zip_code" id="Zip_Code" placeholder="Zip Code"
                                        value="{{ old('zip_code') ?? auth()->user()->zip_code }}">
                                </li>
                                <li>
                                    <br>
                                    <label for="">Company Address</label>
                                    <textarea name="main_address" class="form-control" id=""
                                        placeholder="Address Details"
                                        required>{{ old('main_address') ?? auth()->user()->main_address }}</textarea>
                                    @error('main_address')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </li>
                                <li>
                                    <br>
                                    <label for="">Google Map</label>
                                    <textarea name="company_google_map" class="form-control"
                                        placeholder="Address Details"
                                        required>{{ old('company_google_map') ?? auth()->user()->company_google_map }}</textarea>
                                    @error('company_google_map')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </li>
                                <li>
                                    <br>
                                    <label for="">Sale Area</label>
                                    <input type="text" name="sale_area" id="sale_area" placeholder="Sale Area"
                                        value="{{ old('sale_area') ?? auth()->user()->sale_area }}">
                                    @error('sale_area')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </li>
                                <li>
                                    <br>
                                    <label for="">Delevery Possible Area</label>
                                    <input type="text" name="delivery_possible_area" id="delivery_possible_area"
                                        placeholder="delivery possible area"
                                        value="{{ old('delivery_possible_area') ?? auth()->user()->delivery_possible_area }}">
                                    @error('delivery_possible_area')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </li>
                            </ul>
                            <ul class="pro-input-label">
                                <li>
                                    <br>
                                    <label>Bank Account Name *</label>
                                    <input type="text" name="bank_name" id="bank_name" placeholder="Bank Account Name"
                                        value="{{ old('bank_name') ?? auth()->user()->bank_name }}">

                                </li>
                                <li>
                                    <br>
                                    <label>Bank Account Number*</label>
                                    <input type="text" name="bank_account_number" id="bank_account_number"
                                        placeholder="Bank Account Number"
                                        value="{{ old('bank_account_number') ?? auth()->user()->bank_account_number }}">
                                </li>
                                <li>
                                    <br>
                                    <label>Name of Bank*</label>
                                    <input type="text" name="name_of_bank" id="name_of_bank" placeholder="Name of Bank"
                                        value="{{ old('name_of_bank') ?? auth()->user()->name_of_bank }}">
                                </li>
                                <li>
                                    <br>
                                    <label> Your Bank Address</label>
                                    <input type="text" name="bank_address" id="bank_address"
                                        placeholder="Your Bank Address"
                                        value="{{ old('bank_address') ?? auth()->user()->bank_address }}">
                                </li>
                                <li>
                                    <br>
                                    <label>Routing Number</label>
                                    <input type="text" name="routing_number" id="routing_number"
                                        placeholder="Routing Number"
                                        value="{{ old('routing_number') ?? auth()->user()->routing_number }}">
                                </li>
                                <li>
                                    <br>
                                    <label>iBAN</label>
                                    <input type="text" name="i_ban" id="i_ban" placeholder="iBAN"
                                        value="{{ old('i_ban') ?? auth()->user()->i_ban }}">
                                </li>
                                <li>
                                    <br>
                                    <label>Swift Code</label>
                                    <input type="text" name="swift_code" id="swift_code" placeholder="Swift Code"
                                        value="{{ old('swift_code') ?? auth()->user()->swift_code }}">
                                </li>
                                <li>
                                    <br>
                                    <label>Mobile Bank Name</label>
                                    <input type="text" name="mobile_bank_name" id="mobile_bank_name"
                                        placeholder="ex: Bkash , Rocket"
                                        value="{{ old('mobile_bank_name') ?? auth()->user()->mobile_bank_name }}">
                                </li>
                                <li>
                                    <br>
                                    <label>Mobile Bank Number</label>
                                    <input type="text" name="mobile_bank_number" id="mobile_bank_number"
                                        placeholder="Mobile Bank Number"
                                        value="{{ old('mobile_bank_number') ?? auth()->user()->mobile_bank_number }}">
                                </li>
                                <li>
                                    <br>
                                    <label for="">Trade Licence Id</label>
                                    <input type="text" name="trade_licence" id="trade_licence"
                                        placeholder="Trade Licence Id"
                                        value="{{ old('trade_licence') ?? auth()->user()->trade_licence }}">
                                </li>
                                <li>
                                    <br>
                                    <label for="">Company Logo</label>
                                    <input type="file" name="image">
                                </li>
                            </ul>
                            <ul class="pro-submit">
                                <li>
                                    <button type="submit" class="btn btn-style1">Update profile</button>
                                </li>
                            </ul>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@section('js')
<script type="text/javascript">
    $(document).ready(function () {
        $('select[name="division"]').on('change', function () {
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
            } else {
                //  alert('danger');
            }
        });
    });

</script>
@endsection


{{-- 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>


<style>
    .success-text{
        color:green;
    }
    .danger-text{
        color:red;
    }
    input#flexCheckChecked {
        padding: 10px;
    margin: 20px 2px 10px 0;
}
label.form-check-label {
    margin: 20px 6px;
}

</style>
<style>
 
#msform {
    text-align: center;
    position: relative;
    margin-top: 20px
}

#msform fieldset {
    background: white;
    border: 0 none;
    border-radius: 0.5rem;
    box-sizing: border-box;
    width: 100%;
    margin: 0;
    padding-bottom: 20px;
    position: relative
}

.form-card {
    text-align: left
}

#msform fieldset:not(:first-of-type) {
    display: none
}

#msform input,
#msform textarea {
    padding: 8px 15px 8px 15px;
    border: 1px solid #ccc;
    border-radius: 0px;
    margin-bottom: 25px;
    margin-top: 2px;
    width: 100%;
    box-sizing: border-box;
    font-family: montserrat;
    color: #2C3E50;
    background-color: #ECEFF1;
    font-size: 16px;
    letter-spacing: 1px
}

#msform input:focus,
#msform textarea:focus {
    -moz-box-shadow: none !important;
    -webkit-box-shadow: none !important;
    box-shadow: none !important;
    border: 1px solid #673AB7;
    outline-width: 0
}

#msform .action-button {
    width: 100px;
    background: #673AB7;
    font-weight: bold;
    color: white;
    border: 0 none;
    border-radius: 0px;
    cursor: pointer;
    padding: 10px 5px;
    margin: 10px 0px 10px 5px;
    float: right
}

#msform .action-button:hover,
#msform .action-button:focus {
    background-color: #311B92
}

#msform .action-button-previous {
    width: 100px;
    background: #616161;
    font-weight: bold;
    color: white;
    border: 0 none;
    border-radius: 0px;
    cursor: pointer;
    padding: 10px 5px;
    margin: 10px 5px 10px 0px;
    float: right
}

#msform .action-button-previous:hover,
#msform .action-button-previous:focus {
    background-color: #000000
}

.card {
    z-index: 0;
    border: none;
    position: relative
}

.fs-title {
    font-size: 25px;
    color: #673AB7;
    margin-bottom: 15px;
    font-weight: normal;
    text-align: left
}

.purple-text {
    color: #673AB7;
    font-weight: normal
}

.steps {
    font-size: 25px;
    color: gray;
    margin-bottom: 10px;
    font-weight: normal;
    text-align: right
}

.fieldlabels {
    color: gray;
    text-align: left
}

#progressbar {
    margin-bottom: 30px;
    overflow: hidden;
    color: lightgrey
}

#progressbar .active {
    color: #f39910
}

#progressbar li {
    list-style-type: none;
    font-size: 15px;
    width: 25%;
    float: left;
    position: relative;
    font-weight: 400
}

#progressbar #account:before {
    font-family: FontAwesome;
    content: "\f13e"
}

#progressbar #personal:before {
    font-family: FontAwesome;
    content: "\f007"
}

#progressbar #payment:before {
    font-family: FontAwesome;
    content: "\f030"
}

#progressbar #confirm:before {
    font-family: FontAwesome;
    content: "\f00c"
}

#progressbar li:before {
    width: 50px;
    height: 50px;
    line-height: 45px;
    display: block;
    font-size: 20px;
    color: #ffffff;
    background: lightgray;
    border-radius: 50%;
    margin: 0 auto 10px auto;
    padding: 2px
}

#progressbar li:after {
    content: '';
    width: 100%;
    height: 2px;
    background: lightgray;
    position: absolute;
    left: 0;
    top: 25px;
    z-index: -1
}

#progressbar li.active:before,
#progressbar li.active:after {
    background: #f39910
}

.progress {
    height: 20px
}

.progress-bar {
    background-color: #f39910
}

.fit-image {
    width: 100%;
    object-fit: cover
}
input#flexCheckChecked {
    padding: 11px 3px;
    width: 5%;
    color: black;
    background-color: #f98008;
    border: 1px solid #f98008;
    margin: 15px 0px;
}
</style>
    <!-- breadcrumb start -->
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="page-title">
                        <h2>become a vendor</h2>
                    </div>
                </div>
                <div class="col-sm-6">
                    <nav aria-label="breadcrumb" class="theme-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">become a vendor</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb End -->
  <!-- start selling section start -->
    <section class="start-selling section-b-space">
        <div class="container">
            <div class="col">
            <form id="msform" action="{{ route('vendor.create') }}" method="post" enctype="multipart/form-data">
@csrf
<!-- progressbar -->
<ul id="progressbar">
    @if(Session::has('success'))
    <li class="active" id="account"><strong>Account Information</strong></li>
    <li class="active" id="personal"><strong>Bank Information</strong></li>
    <li class="active" id="payment"><strong>Image</strong></li>
    <li class="active" id="confirm"><strong>Finish</strong></li>
    @else
    <li class="active" id="account"><strong>Account InFormation</strong></li>
    <li id="personal"><strong>Bank Information</strong></li>
    <li id="payment"><strong>Image</strong></li>
    <li id="confirm"><strong>Finish</strong></li>
    @endif

</ul>
<br> <!-- fieldsets -->
<fieldset>
    <div class="form-card">
        <div class="row">
            <div class="col-7">
                <h2 class="fs-title">Account Information:</h2>
            </div>
            <div class="col-5">
                <h2 class="steps">Step 1 - 4</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label for="name">Name <span style="color:red">*</span></label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Enter Your Name"
                    value="{{ Auth::user()->name }}" onchange="removeDisabled()">
            </div>
            <div class="col-md-6">
                <label for="name">Email<span style="color:red">*</span></label>
                <input type="text" name="email" id="email" class="form-control" placeholder="Enter Your Email"
                    value="{{ Auth::user()->email }}" onchange="removeDisabled()">
            </div>
            <div class="col-md-6">
                <label for="name">Phone <span style="color:red">*</span></label>
                <input type="text" name="phone" id="phone" class="form-control" placeholder="Enter Your phone"
                    value="{{ Auth::user()->phone }}" onchange="removeDisabled()">
            </div>
            <div class="col-md-6">
                <label for="name">Company name <span style="color:red">*</span></label>
                <input type="text" name="company_name" id="company_name" class="form-control"
                    placeholder="Enter Company name" value="{{ old('company_name') }}" onchange="removeDisabled()">
                <!-- <span class="success-text">The Name is Unique</span> -->
            </div>
            <div class="col-md-6">
                <label for="name">Company Address <span style="color:red">*</span></label>
                <input type="text" name="company_address" id="company_address" class="form-control"
                    placeholder="Enter Company Address" value="{{ old('company_address') }}"
                    onchange="removeDisabled()">
            </div>
            <div class="col-md-6">
                <label for="name">Company Google Map</label>
                <input type="text" name="company_google_map" class="form-control" placeholder="Enter Company Google Map"
                    value="{{ old('company_google_map') }}">
            </div>
            <div class="col-md-6">
                <label for="name">Country <span style="color:red">*</span></label>
                <select name="country" class="form-control" id="country" onchange="removeDisabled()">
                    <option disabled selected>--select--</option>
                    @foreach($allCountry as $country)
                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label for="name">City <span style="color:red">*</span></label>
                <input type="text" name="city" id="city" class="form-control" placeholder="Enter City Name"
                    value="{{ old('city') }}" onchange="removeDisabled()">
            </div>
            <div class="col-md-6">
                <label for="name">Zip Code </label>
                <input type="text" name="zip_code" class="form-control" placeholder="Enter Your Zip Code"
                    value="{{ old('zip_code') }}">
            </div>
            <div class="col-md-6">
                <label for="name">Sale Area</label>
                <input type="text" name="sale_area" class="form-control" placeholder="Enter Sale Area"
                    value="{{old('sale_area')}}">
            </div>
            <div class="col-md-6">
                <label for="name">Delevery Possible Area</label>
                <input type="text" name="delevery_possible_area" class="form-control"
                    placeholder="Enter Delevery Possible Area" value="{{old('dlevery_possible_area')}}">
            </div>
        </div>
    </div>
    <input type="button" disabled name="next" class="next action-button btn btn-sm btn-solid" id="next_one"
        value="Next" />
</fieldset>
<fieldset>
    <div class="form-card">
        <div class="row">
            <div class="col-7">
                <h2 class="fs-title">Payment Information:</h2>
            </div>
            <div class="col-5">
                <h2 class="steps">Step 2 - 4</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label for="name">Bank Account Name <span style="color:red">*</span></label>
                <input type="text" name="bank_name" id="bank_name" class="form-control"
                    placeholder="Enter Bank Account Name" value="{{ old('bank_name') }}" onchange="removeDisabletwo()">
            </div>
            <div class="col-md-6">
                <label for="name">Bank Account Number <span style="color:red">*</span></label>
                <input type="text" name="bank_account_number" id="bank_account_number" class="form-control"
                    placeholder="Enter Bank Account Number" value="{{ old('bank_account_number') }}"
                    onchange="removeDisabletwo()">
            </div>
            <div class="col-md-6">
                <label for="name">Name Of Bank <span style="color:red">*</span></label>
                <input type="text" name="name_of_bank" id="name_of_bank" class="form-control"
                    placeholder="Enter Name Of Bank" value="{{ old('name_of_bank')  }}" onchange="removeDisabletwo()">
            </div>
            <div class="col-md-6">
                <label for="name">Address Your Bank <span style="color:red">*</span></label>
                <input type="text" name="bank_address" id="bank_address" class="form-control"
                    placeholder="Enter Address Your Bank" value="{{ old('bank_address') }}"
                    onchange="removeDisabletwo()">
            </div>
            <div class="col-md-6">
                <label for="name">Routing Number <span style="color:red">*</span></label>
                <input type="text" name="routing_number" id="routing_number" class="form-control"
                    placeholder="Enter Routing Number" value="{{ old('routing_number') }}"
                    onchange="removeDisabletwo()">
            </div>
            <div class="col-md-6">
                <label for="name">iBAN</label>
                <input type="text" name="i_ban" class="form-control" placeholder="Enter iBAN"
                    value="{{ old('i_ban') }}">
            </div>
            <div class="col-md-6">
                <label for="name">Swift Code</label>
                <input type="text" name="swift_code" class="form-control" placeholder="Enter Swift Code"
                    value="{{ old('swift_code') }}">
            </div>
        </div>
    </div>
    <input type="button" name="next" class="next action-button btn btn-sm btn-solid" disabled id="next_two"
        value="Next" />
    <input type="button" name="previous" class="previous action-button-previous btn btn-sm btn-solid"
        value="Previous" />
</fieldset>
<fieldset>
    <div class="form-card">
        <div class="row">
            <div class="col-7">

                <h2 class="fs-title">Image:</h2>
            </div>
            <div class="col-5">
                <h2 class="steps">Step 3 - 4</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <label class="fieldlabels">Upload Image:</label>
                <input type="file" name="pic" accept="image/*">
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <input class="form-check-input custom-check" type="checkbox" value="" id="flexCheckChecked" checked>
                <label class="form-check-label" for="flexCheckChecked">
                    I Agree With Terms And Conditions
                </label>
            </div>
        </div>
    </div>
    <button type="submit" id="final_submit" class="action-button btn btn-sm btn-solid">Submit </button>
    <input type="button" name="previous" class="previous action-button-previous btn btn-sm btn-solid"
        value="Previous" />
</fieldset>
@if(Session::has('success'))
<fieldset>
    <div class="form-card">
        <div class="row">
            <div class="col-7">
                <h2 class="fs-title">Finish:</h2>
            </div>
            <div class="col-5">
                <h2 class="steps">Step 4 - 4</h2>
            </div>
        </div> <br><br>
        <h2 class="purple-text text-center"><strong>SUCCESS !</strong></h2> <br>
        <div class="row justify-content-center">
            <div class="col-3"> <img src="https://i.imgur.com/GwStPmg.png" class="fit-image"> </div>
        </div> <br><br>
        <div class="row justify-content-center">
            <div class="col-7 text-center">
                <h5 class="purple-text text-center">You Have Successfully Signed Up</h5>
            </div>
        </div>
    </div>
</fieldset>
@endif
@if(Session::has('error'))
<fieldset>
    <div class="form-card">
        <div class="row">
            <div class="col-7">
                <h2 class="fs-title">Finish:</h2>
            </div>
            <div class="col-5">
                <h2 class="steps">Step 4 - 4</h2>
            </div>
        </div> <br><br>
        <h2 class="purple-text text-center"><strong>Faild !</strong></h2> <br>
        <div class="row justify-content-center">
            <div class="col-3"> <img src="https://i.imgur.com/GwStPmg.png" class="fit-image"> </div>
        </div> <br><br>
        <div class="row justify-content-center">
            <div class="col-7 text-center">
                <h5 class="purple-text text-center">SomeThing Is Wrong</h5>
            </div>
        </div>
    </div>
</fieldset>
@endif
</form>
</div>
</div>
</section>

<!-- start selling section end -->




<script>
    function removeDisabled() {
        var name = $("#name").val();
        var email = $("#email").val();
        var phone = $("#phone").val();
        var company_name = $("#company_name").val();
        var company_address = $("#company_address").val();
        var country = $("#country").val();
        var city = $("#city").val();
        if (name != "" && email != "" && phone != "" && company_name != "" && country != "" && company_address != "" &&
            city != "") {
            $('#next_one').attr('disabled', false);
        } else {
            $('#next_one').attr('disabled', true);
        }

    }

    function removeDisabletwo() {

        var bank_name = $("#bank_name").val();
        var bank_account_number = $("#bank_account_number").val();
        var name_of_bank = $("#name_of_bank").val();
        var bank_address = $("#bank_address").val();
        var routing_number = $("#routing_number").val();

        if (bank_name != "" && bank_account_number != "" && name_of_bank != "" && bank_address != "" &&
            routing_number != "") {
            $('#next_two').attr('disabled', false);
        } else {
            $('#next_two').attr('disabled', true);
        }
    }
    // final submit 
    // function finalsubmit(){
    //     alert("ok");
    //     if($('#flexCheckChecked').attr('checked',true)){
    //         $('#final_submit').attr('disabled',false);
    //     }else{
    //         $('#final_submit').attr('disabled',true);
    //     }

    // }

</script>
<script>
    $(document).ready(function () {
        $('input[type="checkbox"]').click(function () {
            if ($(this).prop("checked") == true) {
                $('#final_submit').attr('disabled', false);
            } else if ($(this).prop("checked") == false) {
                $('#final_submit').attr('disabled', true);
            }
        });
    });

</script>
<script>
    $(document).ready(function () {

        var current_fs, next_fs, previous_fs;
        var opacity;
        var current = 1;
        var steps = $("fieldset").length;

        setProgressBar(current);

        $(".next").click(function () {

            current_fs = $(this).parent();
            next_fs = $(this).parent().next();

            //Add Class Active
            $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

            //show the next fieldset
            next_fs.show();
            //hide the current fieldset with style
            current_fs.animate({
                opacity: 0
            }, {
                step: function (now) {
                    // for making fielset appear animation
                    opacity = 1 - now;

                    current_fs.css({
                        'display': 'none',
                        'position': 'relative'
                    });
                    next_fs.css({
                        'opacity': opacity
                    });
                },
                duration: 500
            });
            setProgressBar(++current);
        });

        $(".previous").click(function () {

            current_fs = $(this).parent();
            previous_fs = $(this).parent().prev();

            //Remove class active
            $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

            //show the previous fieldset
            previous_fs.show();

            //hide the current fieldset with style
            current_fs.animate({
                opacity: 0
            }, {
                step: function (now) {
                    // for making fielset appear animation
                    opacity = 1 - now;

                    current_fs.css({
                        'display': 'none',
                        'position': 'relative'
                    });
                    previous_fs.css({
                        'opacity': opacity
                    });
                },
                duration: 500
            });
            setProgressBar(--current);
        });

        function setProgressBar(curStep) {
            var percent = parseFloat(100 / steps) * curStep;
            percent = percent.toFixed();
            $(".progress-bar")
                .css("width", percent + "%")
        }

        $(".submit").click(function () {
            return false;
        })

    });

</script>
--}}
@endsection
