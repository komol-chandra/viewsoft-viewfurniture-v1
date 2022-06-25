<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ads;
use App\Models\Product;
use App\Models\ReReReSubCategory;
use App\Models\ReReSubCategory;
use App\Models\ResubCategory;
use App\Models\Shop;
use App\Models\ShopCategory;
use App\Models\SubCategory;
use App\Models\UserIp;
use Carbon\Carbon;
use Devfaysal\BangladeshGeocode\Models\District;

class ApiController extends Controller
{
    public function checkCookie($ip)
    {
        $today  = Carbon::now()->format('Y-m-d');
        $userIp = UserIp::where('user_ip', $ip)->where('date', $today)->first();
        if ($userIp == null) {
            $insert = UserIp::insertGetId([
                'user_ip'    => $ip,
                'date'       => $today,
                'created_at' => Carbon::now()->toDateTimeString(),
            ]);
        } else {
            $status = 200;
            return response()->json(null, $status);
        }
    }
    public function adsClick($id)
    {
        $ads              = Ads::where('id', $id)->first();
        $ads->click_count = $ads->click_count + 1;
        $ads->save();
        // Ads::where('id', $ads->id)->('click_count', 1);
    }
    // get subcategory
    public function getSubcategory($cate_id)
    {
        $allSubCategory = SubCategory::where('category', $cate_id)->where('is_deleted', 0)->where('is_active', 1)->select(['name', 'id'])->get();
        return response()->json($allSubCategory);
    }
    // get resubcate
    public function getReSubcategory($subcate_id)
    {
        $maindata = ReSubCategory::where('sub_category', $subcate_id)->where('is_deleted', 0)->where('is_active', 1)->select(['name', 'id'])->get();
        return response()->json($maindata);
    }
    // re re subcategory
    public function getReReSubcategory($resubcate_id)
    {

        $maindata = ReReSubCategory::where('re_sub_category', $resubcate_id)->where('is_deleted', 0)->where('is_active', 1)->select(['name', 'id'])->get();
        return response()->json($maindata);

    }
    // re re re subcategory
    public function getreReReSubcategory($resubcate_id)
    {
        $maindata = ReReReSubCategory::where('re_re_sub_category', $resubcate_id)->where('is_deleted', 0)->where('is_active', 1)->select(['name', 'id'])->get();
        return response()->json($maindata);
    }

    // get shop
    public function getShop($shop_id)
    {

        $data     = Shop::where('id', $shop_id)->select(['id', 'shopcategory_id'])->first();
        $maindata = ShopCategory::where('id', $data->shopcategory_id)->first();
        return response()->json($maindata);

    }

    // get product
    public function getProductdetails($id)
    {
        $product = Product::isDeleted()->isActive()->isApprove()->isID($id)->with('Category', 'SubCategory_id')->first();
        // dd($product->discount_price);
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
                    $discounted_price         = $product->product_price - $discount_price;
                    $product_discount_name    = $product->discount_price . "%";
                }
                if ($product->discount_price_type == "taka") {
                    $product_main_price    = $product->product_price;
                    $discount_percent      = ($product->discount_price * 100) / $product->product_price;
                    $discount_price        = $product->discount_price;
                    $discounted_price      = $product->product_price - $discount_price;
                    $product_discount_name = $product->discount_price . " taka";
                }
                // 22 offer
            } elseif ($product->offer == '22_offer') {
                if ($today == $twenty_two) {
                    $isOfferActive         = 1;
                    $product_main_price    = $product->product_price;
                    $product_discount_name = "22%";
                    $discount_price        = $product->product_price * (22 / 100);
                    $discounted_price      = $product->product_price - $discount_price;
                }
                // 11 offer
            } else {
                if ($today == $eleven) {
                    $isOfferActive         = 1;
                    $product_main_price    = $product->product_price;
                    $product_discount_name = "11 %";
                    $discount_price        = $product->product_price * (11 / 100);
                    $discounted_price      = $product->product_price - $discount_price;
                }
            }
        }

        return view('frontend.cart.ajaxmodal', compact('product', 'product_main_price', 'discount_price', 'discounted_price', 'product_discount_name', 'isOfferActive'));
    }

    // get product
    public function customChooseData($id)
    {
        $product = Product::isDeleted()->isActive()->isApprove()->isID($id)->with('Category', 'SubCategory_id')->first();
        return view('frontend.cart.ajaxCustomChoose', compact('product'));
    }

    public function getDistrict($division_id)
    {
        $data = District::where('division_id', $division_id)->get();
        return response()->json($data);
    }
}
