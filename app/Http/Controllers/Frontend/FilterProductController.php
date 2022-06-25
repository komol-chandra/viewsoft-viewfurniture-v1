<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class FilterProductController extends Controller
{
    public function productData()
    {
        return Product::isDeleted()->isActive()->isApprove()->select(['id', 'shop_id', 'product_name', 'product_slug', 'product_qty', 'product_sku', 'sell_qty', 'product_size', 'product_weight', 'product_price', 'have_a_discount', 'offer', 'discount_price', 'discounted_price', 'discount_percent', 'discount_price_type', 'discount_condition', 'from_date', 'to_date', 'offer_stock_type', 'offer_qty', 'checkout_offer_qty', 'image', 'product_condition']);
    }

    public function filterShop(Request $request)
    {
        $products = $this->productData();
        if ($request->category == null && $request->brand == null && $request->price == null && $request->sortingval == null) {
            $products = $products;
        }
        if ($request->category != null) {
            $products = $products->whereIn('category_id', $request->category);
        }
        if ($request->brand != null) {
            $products = $products->whereIn('brand_id', $request->brand);
        }
        if ($request->brand != null && $request->category != null) {
            $products = $products->whereIn('category_id', $request->category)->whereIn('brand_id', $request->brand);
        }

        if ($request->price != null) {
            $priceVal = implode(',', $request->price);
            if ($priceVal == 1) {
                $products = $products->where('product_price', '>', '1')->where('product_price', '<=', '100');
            } elseif ($priceVal == 2) {
                $products = $products->where('product_price', '>', '101')->where('product_price', '<=', '500');
            } elseif ($priceVal == 3) {
                $products = $products->where('product_price', '>', '501')->where('product_price', '<=', '1000');
            } elseif ($priceVal == 4) {
                $products = $products->where('product_price', '>', '1001')->where('product_price', '<=', '10000');
            }
        }
        // if (isset($request["sortingval"])) {
        if ($request->sortingval != null) {
            // $sortVal = implode(',', $request->sortingval);
            if ($request->sortingval == 1) {
                $products = $products->orderBy('product_price', 'ASC');
            } elseif ($request->sortingval == 2) {
                $products = $products->orderBy('product_price', 'DESC');
            } elseif ($request->sortingval == 3) {
                $products = $products->orderBy('product_name', 'ASC');
            }
        }
        if ($request->brand != null && $request->category != null) {
            $products = $products->whereIn('category_id', $request->category)->whereIn('brand_id', $request->brand);
        }
        if ($request->category && $request->sortingval != null) {
            // $sortVal = implode(',', $request->sortingval);
            $sortVal = $request->sortingval;
            if ($sortVal == 1) {
                $products = $products->whereIn('category_id', $request->category)->orderBy('product_price', 'ASC');
            } elseif ($sortVal == 2) {
                $products = $products->whereIn('category_id', $request->category)->orderBy('product_price', 'DESC');
            } elseif ($sortVal == 3) {
                $products = $products->whereIn('category_id', $request->category)->orderBy('product_name', 'ASC');
            }
        }
        if ($request->category != null && $request->brand != null && $request->sortingval != null) {
            // $sortVal = implode(',', $request->sortingval);
            $sortVal = $request->sortingval;
            if ($sortVal == 1) {
                $products = $products->whereIn('brand_id', $request->brand)->whereIn('category_id', $request->category)->orderBy('product_price', 'ASC');
            } elseif ($sortVal == 2) {
                $products = $products->whereIn('brand_id', $request->brand)->whereIn('category_id', $request->category)->orderBy('product_price', 'DESC');
            } elseif ($sortVal == 3) {
                $products = $products->whereIn('brand_id', $request->brand)->whereIn('category_id', $request->category)->orderBy('product_name', 'ASC');
            }
        }
        $products = $products->get();
        // dd($products);
        return view('frontend.components.filter.filter', compact('products'));
    }

    public function filterShopWise(Request $request)
    {
        // dd($request->all());
        $products = $this->productData();
        if ($request->shop == null && $request->category == null && $request->brand == null && $request->price == null && $request->sortingval == null) {
            $products = $products;
        }
        if ($request->shop != null) {
            $products = $products->whereIn('shop_id', $request->shop);
        }
        if ($request->category != null) {
            $products = $products->whereIn('category_id', $request->category);
        }
        if ($request->brand != null) {
            $products = $products->whereIn('brand_id', $request->brand);
        }
        if ($request->brand != null && $request->category != null) {
            $products = $products->whereIn('category_id', $request->category)->whereIn('brand_id', $request->brand);
        }

        if ($request->price == null) {
            // $priceVal = implode(',', $request->price);
            $priceVal = $request->price;
            if ($priceVal == 1) {
                $products = $products->where('product_price', '>', '1')->where('product_price', '<=', '100');
            } elseif ($priceVal == 2) {
                $products = $products->where('product_price', '>', '101')->where('product_price', '<=', '500');
            } elseif ($priceVal == 3) {
                $products = $products->where('product_price', '>', '501')->where('product_price', '<=', '1000');
            } elseif ($priceVal == 4) {
                $products = $products->where('product_price', '>', '1001')->where('product_price', '<=', '10000');
            }
        }
        if ($request->sortingval != null) {
            // $sortVal = implode(',', $request->sortingval);
            $sortVal = $request->sortingval;
            if ($sortVal == 1) {
                $products = $products->orderBy('product_price', 'ASC');
            } elseif ($sortVal == 2) {
                $products = $products->orderBy('product_price', 'DESC');
            } elseif ($sortVal == 3) {
                $products = $products->orderBy('product_name', 'ASC');
            }
        }
        if ($request->brand != null && $request->category != null) {
            $products = $products->whereIn('category_id', $request->category)->whereIn('brand_id', $request->brand);
        }
        if ($request->category != null && $request->sortingval != null) {
            // $sortVal = implode(',', $request->sortingval);
            $sortVal = $request->sortingval;
            if ($sortVal == 1) {
                $products = $products->whereIn('category_id', $request->category)->orderBy('product_price', 'ASC');
            } elseif ($sortVal == 2) {
                $products = $products->whereIn('category_id', $request->category)->orderBy('product_price', 'DESC');
            } elseif ($sortVal == 3) {
                $products = $products->whereIn('category_id', $request->category)->orderBy('product_name', 'ASC');
            }
        }
        if ($request->category != null && $request->brand != null && $request->sortingval != null) {
            // $sortVal = implode(',', $request->sortingval);
            $sortVal = $request->sortingval;
            if ($sortVal == 1) {
                $products = $products->whereIn('brand_id', $request->brand)->whereIn('category_id', $request->category)->orderBy('product_price', 'ASC');
            } elseif ($sortVal == 2) {
                $products = $products->whereIn('brand_id', $request->brand)->whereIn('category_id', $request->category)->orderBy('product_price', 'DESC');
            } elseif ($sortVal == 3) {
                $products = $products->whereIn('brand_id', $request->brand)->whereIn('category_id', $request->category)->orderBy('product_name', 'ASC');
            }
        }
        $products = $products->get();
        // dd($products);
        return view('frontend.components.filter.filter', compact('products'));
    }

    public function filterCategoryShop(Request $request)
    {
        // dd($request->category);
        $products = $this->productData()->where('category_id', $request->category);
        if ($request->subcategory == null && $request->brand == null && $request->price == null && $request->sortingval == null) {
            $products = $products;
        }
        if ($request->subcategory != null) {
            $products = $products->whereIn('subcategory_id', $request->subcategory);
        }
        if ($request->brand != null) {
            $products = $products->whereIn('brand_id', $request->brand);
        }
        if ($request->price != null) {
            // $priceVal = implode(',', $request->price);
            $priceVal = $request->price;

            if ($priceVal == 1) {
                $products = $products->where('product_price', '>', '1')->where('product_price', '<=', '100');
            } elseif ($priceVal == 2) {
                $products = $products->where('product_price', '>', '101')->where('product_price', '<=', '500');
            } elseif ($priceVal == 3) {
                $products = $products->where('product_price', '>', '501')->where('product_price', '<=', '1000');
            } elseif ($priceVal == 4) {
                $products = $products->where('product_price', '>', '1001')->where('product_price', '<=', '10000');
            }
        }
        if ($request->sortingval != null) {
            // $sortVal = implode(',', $request->sortingval);
            $sortVal = $request->sortingval;
            if ($sortVal == 1) {
                $products = $products->orderBy('product_price', 'ASC');
            } elseif ($sortVal == 2) {
                $products = $products->orderBy('product_price', 'DESC');
            } elseif ($sortVal == 3) {
                $products = $products->orderBy('product_name', 'ASC');
            }
        }
        if ($request->subcategory != null && $request->brand != null) {
            $products = $products->whereIn('subcategory_id', $request->subcategory)->whereIn('brand_id', $request->brand);
        }
        if (isset($request["subcategory"]) && $request->sortingval != null) {
            $sortVal = implode(',', $request->sortingval);
            if ($sortVal == 1) {
                $products = $products->whereIn('subcategory_id', $request->subcategory)->orderBy('product_price', 'ASC');
            } elseif ($sortVal == 2) {
                $products = $products->whereIn('subcategory_id', $request->subcategory)->orderBy('product_price', 'DESC');
            } elseif ($sortVal == 3) {
                $products = $products->whereIn('subcategory_id', $request->subcategory)->orderBy('product_name', 'ASC');
            }
        }
        if (isset($request["subcategory"]) && isset($request["brand"]) && isset($request["sortingval"])) {
            $sortVal = implode(',', $request->sortingval);
            if ($sortVal == 1) {
                $products = $products->whereIn('brand_id', $request->brand)->whereIn('subcategory_id', $request->subcategory)->orderBy('product_price', 'ASC');
            } elseif ($sortVal == 2) {
                $products = $products->whereIn('brand_id', $request->brand)->whereIn('subcategory_id', $request->subcategory)->orderBy('product_price', 'DESC');
            } elseif ($sortVal == 3) {
                $products = $products->whereIn('subcategory_id', $request->subcategory)->whereIn('brand_id', $request->brand)->orderBy('product_name', 'ASC');
            }
        }
        $products = $products->get();
        // dd($products);
        return view('frontend.components.filter.filter', compact('products'));
    }

    public function filterSubCategoryShop(Request $request)
    {
        $products = $this->productData()->where('subcategory_id', $request->sub_category);
        if ($request->sub_category == null && $request->brand == null && $request->price == null && $request->sortingval == null) {
            $products = $products;
        }
        if (isset($request["re_sub_category"])) {
            $products = $products->whereIn('resubcategory_id', $request->re_sub_category);
        }
        if (isset($request["brand"])) {
            $products = $products->whereIn('brand_id', $request->brand);
        }
        if (isset($request["brand"]) && isset($request["re_sub_category"])) {
            $products = $products->whereIn('resubcategory_id', $request->re_sub_category)->whereIn('brand_id', $request->brand);
        }
        if (isset($request["price"])) {
            $priceVal = implode(',', $request->price);
            if ($priceVal == 1) {
                $products = $products->where('product_price', '>', '1')->where('product_price', '<=', '100');
            } elseif ($priceVal == 2) {
                $products = $products->where('product_price', '>', '101')->where('product_price', '<=', '500');
            } elseif ($priceVal == 3) {
                $products = $products->where('product_price', '>', '501')->where('product_price', '<=', '1000');
            } elseif ($priceVal == 4) {
                $products = $products->where('product_price', '>', '1001')->where('product_price', '<=', '10000');
            }
        }
        if (isset($request["sortingval"])) {
            $sortVal = implode(',', $request->sortingval);
            if ($sortVal == 1) {
                $products = $products->orderBy('product_price', 'ASC');
            } elseif ($sortVal == 2) {
                $products = $products->orderBy('product_price', 'DESC');
            } elseif ($sortVal == 3) {
                $products = $products->orderBy('product_name', 'ASC');
            }
        }
        if (isset($request["brand"]) && isset($request["re_sub_category"])) {
            $products = $products->whereIn('resubcategory_id', $request->re_sub_category)->whereIn('brand_id', $request->brand);
        }
        if (isset($request["re_sub_category"]) && isset($request["sortingval"])) {
            $sortVal = implode(',', $request->sortingval);
            if ($sortVal == 1) {
                $products = $products->whereIn('resubcategory_id', $request->re_sub_category)->orderBy('product_price', 'ASC');
            } elseif ($sortVal == 2) {
                $products = $products->whereIn('resubcategory_id', $request->re_sub_category)->orderBy('product_price', 'DESC');
            } elseif ($sortVal == 3) {
                $products = $products->whereIn('resubcategory_id', $request->re_sub_category)->orderBy('product_name', 'ASC');
            }
        }
        if (isset($request["re_sub_category"]) && isset($request["brand"]) && isset($request["sortingval"])) {
            $sortVal = implode(',', $request->sortingval);
            if ($sortVal == 1) {
                $products = $products->whereIn('brand_id', $request->brand)->whereIn('resubcategory_id', $request->re_sub_category)->orderBy('product_price', 'ASC');
            } elseif ($sortVal == 2) {
                $products = $products->whereIn('brand_id', $request->brand)->whereIn('resubcategory_id', $request->re_sub_category)->orderBy('product_price', 'DESC');
            } elseif ($sortVal == 3) {
                $products = $products->whereIn('resubcategory_id', $request->re_sub_category)->whereIn('brand_id', $request->brand)->orderBy('product_name', 'ASC');
            }
        }
        $products = $products->get();
        return view('frontend.components.filter.filter', compact('products'));
    }

    public function getUser()
    {
        dd(Admin::all());
    }

    public function filterReSubCategoryShop(Request $request)
    {
        $products = $this->productData()->where('resubcategory_id', $request->re_sub_category);
        if ($request->re_re_sub_category == null && $request->brand == null && $request->price == null && $request->sortingval == null) {
            $products = $products;
        }
        if (isset($request["re_re_sub_category"])) {
            $products = $products->whereIn('child_resubcategory', $request->re_re_sub_category)->paginate();
        }
        if (isset($request["brand"])) {
            $products = $products->whereIn('brand_id', $request->brand);
        }

        if (isset($request["price"])) {
            $priceVal = implode(',', $request->price);
            if ($priceVal == 1) {
                $products = $products->where('product_price', '>', '1')->where('product_price', '<=', '100');
            } elseif ($priceVal == 2) {
                $products = $products->where('product_price', '>', '101')->where('product_price', '<=', '500');
            } elseif ($priceVal == 3) {
                $products = $products->where('product_price', '>', '501')->where('product_price', '<=', '1000');
            } elseif ($priceVal == 4) {
                $products = $products->where('product_price', '>', '1001')->where('product_price', '<=', '10000');
            }
        }
        if (isset($request["sortingval"])) {
            $sortVal = implode(',', $request->sortingval);
            if ($sortVal == 1) {
                $products = $products->orderBy('product_price', 'ASC');
            } elseif ($sortVal == 2) {
                $products = $products->orderBy('product_price', 'DESC');
            } elseif ($sortVal == 3) {
                $products = $products->orderBy('product_name', 'ASC');
            }
        }
        if (isset($request["brand"]) && isset($request["re_re_sub_category"])) {
            $products = $products->whereIn('child_resubcategory', $request->re_re_sub_category)->whereIn('brand_id', $request->brand);
        }

        if (isset($request["re_re_sub_category"]) && isset($request["sortingval"])) {
            $sortVal = implode(',', $request->sortingval);
            if ($sortVal == 1) {
                $products = $products->whereIn('child_resubcategory', $request->re_re_sub_category)->orderBy('product_price', 'ASC');
            } elseif ($sortVal == 2) {
                $products = $products->whereIn('child_resubcategory', $request->re_re_sub_category)->orderBy('product_price', 'DESC');
            } elseif ($sortVal == 3) {
                $products = $products->whereIn('child_resubcategory', $request->re_re_sub_category)->orderBy('product_name', 'ASC');
            }
        }
        if (isset($request["re_re_sub_category"]) && isset($request["brand"]) && isset($request["sortingval"])) {
            $sortVal = implode(',', $request->sortingval);
            if ($sortVal == 1) {
                $products = $products->whereIn('brand_id', $request->brand)->whereIn('child_resubcategory', $request->re_re_sub_category)->orderBy('product_price', 'ASC');
            } elseif ($sortVal == 2) {
                $products = $products->whereIn('brand_id', $request->brand)->whereIn('child_resubcategory', $request->re_re_sub_category)->orderBy('product_price', 'DESC');
            } elseif ($sortVal == 3) {
                $products = $products->whereIn('child_resubcategory', $request->re_re_sub_category)->whereIn('brand_id', $request->brand)->orderBy('product_name', 'ASC');
            }
        }
        $products = $products->get();
        return view('frontend.components.filter.filter', compact('products'));
    }

    public function filter11OfferShop(Request $request)
    {
        $products = $this->productData()->haveDiscount()->offer11();
        if ($request->category == null && $request->brand == null && $request->price == null && $request->sortingval == null) {
            $products = $products;
        }
        if (isset($request["category"])) {
            $products = $products->whereIn('category_id', $request->category);
        }
        if (isset($request["brand"])) {
            $products = $products->whereIn('brand_id', $request->brand);
        }
        if (isset($request["brand"]) && isset($request["category"])) {
            $products = $products->whereIn('category_id', $request->category)->whereIn('brand_id', $request->brand);
        }

        if (isset($request["price"])) {
            $priceVal = implode(',', $request->price);

            if ($priceVal == 1) {
                $products = $products->where('product_price', '>', '1')->where('product_price', '<=', '100');
            } elseif ($priceVal == 2) {
                $products = $products->where('product_price', '>', '101')->where('product_price', '<=', '500');
            } elseif ($priceVal == 3) {
                $products = $products->where('product_price', '>', '501')->where('product_price', '<=', '1000');
            } elseif ($priceVal == 4) {
                $products = $products->where('product_price', '>', '1001')->where('product_price', '<=', '10000');
            }
        }
        if (isset($request["sortingval"])) {
            $sortVal = implode(',', $request->sortingval);
            if ($sortVal == 1) {
                $products = $products->orderBy('product_price', 'ASC');
            } elseif ($sortVal == 2) {
                $products = $products->orderBy('product_price', 'DESC');
            } elseif ($sortVal == 3) {
                $products = $products->orderBy('product_name', 'ASC');
            }
        }
        if (isset($request["brand"]) && isset($request["category"])) {
            $products = $products->whereIn('category_id', $request->category)->whereIn('brand_id', $request->brand);
        }
        if (isset($request["category"]) && isset($request["sortingval"])) {
            $sortVal = implode(',', $request->sortingval);
            if ($sortVal == 1) {
                $products = $products->whereIn('category_id', $request->category)->orderBy('product_price', 'ASC');
            } elseif ($sortVal == 2) {
                $products = $products->whereIn('category_id', $request->category)->orderBy('product_price', 'DESC');
            } elseif ($sortVal == 3) {
                $products = $products->whereIn('category_id', $request->category)->orderBy('product_name', 'ASC');
            }
        }
        if (isset($request["category"]) && isset($request["brand"]) && isset($request["sortingval"])) {
            $sortVal = implode(',', $request->sortingval);
            if ($sortVal == 1) {
                $products = $products->whereIn('brand_id', $request->brand)->whereIn('category_id', $request->category)->orderBy('product_price', 'ASC');
            } elseif ($sortVal == 2) {
                $products = $products->whereIn('brand_id', $request->brand)->whereIn('category_id', $request->category)->orderBy('product_price', 'DESC');
            } elseif ($sortVal == 3) {
                $products = $products->whereIn('brand_id', $request->brand)->whereIn('category_id', $request->category)->orderBy('product_name', 'ASC');
            }
        }
        $products = $products->get();
        return view('frontend.components.filter.filter', compact('products'));
    }

    public function dd()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('admins');
    }

    public function filter22OfferShop(Request $request)
    {
        // dd($request->all());
        $products = $this->productData()->haveDiscount()->offer22();
        if ($request->category == null && $request->brand == null && $request->price == null && $request->sortingval == null) {
            $products = $products;
        }
        if (isset($request["category"])) {
            $products = $products->whereIn('category_id', $request->category);
        }
        if (isset($request["brand"])) {
            $products = $products->whereIn('brand_id', $request->brand);
        }
        if (isset($request["brand"]) && isset($request["category"])) {
            $products = $products->whereIn('category_id', $request->category)->whereIn('brand_id', $request->brand);
        }

        if (isset($request["price"])) {
            $priceVal = implode(',', $request->price);

            if ($priceVal == 1) {
                $products = $products->where('product_price', '>', '1')->where('product_price', '<=', '100');
            } elseif ($priceVal == 2) {
                $products = $products->where('product_price', '>', '101')->where('product_price', '<=', '500');
            } elseif ($priceVal == 3) {
                $products = $products->where('product_price', '>', '501')->where('product_price', '<=', '1000');
            } elseif ($priceVal == 4) {
                $products = $products->where('product_price', '>', '1001')->where('product_price', '<=', '10000');
            }
        }
        if (isset($request["sortingval"])) {
            $sortVal = implode(',', $request->sortingval);
            if ($sortVal == 1) {
                $products = $products->orderBy('product_price', 'ASC');
            } elseif ($sortVal == 2) {
                $products = $products->orderBy('product_price', 'DESC');
            } elseif ($sortVal == 3) {
                $products = $products->orderBy('product_name', 'ASC');
            }
        }
        if (isset($request["brand"]) && isset($request["category"])) {
            $products = $products->whereIn('category_id', $request->category)->whereIn('brand_id', $request->brand);
        }
        if (isset($request["category"]) && isset($request["sortingval"])) {
            $sortVal = implode(',', $request->sortingval);
            if ($sortVal == 1) {
                $products = $products->whereIn('category_id', $request->category)->orderBy('product_price', 'ASC');
            } elseif ($sortVal == 2) {
                $products = $products->whereIn('category_id', $request->category)->orderBy('product_price', 'DESC');
            } elseif ($sortVal == 3) {
                $products = $products->whereIn('category_id', $request->category)->orderBy('product_name', 'ASC');
            }
        }
        if (isset($request["category"]) && isset($request["brand"]) && isset($request["sortingval"])) {
            $sortVal = implode(',', $request->sortingval);
            if ($sortVal == 1) {
                $products = $products->whereIn('brand_id', $request->brand)->whereIn('category_id', $request->category)->orderBy('product_price', 'ASC');
            } elseif ($sortVal == 2) {
                $products = $products->whereIn('brand_id', $request->brand)->whereIn('category_id', $request->category)->orderBy('product_price', 'DESC');
            } elseif ($sortVal == 3) {
                $products = $products->whereIn('brand_id', $request->brand)->whereIn('category_id', $request->category)->orderBy('product_name', 'ASC');
            }
        }
        $products = $products->get();
        return view('frontend.components.filter.filter', compact('products'));
    }

    public function filterSpecialOfferShop(Request $request)
    {
        $products = $this->productData()->haveDiscount()->specialOffer();
        if ($request->category == null && $request->brand == null && $request->price == null && $request->sortingval == null) {
            $products = $products;
        }
        if (isset($request["category"])) {
            $products = $products->whereIn('category_id', $request->category);
        }
        if (isset($request["brand"])) {
            $products = $products->whereIn('brand_id', $request->brand);
        }
        if (isset($request["brand"]) && isset($request["category"])) {
            $products = $products->whereIn('category_id', $request->category)->whereIn('brand_id', $request->brand);
        }

        if (isset($request["price"])) {
            $priceVal = implode(',', $request->price);

            if ($priceVal == 1) {
                $products = $products->where('product_price', '>', '1')->where('product_price', '<=', '100');
            } elseif ($priceVal == 2) {
                $products = $products->where('product_price', '>', '101')->where('product_price', '<=', '500');
            } elseif ($priceVal == 3) {
                $products = $products->where('product_price', '>', '501')->where('product_price', '<=', '1000');
            } elseif ($priceVal == 4) {
                $products = $products->where('product_price', '>', '1001')->where('product_price', '<=', '10000');
            }
        }
        if (isset($request["sortingval"])) {

            $sortVal = implode(',', $request->sortingval);
            if ($sortVal == 1) {
                $products = $products->orderBy('product_price', 'ASC');
            } elseif ($sortVal == 2) {
                $products = $products->orderBy('product_price', 'DESC');
            } elseif ($sortVal == 3) {
                $products = $products->orderBy('product_name', 'ASC');
            }
        }
        if (isset($request["brand"]) && isset($request["category"])) {
            $products = $products->whereIn('category_id', $request->category)->whereIn('brand_id', $request->brand);
        }
        if (isset($request["category"]) && isset($request["sortingval"])) {
            $sortVal = implode(',', $request->sortingval);
            if ($sortVal == 1) {
                $products = $products->whereIn('category_id', $request->category)->orderBy('product_price', 'ASC');
            } elseif ($sortVal == 2) {
                $products = $products->whereIn('category_id', $request->category)->orderBy('product_price', 'DESC');
            } elseif ($sortVal == 3) {
                $products = $products->whereIn('category_id', $request->category)->orderBy('product_name', 'ASC');
            }
        }
        if (isset($request["category"]) && isset($request["brand"]) && isset($request["sortingval"])) {
            $sortVal = implode(',', $request->sortingval);
            if ($sortVal == 1) {
                $products = $products->whereIn('brand_id', $request->brand)->whereIn('category_id', $request->category)->orderBy('product_price', 'ASC');
            } elseif ($sortVal == 2) {
                $products = $products->whereIn('brand_id', $request->brand)->whereIn('category_id', $request->category)->orderBy('product_price', 'DESC');
            } elseif ($sortVal == 3) {
                $products = $products->whereIn('brand_id', $request->brand)->whereIn('category_id', $request->category)->orderBy('product_name', 'ASC');
            }
        }
        $products = $products->get();
        return view('frontend.components.filter.filter', compact('products'));
    }
}
