@extends('layouts.frontend')
@section('title', 'Privacy Policy')

@section('content')
<section class="about-content section-tb-padding">
    <div class="container">
        <div class="row">
            <div class="col">
                {!! $data->details !!}
            </div>
        </div>
    </div>
</section>
@endsection
