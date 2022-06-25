<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Shop;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class ApproveProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    // all approve product
    public function index()
    {
        $alldata = Product::where('is_deleted', 0)->where('is_active', 1)->where('is_approve', 0)->get();
        return view('backend.productApprove.index', compact('alldata'));
    }

    // all Reject product
    public function rejectproduct()
    {
        $alldata = Product::where('is_deleted', 0)->where('is_active', 1)->where('is_approve', 2)->get();
        return view('backend.productApprove.reject', compact('alldata'));
    }
    //
    public function approvedProduct()
    {
        $alldata = Product::where('is_deleted', 0)->where('is_approve', 1)->get();
        return view('backend.approved-products.index', compact('alldata'));
    }

    /**
     * edit
     * this method used to edit product info
     * @param  mixed $id
     * @return void
     */
    public function edit($id)
    {
        $edit        = Product::where('id', $id)->first();
        $allCategory = Category::where('is_deleted', 0)->where('is_active', 1)->get();
        $allshop     = Shop::where('user_id', $edit->user_id)->where('is_deleted', 0)->where('is_active', 1)->get();
        $allbrand    = Brand::where('is_deleted', 0)->where('is_active', 1)->get();
        return view('backend.product.index', compact('edit', 'allCategory', 'allshop', 'allbrand'));
    }

    /**
     * update
     * this method used for update product info
     * @param  mixed $request
     * @return void
     */

    public function update(Request $request)
    {
        $product = Product::where('id', $request->id)->first();
        $request->validate([
            'product_name'          => 'required',
            'product_price'         => 'required',
            'category'              => 'required',
            'product_qty'           => 'required',
            'product_upload_policy' => 'required',

        ]);
        // update  product image
        if ($request->hasFile('product_img')) {

            $image     = $request->file('product_img');
            $ImageName = 'th' . '_' . time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(590, 668)->save('uploads/products/' . $ImageName);
        } else {
            $ImageName = $product->image;
        }
        // upload gallary_image
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
        // update data
        $insert = Product::where('id', $request->id)->update([
            'product_name'           => $request->product_name,
            'product_slug'           => preg_replace('/[^A-Za-z0-9-]+/', '-', $request->product_name),
            'image'                  => $ImageName,
            'gallary_image'          => json_encode($photos),
            'product_qty'            => $request->product_qty,

            'shop_id'                => $request->product_shop,
            'user_id'                => $product->user_id,
            'category_id'            => $request->category,
            'subcategory_id'         => $request->subcategory,
            'resubcategory_id'       => $request->resubcategory,
            'brand_id'               => $request->product_brand,

            'product_price'          => $request->product_price,
            'product_details'        => $request->product_details,
            'product_condition'      => $request->product_condition,
            'product_tags'           => $request->tag,
            'style'                  => $request->style,
            'feature_product'        => $request->feature_product,
            'trending_product'       => $request->trending_product,
            'top_collection_product' => $request->top_collection_product,
            'have_a_discount'        => $request->have_a_discount,
            'offer'                  => $request->offer,
            'discount_price'         => $request->discount_price,
            'discount_price_type'    => $request->discount_price_type,
            'from_date'              => $request->from_date,
            'to_date'                => $request->to_date,
            'offer_stock_type'       => $request->offer_stock_type,
            'offer_qty'              => $request->offer_qty,
            'discount_condition'     => $request->discount_condition,
            'offer_stock_type'       => $request->offer_stock_type,
            'offer_qty'              => $request->offer_qty,
            'product_upload_policy'  => $request->product_upload_policy,
            'created_at'             => Carbon::now()->toDateTimeString(),
        ]);

        if ($insert) {
            $notification = [
                'messege'    => 'Insert success!',
                'alert-type' => 'success',
            ];
            return redirect()->back()->with($notification);
        } else {

            $notification = [
                'messege'    => 'Insert Faild!',
                'alert-type' => 'error',
            ];
            return redirect()->back()->with($notification);
        }
    }
    // approve
    public function approve($id)
    {
        $update = Product::where('id', $id)->update([
            'is_approve' => 1,
        ]);
        if ($update) {
            $notification = [
                'messege'    => 'Approve success!',
                'alert-type' => 'success',
            ];
            return redirect()->back()->with($notification);
        } else {
            $notification = [
                'messege'    => 'Approve Faild!',
                'alert-type' => 'error',
            ];
            return redirect()->back()->with($notification);
        }
    }
    public function reject($id)
    {

        $update = Product::where('id', $id)->update([
            'is_approve' => 2,
        ]);
        if ($update) {
            $notification = [
                'messege'    => 'Rejected!',
                'alert-type' => 'success',
            ];
            return redirect()->back()->with($notification);
        } else {
            $notification = [
                'messege'    => 'Rejected Faild!',
                'alert-type' => 'error',
            ];
            return redirect()->back()->with($notification);
        }
    }
    // reject
    public function delete($id)
    {
        $delete = Product::where('id', $id)->delete();
        if ($delete) {
            $notification = [
                'messege'    => 'Delete Success!',
                'alert-type' => 'success',
            ];
            return redirect()->back()->with($notification);
        } else {
            $notification = [
                'messege'    => 'Delete Faild!',
                'alert-type' => 'error',
            ];
            return redirect()->back()->with($notification);
        }
    }

    // active
    public function active($id)
    {
        $active = Product::where('id', $id)->update([
            'is_active'  => 1,
            'updated_by' => Auth::user()->id,
            'updated_at' => Carbon::now()->todateTimeString(),
        ]);
        if ($active) {
            $notification = [
                'messege'    => 'Product Active success!',
                'alert-type' => 'success',
            ];
            return redirect()->back()->with($notification);
        } else {
            $notification = [
                'messege'    => 'Active Faild!',
                'alert-type' => 'error',
            ];
            return redirect()->back()->with($notification);
        }
    }
    // Deactive
    public function deactive($id)
    {
        $Deactive = Product::where('id', $id)->update([
            'is_active'  => 0,
            'updated_by' => Auth::user()->id,
            'updated_at' => Carbon::now()->todateTimeString(),
        ]);
        if ($Deactive) {
            $notification = [
                'messege'    => 'Product Deactive success!',
                'alert-type' => 'success',
            ];
            return redirect()->back()->with($notification);
        } else {
            $notification = [
                'messege'    => 'Deactive Faild!',
                'alert-type' => 'error',
            ];
            return redirect()->back()->with($notification);
        }
    }
}
