<div class="tred-pro">
    <div class="tr-pro-img">
        <a href="{{ url('/products/' . $product->product_slug . '/' . $product->id) }}">
            <img class="img-fluid" src="{{ asset('uploads/products/' . $product->image) }}" alt="pro-img1">

        </a>
    </div>
    <div class="Pro-lable">
        <span class="p-text">{{ $product->product_condition }}</span>
    </div>
    <div class="pro-icn">
        <a href="wishlist.html" class="w-c-q-icn"><i class="fa fa-heart"></i></a>
        <a href="cart.html" class="w-c-q-icn"><i class="fa fa-shopping-bag"></i></a>
        <a href="javascript:void(0)" class="w-c-q-icn" data-bs-toggle="modal" data-bs-target="#exampleModal"><i
                class="fa fa-eye"></i></a>
    </div>
</div>
<div class="caption">
    <h3><a href="{{ url('/products/' . $product->product_slug . '/' . $product->id) }}">{{ $product->product_name }}</a>
    </h3>
    <div class="rating">
        <i class="fa fa-star c-star"></i>
        <i class="fa fa-star c-star"></i>
        <i class="fa fa-star c-star"></i>
        <i class="fa fa-star-o"></i>
        <i class="fa fa-star-o"></i>
    </div>
    <div class="pro-price">
        <span class="new-price"> ৳ {{ $product->product_price }}</span>
    </div>
</div>
