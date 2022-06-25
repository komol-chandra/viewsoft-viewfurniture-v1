@if ($categoryFooter)
<section class="news-letter1">
    <div class="container">
        <div class="col-md-12 row">
            <a href="{{ $categoryFooter->url }}" class="category_footer_click" target="_blank"
                data-id="{{ $categoryFooter->id }}" onclick="categoryFooterCount();">
                <img src="{{ asset('uploads/ads/' . $categoryFooter->image) }}" alt="" class="img-fluid add_imz"
                    style="height: 110px;width: 100%" />
            </a>
        </div>
    </div>
</section>
@endif
