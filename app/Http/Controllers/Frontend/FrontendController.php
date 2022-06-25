<?php

namespace App\Http\Controllers\Frontend;

use Carbon\Carbon;
use App\Models\Ads;
use App\Models\User;
use App\Models\Color;
use App\Models\Order;
use App\Models\Banner;
use App\Models\Slider;
use App\Models\AboutUs;
use App\Models\Product;
use App\Models\Category;
use Facade\FlareClient\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use RealRashid\SweetAlert\Facades\Alert;

class FrontendController extends Controller
{
    public function productData()
    {
        return Product::isDeleted()->isActive()->isApprove()->select(['id', 'shop_id', 'product_name', 'product_slug', 'product_qty', 'product_sku', 'sell_qty', 'product_size', 'product_weight', 'product_price', 'have_a_discount', 'offer', 'discount_price', 'discounted_price', 'discount_percent', 'discount_price_type', 'discount_condition', 'from_date', 'to_date', 'offer_stock_type', 'offer_qty', 'checkout_offer_qty', 'image', 'product_condition']);
    }

    public function old()
    {
        $headerAds = Ads::isActive()->isDeleted()->whereColumn('add_limit', '>', 'view_count')
            ->where('ads_section', '=', 'category_header')->inRandomOrder()->first();
        if ($headerAds) {
            $model_header             = Ads::where('id', $headerAds->id)->first();
            $model_header->view_count = $model_header->view_count + 1;
            $model_header->save();
        }
        $footerAds = Ads::isActive()->isDeleted()->whereColumn('add_limit', '>', 'view_count')
            ->where('ads_section', '=', 'footer')->inRandomOrder()->first();
        if ($footerAds) {
            $footer_ad = Ads::where('id', $footerAds->id)->first();

            $footer_ad->view_count = $footer_ad->view_count + 1;
            $footer_ad->save();
        }
    }

    // home section
    public function home()
    {
        $sliders = Cache::rememberForever("sliders", function () {
            return Slider::select(['image', 'title'])->isActive()->get();
        });
        $banners = Cache::rememberForever("banners", function () {
            return Banner::isActive()->isDeleted()->select(['title', 'discount', 'url', 'image', 'type'])->limit(3)->get();
        });
        $categories = Cache::rememberForever("categories", function () {
            return  Category::isDeleted()->isActive()->orderBy('id', 'ASC')->withCount('Product')->limit(12)->get();
        });
        $bestSellProducts      = $this->productData()->orderBy('sell_qty', 'DESC')->limit(12)->get();
        $topCollectionProducts = $this->productData()->topCollectionProduct()->orderBy('id', 'DESC')->limit(12)->get();
        $trendingProducts      = $this->productData()->trendingProduct()->orderBy('id', 'DESC')->limit(12)->get();
        $featureProducts       = $this->productData()->featureProduct()->orderBy('id', 'DESC')->limit(12)->get();
        $trendingProducts      = $this->productData()->trendingProduct()->orderBy('id', 'DESC')->limit(12)->get();
        $featureProducts       = $this->productData()->featureProduct()->orderBy('id', 'DESC')->limit(12)->get();
        $usedProducts          = $this->productData()->UsedProduct()->orderBy('id', 'DESC')->limit(12)->get();

        $popupAds = Ads::isActive()->isDeleted()->whereColumn('add_limit', '>', 'view_count')
            ->where('ads_section', '=', 'popup')->inRandomOrder()->first();
        if ($popupAds) {
            $popupAdd = Ads::where('id', $popupAds->id)->first();

            $popupAdd->view_count = $popupAdd->view_count + 1;
            $popupAdd->save();
        }
        return view('frontend.home.index', compact('usedProducts', 'popupAds', 'sliders', 'banners', 'categories', 'bestSellProducts', 'topCollectionProducts', 'trendingProducts', 'featureProducts'));

    }

