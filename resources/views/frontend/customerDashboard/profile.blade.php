@extends('layouts.frontend')
@section('title', 'Profile')
@section('content')

<section class="order-histry-area section-tb-padding">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="order-history">
                    @include('frontend.customerDashboard.include.sidebar')
                    <div class="profile-form">
                        <form action="{{ url('/profile') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @if(auth()->user()->is_vendor == 0 || auth()->user()->is_vendor == 1)

                            <ul class="pro-input-label">
                                <li>
                                    <label>Name</label>
                                    <input type="text" name="name" placeholder="Enter Your name"
                                        value="{{ Auth::user()->name }}">
                                    @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </li>
                                <li>
                                    <label>Email</label>
                                    <input type="text" name="email" id="email" placeholder="Email"
                                        value="{{ Auth::user()->email }}">
                                    @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </li>
                            </ul>
                            <ul class="pro-input-label">
                                <li>
                                    <label>age</label>
                                    <input type="number" name="age" placeholder="Enter Your age"
                                        value="{{ Auth::user()->age }}">
                                    @error('age')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </li>
                                <li>
                                    <label>Gender</label>
                                    <div class="position-relative d-flex align-items-center">
                                        <select name="gender" id="" class="form-control border-form-control"
                                            style="height: 40px" required>
                                            <option value="" disabled selected>Select gender</option>
                                            <option value="1" {{ auth()->user()->gender=='1' ? 'selected':'' }}>male
                                            </option>
                                            <option value="2" {{ auth()->user()->gender=='0' ? 'selected':'' }}>female
                                            </option>
                                        </select>

                                    </div>
                                    @error('gender')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </li>
                            </ul>
                            <ul class="pro-input-label">
                                <li>
                                    <label>Phone</label>
                                    <input type="text" name="phone" class="form-control" id="review"
                                        placeholder="Enter your Number" value="{{ Auth::user()->phone }}">
                                    @error('phone')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </li>
                                <li>
                                    <label>Divission</label>
                                    <select name="division" id="division" class="form-control">
                                        <option value="" disabled selected>Select Division</option>
                                        @foreach($divisions as $division)
                                        <option value="{{$division->id}}" @if(Auth::user()->division ==
                                            $division->id) selected @endif>{{$division->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('division')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </li>


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
                                        value="{{ Auth::user()->zip_code }}">
                                </li>
                                <li>
                                    <label for="">Address</label>
                                    <textarea name="main_address" class="form-control" id=""
                                        placeholder="Address Details"
                                        required>{{  Auth::user()->main_address }}</textarea>
                                    @error('main_address')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </li>
                                <li>
                                    <label for="">Google Map</label>
                                    <textarea name="google_map" class="form-control" placeholder="Address Details"
                                        required>{{ Auth::user()->google_map  }}</textarea>
                                    @error('main_address')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </li>
                                <li>
                                    <br>
                                    <label for="">Image/Logo</label>
                                    <input type="file" name="image">
                                </li>
                                <li>
                                    <br>
                                    <label for="">Image/Cover</label>
                                    <input type="file" name="cover">
                                </li>
                                <li>
                                    <br>
                                    <label for="">Description</label>
                                    <input type="text" name="description"
                                        value="{{ old('description') ?? Auth::user()->description }}">
                                </li>
                            </ul>
                            @endif
                            @if(auth()->user()->is_vendor == 1)
                            <ul class="pro-input-label">
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
                            @endif
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
<!-- breadcrumb End -->
<!-- section start -->

<!-- section end -->
@endsection
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
