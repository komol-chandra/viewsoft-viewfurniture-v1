@extends('layouts.frontend')
@section('title', 'Vendor')
@section('content')

<!-- breadcrumb start -->
<div class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="page-title">
                    <h2>{{$data->company_name}}</h2>
                </div>
            </div>
            <div class="col-sm-6">
                <nav aria-label="breadcrumb" class="theme-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{$data->company_name}}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb end -->


<!-- section start -->
<section class="section-b-space ratio_asos">
    <div class="collection-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-sm-3 collection-filter">
                    <!-- side-bar colleps block stat -->
                    <div class="collection-filter-block">
                        <!-- brand filter start -->
                        <div class="collection-mobile-back"><span class="filter-back"><i class="fa fa-angle-left"
                                    aria-hidden="true"></i> back</span></div>

                        <div class="collection-collapse-block open">
                            <h3 class="collapse-block-title">Shop</h3>
                            <div class="collection-collapse-block-content">
                                <div class="collection-brand-filter">
                                    @foreach ($data->vendorShop ?? [] as $shop)
                                    <div class="form-check collection-filter-checkbox">
                                        <input type="checkbox" class="form-check-input shop common_selector"
                                            name="shop" id="{{ $shop->id }}" value="{{ $shop->id }}">
                                        <label class="form-check-label" for="{{ $shop->id }}">{{ $shop->shop_name }}</label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        
                        <div class="collection-collapse-block open">
                            <h3 class="collapse-block-title">Category</h3>
                            <div class="collection-collapse-block-content">
                                <div class="collection-brand-filter">
                                    @foreach ($category_data ?? [] as $category)
                                    <div class="form-check collection-filter-checkbox">
                                        <input type="checkbox" class="form-check-input category common_selector"
                                            name="category" id="{{ $category->id }}" value="{{ $category->id }}">
                                        <label class="form-check-label" for="{{ $category->id }}">{{ $category->name
                                            }}</label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>


                        <!-- brand filter start -->

                        <div class="collection-collapse-block open">
                            <h3 class="collapse-block-title">brand</h3>
                            <div class="collection-collapse-block-content">
                                <div class="collection-brand-filter">
                                    @foreach ($brands ?? [] as $brand)
                                    <div class="form-check collection-filter-checkbox">
                                        <input type="checkbox" class="form-check-input brand common_selector"
                                            name="brand" id="b-{{ $brand->id }}" value="{{ $brand->id }}">
                                        <label class="form-check-label" for="b-{{ $brand->id }}">{{ $brand->name
                                            }}</label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="collection-collapse-block open">
                            <h3 class="collapse-block-title">Price</h3>
                            <div class="collection-collapse-block-content">
                                <div class="collection-brand-filter mt-3 mb-2 ">
                                    <div class="custom-control custom-radio mt-2">
                                        <input type="radio" class="custom-control-input common_selector price"
                                            name="price" id="p-1" value="1">
                                        <label class="custom-control-label" for="p-1">৳10 to ৳100</label>
                                    </div>
                                    <div class="custom-control custom-radio mt-2">
                                        <input type="radio" class="custom-control-input common_selector price"
                                            name="price" id="p-2" value="2">
                                        <label class="custom-control-label" for="p-2">৳101 to ৳500</label>
                                    </div>
                                    <div class="custom-control custom-radio mt-2">
                                        <input type="radio" class="custom-control-input common_selector price"
                                            name="price" id="p-3" value="3">
                                        <label class="custom-control-label" for="p-3">৳501 to ৳1000</label>
                                    </div>
                                    <div class="custom-control custom-radio mt-2">
                                        <input type="radio" class="custom-control-input common_selector price"
                                            name="price" id="p-4" value="4">
                                        <label class="custom-control-label" for="p-4">৳1001 to 10000</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="collection-content col">
                    <div class="page-main-content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="collection-product-wrapper">
                                    <div class="product-top-filter">
                                        <div class="row">
                                            <div class="col-xl-12">
                                                <div class="filter-main-btn"><span class="filter-btn btn btn-theme"><i
                                                            class="fa fa-filter" aria-hidden="true"></i> Filter</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="product-filter-content">
                                                    <div class="search-count">
                                                        <h5>Showing All Products </h5>
                                                    </div>
                                                    <div class="collection-view">
                                                        <ul>
                                                            <li><i class="fa fa-th grid-layout-view"></i></li>
                                                            <li><i class="fa fa-list-ul list-layout-view"></i></li>
                                                        </ul>
                                                    </div>
                                                    <div class="product-page-filter">
                                                        <select class="common_selector" name="sortBy" id="sortBy">
                                                            <option selected value="">Select</option>
                                                            <option value="1">Price (Low to High)</option>
                                                            <option value="2">Price (High to Low)</option>
                                                            <option value="3">Name (A to Z)</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-wrapper-grid" id="defultData">
                                        <div class="row margin-res">                                                                            
                                            @foreach($products as $product)
                                            <div class="col-xl-3 col-6 col-grid-box">
                                                @include('frontend.shop.product.basic-cart-product')
                                            </div>
                                            @endforeach
                                        </div>
                                        <div class="product-pagination">
                                            <div class="theme-paggination-block">
                                                <div class="container-fluid p-0">
                                                    <div class="row">
                                                        <div class="col-xl-12 col-md-12 col-sm-12">
                                                            {{$products -> links('vendor.pagination.custom')}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-wrapper-grid" id="filterData"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
@section('js')
<script>
    function onClickCategory(){
        // alert('hi');
    }
</script>
<script>
    $(document).ready(function(){   
        function filter_data()
        {
            // var category = $('#category').val();
            var shop = get_filter('shop');
            var brand = get_filter('brand');
            var category = get_filter('category');
            var price = get_filter('price');
            var sortingval = get_sort();
           $.ajax({
                url : '{{url('/filter-shop-wise-product')}}',
                type : 'get',
                data : {shop:shop,category:category,brand:brand,price:price,sortingval:sortingval},
                success: function(products) {
                    if(products){
                        $('#defultData').hide();
                        $('#filterData').html(products);
                    }else{
                        $('#defultData').show();
                        $('#filterData').hide();
                    }
                }
            })
        }
        
        function get_filter(class_name)
        {
            var filter = [];
            $('.'+class_name+':checked').each(function(){
                filter.push($(this).val());
            });
            return filter;
        }
        
        $('.common_selector').click(function(){
            filter_data();
        });
       
        $('.common_selector').on('change' ,function(){
            get_sort();
            filter_data();
        });

        function get_sort()
        {
            var sortBy = [];
            $.each($("#sortBy option:selected"), function(){            
                sortBy.push($(this).val());
            });
            return sortBy;
        }
    });
</script>
@endsection