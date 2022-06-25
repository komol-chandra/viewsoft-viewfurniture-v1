@extends('layouts.frontend')
@section('title', 'Login')
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
                        <h1>Login</h1>
                        <p>Please login below account detail</p>
                        <div class="facebook mt-3">
                            <!-- <a href="{{ url('/') }}" class="btn btn-success">Facebook Login</a>
                            <a href="{{ url('/') }}" class="btn btn-success">Google Login</a> -->
                        </div>
                        <form action="{{ route('user.login') }}" method="POST">
                            @csrf
                            <label>Phone</label>
                            <input type="text" name="phone" placeholder="Phone">
                            @error('phone')
                            <span style="color:red">{{ $message }}</span>
                            @enderror
                            <br>
                            <label>Password</label>
                            <input type="password" name="password" placeholder="Password">
                            @error('password')
                            <span style="color:red">{{ $message }}</span>
                            @enderror
                            <button type="submit" class="btn-style1">Sign in</button>
                            <a href="{{ url('forget-password') }}" class="re-password">Forgot your password?</a>
                        </form>
                    </div>
                    <div class="login-account">
                        <h4>Don't have an account?</h4>
                        <a href="{{ url('/register') }}" class="ceate-a">Create account</a>
                        <div class="login-info">
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
<!-- login end -->
@endsection
