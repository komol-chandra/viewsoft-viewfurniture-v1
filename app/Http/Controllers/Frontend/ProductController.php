<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\Shop;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function sku_combination_edit(Request $request)
    {

        $product = Product::findOrFail($request->id);
        $options = [];
        if ($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0) {
            $colors_active = 1;
            array_push($options, $request->colors);
        } else {
            $colors_active = 0;
        }

        $product_name = $request->product_name;
        $unit_price   = $request->unit_price;

        if ($request->has('choice_no')) {
            foreach ($request->choice_no as $key => $no) {
                $name   = 'choice_options_' . $no;
                $my_str = implode('|', $request[$name]);
                array_push($options, explode(',', $my_str));
            }
        }

        if ($request->has('colors_active') && $request->has('choice_no')) {
            $choice_count = count($request->choice_no);
            if ($choice_count == 0) {
                $combinations = Arr::crossJoin($options[0]);
                return view('frontend.vendor.product.sku_combinations_edit', compact('combinations', 'unit_price', 'colors_active', 'product_name', 'product'));
            } elseif ($choice_count == 1) {
                $combinations = Arr::crossJoin($options[0], $options[1]);
                return view('frontend.vendor.product.sku_combinations_edit', compact('combinations', 'unit_price', 'colors_active', 'product_name', 'product'));
            } elseif ($choice_count == 2) {
                $combinations = Arr::crossJoin($options[0], $options[1], $options[2]);
                return view('frontend.vendor.product.sku_combinations_edit', compact('combinations', 'unit_price', 'colors_active', 'product_name', 'product'));
            } elseif ($choice_count == 3) {
                $combinations = Arr::crossJoin($options[0], $options[1], $options[2], $options[3]);
                return view('frontend.vendor.product.sku_combinations_edit', compact('combinations', 'unit_price', 'colors_active', 'product_name', 'product'));
            } elseif ($choice_count == 4) {
                $combinations = Arr::crossJoin($options[0], $options[1], $options[2], $options[3], $options[4]);
                return view('frontend.vendor.product.sku_combinations_edit', compact('combinations', 'unit_price', 'colors_active', 'product_name', 'product'));
            } elseif ($choice_count == 5) {
                $combinations = Arr::crossJoin($options[0], $options[1], $options[2], $options[3], $options[4], $options[5]);
                return view('frontend.vendor.product.sku_combinations_edit', compact('combinations', 'unit_price', 'colors_active', 'product_name', 'product'));
            }
        } elseif ($request->has('colors_active')) {

            $combinations = Arr::crossJoin($options[0]);
            return view('frontend.vendor.product.sku_combinations_edit', compact('combinations', 'unit_price', 'colors_active', 'product_name', 'product'));
        } elseif ($request->has('choice_no')) {
            $choice_count = count($request->choice_no);
            if ($choice_count == 1) {
                $combinations = Arr::crossJoin($options[0]);
                return view('frontend.vendor.product.sku_combinations_edit', compact('combinations', 'unit_price', 'colors_active', 'product_name', 'product'));
            } elseif ($choice_count == 2) {
                $combinations = Arr::crossJoin($options[0], $options[1]);
                return view('frontend.vendor.product.sku_combinations_edit', compact('combinations', 'unit_price', 'colors_active', 'product_name', 'product'));
            } elseif ($choice_count == 3) {
                $combinations = Arr::crossJoin($options[0], $options[1], $options[2]);
                return view('frontend.vendor.product.sku_combinations_edit', compact('combinations', 'unit_price', 'colors_active', 'product_name', 'product'));
            } elseif ($choice_count == 4) {
                $combinations = Arr::crossJoin($options[0], $options[1], $options[2], $options[3]);
                return view('frontend.vendor.product.sku_combinations_edit', compact('combinations', 'unit_price', 'colors_active', 'product_name', 'product'));
            } elseif ($choice_count == 5) {
                $combinations = Arr::crossJoin($options[0], $options[1], $options[2], $options[3], $options[4]);
                return view('frontend.vendor.product.sku_combinations_edit', compact('combinations', 'unit_price', 'colors_active', 'product_name', 'product'));
            }
        }
    }
    public function create()
    {
        $allCategory = Category::isDeleted()->isActive()->select(['id', 'name'])->get();
        $allshop     = Shop::isUser()->isDeleted()->isActive()->isApprove()->select(['id', 'shop_name'])->get();
        $allbrand    = Brand::isDeleted()->isActive()->select(['id', 'name'])->get();
        $allcolor    = Color::isDeleted()->isActive()->select(['id', 'color_name', 'color_code'])->get();
        return view('frontend.vendor.product.create', compact('allCategory', 'allshop', 'allbrand', 'allcolor'));
    }
    public function editproduct($id)
    {
        $edit        = Product::isUser()->where('id', $id)->first();
        $allCategory = Category::isDeleted()->isActive()->select(['id', 'name'])->get();
        $allshop     = Shop::isUser()->isActive()->isDeleted()->select(['id', 'shop_name'])->get();
        $allbrand    = Brand::isActive()->isDeleted()->select(['id', 'name'])->get();
        $allcolor    = Color::isActive()->isDeleted()->select(['id', 'color_name', 'color_code'])->get();

        return view('frontend.vendor.product.update', compact('edit', 'allCategory', 'allshop', 'allbrand', 'allcolor'));
    }
    // product index
    public function index(Request $request)
    {
        $allCategory = Category::isDeleted()->isActive()->get();
        $allshop     = Shop::isUser()->isDeleted()->isActive()->isApprove()->get();
        $allbrand    = Brand::isDeleted()->isActive()->get();
        $allProduct  = Product::query()->with('Category')->isUser()->isDeleted()->select(['id', 'product_name', 'product_sku', 'image', 'product_price', 'category_id'])->orderBy('id', 'DESC');
        if ($request->t == "approve") {
            $allProduct  = $allProduct->isApprove()->get();
            $table_title = "Approve";
        } else if ($request->t == "un-approve") {
            $allProduct  = $allProduct->isNotApprove()->get();
            $table_title = "Un Approve";

        } else if ($request->t == "inactive") {
            $allProduct  = $allProduct->isApprove()->isNotActive()->get();
            $table_title = "Inactive";

        } else if ($request->t == "active") {
            $allProduct  = $allProduct->isApprove()->isActive()->get();
            $table_title = "Active";

        } else if ($request->t == "offer") {
            $table_title = "Have a Discount";

            $allProduct = $allProduct->isApprove()->haveDiscount()->get();
        } else {
            $allProduct  = $allProduct->get();
            $table_title = "All";

        }

        $countProducts           = Product::isUser()->isDeleted()->count();
        $countActiveProducts     = Product::isUser()->isDeleted()->isActive()->isApprove()->count();
        $countUnapprovedProducts = Product::isUser()->isDeleted()->isActive()->isNotApprove()->count();
        return view('frontend.vendor.product.index', compact('table_title', 'allCategory', 'allshop', 'allbrand', 'allProduct', 'countProducts', 'countActiveProducts', 'countUnapprovedProducts'));
    }
    //
    public function createstore(Request $request)
    {
        $validated = $request->validate([
            'product_name'          => 'required',
            'product_sku'           => 'required',
            'unit_price'            => 'required',
            'category'              => 'required',
            'product_qty'           => 'required',
            'product_upload_policy' => 'required',

        ]);
        // create slug
        $shop_id = Shop::where('user_id', Auth::user()->id)->select(['id', 'shop_name'])->first();
        $words   = explode(" ", $shop_id->shop_name);
        $acronym = "";

        foreach ($words as $w) {
            $acronym .= $w[0];
        }
        $sku = $acronym . rand(22, 876) . '-' . $request->product_sku;

        if ($request->hasFile('product_img')) {
            $image     = $request->file('product_img');
            $imageName = 'th' . '_' . time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(590, 668)->save('uploads/products/' . $imageName);
        }

        $photos = [];
        if ($request->hasFile('images')) {
            foreach ($request->images as $key => $photo) {
                $photoName    = uniqid() . "." . $photo->getClientOriginalExtension();
                $resizedPhoto = Image::make($photo)->save('uploads/products/' . $photoName);
                array_push($photos, $photoName);
            }
        }

        $insert = Product::insertGetId([
            'image'                       => $imageName,
            'gallary_image'               => json_encode($photos),
            'product_name'                => $request->product_name,
            'product_upload_policy'       => $request->product_upload_policy,
            'product_slug'                => preg_replace('/[^A-Za-z0-9-]+/', '-', $request->product_name),
            'product_sku'                 => $sku,
            'product_qty'                 => $request->product_qty,
            'product_price'               => $request->unit_price,
            'product_details'             => $request->product_details,
            'product_condition'           => $request->product_condition,
            'product_tags'                => $request->product_tag,

            'shop_id'                     => $request->product_shop,
            'user_id'                     => Auth::user()->id,
            'brand_id'                    => $request->product_brand,
            'category_id'                 => $request->category,
            'subcategory_id'              => $request->subcategory,
            'resubcategory_id'            => $request->resubcategory,
            'child_resubcategory'         => $request->child_resubcategory,
            'grand_childresubcategory_id' => $request->grand_childresubcategory_id,

            'finished_color_id'           => $request->finished_color_id,
            'decor_style'                 => $request->decor_style,
            'hight'                       => $request->hight,
            'width'                       => $request->width,
            'length'                      => $request->length,
            'depth'                       => $request->depth,

            'have_a_warranty'             => $request->have_a_warranty,
            'warranty_name'               => $request->warranty_name,
            'warranty_year'               => $request->warranty_year,

            'have_a_discount'             => $request->have_a_discount,
            'offer'                       => $request->offer,
            'discount_price'              => $request->discount_price,
            'discounted_price'            => null,
            'discount_price_type'         => $request->discount_price_type,
            'discount_percent'            => null,

            'from_date'                   => $request->from_date,
            'to_date'                     => $request->to_date,
            'offer_stock_type'            => $request->offer_stock_type,
            'offer_qty'                   => $request->offer_qty,
            'discount_condition'          => $request->discount_condition,
            'offer_stock_type'            => $request->offer_stock_type,
            'offer_qty'                   => $request->offer_qty,
            'created_at'                  => Carbon::now()->toDateTimeString(),

        ]);

        if ($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0) {
            $updatecolor = Product::where('id', $insert)->Update([
                'colors' => json_encode($request->colors),
            ]);

        } else {
            $colors      = [];
            $updatecolor = Product::where('id', $insert)->Update([
                'colors' => json_encode($colors),
            ]);

        }

        $choice_options = [];
        if ($request->has('choice')) {
            foreach ($request->choice_no as $key => $no) {
                $str             = 'choice_options_' . $no;
                $item['name']    = 'choice_' . $no;
                $item['title']   = $request->choice[$key];
                $item['options'] = explode(',', implode('|', $request[$str]));
                array_push($choice_options, $item);
            }
        }
        $updatechoiceoptions = Product::where('id', $insert)->Update([
            'choice_options' => json_encode($choice_options),
        ]);

        $options = [];
        if ($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0) {
            $colors_active = 1;
            array_push($options, $request->colors);
        }

        if ($request->has('choice_no')) {
            foreach ($request->choice_no as $key => $no) {
                $name   = 'choice_options_' . $no;
                $my_str = implode('|', $request[$name]);
                array_push($options, explode(',', $my_str));
            }
        }
        // combiation start...............................................................................................

        if ($request->has('colors_active') && $request->has('choice_no')) {
            $choice_count = count($request->choice_no);
            if ($choice_count == 0) {
                $combinations = Arr::crossJoin($options[0]);
                if (count($combinations[0]) > 0) {
                    foreach ($combinations as $key => $combination) {
                        $str = '';
                        foreach ($combination as $key => $item) {
                            if ($key > 0) {
                                $str .= '-' . str_replace(' ', '', $item);
                            } else {
                                if ($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0) {
                                    $color_name = \App\Models\Color::where('color_code', $item)->first()->color_name;
                                    $str .= $color_name;
                                } else {
                                    $str .= str_replace(' ', '', $item);
                                }
                            }
                        }
                        $item             = [];
                        $item['price']    = $request['price_' . str_replace('.', '_', $str)];
                        $item['sku']      = $request['sku_' . str_replace('.', '_', $str)];
                        $item['qty']      = $request['qty_' . str_replace('.', '_', $str)];
                        $variations[$str] = $item;
                    }
                }
            } elseif ($choice_count == 1) {
                $combinations = Arr::crossJoin($options[0], $options[1]);
                if (count($combinations[0]) > 0) {
                    foreach ($combinations as $key => $combination) {
                        $str = '';
                        foreach ($combination as $key => $item) {
                            if ($key > 0) {
                                $str .= '-' . str_replace(' ', '', $item);
                            } else {
                                if ($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0) {
                                    $color_name = \App\Models\Color::where('color_code', $item)->first()->color_name;
                                    $str .= $color_name;
                                } else {
                                    $str .= str_replace(' ', '', $item);
                                }
                            }
                        }
                        $item             = [];
                        $item['price']    = $request['price_' . str_replace('.', '_', $str)];
                        $item['sku']      = $request['sku_' . str_replace('.', '_', $str)];
                        $item['qty']      = $request['qty_' . str_replace('.', '_', $str)];
                        $variations[$str] = $item;
                    }
                }
            } elseif ($choice_count == 2) {
                $combinations = Arr::crossJoin($options[0], $options[1], $options[2]);
                if (count($combinations[0]) > 0) {
                    foreach ($combinations as $key => $combination) {
                        $str = '';
                        foreach ($combination as $key => $item) {
                            if ($key > 0) {
                                $str .= '-' . str_replace(' ', '', $item);
                            } else {
                                if ($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0) {
                                    $color_name = \App\Models\Color::where('color_code', $item)->first()->color_name;
                                    $str .= $color_name;
                                } else {
                                    $str .= str_replace(' ', '', $item);
                                }
                            }
                        }
                        $item             = [];
                        $item['price']    = $request['price_' . str_replace('.', '_', $str)];
                        $item['sku']      = $request['sku_' . str_replace('.', '_', $str)];
                        $item['qty']      = $request['qty_' . str_replace('.', '_', $str)];
                        $variations[$str] = $item;
                    }
                }
            } elseif ($choice_count == 3) {
                $combinations = Arr::crossJoin($options[0], $options[1], $options[2], $options[3]);
                if (count($combinations[0]) > 0) {
                    foreach ($combinations as $key => $combination) {
                        $str = '';
                        foreach ($combination as $key => $item) {
                            if ($key > 0) {
                                $str .= '-' . str_replace(' ', '', $item);
                            } else {
                                if ($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0) {
                                    $color_name = \App\Models\Color::where('color_code', $item)->first()->color_name;
                                    $str .= $color_name;
                                } else {
                                    $str .= str_replace(' ', '', $item);
                                }
                            }
                        }
                        $item             = [];
                        $item['price']    = $request['price_' . str_replace('.', '_', $str)];
                        $item['sku']      = $request['sku_' . str_replace('.', '_', $str)];
                        $item['qty']      = $request['qty_' . str_replace('.', '_', $str)];
                        $variations[$str] = $item;
                    }
                }
            } elseif ($choice_count == 4) {
                $combinations = Arr::crossJoin($options[0], $options[1], $options[2], $options[3], $options[4]);
                if (count($combinations[0]) > 0) {
                    foreach ($combinations as $key => $combination) {
                        $str = '';
                        foreach ($combination as $key => $item) {
                            if ($key > 0) {
                                $str .= '-' . str_replace(' ', '', $item);
                            } else {
                                if ($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0) {
                                    $color_name = \App\Models\Color::where('color_code', $item)->first()->color_name;
                                    $str .= $color_name;
                                } else {
                                    $str .= str_replace(' ', '', $item);
                                }
                            }
                        }
                        $item             = [];
                        $item['price']    = $request['price_' . str_replace('.', '_', $str)];
                        $item['sku']      = $request['sku_' . str_replace('.', '_', $str)];
                        $item['qty']      = $request['qty_' . str_replace('.', '_', $str)];
                        $variations[$str] = $item;
                    }
                }
            } elseif ($choice_count == 5) {
                $combinations = Arr::crossJoin($options[0], $options[1], $options[2], $options[3], $options[4], $options[5]);
                if (count($combinations[0]) > 0) {
                    foreach ($combinations as $key => $combination) {
                        $str = '';
                        foreach ($combination as $key => $item) {
                            if ($key > 0) {
                                $str .= '-' . str_replace(' ', '', $item);
                            } else {
                                if ($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0) {
                                    $color_name = \App\Models\Color::where('color_code', $item)->first()->color_name;
                                    $str .= $color_name;
                                } else {
                                    $str .= str_replace(' ', '', $item);
                                }
                            }
                        }
                        $item             = [];
                        $item['price']    = $request['price_' . str_replace('.', '_', $str)];
                        $item['sku']      = $request['sku_' . str_replace('.', '_', $str)];
                        $item['qty']      = $request['qty_' . str_replace('.', '_', $str)];
                        $variations[$str] = $item;
                    }
                }
            }
            $variationupdate = Product::where('id', $insert)->update([
                'variations' => json_encode($variations),
            ]);
            // $product->variations = json_encode($variations);
        } elseif ($request->has('colors_active')) {

            $combinations = Arr::crossJoin($options[0]);
            if (count($combinations[0]) > 0) {
                foreach ($combinations as $key => $combination) {
                    $str = '';
                    foreach ($combination as $key => $item) {
                        if ($key > 0) {
                            $str .= '-' . str_replace(' ', '', $item);
                        } else {
                            if ($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0) {
                                $color_name = \App\Models\Color::where('color_code', $item)->first()->color_name;
                                $str .= $color_name;
                            } else {
                                $str .= str_replace(' ', '', $item);
                            }
                        }
                    }
                    $item             = [];
                    $item['price']    = $request['price_' . str_replace('.', '_', $str)];
                    $item['sku']      = $request['sku_' . str_replace('.', '_', $str)];
                    $item['qty']      = $request['qty_' . str_replace('.', '_', $str)];
                    $variations[$str] = $item;
                }
            }
        } elseif ($request->has('choice_no')) {
            $choice_count = count($request->choice_no);
            if ($choice_count == 1) {
                $combinations = Arr::crossJoin($options[0]);
                if (count($combinations[0]) > 0) {
                    foreach ($combinations as $key => $combination) {
                        $str = '';
                        foreach ($combination as $key => $item) {
                            if ($key > 0) {
                                $str .= '-' . str_replace(' ', '', $item);
                            } else {
                                if ($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0) {
                                    $color_name = \App\Models\Color::where('color_code', $item)->first()->color_name;
                                    $str .= $color_name;
                                } else {
                                    $str .= str_replace(' ', '', $item);
                                }
                            }
                        }
                        $item             = [];
                        $item['price']    = $request['price_' . str_replace('.', '_', $str)];
                        $item['sku']      = $request['sku_' . str_replace('.', '_', $str)];
                        $item['qty']      = $request['qty_' . str_replace('.', '_', $str)];
                        $variations[$str] = $item;
                    }
                }
            } elseif ($choice_count == 2) {
                $combinations = Arr::crossJoin($options[0], $options[1]);
                if (count($combinations[0]) > 0) {
                    foreach ($combinations as $key => $combination) {
                        $str = '';
                        foreach ($combination as $key => $item) {
                            if ($key > 0) {
                                $str .= '-' . str_replace(' ', '', $item);
                            } else {
                                if ($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0) {
                                    $color_name = \App\Models\Color::where('color_code', $item)->first()->color_name;
                                    $str .= $color_name;
                                } else {
                                    $str .= str_replace(' ', '', $item);
                                }
                            }
                        }
                        $item             = [];
                        $item['price']    = $request['price_' . str_replace('.', '_', $str)];
                        $item['sku']      = $request['sku_' . str_replace('.', '_', $str)];
                        $item['qty']      = $request['qty_' . str_replace('.', '_', $str)];
                        $variations[$str] = $item;
                    }
                }
            } elseif ($choice_count == 3) {
                $combinations = Arr::crossJoin($options[0], $options[1], $options[2]);
                if (count($combinations[0]) > 0) {
                    foreach ($combinations as $key => $combination) {
                        $str = '';
                        foreach ($combination as $key => $item) {
                            if ($key > 0) {
                                $str .= '-' . str_replace(' ', '', $item);
                            } else {
                                if ($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0) {
                                    $color_name = \App\Models\Color::where('color_code', $item)->first()->color_name;
                                    $str .= $color_name;
                                } else {
                                    $str .= str_replace(' ', '', $item);
                                }
                            }
                        }
                        $item             = [];
                        $item['price']    = $request['price_' . str_replace('.', '_', $str)];
                        $item['sku']      = $request['sku_' . str_replace('.', '_', $str)];
                        $item['qty']      = $request['qty_' . str_replace('.', '_', $str)];
                        $variations[$str] = $item;
                    }
                }
            } elseif ($choice_count == 4) {
                $combinations = Arr::crossJoin($options[0], $options[1], $options[2], $options[3]);
                if (count($combinations[0]) > 0) {
                    foreach ($combinations as $key => $combination) {
                        $str = '';
                        foreach ($combination as $key => $item) {
                            if ($key > 0) {
                                $str .= '-' . str_replace(' ', '', $item);
                            } else {
                                if ($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0) {
                                    $color_name = \App\Models\Color::where('color_code', $item)->first()->color_name;
                                    $str .= $color_name;
                                } else {
                                    $str .= str_replace(' ', '', $item);
                                }
                            }
                        }
                        $item             = [];
                        $item['price']    = $request['price_' . str_replace('.', '_', $str)];
                        $item['sku']      = $request['sku_' . str_replace('.', '_', $str)];
                        $item['qty']      = $request['qty_' . str_replace('.', '_', $str)];
                        $variations[$str] = $item;
                    }
                }
            } elseif ($choice_count == 5) {
                $combinations = Arr::crossJoin($options[0], $options[1], $options[2], $options[3], $options[4]);
                if (count($combinations[0]) > 0) {
                    foreach ($combinations as $key => $combination) {
                        $str = '';
                        foreach ($combination as $key => $item) {
                            if ($key > 0) {
                                $str .= '-' . str_replace(' ', '', $item);
                            } else {
                                if ($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0) {
                                    $color_name = \App\Models\Color::where('color_code', $item)->first()->color_name;
                                    $str .= $color_name;
                                } else {
                                    $str .= str_replace(' ', '', $item);
                                }
                            }
                        }
                        $item             = [];
                        $item['price']    = $request['price_' . str_replace('.', '_', $str)];
                        $item['sku']      = $request['sku_' . str_replace('.', '_', $str)];
                        $item['qty']      = $request['qty_' . str_replace('.', '_', $str)];
                        $variations[$str] = $item;
                    }
                }
            }
            // $product->variations = json_encode($variations);
            $variationupdate = Product::where('id', $insert)->update([
                'variations' => json_encode($variations),
            ]);
        }

        // combination end ...............................................................................................
        // image section start.............................................................................

        if ($insert) {
            Alert::toast('Insert Success', 'success');
            return redirect()->back();
        } else {
            Alert::toast('Insert Faild!', 'error');
            return redirect()->back();
        }

    }

    public function edit($id)
    {

        $edit        = Product::where('id', $id)->first();
        $allCategory = Category::where('is_deleted', 0)->where('is_active', 1)->get();
        $allshop     = Shop::where('user_id', Auth::user()->id)->where('is_deleted', 0)->where('is_active', 1)->get();
        $allbrand    = Brand::where('is_deleted', 0)->where('is_active', 1)->get();
        return view('frontend.vendor.product.ajaxupdate', compact('allCategory', 'allshop', 'allbrand', 'edit'));
    }
    //
    public function update(Request $request)
    {

        $validated = $request->validate([
            'product_name' => 'required',
            'product_sku'  => 'required',
            'unit_price'   => 'required',
            'category'     => 'required',
            'product_qty'  => 'required',
        ]);
        //create sku
        $shop_id     = Shop::where('user_id', Auth::user()->id)->select(['id', 'shop_name'])->first();
        $product_sku = Product::where('id', $request->product_id)->select(['product_sku', 'image', 'gallary_image'])->first();

        if ($request->product_sku == $product_sku->product_sku) {
            $sku = $product_sku->product_sku;
        } else {
            $words   = explode(" ", $shop_id->shop_name);
            $acronym = "";

            foreach ($words as $w) {
                $acronym .= $w[0];
            }
            $sku = $acronym . rand(22, 876) . '-' . $request->product_sku;
        }

        // image section start.
        if ($request->hasFile('product_img')) {
            $image     = $request->file('product_img');
            $ImageName = 'th' . '_' . time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(590, 668)->save('uploads/products/' . $ImageName);
            $frontImage = $ImageName;
        } else {
            $frontImage = $product_sku->image;
        }
        if ($request->has('previous_photos')) {
            $photos = $request->previous_photos;
        } else {
            $photos = [];
        }
        if ($request->hasFile('images')) {
            foreach ($request->images as $key => $photo) {
                $photoName    = uniqid() . "." . $photo->getClientOriginalExtension();
                $resizedPhoto = Image::make($photo)->save('uploads/products/' . $photoName);
                array_push($photos, $photoName);
            }
        }

        // dd($frontImage);
        $insert = Product::where('id', $request->product_id)->update([
            'product_name'                => $request->product_name,
            'product_slug'                => preg_replace('/[^A-Za-z0-9-]+/', '-', $request->product_name),
            'product_sku'                 => $sku,
            'product_qty'                 => $request->product_qty,
            'product_price'               => $request->unit_price,
            'product_details'             => $request->product_details,
            'product_condition'           => $request->product_condition,
            'product_tags'                => $request->product_tag,
            'image'                       => $frontImage,
            'gallary_image'               => json_encode($photos),

            'brand_id'                    => $request->product_brand,
            'shop_id'                     => $request->product_shop,
            'user_id'                     => Auth::user()->id,
            'category_id'                 => $request->category,
            'subcategory_id'              => $request->subcategory,
            'resubcategory_id'            => $request->resubcategory,
            'child_resubcategory'         => $request->child_resubcategory,
            'grand_childresubcategory_id' => $request->grand_childresubcategory_id,

            'finished_color_id'           => $request->finished_color_id,
            'decor_style'                 => $request->decor_style,
            'hight'                       => $request->hight,
            'width'                       => $request->width,
            'length'                      => $request->length,
            'depth'                       => $request->depth,

            'have_a_warranty'             => $request->have_a_warranty,
            'warranty_name'               => $request->warranty_name,
            'warranty_year'               => $request->warranty_year,

            'have_a_discount'             => $request->have_a_discount,
            'offer'                       => $request->offer,
            'discount_price'              => $request->discount_price,
            'discounted_price'            => null,
            'discount_price_type'         => $request->discount_price_type,
            'discount_percent'            => null,

            'from_date'                   => $request->from_date,
            'to_date'                     => $request->to_date,
            'offer_stock_type'            => $request->offer_stock_type,
            'offer_qty'                   => $request->offer_qty,
            'discount_condition'          => $request->discount_condition,
            'offer_stock_type'            => $request->offer_stock_type,
            'offer_qty'                   => $request->offer_qty,
            'created_at'                  => Carbon::now()->toDateTimeString(),
        ]);

        if ($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0) {
            $updatecolor = Product::where('id', $request->product_id)->Update([
                'colors' => json_encode($request->colors),
            ]);

        } else {
            $colors      = [];
            $updatecolor = Product::where('id', $request->product_id)->Update([
                'colors' => json_encode($colors),
            ]);

        }

        $choice_options = [];
        if ($request->has('choice')) {
            foreach ($request->choice_no as $key => $no) {
                $str             = 'choice_options_' . $no;
                $item['name']    = 'choice_' . $no;
                $item['title']   = $request->choice[$key];
                $item['options'] = explode(',', implode('|', $request[$str]));
                array_push($choice_options, $item);
            }
        }
        $updatechoiceoptions = Product::where('id', $request->product_id)->Update([
            'choice_options' => json_encode($choice_options),
        ]);

        $options = [];
        if ($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0) {
            $colors_active = 1;
            array_push($options, $request->colors);
        }

        if ($request->has('choice_no')) {
            foreach ($request->choice_no as $key => $no) {
                $name   = 'choice_options_' . $no;
                $my_str = implode('|', $request[$name]);
                array_push($options, explode(',', $my_str));
            }
        }
        // combiation start...............................................................................................

        if ($request->has('colors_active') && $request->has('choice_no')) {
            $choice_count = count($request->choice_no);
            if ($choice_count == 0) {
                $combinations = Arr::crossJoin($options[0]);
                if (count($combinations[0]) > 0) {
                    foreach ($combinations as $key => $combination) {
                        $str = '';
                        foreach ($combination as $key => $item) {
                            if ($key > 0) {
                                $str .= '-' . str_replace(' ', '', $item);
                            } else {
                                if ($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0) {
                                    $color_name = \App\Models\Color::where('color_code', $item)->first()->color_name;
                                    $str .= $color_name;
                                } else {
                                    $str .= str_replace(' ', '', $item);
                                }
                            }
                        }
                        $item             = [];
                        $item['price']    = $request['price_' . str_replace('.', '_', $str)];
                        $item['sku']      = $request['sku_' . str_replace('.', '_', $str)];
                        $item['qty']      = $request['qty_' . str_replace('.', '_', $str)];
                        $variations[$str] = $item;
                    }
                }
            } elseif ($choice_count == 1) {
                $combinations = Arr::crossJoin($options[0], $options[1]);
                if (count($combinations[0]) > 0) {
                    foreach ($combinations as $key => $combination) {
                        $str = '';
                        foreach ($combination as $key => $item) {
                            if ($key > 0) {
                                $str .= '-' . str_replace(' ', '', $item);
                            } else {
                                if ($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0) {
                                    $color_name = \App\Models\Color::where('color_code', $item)->first()->color_name;
                                    $str .= $color_name;
                                } else {
                                    $str .= str_replace(' ', '', $item);
                                }
                            }
                        }
                        $item             = [];
                        $item['price']    = $request['price_' . str_replace('.', '_', $str)];
                        $item['sku']      = $request['sku_' . str_replace('.', '_', $str)];
                        $item['qty']      = $request['qty_' . str_replace('.', '_', $str)];
                        $variations[$str] = $item;
                    }
                }
            } elseif ($choice_count == 2) {
                $combinations = Arr::crossJoin($options[0], $options[1], $options[2]);
                if (count($combinations[0]) > 0) {
                    foreach ($combinations as $key => $combination) {
                        $str = '';
                        foreach ($combination as $key => $item) {
                            if ($key > 0) {
                                $str .= '-' . str_replace(' ', '', $item);
                            } else {
                                if ($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0) {
                                    $color_name = \App\Models\Color::where('color_code', $item)->first()->color_name;
                                    $str .= $color_name;
                                } else {
                                    $str .= str_replace(' ', '', $item);
                                }
                            }
                        }
                        $item             = [];
                        $item['price']    = $request['price_' . str_replace('.', '_', $str)];
                        $item['sku']      = $request['sku_' . str_replace('.', '_', $str)];
                        $item['qty']      = $request['qty_' . str_replace('.', '_', $str)];
                        $variations[$str] = $item;
                    }
                }
            } elseif ($choice_count == 3) {
                $combinations = Arr::crossJoin($options[0], $options[1], $options[2], $options[3]);
                if (count($combinations[0]) > 0) {
                    foreach ($combinations as $key => $combination) {
                        $str = '';
                        foreach ($combination as $key => $item) {
                            if ($key > 0) {
                                $str .= '-' . str_replace(' ', '', $item);
                            } else {
                                if ($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0) {
                                    $color_name = \App\Models\Color::where('color_code', $item)->first()->color_name;
                                    $str .= $color_name;
                                } else {
                                    $str .= str_replace(' ', '', $item);
                                }
                            }
                        }
                        $item             = [];
                        $item['price']    = $request['price_' . str_replace('.', '_', $str)];
                        $item['sku']      = $request['sku_' . str_replace('.', '_', $str)];
                        $item['qty']      = $request['qty_' . str_replace('.', '_', $str)];
                        $variations[$str] = $item;
                    }
                }
            } elseif ($choice_count == 4) {
                $combinations = Arr::crossJoin($options[0], $options[1], $options[2], $options[3], $options[4]);
                if (count($combinations[0]) > 0) {
                    foreach ($combinations as $key => $combination) {
                        $str = '';
                        foreach ($combination as $key => $item) {
                            if ($key > 0) {
                                $str .= '-' . str_replace(' ', '', $item);
                            } else {
                                if ($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0) {
                                    $color_name = \App\Models\Color::where('color_code', $item)->first()->color_name;
                                    $str .= $color_name;
                                } else {
                                    $str .= str_replace(' ', '', $item);
                                }
                            }
                        }
                        $item             = [];
                        $item['price']    = $request['price_' . str_replace('.', '_', $str)];
                        $item['sku']      = $request['sku_' . str_replace('.', '_', $str)];
                        $item['qty']      = $request['qty_' . str_replace('.', '_', $str)];
                        $variations[$str] = $item;
                    }
                }
            } elseif ($choice_count == 5) {
                $combinations = Arr::crossJoin($options[0], $options[1], $options[2], $options[3], $options[4], $options[5]);
                if (count($combinations[0]) > 0) {
                    foreach ($combinations as $key => $combination) {
                        $str = '';
                        foreach ($combination as $key => $item) {
                            if ($key > 0) {
                                $str .= '-' . str_replace(' ', '', $item);
                            } else {
                                if ($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0) {
                                    $color_name = \App\Models\Color::where('color_code', $item)->first()->color_name;
                                    $str .= $color_name;
                                } else {
                                    $str .= str_replace(' ', '', $item);
                                }
                            }
                        }
                        $item             = [];
                        $item['price']    = $request['price_' . str_replace('.', '_', $str)];
                        $item['sku']      = $request['sku_' . str_replace('.', '_', $str)];
                        $item['qty']      = $request['qty_' . str_replace('.', '_', $str)];
                        $variations[$str] = $item;
                    }
                }
            }
            $variationupdate = Product::where('id', $request->product_id)->update([
                'variations' => json_encode($variations),
            ]);
            // $product->variations = json_encode($variations);
        } elseif ($request->has('colors_active')) {

            $combinations = Arr::crossJoin($options[0]);
            if (count($combinations[0]) > 0) {
                foreach ($combinations as $key => $combination) {
                    $str = '';
                    foreach ($combination as $key => $item) {
                        if ($key > 0) {
                            $str .= '-' . str_replace(' ', '', $item);
                        } else {
                            if ($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0) {
                                $color_name = \App\Models\Color::where('color_code', $item)->first()->color_name;
                                $str .= $color_name;
                            } else {
                                $str .= str_replace(' ', '', $item);
                            }
                        }
                    }
                    $item             = [];
                    $item['price']    = $request['price_' . str_replace('.', '_', $str)];
                    $item['sku']      = $request['sku_' . str_replace('.', '_', $str)];
                    $item['qty']      = $request['qty_' . str_replace('.', '_', $str)];
                    $variations[$str] = $item;
                }
            }
        } elseif ($request->has('choice_no')) {
            $choice_count = count($request->choice_no);
            if ($choice_count == 1) {
                $combinations = Arr::crossJoin($options[0]);
                if (count($combinations[0]) > 0) {
                    foreach ($combinations as $key => $combination) {
                        $str = '';
                        foreach ($combination as $key => $item) {
                            if ($key > 0) {
                                $str .= '-' . str_replace(' ', '', $item);
                            } else {
                                if ($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0) {
                                    $color_name = \App\Models\Color::where('color_code', $item)->first()->color_name;
                                    $str .= $color_name;
                                } else {
                                    $str .= str_replace(' ', '', $item);
                                }
                            }
                        }
                        $item             = [];
                        $item['price']    = $request['price_' . str_replace('.', '_', $str)];
                        $item['sku']      = $request['sku_' . str_replace('.', '_', $str)];
                        $item['qty']      = $request['qty_' . str_replace('.', '_', $str)];
                        $variations[$str] = $item;
                    }
                }
            } elseif ($choice_count == 2) {
                $combinations = Arr::crossJoin($options[0], $options[1]);
                if (count($combinations[0]) > 0) {
                    foreach ($combinations as $key => $combination) {
                        $str = '';
                        foreach ($combination as $key => $item) {
                            if ($key > 0) {
                                $str .= '-' . str_replace(' ', '', $item);
                            } else {
                                if ($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0) {
                                    $color_name = \App\Models\Color::where('color_code', $item)->first()->color_name;
                                    $str .= $color_name;
                                } else {
                                    $str .= str_replace(' ', '', $item);
                                }
                            }
                        }
                        $item             = [];
                        $item['price']    = $request['price_' . str_replace('.', '_', $str)];
                        $item['sku']      = $request['sku_' . str_replace('.', '_', $str)];
                        $item['qty']      = $request['qty_' . str_replace('.', '_', $str)];
                        $variations[$str] = $item;
                    }
                }
            } elseif ($choice_count == 3) {
                $combinations = Arr::crossJoin($options[0], $options[1], $options[2]);
                if (count($combinations[0]) > 0) {
                    foreach ($combinations as $key => $combination) {
                        $str = '';
                        foreach ($combination as $key => $item) {
                            if ($key > 0) {
                                $str .= '-' . str_replace(' ', '', $item);
                            } else {
                                if ($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0) {
                                    $color_name = \App\Models\Color::where('color_code', $item)->first()->color_name;
                                    $str .= $color_name;
                                } else {
                                    $str .= str_replace(' ', '', $item);
                                }
                            }
                        }
                        $item             = [];
                        $item['price']    = $request['price_' . str_replace('.', '_', $str)];
                        $item['sku']      = $request['sku_' . str_replace('.', '_', $str)];
                        $item['qty']      = $request['qty_' . str_replace('.', '_', $str)];
                        $variations[$str] = $item;
                    }
                }
            } elseif ($choice_count == 4) {
                $combinations = Arr::crossJoin($options[0], $options[1], $options[2], $options[3]);
                if (count($combinations[0]) > 0) {
                    foreach ($combinations as $key => $combination) {
                        $str = '';
                        foreach ($combination as $key => $item) {
                            if ($key > 0) {
                                $str .= '-' . str_replace(' ', '', $item);
                            } else {
                                if ($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0) {
                                    $color_name = \App\Models\Color::where('color_code', $item)->first()->color_name;
                                    $str .= $color_name;
                                } else {
                                    $str .= str_replace(' ', '', $item);
                                }
                            }
                        }
                        $item             = [];
                        $item['price']    = $request['price_' . str_replace('.', '_', $str)];
                        $item['sku']      = $request['sku_' . str_replace('.', '_', $str)];
                        $item['qty']      = $request['qty_' . str_replace('.', '_', $str)];
                        $variations[$str] = $item;
                    }
                }
            } elseif ($choice_count == 5) {
                $combinations = Arr::crossJoin($options[0], $options[1], $options[2], $options[3], $options[4]);
                if (count($combinations[0]) > 0) {
                    foreach ($combinations as $key => $combination) {
                        $str = '';
                        foreach ($combination as $key => $item) {
                            if ($key > 0) {
                                $str .= '-' . str_replace(' ', '', $item);
                            } else {
                                if ($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0) {
                                    $color_name = \App\Models\Color::where('color_code', $item)->first()->color_name;
                                    $str .= $color_name;
                                } else {
                                    $str .= str_replace(' ', '', $item);
                                }
                            }
                        }
                        $item             = [];
                        $item['price']    = $request['price_' . str_replace('.', '_', $str)];
                        $item['sku']      = $request['sku_' . str_replace('.', '_', $str)];
                        $item['qty']      = $request['qty_' . str_replace('.', '_', $str)];
                        $variations[$str] = $item;
                    }
                }
            }
            // $product->variations = json_encode($variations);
            $variationupdate = Product::where('id', $request->product_id)->update([
                'variations' => json_encode($variations),
            ]);
        }

        // combination end ...............................................................................................

        if ($insert) {
            Alert::toast('Insert Success', 'success');
            return redirect()->back();
        } else {
            Alert::toast('Insert Faild!', 'error');
            return redirect()->back();
        }
    }

    public function delete($id)
    {
        $update = Product::where('id', $id)->update([
            'is_deleted' => 1,
        ]);
        if ($update) {
            Alert::toast('Delete Success', 'success');
            return redirect()->back();
        } else {
            Alert::toast('Delete Faild!', 'error');
            return redirect()->back();
        }

    }

    public function shopwiseproduct()
    {
        $allCategory = Category::where('is_deleted', 0)->where('is_active', 1)->get();
        $allshop     = Shop::where('user_id', Auth::user()->id)->where('is_deleted', 0)->where('is_active', 1)->get();
        $allbrand    = Brand::where('is_deleted', 0)->where('is_active', 1)->get();
        return view('frontend.vendor.product.shopwiseproduct', compact('allCategory', 'allshop', 'allbrand'));
    }

    public function getshopwiseproduct($id)
    {

        $allCategory = Category::where('is_deleted', 0)->where('is_active', 1)->get();
        $allshop     = Shop::where('user_id', Auth::user()->id)->where('is_deleted', 0)->where('is_active', 1)->get();
        $allbrand    = Brand::where('is_deleted', 0)->where('is_active', 1)->get();
        $allProduct  = Product::where('shop_id', $id)->where('user_id', Auth::user()->id)->where('is_deleted', 0)->select(['id', 'product_name', 'product_sku', 'image', 'product_price', 'category_id'])->with('Category')->orderBy('id', 'DESC')->get();
        return view('frontend.vendor.product.index', compact('allCategory', 'allshop', 'allbrand', 'allProduct'));
    }

    public function sku_combination(Request $request)
    {
        $options = [];
        if ($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0) {
            $colors_active = 1;
            array_push($options, $request->colors);
        } else {
            $colors_active = 0;
        }

        $unit_price   = $request->unit_price;
        $product_name = $request->product_name;

        if ($request->has('choice_no')) {
            foreach ($request->choice_no as $key => $no) {
                $name   = 'choice_options_' . $no;
                $my_str = implode('|', $request[$name]);
                array_push($options, explode(',', $my_str));
            }
        }
        if ($request->has('colors_active') && $request->has('choice_no')) {
            $choice_count = count($request->choice_no);
            if ($choice_count == 0) {
                $combinations = Arr::crossJoin($options[0]);
                return view('frontend.vendor.product.ajaxvariation', compact('combinations', 'unit_price', 'colors_active', 'product_name'));
            } elseif ($choice_count == 1) {
                $combinations = Arr::crossJoin($options[0], $options[1]);
                return view('frontend.vendor.product.ajaxvariation', compact('combinations', 'unit_price', 'colors_active', 'product_name'));
            } elseif ($choice_count == 2) {
                $combinations = Arr::crossJoin($options[0], $options[1], $options[2]);
                return view('frontend.vendor.product.ajaxvariation', compact('combinations', 'unit_price', 'colors_active', 'product_name'));
            } elseif ($choice_count == 3) {
                $combinations = Arr::crossJoin($options[0], $options[1], $options[2], $options[3]);
                return view('frontend.vendor.product.ajaxvariation', compact('combinations', 'unit_price', 'colors_active', 'product_name'));
            } elseif ($choice_count == 4) {
                $combinations = Arr::crossJoin($options[0], $options[1], $options[2], $options[3], $options[4]);
                return view('frontend.vendor.product.ajaxvariation', compact('combinations', 'unit_price', 'colors_active', 'product_name'));
            } elseif ($choice_count == 5) {
                $combinations = Arr::crossJoin($options[0], $options[1], $options[2], $options[3], $options[4], $options[5]);
                return view('frontend.vendor.product.ajaxvariation', compact('combinations', 'unit_price', 'colors_active', 'product_name'));
            }
        } elseif ($request->has('colors_active')) {

            $combinations = Arr::crossJoin($options[0]);
            return view('frontend.vendor.product.ajaxvariation', compact('combinations', 'unit_price', 'colors_active', 'product_name'));
        } elseif ($request->has('choice_no')) {
            $choice_count = count($request->choice_no);
            if ($choice_count == 1) {
                $combinations = Arr::crossJoin($options[0]);
                return view('frontend.vendor.product.ajaxvariation', compact('combinations', 'unit_price', 'colors_active', 'product_name'));
            } elseif ($choice_count == 2) {
                $combinations = Arr::crossJoin($options[0], $options[1]);
                return view('frontend.vendor.product.ajaxvariation', compact('combinations', 'unit_price', 'colors_active', 'product_name'));
            } elseif ($choice_count == 3) {
                $combinations = Arr::crossJoin($options[0], $options[1], $options[2]);
                return view('frontend.vendor.product.ajaxvariation', compact('combinations', 'unit_price', 'colors_active', 'product_name'));
            } elseif ($choice_count == 4) {
                $combinations = Arr::crossJoin($options[0], $options[1], $options[2], $options[3]);
                return view('frontend.vendor.product.ajaxvariation', compact('combinations', 'unit_price', 'colors_active', 'product_name'));
            } elseif ($choice_count == 5) {
                $combinations = Arr::crossJoin($options[0], $options[1], $options[2], $options[3], $options[4]);
                return view('frontend.vendor.product.ajaxvariation', compact('combinations', 'unit_price', 'colors_active', 'product_name'));
            }
        }
    }

}
