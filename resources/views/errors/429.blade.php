@extends('layouts.frontend')
@section('title', 'Too Many Requests')
@section('head')
@include('frontend.include.breadcrumb', ['page_name'=>'429'])
@endsection
@section('content')
<section class="about-content section-tb-padding">
    <div class="container">
        <div class="row">
            <div class="col text-center">
                <h3>419</h3>
                <h4>Too Many Requests</h4>
                <a href="{{ url('/') }}" class="btn-style1 mt-5">Home</a>
            </div>
        </div>
    </div>
</section>
@endsection
