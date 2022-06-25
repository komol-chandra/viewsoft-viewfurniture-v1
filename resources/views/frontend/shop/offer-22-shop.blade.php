@extends('layouts.frontend')
@section('title', '22 Offer Shop')

@section('content')
@include('frontend.components.filter.header_ad')

<section class="section-tb-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-12">
                <div class="all-filter">
                    @include('frontend.components.filter.shop_page_category_shorting')
                    @include('frontend.components.filter.shop_page_shorting_sidebar')
                </div>
            </div>
            <div class="col-lg-9 col-md-8 col-12">
                @php
                $shop_content =
                App\Models\Option::where('title_key','22_offer')->where('key','shop_page_section')->first();
                @endphp
                <div class="grid-list-banner"
                    style="background-image: url({{ asset($shop_content->cover ? 'uploads/shop-section/'.$shop_content->cover : 'frontend/image/slider17.jpg')}});">

                </div>
                <div>
                    <h4>{{ $shop_content->title }}</h4>
                    <p>{{ $shop_content->description }}</p>
                </div>
                <div class="grid-list-area">
                    <div class="grid-list-select">
                        <ul class="grid-list">
                        </ul>
                        @include('frontend.components.filter.shop_page_short_by')

                    </div>
                    <div id="defultData">
                        <div class="grid-pro mb-5">
                            <ul class="grid-product">
                                @forelse ($products as $product)
                                <li class="grid-items">
                                    @include('frontend.components.products.shop_page_product')
                                </li>
                                @empty
                                <li class="grid-items">
                                    <div class="tred-pro">
                                        <div class="tr-pro-img">
                                            <img class="img-fluid"
                                                src="{{ asset('uploads/damo/no-product-found.png') }}" alt="pro-img1">
                                        </div>
                                    </div>
                                </li>
                                @endforelse
                            </ul>
                        </div>
                        <div class="all-page mt-4">
                            <div class="page-number style-1">
                                {{ $products->links('vendor.pagination.custom') }}
                            </div>
                        </div>
                    </div>
                    <div id="filterData"></div>
                </div>
            </div>
        </div>
    </div>
</section>
@include('frontend.components.filter.footer_ad')

@endsection
@section('js')
<script>
    $(document).ready(function () {
        function filter_data() {
            var brand = get_filter('brand');
            var category = get_filter('category');
            var price = get_filter('price');
            var sortingval = get_sort();
            $.ajax({
                url: "{{url('/filter-22-offer-shop')}}",
                type: 'get',
                data: {
                    category: category,
                    brand: brand,
                    price: price,
                    sortingval: sortingval
                },
                success: function (products) {
                    console.log(products);
                    if (products) {
                        $('#defultData').hide();
                        $('#filterData').html(products);
                    } else {
                        $('#defultData').show();
                        $('#filterData').hide();
                    }
                }
            })
        }

        function get_filter(class_name) {
            var filter = [];
            $('.' + class_name + ':checked').each(function () {
                filter.push($(this).val());
            });
            return filter;
        }

        $('.common_selector').click(function () {
            filter_data();
        });

        $('.common_selector').on('change', function () {
            get_sort();
            filter_data();
        });

        function get_sort() {
            var sortBy = [];
            $.each($("#sortBy option:selected"), function () {
                sortBy.push($(this).val());
            });
            return sortBy;
        }
    });

</script>
@endsection
