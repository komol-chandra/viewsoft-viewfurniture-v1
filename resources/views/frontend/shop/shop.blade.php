@extends('layouts.frontend')
@section('title', 'Shop')
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


                <div class="grid-list-area">
                    <div class="grid-list-select">
                        <ul class="grid-list">
                            <div class="col-md-12" id="tags_value">

                            </div>
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
            $('#preloaderss').css("visibility", "visible");

            let tag = [];
            var brand = get_filter('brand');
            var category = get_filter('category');
            var price = get_filter('price');
            var sortingval = get_sort();

            var obj = {
                brand,
                category,
                price,
                sortingval
            };
            console.log(obj);

            brand[1].forEach(function (item) {
                tag.push(item);
            });
            category[1].forEach(function (item) {
                tag.push(item);
            });
            price[1].forEach(function (item) {
                tag.push(item);
            });
            sortingval[1].forEach(function (item) {
                tag.push(item);
            });
            console.log(tag);
            var gethtml = '';
            // gethtml +=
            //         '<li style="margin-right:10px" class="select2-selection__choice custom_tag title="Green" data-select2-id="select2-data-11-kqby"><span class= "select2-selection__choice__display" id = "' +
            //         index + '" style = "margin-right: 10px" >' +
            //         item +
            //         '</span> <button onclick="remove_item(this)" type = "button btn-sm btn btn-danger" class = "select2-selection__choice__remove" tabindex = "-1" title = "Remove item" aria-label = "Remove item"aria-describedby = "select2-colors-container-choice-6ag0-#f7f7f5" style = "color: red;width: 20px;" > <span aria-hidden = "true" > × </span></button></li>';
            tag.forEach(function (item, index) {
                gethtml +=
                    '<li style="margin-right:10px" class="select2-selection__choice custom_tag title="Green" data-select2-id="select2-data-11-kqby"><span class= "select2-selection__choice__display" id = "' +
                    index + '" style = "margin-right: 10px" >' +
                    item +
                    '</span> </li>';
            });
            $('#tags_value').html(gethtml);








            $.ajax({
                url: "{{url('/filter-shop')}}",
                type: 'get',
                data: {
                    category: category[0],
                    brand: brand[0],
                    price: price[0],
                    sortingval: sortingval[0]
                },

                success: function (products) {
                    $('#preloaderss').css("visibility", "hidden");

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
            var filter_tag_name = [];
            var filter_tag_slug = [];
            $('.' + class_name + ':checked').each(function () {
                filter_tag_name.push($(this).data("name"));
                filter_tag_slug.push($(this).data("slug"));
                filter.push($(this).val());
            });
            var get_filter_array = [filter, filter_tag_name, filter_tag_slug];
            return get_filter_array;
        }

        $('.common_selector').click(function () {
            filter_data();
        });

        $('.common_selector').on('change', function () {
            get_sort();
            filter_data();
        });

        function get_sort() {
            var filter = [];
            var filter_tag_name = [];
            var filter_tag_slug = [];
            $.each($("#sortBy option:selected"), function () {
                filter.push($(this).val());
                filter_tag_name.push($(this).data("name"));
                filter_tag_slug.push($(this).data("slug"));
            });
            var get_filter_array = [filter, filter_tag_name, filter_tag_slug];
            return get_filter_array;
        }


    });

</script>
<script>
    function remove_item(selected_item) {
        // alert("ok");
        // selected_item.parentNode.removeChild(selected_item);
        $(selected_item).closest("li").remove();
    }

</script>
@endsection
