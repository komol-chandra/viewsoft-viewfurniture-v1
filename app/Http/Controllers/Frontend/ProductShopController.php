<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Ads;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ResubCategory;
use App\Models\Shop;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Http\Request;

class ProductShopController extends Controller
{
    public function categoryHead()
    {
        $categoryAds = Ads::isActive()->isDeleted()->whereColumn('add_limit', '>', 'view_count')
            ->where('ads_section', '=', 'category_header')->inRandomOrder()->first();
        if ($categoryAds) {
            $model2 = Ads::where('id', $categoryAds->id)->first();

            $model2->view_count = $model2->view_count + 1;
            $model2->save();

        }
        return $categoryAds;
    }

    public function categoryFooter()
    {
        $categoryAds = Ads::isActive()->isDeleted()->whereColumn('add_limit', '>', 'view_count')
            ->where('ads_section', '=', 'category_footer')->inRandomOrder()->first();
        if ($categoryAds) {
            $model2 = Ads::where('id', $categoryAds->id)->first();

            $model2->view_count = $model2->view_count + 1;
            $model2->save();

        }
        return $categoryAds;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function productData()
    {
        return Product::isDeleted()->isActive()->isApprove()->select(['id', 'shop_id', 'product_name', 'product_slug', 'product_qty', 'product_sku', 'sell_qty', 'product_size', 'product_weight', 'product_price', 'have_a_discount', 'offer', 'discount_price', 'discounted_price', 'discount_percent', 'discount_price_type', 'discount_condition', 'from_date', 'to_date', 'offer_stock_type', 'offer_qty', 'checkout_offer_qty', 'image', 'product_condition']);
    }

    public function index(Request $request)
    {
        $categoryHead   = $this->categoryHead();
        $categoryFooter = $this->categoryFooter();
        $products       = $this->productData()->orderBy('id', 'DESC')->paginate(12);
        $category_data  = Category::orderBy('id', 'DESC')->isActive()->isDeleted()->select(['id', 'name', 'slug'])->get();
        $brands         = Brand::orderBy('id', 'DESC')->isActive()->isDeleted()->select(['id', 'name', 'slug'])->get();
        return view('frontend.shop.shop', compact('categoryHead', 'categoryFooter', 'products', 'brands', 'category_data'));
    }

    public function vendorWishShop($id)
    {
        $categoryHead   = $this->categoryHead();
        $categoryFooter = $this->categoryFooter();
        $data           = User::where('id', $id)->with('vendorShop')->first();
        $shopId         = Shop::where('user_id', $id)->pluck('id')->toArray();
        $products       = $this->productData()->orderBy('id', 'DESC')->whereIn('shop_id', $shopId)->paginate(12);
        $category_data  = Category::orderBy('id', 'DESC')->isActive()->isDeleted()->select(['id', 'name'])->get();
        $brands         = Brand::orderBy('id', 'DESC')->isActive()->isDeleted()->select(['id', 'name'])->get();
        return view('frontend.shop.vendor-wish-shop', compact('categoryHead', 'categoryFooter', 'products', 'brands', 'category_data', 'data'));
    }

    public function sectionWishProduct($key)
    {
        $categoryHead   = $this->categoryHead();
        $categoryFooter = $this->categoryFooter();
        $products       = $this->productData();
        $category_data  = Category::orderBy('id', 'DESC')->isActive()->isDeleted()->select(['id', 'name'])->get();
        $brands         = Brand::orderBy('id', 'DESC')->isActive()->isDeleted()->select(['id', 'name'])->get();

        if ($key == 'bestsellproduct') {
            $header   = "Best Sell Product";
            $products = $products->orderBy('sell_qty', 'DESC')->paginate(12);
        } elseif ($key == 'trandingproduct') {
            $header   = " Trending Products";
            $products = $products->trendingProduct()->orderBy('id', 'DESC')->paginate(12);
        } elseif ($key == 'bigSavings') {
            $header   = " Big Saving Products";
            $products = $products->haveDiscount()->specialOffer()->orderBy('discount_price', 'DESC')->paginate(12);
        } elseif ($key == 'newproduct') {
            $header   = "New Products";
            $products = $products->haveDiscount()->specialOffer()->orderBy('discount_price', 'DESC')->paginate(12);
        } elseif ($key == 'featureproduct') {
            $header   = "Feature Product";
            $products = $products->featureProduct()->orderBy('id', 'DESC')->paginate(12);
        } elseif ($key == 'onlythreeBestproduct') {
            $header   = "best seller";
            $products = $products->orderBy('sell_qty', 'DESC')->paginate(12);
        } elseif ($key == 'latestproduct') {
            $header   = "on sale";
            $products = $products->haveDiscount()->specialOffer()->orderBy('discount_price', 'DESC')->paginate(12);
        } elseif ($key == 'topProducts') {
            $header   = "Top Rated Product";
            $products = $products->orderBy('id', 'DESC')->paginate(12);
        } elseif ($key == 'topCollectionProducts') {
            $header   = "Top Collection Product";
            $products = $products->topCollectionProduct()->orderBy('id', 'DESC')->paginate(12);
        } elseif ($key == 'usedproduct') {
            $header   = "Used Product";
            $products = $products->where('product_condition', '!=', 'New')->orderBy('id', 'DESC')->paginate(12);
        }

        return view('frontend.shop.section-wish-product', compact('categoryHead', 'categoryFooter', 'products', 'brands', 'category_data', 'header'));
    }

    public function categoryWishProduct($slug, $id)
    {
        $categoryHead   = $this->categoryHead();
        $categoryFooter = $this->categoryFooter();
        $products       = $this->productData()->orderBy('id', 'DESC')->where("category_id", $id)->paginate(12);
        $brands         = Brand::orderBy('id', 'DESC')->isActive()->isDeleted()->select(['id', 'name'])->get();
        $category       = Category::with('subCategory')->orderBy('id', 'DESC')->isActive()->isDeleted()->where('id', $id)->first();
        return view('frontend.shop.category-shop', compact('categoryHead', 'categoryFooter', 'products', 'brands', 'category'));
    }

    public function subCategoryWishProduct($slug, $id)
    {
        $categoryHead   = $this->categoryHead();
        $categoryFooter = $this->categoryFooter();
        $products       = $this->productData()->orderBy('id', 'DESC')->where("subcategory_id", $id)->paginate(12);
        $brands         = Brand::orderBy('id', 'DESC')->isActive()->isDeleted()->select(['id', 'name'])->get();
        $subCategory    = SubCategory::with('reSubCategory')->orderBy('id', 'DESC')->isActive()->isDeleted()->where('id', $id)->first();
        return view('frontend.shop.sub-category-shop', compact('categoryHead', 'categoryFooter', 'products', 'brands', 'subCategory'));
    }
    public function reSubCategoryWishProduct($slug, $id)
    {
        $categoryHead   = $this->categoryHead();
        $categoryFooter = $this->categoryFooter();
        $products       = $this->productData()->orderBy('id', 'DESC')->where("resubcategory_id", $id)->paginate(12);
        $brands         = Brand::orderBy('id', 'DESC')->isActive()->isDeleted()->select(['id', 'name'])->get();
        $reSubCategory  = ResubCategory::with('reReSubCategory')->orderBy('id', 'DESC')->isActive()->isDeleted()->where('id', $id)->first();
        return view('frontend.shop.re-sub-category-shop', compact('categoryHead', 'categoryFooter', 'products', 'brands', 'reSubCategory'));
    }

    public function offer11Store()
    {
        $categoryHead   = $this->categoryHead();
        $categoryFooter = $this->categoryFooter();
        $products       = $this->productData()->haveDiscount()->offer11()->orderBy('id', 'DESC')->paginate(12);
        $category_data  = Category::orderBy('id', 'DESC')->isActive()->isDeleted()->select(['id', 'name'])->get();
        $brands         = Brand::orderBy('id', 'DESC')->isActive()->isDeleted()->select(['id', 'name'])->get();
        return view('frontend.shop.offer-11-shop', compact('categoryHead', 'categoryFooter', 'products', 'brands', 'category_data'));
    }
    public function offer22Store()
    {
        $categoryHead   = $this->categoryHead();
        $categoryFooter = $this->categoryFooter();
        $products       = $this->productData()->haveDiscount()->offer22()->orderBy('id', 'DESC')->paginate(12);
        $category_data  = Category::orderBy('id', 'DESC')->isActive()->isDeleted()->select(['id', 'name'])->get();
        $brands         = Brand::orderBy('id', 'DESC')->isActive()->isDeleted()->select(['id', 'name'])->get();
        return view('frontend.shop.offer-22-shop', compact('categoryHead', 'categoryFooter', 'products', 'brands', 'category_data'));
    }

    public function offerSpecialStore()
    {
        $categoryHead   = $this->categoryHead();
        $categoryFooter = $this->categoryFooter();
        $products       = $this->productData()->haveDiscount()->specialOffer()->orderBy('id', 'DESC')->paginate(12);
        $category_data  = Category::orderBy('id', 'DESC')->isActive()->isDeleted()->select(['id', 'name'])->get();
        $brands         = Brand::orderBy('id', 'DESC')->isActive()->isDeleted()->select(['id', 'name'])->get();
        return view('frontend.shop.offer-special-shop', compact('categoryHead', 'categoryFooter', 'products', 'brands', 'category_data'));
    }
    public function searchProduct(Request $request)
    {
        $categoryHead   = $this->categoryHead();
        $categoryFooter = $this->categoryFooter();
        $products       = $this->productData()->orderBy('id', 'DESC')->search($request->q)->get();
        $search_name    = $request->q;
        return view('frontend.shop.product_search', compact('categoryHead', 'categoryFooter', 'products', 'search_name'));
    }
}
