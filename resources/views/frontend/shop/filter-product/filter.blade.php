<div class="row margin-res">
    @foreach ($products as $product)
    <div class="col-xl-3 col-6 col-grid-box">
        @include('frontend.shop.product.basic-cart-product')
    </div>
    @endforeach
</div>