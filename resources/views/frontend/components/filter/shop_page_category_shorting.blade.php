<div class="categories-page-filter">
    <h4 class="filter-title">Categories</h4>
    <a href="#category-filter" data-bs-toggle="collapse" class="filter-link"><span>Categories
        </span><i class="fa fa-angle-down"></i></a>
    <ul class="all-option collapse" id="category-filter">
        @foreach ($category_data ?? [] as $category)
        <li class="grid-list-option">
            <input type="checkbox" class="category common_selector category_wish" name="category"
                id="{{ $category->id }}" value="{{ $category->id }}" data-slug="category-{{ $category->slug }}"
                data-name="{{ $category->name }}">
            <label for="{{ $category->id }}" style="margin-left: 5px;">{{ $category->name}}</label>
        </li>
        @endforeach
    </ul>
</div>
