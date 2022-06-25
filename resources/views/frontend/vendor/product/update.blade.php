@extends('layouts.frontend')
@section('title', 'Update-Products')
@section('content')
<link type="text/css" rel="stylesheet" href="{{asset('backend')}}/assets/css/image-uploader.min.css">
<link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<style>
    .order-histry-area .order-history .profile-form {
        width: calc(100% - 30px) !important;
        margin-left: 30px;
    }

    span.selection {
        display: block !important;
    }

    input[type="checkbox"] {
        height: 26px;
        width: 19px;
        margin-top: 20px;
    }

    .bootstrap-tagsinput {
        background-color: #fff;
        border: 1px solid #ccc;
        box-shadow: inset 0 1px 1px rgb(0 0 0 / 8%);
        display: inline-block;
        padding: 7px 20px;
        color: #555;
        vertical-align: middle;
        border-radius: 4px;
        max-width: 100%;
        line-height: 23px;
        cursor: text;
    }

    .bootstrap-tagsinput {
        background-color: #fff;
        border: 1px solid #ccc;
        box-shadow: inset 0 1px 1px rgb(0 0 0 / 8%);
        display: inline-block;
        padding: 4px 6px;
        color: #555;
        vertical-align: middle;
        border-radius: 4px;
        width: 100%;
        line-height: 22px;
        cursor: text;
    }

    .badge {

        padding: 0.35em 0.65em;
        font-size: 17px;
        color: #fff;
        background: #7db100;
        margin: 0px 2px;

    }

    label.form-check-label. {
        margin: 10px 25px 0px 20px;
        padding: 14px 0px;
    }

    .form-check-input[type=radio] {
        border-radius: 17%;
    }

    .form-check-input {
        width: 2em;
        height: 2em;
        margin-top: 0.25em;
        vertical-align: top;
        background-color: #fff;
        background-repeat: no-repeat;
        background-position: center;
        background-size: contain;
        border: 1px solid rgba(0, 0, 0, .25);
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        -webkit-print-color-adjust: exact;
        color-adjust: exact;
    }

    label.form-check-label {
        padding: 10px 13px;
    }