    // product details
    public function productDetails($slug, $id)
    {
        $product = Product::isDeleted()->isActive()->isApprove()->isID($id)->with('Category', 'SubCategory_id', 'Brand', 'Vendor', 'Review')->withAvg('Review', 'review_star')->withCount('Review')->first();

        $todayDate             = Carbon::now();
        $today                 = $todayDate->format('d');
        $eleven                = '11';
        $twenty_two            = '22';
        $discounted_price      = 0;
        $product_main_price    = 0;
        $discount_price        = 0;
        $product_discount_name = 0;
        $isOfferActive         = 0;
        if ($product->have_a_discount == 1) {
            // special_offer
            if ($product->offer == 'special_offer') {
                if ($product->discount_condition == 'date' && ($todayDate->gte($product->from_date) && $todayDate->lte($product->to_date))) {
                    $isOfferActive = 1;
                } elseif ($product->discount_condition == 'Stock' && $product->offer_stock_type == "limit_qty" && $product->product_qty >= $product->offer_qty) {
                    $isOfferActive = 1;
                } elseif ($product->discount_condition == 'Stock' && $product->offer_stock_type == "all_stock" && $product->product_qty != '0') {
                    $isOfferActive = 1;
                } else {}

                if ($product->discount_price_type == "percent") {
                    $product_main_price       = $product->product_price;
                    $product_discount_percent = $product->discount_price;
                    $discount_price           = $product->product_price * ($product->discount_price / 100);
                    $discounted_price         = ($product->product_price - $discount_price);
                    $product_discount_name    = $product->discount_price . "% Off";
                }
                if ($product->discount_price_type == "taka") {
                    $product_main_price    = $product->product_price;
                    $discount_percent      = ($product->discount_price * 100) / $product->product_price;
                    $discount_price        = $product->discount_price;
                    $discounted_price      = ($product->product_price - $discount_price);
                    $product_discount_name = $product->discount_price . " ৳ Off";
                }
                // 22 offer
            } elseif ($product->offer == '22_offer') {
                if ($today == $twenty_two) {
                    $isOfferActive         = 1;
                    $product_main_price    = $product->product_price;
                    $product_discount_name = "22% Off";
                    $discount_price        = $product->product_price * (22 / 100);
                    $discounted_price      = ($product->product_price - $discount_price);
                }
                // 11 offer
            } else {
                if ($today == $eleven) {
                    $isOfferActive         = 1;
                    $product_main_price    = $product->product_price;
                    $product_discount_name = "11 % Off";
                    $discount_price        = $product->product_price * (11 / 100);
                    $discounted_price      = ($product->product_price - $discount_price);
                }
            }
        }
        // dd($product);

        $related_products = $this->productData()->where('category_id', $product->category_id)->notID($product->id)
            ->limit(6)->orderBy('id', 'DESC')->limit(12)->get();

        $discounted_price = intval($discounted_price);
        $ads              = Ads::isActive()->isDeleted()->whereColumn('add_limit', '>', 'view_count')
            ->where('ads_section', '=', 'details_sidebar')->inRandomOrder()->first();
        if ($ads) {
            $model_header             = Ads::where('id', $ads->id)->first();
            $model_header->view_count = $model_header->view_count + 1;
            $model_header->save();
        }

        $footerAds = Ads::isActive()->isDeleted()->whereColumn('add_limit', '>', 'view_count')
            ->where('ads_section', '=', 'footer')->inRandomOrder()->first();
        if ($footerAds) {
            $footer_ad = Ads::where('id', $footerAds->id)->first();

            $footer_ad->view_count = $footer_ad->view_count + 1;
            $footer_ad->save();
        }

        return view('frontend.product_details.details', compact('ads', 'footerAds', 'product', 'related_products', 'product_main_price', 'discount_price', 'discounted_price', 'product_discount_name', 'isOfferActive'));
    }
    public function contactUs()
    {
        $data = AboutUs::select(['details', 'id'])->where('keyword', 'contact_us')->first();
        return view('frontend.pages.contact_us', compact('data'));
    }
    public function aboutUs()
    {
        $data = AboutUs::select(['details', 'id'])->where('keyword', 'about_us')->first();
        return view('frontend.pages.about_us', compact('data'));
    }
    public function privacyPolicy()
    {
        $data = AboutUs::select(['details', 'id'])->where('keyword', 'privacy_policy')->first();
        return view('frontend.pages.privacy_policy', compact('data'));
    }
    public function termsCondition()
    {
        $data = AboutUs::select(['details', 'id'])->where('keyword', 'terms_condition')->first();
        return view('frontend.pages.terms_condition', compact('data'));
    }

