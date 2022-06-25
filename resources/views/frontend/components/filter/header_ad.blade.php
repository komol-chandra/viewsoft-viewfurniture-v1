@if ($categoryHead)
<section class="news-letter1">
    <div class="container">
        <div class="col-md-12 row">
            <a href="{{ $categoryHead->url }}" class="category_head_click" target="_blank"
                data-id="{{ $categoryHead->id }}" onclick="categoryHeadCount();">
                <img src="{{ asset('uploads/ads/' . $categoryHead->image) }}" alt="" class="img-fluid add_imz"
                    style="height: 110px;width: 100%" />
            </a>
        </div>
    </div>
</section>
@endif
