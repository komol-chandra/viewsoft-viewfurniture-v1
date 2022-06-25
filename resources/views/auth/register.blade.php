@extends('layouts.frontend')
@section('title', 'Register')
@section('content')
<style>
    .register-area .register-box button.btn-style1 {
        width: 100%;
        margin-top: 30px;
        text-align: center;
    }

</style>

<section class="section-tb-padding">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="register-area">
                    <div class="register-box">
                        <h1>Create account</h1>
                        <p>Please register below account detail</p>
                        <form action="{{ route('register') }}" method="post">
                            @csrf
                            <input type="text" name="name" placeholder="name">
                            @error('name')
                            <span style="color:red">{{ $message }}</span>
                            @enderror
                            <input type="text" name="phone" placeholder="Phone">
                            @error('phone')
                            <span style="color:red">{{ $message }}</span>
                            @enderror
                            <input type="password" name="password" placeholder="Password">
                            @error('password')
                            <span style="color:red">{{ $message }}</span>
                            @enderror
                            <input type="password" name="confirm_password" placeholder="Confirm Password">
                            <button type="submit" class="btn-style1">Create</button>
                        </form>
                    </div>
                    <div class="register-account">
                        <h4>Already an account holder?</h4>
                        <a href="{{ url('/login') }}" class="ceate-a">Log in</a>
                        <div class="register-info">
                            <a href="{{ url('/terms-conditions') }}" class="terms-link"><span>*</span> Terms &
                                conditions.</a>
                            <p>Your privacy and security are important to us. For more information on how we use your
                                data read our <a href="{{ url('/privacy-policy') }}">privacy policy</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