    public function trackCustomerOrder(Request $request)
    {
        $validated = $request->validate([
            'order_id' => 'required',
        ]);
        if ($validated) {
            $data = Order::where('order_id', $request->order_id)->first();
            return view("frontend.checkout.order_track", compact('data'));
        } else {
            Alert::toast('Oops! Order Id is required!', 'error');
            return \redirect()->back();
        }
    }

    public function allVendor()
    {
        $data = User::
            where([
            ['is_vendor', '1'],
            ['is_active', '1'],
            ['is_vendor_approve', '1'],
            ['is_deleted', '0'],
        ])
            ->select(['id', 'name', 'image'])->get();
        return view('frontend.shop.all-vendor', compact('data'));
    }

    public function provarient(Request $request)
    {

        $product = Product::find($request->product_id);

        $str      = '';
        $quantity = 0;

        if ($request->has('color')) {
            $data['color'] = $request['color'];
            $str           = Color::where('color_code', $request['color'])->first()->color_name;
        }

        foreach (json_decode(Product::find($request->product_id)->choice_options) as $key => $choice) {
            if ($str != null) {
                $str .= '-' . str_replace(' ', '', $request[$choice->name]);
            } else {
                $str .= str_replace(' ', '', $request[$choice->name]);
            }
        }

        if ($str != null) {
            $price = json_decode($product->variations)->$str->price;
            $sku   = json_decode($product->variations)->$str->sku;
        } else {
            $price = $product->product_price;
            $sku   = $product->product_sku;
        }

        if ($product->have_a_discount == 1) {
            $val_old_price         = 0;
            $discounted_price      = 0;
            $product_main_price    = 0;
            $discount_price        = 0;
            $product_discount_name = 0;
            $isOfferActive         = 0;
            $val_price             = $price;
            // offer data
            $todayDate     = Carbon::now();
            $today         = $todayDate->format('d');
            $eleven        = '11';
            $twenty_two    = '22';
            $isOfferActive = 0;
            $offer_data    = [];

            // special_offer
            if ($product->offer == 'special_offer') {
                if ($product->discount_condition == 'date' && ($todayDate->gte($product->from_date) && $todayDate->lte($product->to_date))) {
                    $isOfferActive = 1;
                } elseif ($product->discount_condition == 'Stock' && $product->offer_stock_type == "limit_qty" && $product->product_qty >= $product->offer_qty) {
                    $isOfferActive = 1;
                } elseif ($product->discount_condition == 'Stock' && $product->offer_stock_type == "all_stock" && $product->product_qty != '0') {
                    $isOfferActive = 1;
                } else {}

                if ($product->discount_price_type == "percent") {
                    $product_main_price       = $price;
                    $product_discount_percent = $product->discount_price;
                    $discount_price           = $price * ($product->discount_price / 100);
                    $discounted_price         = ($price - $discount_price);
                    $product_discount_name    = $product->discount_price . "% off";
                }
                if ($product->discount_price_type == "taka") {
                    $product_main_price    = $price;
                    $discount_percent      = ($product->discount_price * 100) / $price;
                    $discount_price        = $product->discount_price;
                    $discounted_price      = ($price - $discount_price);
                    $product_discount_name = $product->discount_price . " ৳ off";
                }
                // 22 offer
            } elseif ($product->offer == '22_offer') {
                if ($today == $twenty_two) {
                    $isOfferActive         = 1;
                    $product_main_price    = $price;
                    $product_discount_name = "22% Off";
                    $discount_price        = $price * (22 / 100);
                    $discounted_price      = ($price - $discount_price);
                }
                // 11 offer
            } else {
                if ($today == $eleven) {
                    $isOfferActive         = 1;
                    $product_main_price    = $price;
                    $product_discount_name = "11 % Off";
                    $discount_price        = $price * (11 / 100);
                    $discounted_price      = ($price - $discount_price);
                }
            }

        } else {
            $discounted_price      = 0;
            $product_main_price    = 0;
            $discount_price        = 0;
            $product_discount_name = 0;
            $isOfferActive         = 0;
            $val_price             = $price;

            $val_price     = $price;
            $val_old_price = 0;
            $sku           = $sku;
        }
        $discounted_price = intval($discounted_price);
        return ['price' => $val_price, 'sku' => $sku, 'product_main_price' => $val_old_price, 'discount_price' => $discount_price, 'discounted_price' => $discounted_price, 'product_discount_name' => $product_discount_name, 'isOfferActive' => $isOfferActive];

    }
}
