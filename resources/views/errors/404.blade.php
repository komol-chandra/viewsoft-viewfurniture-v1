@extends('layouts.frontend')
@section('title', '404')
@section('head')
@include('frontend.include.breadcrumb', ['page_name'=>'404'])
@endsection
@section('content')
<section class="about-content section-tb-padding">
    <div class="container">
        <div class="row">
            <div class="col text-center">
                <h3>404</h3>
                <h4>Page Not Found</h4>
                <a href="{{ url('/') }}" class="btn-style1 mt-5">Home</a>
            </div>
        </div>
    </div>
</section>
@endsection
