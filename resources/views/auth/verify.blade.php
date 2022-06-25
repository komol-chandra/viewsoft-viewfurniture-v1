@extends('layouts.frontend')
@section('title','Verify Your Phone')
@section('content')
<style>
    .btn-success {
        color: #000;
        background-color: #ffffff;
        border-color: #000000;
        font-size: 12px;
    }

    button.btn-style1 {
        width: 100%;
        margin-top: 30px;
        text-align: center;
    }

</style>

<section class="section-tb-padding">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="login-area">
                    <div class="login-box">
                        <h1>Verify Your Phone</h1>
                        <p>Please Check Your Phone & Input Verificaion Code</p>
                        <form action="{{ route('email.verify') }}" method="POST">
                            @csrf
                            <label>Verification Code</label>
                            <input type="text" name="code" placeholder="Enter Verification Code">
                            <input type="hidden" name="id" value="{{ $id }}">
                            @error('code')
                            <span style="color:red">{{ $message }}</span>
                            @enderror
                            <button type="submit" class="btn-style1">Submit</button>
                        </form>
                    </div>
                    <div class="login-account">
                        <h4>Already have an account?</h4>
                        <a href="{{ url('/login') }}" class="ceate-a">Login</a>
                        <div class="login-info">
                            <a href="terms-conditions.html" class="terms-link"><span>*</span> Terms & conditions.</a>
                            <p>Your privacy and security are important to us. For more information on how we use your
                                data read our <a href="privacy-policy.html">privacy policy</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- login end -->






{{-- 

<form class="theme-form" action="{{ route('email.verify') }}" method="POST">
@csrf
<div class="form-row row">
    <div class="col-md-12">
        <input type="text" name="code" class="form-control" id="email" placeholder="Enter Your Code" required="">
        <input type="hidden" name="id" value="{{ $id }}">
    </div>
    <button type="submit" class="btn btn-solid w-auto">Submit</button>
</div>
</form>
--}}



@endsection
