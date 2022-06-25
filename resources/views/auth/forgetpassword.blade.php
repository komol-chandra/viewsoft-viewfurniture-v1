{{-- @extends('layouts.frontend')
@section('title', 'Forget Password')
@section('content')
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="page-title">
                        <h2>forget password</h2>
                    </div>
                </div>
                <div class="col-sm-6">
                    <nav aria-label="breadcrumb" class="theme-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
<li class="breadcrumb-item"><a href="{{ url('/') }}">login</a></li>
<li class="breadcrumb-item active" aria-current="page">forget password</li>
</ol>
</nav>
</div>
</div>
</div>
</div>
<section class="pwd-page section-b-space">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 m-auto">
                <h2>Forget Your Password</h2>
                <form class="theme-form" action="{{ url('/forget-password') }}" method="post">
                    @csrf
                    <div class="form-row row">
                        <div class="col-md-12">
                            <input type="email" name="email" class="form-control" id="email"
                                placeholder="Enter Your Email" required="" value="{{ old('email') }}">
                            @error('email')
                            <div style="color:red">{{ $message }}</div>
                            @enderror
                        </div><button type="submit" class="btn btn-solid w-auto">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection --}}


@extends('layouts.frontend')
@section('title', 'Forget Password')
@section('head')
@include('frontend.include.breadcrumb', ['page_name'=>'Forget Password'])
@endsection
@section('content')
<section class="about-content section-tb-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2>Forget Your Password</h2>
                <form class="theme-form" action="{{ url('/forget-password') }}" method="post">
                    @csrf
                    <div class="form-row row">
                        <div class="col-md-12">
                            <input type="text" name="phone" class="form-control" id="phone"
                                placeholder="Enter Your phone" required="" value="{{ old('phone') }}">
                            @error('phone')
                            <div style="color:red">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class=" mt-2 btn btn-style2 w-auto">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
