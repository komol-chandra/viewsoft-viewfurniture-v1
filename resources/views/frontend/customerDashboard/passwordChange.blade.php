@extends('layouts.frontend')
@section('title', 'Password Change')
@section('content')

<section class="order-histry-area section-tb-padding">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="order-history">
                    @include('frontend.customerDashboard.include.sidebar')
                    <div class="profile-form">
                        <form method="post" action="{{ url('/password-change') }}">
                            @csrf
                            <ul class="pro-input-label">
                                <li>
                                    <label>Current Password</label>
                                    <input type="password" name="current_password" class="form-control" id="name"
                                        placeholder="Enter your Current Password"
                                        required="Enter your Current Password">
                                    @error('current_password')
                                    <div style="color:red">{{ $message }}</div>
                                    @enderror
                                </li>
                                <li>
                                    <label for="email">New Password</label>
                                    <input type="password" name="password" class="form-control" id="last-name"
                                        placeholder="Enter your New Password" required="Enter your Password">
                                    @error('password')
                                    <div style="color:red">{{ $message }}</div>
                                    @enderror
                                </li>
                                <br>
                                <li>
                                    <br>
                                    <label for="review">Confirm Password</label>
                                    <input type="password" name="password_confirmation" class="form-control" id="review"
                                        placeholder="Enter your Confirm Password" required="">
                                    @error('password_confirmation')
                                    <div style="color:red">{{ $message }}</div>
                                    @enderror
                                </li>
                            </ul>
                            <ul class="pro-submit">

                                <li>
                                    <button type="submit" class="btn btn-style1">Update</button>
                                </li>
                            </ul>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
