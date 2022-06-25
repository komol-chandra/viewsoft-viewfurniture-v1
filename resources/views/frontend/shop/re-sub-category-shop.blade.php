@extends('layouts.frontend')
@section('title', 'Re Sub Category Wish Shop')

@section('content')
@include('frontend.components.filter.header_ad')

<section class="section-tb-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-12">
                <div class="all-filter">
                    <input type="hidden" name="re_sub_category" id="re_sub_category" class="re_sub_category"
                        value="{{$reSubCategory->id}}">
                    @if($reSubCategory->reReSubCategory->count() > 0)
                    <div class="categories-page-filter">
                        <h4 class="filter-title">Re Re Sub Category</h4>
                        <a href="#category-filter" data-bs-toggle="collapse" class="filter-link"><span>Re Re Sub
                                Category
                            </span><i class="fa fa-angle-down"></i></a>
                        <ul class="all-option collapse" id="category-filter">
                            @foreach ($subCategory->reSubCategory as $re_sub_category)
                            <li class="grid-list-option">
                                <input type="checkbox" class="common_selector re_re_sub_category"
                                    name="re_re_sub_category" id="{{ $re_re_sub_category->id}}"
                                    value="{{ $re_re_sub_category->id}}">
                                <label for="{{ $re_re_sub_category->id}}"
                                    style="margin-left: 5px;">{{$reSubCategory->name }}</label>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    @include('frontend.components.filter.shop_page_shorting_sidebar')
                </div>
            </div>

            <div class="col-lg-9 col-md-8 col-12">
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
            var sub_category = $('#sub_category').val();
            var brand = get_filter('brand');
            var re_sub_category = get_filter('re_sub_category');
            var price = get_filter('price');
            var sortingval = get_sort();
            $.ajax({
                url: "{{url('/filter-re-sub-category-shop')}}",
                type: 'get',
                data: {
                    sub_category: sub_category,
                    brand: brand,
                    re_sub_category: re_sub_category,
                    price: price,
                    sortingval: sortingval
                },
                success: function (products) {
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
