@extends('layouts.frontend')
@section('title', 'Vendor-Create')
@section('content')
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets') }}/css/asif.css">


<link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link type="text/css" rel="stylesheet" href="{{asset('backend')}}/assets/css/image-uploader.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<style>
    .fw-bold {
    font-weight: 400!important;
    font-size: 14px !important;
}

.bootstrap-tagsinput {
        background-color: #f5f8fa;
        border-color: #f5f8fa;
        box-shadow: inset 0 1px 1px rgb(0 0 0 / 8%);
        display: inline-block;
        padding: 4px 6px;
        color: #b9b9b9;
        vertical-align: middle;
        border-radius: 4px;
        max-width: 100%;
        line-height: 25px;
        cursor: text;
        width: 100%;
        background: aliceblue;
    }
    
</style>
<style>
   div.dataTables_wrapper div.dataTables_length select {

        height: 33px;
    }

    div.dataTables_wrapper div.dataTables_filter input {

        height: 25px;
    }
</style>
    <!-- breadcrumb start -->
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="page-title">
                        <h2>vendor dashboard</h2>
                    </div>
                </div>
                <div class="col-sm-6">
                    <nav aria-label="breadcrumb" class="theme-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">vendor dashboard</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb End -->


    <!--  dashboard section start -->
    <section class="dashboard-section section-b-space">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    @include('frontend.vendor.dashboard.include.sidebar')
                </div>
                <div class="col-lg-9">
                <div class="dashboard-right">
                    <div class="dashboard">
                        <div class="row">
                            <div class="col-sm-12">
                                <h3>COMPANY DETAIL</h3>
                                <form class="theme-form" action="{{ url('/vendor/edit') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-row row">
                                        <div class="col-md-6">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control" id="name" name="name"placeholder="Enter Your name" value="{{ $vendorcompany->name }}">
                                            <input type="hidden" class="form-control" name="id" value="{{ $vendorcompany->id }}">
                                            @error('name')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="name">Phone</label>
                                            <input type="text" class="form-control" id="phone" name="phone"
                                                placeholder="Enter Your phone" value="{{ $vendorcompany->phone }}">
                                            @error('name')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="name">Company Name</label>
                                            <input type="text" class="form-control" id="company_name" name="company_name"
                                                placeholder="Enter Your Company Name" value="{{ $vendorcompany->company_name }}">
                                            @error('name')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <br>
                                        <div class="col-md-6">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" name="email" id="email"
                                                placeholder="Email" value="{{ $vendorcompany->email }}">
                                            @error('email')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <br>
                                    </div>
                            </div>
                        </div>
                        <!-- Section ends -->
                        <!-- address section start -->
                        <div class="row">
                            <div class="col-sm-12">
                                <br>
                                <h3>ADDRESS</h3>
                                <div class="form-row row">
                                    <br>
                                    <div class="col-md-6">
                                        <label for="main_address">Company Address</label>
                                        <textarea name="company_address" class="form-control" id="" cols="30" rows="10"
                                            placeholder="Address Details"
                                            required>{{  $vendorcompany->company_address }}</textarea>
                                        @error('company_address')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <br>
                                    <div class="col-md-6">
                                        <label for="google_map">Company Google Map</label>
                                        <textarea name="company_google_map" class="form-control" id="" cols="30" rows="10"
                                            placeholder="Google Map">{{ $vendorcompany->company_google_map  }}</textarea>
                                        @error('google_map')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <br>

                                    <div class="col-md-6">
                                        <label for="division">division*</label>
                                        <select name="division" id="division" class="form-control border-form-control">
                                            <option value="" disabled selected>Select Division</option>
                                            @foreach($divisions as $division)
                                            <option value="{{$division->id}}" @if($vendorcompany->division ==
                                                $division->id) selected @endif>{{$division->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('division')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <br>

                                    <div class="col-md-6">
                                        <label for="city">City*</label>
                                        @php
                                        $alldistrict=Devfaysal\BangladeshGeocode\Models\District::where('division_id',$vendorcompany->division)->get();
                                        @endphp
                                        <select name="city" id="city" class="form-control border-form-control">
                                            @if($alldistrict->count() >0)
                                            @foreach ($alldistrict as $district)
                                            <option value="{{$district->id}}" @if($vendorcompany->city ==
                                                $district->id) selected @endif>{{$district->name}}</option>
                                            @endforeach
                                            @else
                                            <option value="" disabled selected>Select District</option>
                                            @endif
                                        </select>
                                        @error('city')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <br>
                                    <div class="col-md-6">
                                        <label for="Zip_Code">Zip Code*</label>
                                        <input type="text" class="form-control" name="zip_code" id="Zip_Code"
                                            placeholder="Zip Code" required="" value="{{ $vendorcompany->zip_code }}">
                                        @error('zip_code')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="Zip_Code">Sale Area</label>
                                        <input type="text" class="form-control" name="sale_area" id="sale_area"
                                            placeholder="Sale Area" required="" value="{{ $vendorcompany->sale_area }}">
                                       
                                    </div>
                                    <br>
                                    <div class="col-md-6">
                                        <label for="Zip_Code">Delevery Possible Area</label>
                                        <input type="text" class="form-control" name="delevery_possible_area" id="delevery_possible_area"
                                            placeholder="Delevery Possible Area" required="" value="{{ $vendorcompany->delevery_possible_area }}">
                                       
                                    </div>
                                    <br>
                                    <div class="col-md-6">
                                        <label for="Zip_Code">Image*</label>
                                        <input type="file" class="form-control" name="image">
                                    </div>
                                    <br>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <br>
                                <h3>Bank Information</h3>
                                <div class="form-row row">
                                    <br>
                                    <div class="col-md-6">
                                        <label for="main_address">Bank Name</label>
                                        <input type="text" name="bank_name" class="form-control"
                                            placeholder="Address Details"
                                            required value="{{  $vendorcompany->bank_name }}"/>
                                        @error('company_address')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <br>
                                    <br>
                                    <div class="col-md-6">
                                        <label for="main_address">Bank Account Number</label>
                                        <input type="text" name="bank_account_number" class="form-control"
                                            placeholder="Address Details"
                                            required value="{{  $vendorcompany->bank_account_number }}"/>
                                        @error('bank_account_number')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <br>
                                    <br>
                                    <div class="col-md-6">
                                        <label for="main_address">Name Of Bank</label>
                                        <input type="text" name="name_of_bank" class="form-control"
                                            placeholder="Address Details"
                                            required value="{{  $vendorcompany->name_of_bank }}"/>
                                        @error('name_of_bank')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <br>	
                                    <br>
                                   <div class="col-md-6">
                                       <label for="main_address">Bank Address</label>
                                       <input type="text" name="bank_address" class="form-control"
                                           placeholder="Address Details"
                                           required value="{{  $vendorcompany->bank_address }}"/>
                                       @error('name_of_bank')
                                       <div class="text-danger">{{ $message }}</div>
                                       @enderror
                                   </div>
                                   <br>
                                   <br>
                                   <div class="col-md-6">
                                       <label for="main_address">Routing Number</label>
                                       <input type="text" name="routing_number" class="form-control"
                                           placeholder="Routing Number"
                                           required value="{{  $vendorcompany->routing_number }}"/>
                                       @error('name_of_bank')
                                       <div class="text-danger">{{ $message }}</div>
                                       @enderror
                                   </div>
                                   <br>
                                   <br>
                                    <div class="col-md-6">
                                        <label for="Zip_Code">i-Ban</label>
                                        <input type="text" class="form-control" name="i_ban" id="Zip_Code"
                                            placeholder="i-Ban" value="{{ $vendorcompany->i_ban }}">
                                       
                                    </div>
                                    <br>
                                    <br>
                                    <div class="col-md-6">
                                        <label for="Zip_Code">Swift Code</label>
                                        <input type="text" class="form-control" name="swift_code" id="Zip_Code"
                                            placeholder="Swift Code" value="{{ $vendorcompany->swift_code }}">
                                       
                                    </div>
                                    <br>
                                    <br>
                                    <div class="col-md-12 mt-5">
                                        <button class="btn btn-sm btn-solid" type="submit">Update</button>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                        <!-- Section ends -->
                    </div>
                </div>
            </div>
            </div>
        </div>
    </section>
<!-- create product -->
<script type="text/javascript" src="{{asset('backend')}}/assets/js/image-uploader.min.js"></script>

<script>
$('.input-images').imageUploader();
</script>

@endsection
@section('js')
<script type="text/javascript">
    $(document).ready(function() {        
        $('select[name="division"]').on('change', function() {
            var division_id = $(this).val();
            if (division_id) {
                $.ajax({
                    url: "{{  url('/get/district/all/') }}/" + division_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('#city').empty();
                        $('#city').append(' <option value="">--select--</option>');
                        $.each(data, function(index, districtObj) {
                            $('#city').append('<option value="' + districtObj.id + '">' + districtObj.name + '</option>');
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