</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<section class="order-histry-area section-tb-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-3 mb-3">
                <a href="{{ url('/vendor/product') }}" class="btn btn-style1">Back To Products</a>
            </div>
            <div class="col">
                <div class="order-history" style="width:100%">
                    <div class="profile-form">
                        <form action="{{ route('update.vendor.product') }}" method="post" class="row" id="choice_form"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row mt-4">
                                <div class="col-md-8 form-group">
                                    <label for="exampleInputEmail1">Product Name</label>
                                    <input type="text" name="product_name" onchange="update_sku()" class="form-control"
                                        placeholder="Enter Product name" value="{{ $edit->product_name}}">

                                    <input type="hidden" name="id" value="{{ $edit->id}}">
                                    @error('product_name')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="exampleInputEmail1">Product Sku</label>
                                    <input type="text" name="product_sku" class="form-control"
                                        placeholder="Enter Product Sku" value="{{ $edit->product_sku}}">
                                    <input type="hidden" name="product_id" value="{{ $edit->id }}">

                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-3 form-group ">
                                    <label for="exampleInputEmail1">Product Price</label>
                                    <input type="text" name="unit_price" class="form-control"
                                        placeholder="Enter Product Price" value="{{ $edit->product_price}}">
                                    @error('unit_price')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3 form-group ">
                                    <label for="exampleInputEmail1">Product Stock Qty</label>
                                    <input type="number" name="product_qty" class="form-control"
                                        placeholder="Enter Product Qty" value="{{ $edit->product_qty}}">
                                    @error('product_qty')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3 form-group ">
                                    <label for="exampleInputEmail1">Product Brand(Optional)</label>
                                    <select name="product_brand" id="product_brand"
                                        class="form-control border-form-control" style="height: 40px">
                                        <option disabled selected>select</option>
                                        @foreach($allbrand as $brand)
                                        <option value="{{$brand->id}}" @if($edit->brand_id==$brand->id) selected
                                            @endif>{{$brand->name}}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="col-md-3 form-group ">
                                    <label for="exampleInputEmail1">Product Condition</label>
                                    <select name="product_condition" id="product_condition"
                                        class="form-control border-form-control" style="height: 40px">
                                        <option disabled selected>select</option>
                                        <option value="1" @if($edit->product_condition=='1') selected @endif>New
                                        </option>
                                        <option value="2" @if($edit->product_condition=='2') selected @endif>Used
                                        </option>
                                        <option value="3" @if($edit->product_condition=='3') selected
                                            @endif>Used(Good)</option>
                                        <option value="4" @if($edit->product_condition=="4" )
                                            selected @endif>Used(Like Good)</option>
                                    </select>
                                </div>
                            </div>
                            @php
                            $subcategory=App\Models\SubCategory::where('is_deleted',0)->where('is_active',1)->where('category',$edit->category_id)->get();

                            $resubcategory=App\Models\ResubCategory::where('is_deleted',0)->where('is_active',1)->where('sub_category',$edit->subcategory_id)->get();

                            $reresubcategory=App\Models\ReReSubCategory::where('is_deleted',0)->where('is_active',1)->where('re_sub_category',$edit->resubcategory_id)->get();

                            $rereresubcategory=App\Models\ReReReSubCategory::where('is_deleted',0)->where('is_active',1)->where('re_re_sub_category',$edit->child_resubcategory)->get();

                            $finfished_colors =
                            App\Models\FinishedColor::where('is_deleted','0')->where('is_active','1')->get();
                            @endphp
                            <div class="row mt-4">
                                <div class="col-md-2 form-group ">
                                    <label for="exampleInputEmail1">Category</label>
                                    <select name="category" id="category" class="form-control border-form-control">
                                        <option selected disabled>select</option>
                                        @foreach($allCategory as $category)
                                        <option value="{{ $category->id }}" @if($edit->category_id == $category->id)
                                            selected @endif>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-2 form-group ">
                                    <label for="exampleInputEmail1">SubCategory</label>
                                    <select name="subcategory" id="subcategory"
                                        class="form-control border-form-control">
                                        <option disabled>select</option>
                                        @foreach($subcategory as $subcate)
                                        <option value="{{ $subcate->id }}" @if($edit->subcategory_id == $subcate->id)
                                            selected @endif>{{ $subcate->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2 form-group ">
                                    <label for="exampleInputEmail1">ReSubCategory</label>
                                    <select name="resubcategory" id="resubcategory"
                                        class="form-control border-form-control">
                                        <option disabled>select</option>
                                        @foreach($resubcategory as $resubcate)
                                        <option value="{{ $resubcate->id }}" @if($edit->resubcategory_id ==
                                            $resubcate->id)
                                            selected @endif>{{ $resubcate->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2 form-group">
                                    <label for="child_resubcategory">ReReSubCategory</label>
                                    <select name="child_resubcategory" id="child_resubcategory"
                                        class="form-control border-form-control">
                                        <option selected disabled>select</option>
                                        @foreach($reresubcategory as $reresubcat)
                                        <option value="{{ $reresubcat->id }}" @if($edit->child_resubcategory ==
                                            $reresubcat->id)
                                            selected @endif>{{ $reresubcat->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2 form-group">
                                    <label for="grand_childresubcategory_id">ReReReSubCategory</label>
                                    <select name="grand_childresubcategory_id" id="grand_childresubcategory_id"
                                        class="form-control border-form-control">
                                        <option selected disabled>select</option>
                                        @foreach($rereresubcategory as $rereresubcat)
                                        <option value="{{ $rereresubcat->id }}" @if($edit->grand_childresubcategory_id
                                            ==
                                            $rereresubcat->id)
                                            selected @endif>{{ $rereresubcat->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2 form-group ">
                                    <label for="exampleInputEmail1">Shop</label>
                                    <select name="product_shop" id="product_shop"
                                        class="form-control border-form-control">
                                        <option selected disabled>select</option>
                                        @foreach($allshop as $shop)
                                        <option value="{{ $shop->id }}" @if($edit->shop_id == $shop->id) selected
                                            @endif>{{ $shop->shop_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('shop')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-2 form-group ">
                                    <label for="exampleFormControlSelect1">Finished </label>
                                    <select class="form-control" id="exampleFormControlSelect1" name="finished_color_id"
                                        required>
                                        <option selected disabled>select</option>
                                        @foreach ($finfished_colors as $color)
                                        <option value="{{ $color->id }}" @if($edit->finished_color_id==$color->id)
                                            selected
                                            @endif>{{ $color->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('finished_color_id')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-2 form-group ">
                                    <label for="exampleInputEmail1">Decor Style</label>
                                    <input type="text" name="decor_style" class="form-control"
                                        placeholder="Enter Product Decor Style"
                                        value="{{old('decor_style') ?? $edit->decor_style}}">
                                    @error('decor_style')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-2 form-group ">
                                    <label for="exampleInputEmail1">Hight(inch)</label>
                                    <input type="number" name="hight" class="form-control"
                                        placeholder="Enter Product hight" value="{{old('hight')?? $edit->hight}}">
                                    @error('hight')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-2 form-group ">
                                    <label for="exampleInputEmail1">Width(inch)</label>
                                    <input type="number" name="width" class="form-control"
                                        placeholder="Enter Product width" value="{{old('width')?? $edit->width}}">
                                    @error('width')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-2 form-group ">
                                    <label for="exampleInputEmail1">Length(inch)</label>
                                    <input type="number" name="length" class="form-control"
                                        placeholder="Enter Product length" value="{{old('length')?? $edit->length}}">
                                    @error('length')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-2 form-group ">
                                    <label for="exampleInputEmail1">Depth(inch)</label>
                                    <input type="number" name="depth" class="form-control"
                                        placeholder="Enter Product depth" value="{{old('depth')?? $edit->depth}}">
                                    @error('depth')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mt-4">

                                <div class="col-md-6 form-group ">
                                    <label for="exampleInputEmail1">Thumbnail Image</label>
                                    <div class="row mb-10">
                                        <div class="col-lg-12 col-xl-12">
                                            <!-- image start -->
                                            <div id="editimage"
                                                class="col-xl-12 col-md-12 col-sm-12 col-xs-12 spartan_item_wrapper"
                                                data-spartanindexrow="0" style="margin-bottom : 20px; ">
                                                <div style="position: relative;">
                                                    <div class="spartan_item_loader" data-spartanindexloader="0"
                                                        style="position: absolute; width: 100%; height: 450px; background: rgba(255,255,255, 0.7); z-index: 22; text-align: center; align-items: center; margin: auto; justify-content: center; flex-direction: column; display : none; font-size : 1.7em; color: #CECECE">
                                                        <i class="fas fa-sync fa-spin"></i></div>
                                                    <label class="file_upload"
                                                        style="width: 100%; height: 250px; border: 2px dashed #ddd; border-radius: 3px; cursor: pointer; text-align: center; overflow: hidden; padding: 5px; margin-top: 5px; margin-bottom : 5px; position : relative; display: flex; align-items: center; margin: auto; justify-content: center; flex-direction: column;">
                                                        <a href="javascript:void(0)" onclick="editimageremove(this)"
                                                            data-spartanindexremove="0"
                                                            style="right: 3px; top: 3px; background: rgb(237, 60, 32); border-radius: 3px; width: 30px; height: 30px; line-height: 30px; text-align: center; text-decoration: none; color: rgb(255, 255, 255); position: absolute !important;"
                                                            class="spartan_remove_row">

                                                            <i class="fas fa-times"></i> </a>
                                                        <img style="width: 100%; margin: 0px auto; vertical-align: middle; display: ;"
                                                            data-spartanindexi="0"
                                                            src="{{asset('uploads/products/'.$edit->image)}}">
                                                        <input class="form-control spartan_image_input" accept="image/*"
                                                            data-spartanindexinput="0" style="display : none"
                                                            name="product_img" type="file">
                                                    </label>
                                                </div>
                                            </div>
                                            <div id="product_img" style="display: none;"></div>
                                            <!-- image end -->
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 form-group ">
                                    <label for="exampleInputEmail1">Gallary Image</label>
                                    <!-- <div class="input-images"></div> -->
                                    <div class="row mb-10">
                                        <div class="col-xl-12 col-lg-12 row">
                                            <div class="input-images">
                                                <div class="image-uploader has-files">
                                                    <input type="file" id="images" name="images[]" multiple="multiple">
                                                    <div class="uploaded">
                                                        @if(is_array(json_decode($edit->gallary_image)))
                                                        @foreach (json_decode($edit->gallary_image) as $key => $photo)
                                                        <div class="uploaded-image" data-index="{{++$key}}">
                                                            <img src="{{asset('uploads/products/'.$photo) }}">
                                                            <input type="hidden" name="previous_photos[]"
                                                                value="{{ $photo }}">
                                                            <button type="button" class="delete-image"
                                                                onclick="delete_row_photos(this)"><i
                                                                    class="material-icons">clear</i></button>
                                                        </div>
                                                        @endforeach
                                                        @endif
                                                    </div>
                                                    <div class="upload-text">
                                                        <i class="material-icons"></i>
                                                        <span>Drag &amp; Drop files here or click to browse</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">

                                <div class="col-md-5 form-group ">
                                    <label for="exampleInputEmail1">Color</label>
                                    <select id="colors"
                                        class="form-control form-control-solid js-example-basic-multiple"
                                        name="colors[]" multiple="multiple" onchange="myFunction()">

                                        @php
                                        $allcolor=App\Models\Color::where('is_deleted',0)->get();
                                        @endphp
                                        @foreach($allcolor as $color)
                                        <option value="{{$color->color_code}}"
                                            <?php if(in_array($color->color_code, json_decode($edit->colors))) echo 'selected'?>>
                                            {{$color->color_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-1 form-group ">
                                    <label class="chech_container">
                                        <input value="1" type="checkbox" name="colors_active"
                                            <?php if(count(json_decode($edit->colors)) > 0) echo "checked";?>>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="customer_choice_options" id="customer_choice_options">
                                    @foreach (json_decode($edit->choice_options) as $key => $choice_option)
                                    <div class="form-group row">
                                        <div class="col-lg-4">
                                            <input type="hidden" name="choice_no[]"
                                                value="{{ explode('_', $choice_option->name)[1] }}">
                                            <input type="text" class="form-control" name="choice[]"
                                                value="{{ $choice_option->title }}">
                                        </div>
                                        <div class="col-lg-7">
                                            <input type="text" class="form-control"
                                                name="choice_options_{{ explode('_', $choice_option->name)[1] }}[]"
                                                placeholder="Enter choice values"
                                                value="{{ implode(',', $choice_option->options) }}"
                                                data-role="tagsinput" onchange="update_sku()">
                                        </div>
                                        <div class="col-lg-1">
                                            <button onclick="delete_row(this)" class="btn btn-danger btn-icon"><i
                                                    class="fa fa-times"></i></button>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="col-md-12 form-group ">
                                    <button type="button" id="add_attributes"
                                        onclick="add_more_customer_choice_option()" class="btn-sm btn-success">Add
                                        Attributes</button>
                                </div>
                                <div class="col-md-12 sku_combination" id="sku_combination">
                                </div>
                            </div>
                            <div class="row mt-4">

                                <div class="col-md-6 form-group ">
                                    <label for="exampleInputEmail1">Product Details</label>
                                    <textarea name="product_details" class="form-control" id="summernote" cols="30"
                                        rows="10">{!! $edit->product_details !!} </textarea>
                                </div>
                                <div class="col-md-6 form-group ">
                                    <label for="exampleInputEmail1">Product Tag</label>
                                    <input type="text" name="product_tag" data-role="tagsinput" class="form-control"
                                        placeholder="Enter Product Tag" value="{{$edit->product_tags}}">
                                    @error('product_tag')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-12 form-group mt-2">
                                    <div class="form-check">
                                        <input class="form-check-input have_a_warranty" type="checkbox"
                                            name="have_a_warranty" type="checkbox" value="1" @if($edit->have_a_warranty
                                        !=NULL) checked @endif>
                                        <label class="form-check-label  mt-2">
                                            Have a Warranty
                                        </label>
                                    </div>

                                    <div @if($edit->have_a_warranty==NULL) style="display:none" @endif class="col-md-12
                                        form-group mt-2" id="warranty_type" >
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input warranty" type="radio" id="inline_Radio4"
                                                name="warranty_name" value="none" @if($edit->warranty_name == "none")
                                            checked @endif>
                                            <label class="form-check-label" for="inline_Radio4">None</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input @if($edit->warranty_name == "Warranty")checked @endif
                                            class="form-check-input warranty" type="radio" id="inline_Radio5"
                                            name="warranty_name" value="Warranty">
                                            <label class="form-check-label" for="inline_Radio5">Warranty</label>
                                        </div>

                                        <div class="form-check
                                            form-check-inline">
                                            <input @if($edit->warranty_name == "Guarantee")checked @endif
                                            class="form-check-input warranty" type="radio" id="inline_Radio6"
                                            name="warranty_name" value="Guarantee">
                                            <label class="form-check-label" for="inline_Radio6">Guarantee</label>
                                        </div>
                                    </div>

                                    <div @if($edit->warranty_name == "Warranty" || $edit->warranty_name == "Guarantee")
                                        @else style="display:none" @endif class="row col-md-12 form-group mt-2"
                                        id="warranty_time" >
                                        <div class="col-md-6 form-group mt-2">
                                            <label for="exampleInputEmail1">Enter Warranty or guarantee time(year)
                                                <span class="text-danger">(*)</span> </label>
                                            <input type="number" name="warranty_year" class="form-control"
                                                placeholder="Enter time" value="{{$edit->warranty_year}}">
                                            @error('warranty_year')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-12 form-group ">
                                    <div class="form-check">
                                        <input class="form-check-input have_a_discount" type="checkbox"
                                            name="have_a_discount" type="checkbox" value="1" @if($edit->have_a_discount
                                        !=NULL) checked @endif>
                                        <label class="form-check-label  " for="flexCheckIndeterminate">
                                            Have A Discount
                                        </label>
                                    </div>
                                    <div class="col-md-12 form-group " id="discount_price" @if($edit->
                                        have_a_discount==NULL) style="display:none" @endif >
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input Special" type="radio" id="inlineRadio1"
                                                name="offer" value="none" @if($edit->offer == "none") checked @endif>
                                            <label class="form-check-label" for="inlineRadio1">None</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input Special" type="radio" id="inlineRadio2"
                                                name="offer" value="11_offer" @if($edit->offer == "11_offer") checked
                                            @endif>
                                            <label class="form-check-label" for="inlineRadio2">11 Offer</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input Special" type="radio" id="inlineRadio4"
                                                name="offer" value="special_offer" @if($edit->offer == "special_offer")
                                            checked @endif>
                                            <label class="form-check-label" for="inlineRadio4">Spacial offer</label>
                                        </div>
                                    </div>
                                    <div class="row col-md-12 form-group " id="special_sec" @if($edit->offer ==
                                        "special_offer") @else style="display:none;" @endif>
                                        <div class="col-md-6 form-group ">
                                            <label for="exampleInputEmail1">Discount Price</label>
                                            <input type="text" name="discount_price" class="form-control"
                                                placeholder="Enter Discount Price" value="{{ $edit->discount_price }}">
                                            @error('discount_price')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4 form-group ">
                                            <label for="exampleInputEmail1">Discount Type</label>
                                            <select name="discount_price_type" class="form-control form-control-solid">
                                                <option value="percent" @if($edit->discount_price_type=='percent')
                                                    selected
                                                    @endif>%</option>
                                                <option value="taka" @if($edit->discount_price_type=='taka') selected
                                                    @endif>TK</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 form-group ">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input special_section" type="radio" data-id="1"
                                                    checked name="discount_condition" value="date"
                                                    @if($edit->discount_condition=='date') checked @endif >
                                                <label class="form-check-label" for="">Date</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input s_section" type="radio" data-id="2"
                                                    name="discount_condition" value="Stock"
                                                    @if($edit->discount_condition=='Stock') checked @endif >
                                                <label class="form-check-label" for="">Stock</label>
                                            </div>
                                        </div>
                                        <div class="form-group  col-md-12 row" id="main_date_section" @if($edit->
                                            discount_condition=='date') @else style="display:none" @endif>
                                            <div class="col-md-6 ">
                                                <input type="date" name="from_date"
                                                    class="form-control  form-control-solid"
                                                    placeholder="Enter From Date" value="{{ ($edit->from_date) }}">
                                            </div>
                                            <div class="col-md-6 ">
                                                <input type="date" name="to_date"
                                                    class="form-control  form-control-solid" placeholder="Enter To Date"
                                                    value="{{ ($edit->to_date) }}">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12 row" id="main_stock_section" @if($edit->
                                            discount_condition=='Stock') @else style="display:none" @endif>
                                            <div class="col-md-2  ">
                                                <input class="form-check-input all_stock" type="radio"
                                                    name="offer_stock_type" value="all_stock"
                                                    @if($edit->offer_stock_type=='all_stock') checked @endif >
                                                <label class="form-check-label" for="">All Stock</label>
                                            </div>
                                            <div class="col-md-6 ">
                                                <input class="form-check-input limit_qty" type="radio"
                                                    name="offer_stock_type" value="limit_qty"
                                                    @if($edit->offer_stock_type=='limit_qty') checked @endif>
                                                <label class="form-check-label" for="">Limit Qty</label>
                                            </div>
                                            <div class="col-md-6" id="all_stock_qty" @if($edit->
                                                offer_stock_type=='limit_qty') @else style="display:none" @endif>
                                                <div class="fv-row ">
                                                    <label>
                                                        <span class="required">Qty</span>
                                                    </label>
                                                    <input type="number" min="1"
                                                        class="form-control  form-control-solid" name="offer_qty"
                                                        placeholder="Enter Qty" value="{{ $edit->offer_qty  }}" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <ul class="pro-submit">
                        <li>
                            <button type="submit" class="btn btn-style1">Add Product</button>
                        </li>
                    </ul>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
<script type="text/javascript">
    $(document).ready(function () {
        // get sub category data
        $('select[name="category"]').on('change', function () {
            var cate_id = $(this).val();
            if (cate_id) {
                $.ajax({
                    url: "{{  url('/get/subcategory/all/') }}/" + cate_id,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {

                        $('#subcategory').empty();
                        $('#subcategory').append(
                            ' <option disabled selected>select</option>');
                        $.each(data, function (index, districtObj) {
                            $('#subcategory').append('<option value="' + districtObj
                                .id + '">' + districtObj.name + '</option>');
                        });

                    }
                });
            } else {
                //  alert('danger');
            }

        });
        //  resubcategory
        //  resubcategory
        $('select[name="subcategory"]').on('change', function () {
            var subcate_id = $(this).val();
            if (subcate_id) {
                $.ajax({
                    url: "{{  url('/get/resubcategory/all/') }}/" + subcate_id,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {

                        $('#resubcategory').empty();
                        $('#resubcategory').append(
                            '<option disabled selected>select</option>');
                        $.each(data, function (index, districtObj) {
                            $('#resubcategory').append('<option value="' +
                                districtObj.id + '">' + districtObj.name +
                                '</option>');
                        });


                    }
                });
            } else {
                //  alert('danger');
            }
            // re re subcategory get

        });
        $('select[name="resubcategory"]').on('change', function () {
            var resubcate_id = $(this).val();
            if (resubcate_id) {
                $.ajax({
                    url: "{{  url('/get/reresubcategory/all/') }}/" + resubcate_id,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {

                        $('#child_resubcategory').empty();
                        $('#child_resubcategory').append(
                            ' <option value="">--select--</option>');
                        $.each(data, function (index, districtObj) {
                            $('#child_resubcategory').append('<option value="' +
                                districtObj.id + '">' + districtObj.name +
                                '</option>');
                        });
                    }
                });
            } else {
                //  alert('danger');
            }

        });
        $('select[name="child_resubcategory"]').on('change', function () {
            var resubcate_id = $(this).val();

            if (resubcate_id) {
                $.ajax({
                    url: "{{  url('/get/rereresubcategory/all/') }}/" + resubcate_id,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('#grand_childresubcategory_id').empty();
                        $('#grand_childresubcategory_id').append(
                            ' <option value="">--select--</option>');
                        $.each(data, function (index, districtObj) {
                            $('#grand_childresubcategory_id').append(
                                '<option value="' +
                                districtObj.id + '">' + districtObj.name +
                                '</option>');
                        });
                    }
                });
            } else {
                //  alert('danger');
            }
        });
    });

</script>








<script>
    function myFunction() {
        update_sku()
    }

</script>
<script type="text/javascript" src="{{asset('backend')}}/assets/js/image-uploader.min.js"></script>
<script>
    $('.input-images').imageUploader();

</script>
<script>
    $(document).ready(function () {
        $(".have_a_warranty").click(function () {

            if ($(this).is(":checked")) {
                $("#warranty_type").show();

            } else {
                $("#warranty_type").hide();
            }
        });

        $(".warranty").click(function () {
            var val = $(this).val();
            if (val == 'Warranty' || val == 'Guarantee') {
                $("#warranty_time").show();
            } else {
                $("#warranty_time").hide();
            }
        });

    });

</script>

<script>
    $(document).ready(function () {
        $(".have_a_discount").click(function () {

            if ($(this).is(":checked")) {
                $("#discount_price").show();

            } else {
                $("#discount_price").hide();

            }
        });
    });

</script>

<script>
    $(document).ready(function () {
        $(".Special").click(function () {

            var val = $(this).val();
            if (val == 'special_offer') {

                $("#special_sec").show();
            } else {
                $("#special_sec").hide();
            }
        });
    });

</script>
<script>
    $(document).ready(function () {
        $(".special_section").click(function () {
            $("#main_date_section").show();
            $("#main_stock_section").hide();
        });

        $(".s_section").click(function () {
            $("#main_date_section").hide();
            $("#main_stock_section").show();
        });
    });

</script>
<script>
    $(document).ready(function () {
        $(".all_stock").click(function () {
            $("#all_stock_qty").hide();
        });

        $(".limit_qty").click(function () {
            $("#all_stock_qty").show();
        });
    });

</script>

<script>
    var i = $('input[name="choice_no[]"').last().val();
    if (isNaN(i)) {
        i = 0;
    }

    function add_more_customer_choice_option() {
        $('#customer_choice_options').append(
            '<div class="form-group row"><div class="col-lg-4"><input type="hidden" name="choice_no[]" value="' +
            i +
            '"><input type="text" class="form-control" name="choice[]" value="" placeholder="Choice Title"></div><div class="col-lg-7"><input type="text" class="form-control choice_tag" name="choice_options_' +
            i +
            '[]" id="choice_tag" placeholder="Enter choice values" data-role="tagsinput" onchange="update_sku()"></div><div class="col-lg-2"><button onclick="delete_row(this)" class="btn btn-danger btn-icon"><i class="fa fa-times"></i></button></div></div>'
        );
        i++;
        $("input[data-role=tagsinput], select[multiple][data-role=tagsinput]").tagsinput();
    }

    $('input[name="colors_active"]').on('change', function () {
        if (!$('input[name="colors_active"]').is(':checked')) {
            $('#colors').prop('disabled', true);
        } else {
            $('#colors').prop('disabled', false);
        }
        update_sku();
    });

    function delete_row(em) {
        $(em).closest('.form-group').remove();
        update_sku();
    }

    $('input[name="unit_price"]').on('keyup', function () {
        update_sku();
    });

    function update_sku() {
        $.ajax({
            type: "GET",
            url: "{{ route('products.sku_combination_edit') }}",
            data: $('#choice_form').serialize(),
            success: function (data) {
                // console.log(data);
                $('#sku_combination').html(data);
            }
        });
    }

</script>
<script>
    function editimageremove(em) {
        //   alert('ok');
        $("#editimage").hide();
        $("#product_img").show();
    }

</script>

<script>
    function delete_row_photos(em) {
        $(em).closest('.uploaded-image').remove();
    }

</script>


@endsection
