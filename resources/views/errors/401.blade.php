{{-- @extends('errors::minimal')

@section('title', __('Unauthorized'))
@section('code', '401')
@section('message', __('Unauthorized')) --}}

@extends('layouts.frontend')
@section('title', 'Unauthorized')
@section('head')
@include('frontend.include.breadcrumb', ['page_name'=>'401'])
@endsection
@section('content')
<section class="about-content section-tb-padding">
    <div class="container">
        <div class="row">
            <div class="col text-center">
                <h3>401</h3>
                <h4>Unauthorized</h4>
                <a href="{{ url('/') }}" class="btn-style1 mt-5">Home</a>
            </div>
        </div>
    </div>
</section>
@endsection
