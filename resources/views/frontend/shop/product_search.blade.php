@extends('layouts.frontend')
@section('title', 'Searched Product')

@section('content')
@include('frontend.components.filter.header_ad')

<section class="section-tb-padding">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="search-title">
                    <h3>Your search for "{{ $search_name }}" revealed the following:</h3>
                </div>

                <div class="search-pro-area">
                    @foreach ($products as $product)
                    @include('frontend.components.products.search_product')
                    @endforeach

                </div>

            </div>
        </div>
    </div>
</section>
@include('frontend.components.filter.footer_ad')

@endsection
