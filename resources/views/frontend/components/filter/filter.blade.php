<script src="{{ asset('frontend') }}/js/jquery-3.6.0.min.js"></script>
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
                    <img class="img-fluid" src="{{ asset('uploads/damo/no-product-found.png') }}" alt="pro-img1">
                </div>
            </div>
        </li>
        @endforelse
    </ul>
</div>
