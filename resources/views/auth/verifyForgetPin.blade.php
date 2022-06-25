@extends('layouts.frontend')
@section('title', 'Forget Password Verify')

@section('content')
<section class="about-content section-tb-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 m-auto">
                <h4>Check Your Email.Input Your Verification Code and Reset Password</h4>
                <form class="theme-form" action="{{ url('forget-password/verify/store') }}" method="POST">
                    @csrf
                    <div class="form-row row">
                        <div class="col-lg-12">
                            <div class="theme-card">
                                <form class="theme-form" action="" method="POST">
                                    @csrf
                                    <div class="form-group mt-4">
                                        <input type="text" name="code" class="form-control" id="code"
                                            placeholder="Verification Code" value="{{ old('code')}}">
                                        <input type="hidden" name="id" value="{{ $id }}">
                                        @error('code')
                                        <div style="color:red">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group mt-4">

                                        <input type="password" name="password" class="form-control" id="email"
                                            placeholder="Password">
                                        @error('password')
                                        <div style="color:red">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group mt-4">
                                        <input type="password" class="form-control" id="review"
                                            name="password_confirmation" placeholder="Confirm Password">
                                        @error('password_confirmation')
                                        <div style="color:red">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <button type="submit" class=" mt-2 btn btn-style2 w-auto">Submit</button>

                                </form>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
