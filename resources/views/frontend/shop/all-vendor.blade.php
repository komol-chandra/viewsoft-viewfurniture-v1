@extends('layouts.frontend')
@section('title', 'All Vendors')
@section('css')
<style>
    .vendor_img {
        border-radius: 50%;
        height: 180px;
        width: 180px;
    }

</style>
@endsection

@section('content')
<section class="section-tb-padding">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="search-pro-area">
                    @foreach ($data as $vendors)
                    @php
                    $shop = App\Models\Shop::where('user_id',
                    $vendors->id)->where('is_active', 1)->where('is_deleted', 0)->where('is_approve',
                    1)->count();
                    $productcount = App\Models\Product::where('user_id',
                    $vendors->id)->where('is_active', 1)->where('is_deleted', 0)->where('is_approve',
                    1)->count();
                    @endphp
                    @if($shop > 0)
                    <div class="search-pro-items" style="text-align: center">
                        <div class="search-img">
                            <a href="{{url('vendor-shop'.'/'.$vendors->id)}}">
                                <img data-original="{{asset('uploads/user/'.$vendors->image)}}"
                                    class="img-fluid img_laz vendor_img" alt="image">
                            </a>
                        </div>
                        <div class="search-caption">
                            <h4><a href="{{url('vendor-shop'.'/'.$vendors->id)}}">{{ $vendors->name }}</a></h4>
                            <span class="all-price">
                                <span class="search-new-price">{{ $productcount }} products</span>
                            </span>
                        </div>
                    </div>
                    @endif

                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
