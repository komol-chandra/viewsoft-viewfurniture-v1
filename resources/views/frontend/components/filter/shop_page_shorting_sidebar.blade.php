<div class="vendor-filter">
    <h4 class="filter-title">Brands</h4>
    <a href="#vendor" data-bs-toggle="collapse" class="filter-link"><span>Brands</span><i
            class="fa fa-angle-down"></i></a>
    <ul class="all-vendor collapse" id="vendor">
        @foreach ($brands ?? [] as $brand)
        <li class="f-vendor">
            <input type="checkbox" class="brand common_selector brand_wish" name="brand" id="b-{{ $brand->id }}"
                value="{{ $brand->id }}" data-name="{{ $brand->name}}" data-slug="brand-{{ $brand->slug }}">
            <label for="b-{{ $brand->id }}">{{ $brand->name}}</label>
        </li>
        @endforeach

    </ul>
</div>
