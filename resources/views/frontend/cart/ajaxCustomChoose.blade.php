<link type="text/css" rel="stylesheet" href="{{asset('backend')}}/assets/css/image-uploader.min.css">

<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">{{ $product->product_name }} Product Custom Choise</h5>
    <a href="javascript:void(0)" data-bs-dismiss="modal" aria-label="Close"><i class="ion-close-round"></i></a>
</div>
<form action="{{ route('customer.custom-choose') }}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="product_id" value="{{$product->id}}">
    <input type="hidden" name="user_id" value="{{auth()->user()->id ?? null}}">
    <input type="hidden" name="vendor_id" value="{{$product->user_id}}">

    <div class="modal-body">
        <div class="row">
            <div class="form-group col-md-12 mb-2">

                <div class="pro-availabale">
                    <span class="available">Availability:</span>
                    <span class="pro-instock">{{ $product->product_qty > 0 ? "In stock" : "out of stock" }}
                    </span>
                </div>
                <div class="pro-availabale">
                    <span class="available">Defult Price:</span>
                    <span class="pro-instock">{{ $product->product_price}}
                    </span>
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="exampleFormControlSelect1">Colors <span class="text-danger">(*)</span></label>
                <select class="form-control" id="exampleFormControlSelect1" name="color_id" required>
                    @php
                    $colors = App\Models\Color::where('is_deleted','0')->where('is_active','1')->get();
                    @endphp
                    @foreach ($colors as $color)
                    <option value="{{ $color->id }}">{{ $color->color_name }}</option>
                    @endforeach
                </select>
                @error('color_id')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group col-md-4">
                <label for="exampleFormControlSelect1">Finished <span class="text-danger">(*)</span></label>
                <select class="form-control" id="exampleFormControlSelect1" name="finished_color_id" required>
                    @php
                    $finfished_colors =
                    App\Models\FinishedColor::where('is_deleted','0')->where('is_active','1')->get();
                    @endphp
                    @foreach ($finfished_colors as $color)
                    <option value="{{ $color->id }}">{{ $color->name }}</option>
                    @endforeach
                </select>
                @error('finished_color_id')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group col-md-4">
                <label for="exampleFormControlSelect1">Materials<span class="text-danger">(*)</span></label>
                <select class="form-control" id="exampleFormControlSelect1" name="material_id" required>
                    @php
                    $materials = App\Models\Materials::where('is_deleted','0')->where('is_active','1')->get();
                    @endphp
                    @foreach ($materials as $material)
                    <option value="{{ $material->id }}">{{ $material->name }}</option>
                    @endforeach

                </select>
                @error('material_id')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group col-md-4">
                <label for="exampleFormControlSelect1">Hight(inch)<span class="text-danger">(*)</span></label>
                <input type="number" class="form-control" name="hight" required>
                @error('hight')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group col-md-4">
                <label for="exampleFormControlSelect1">Wegiht(inch)<span class="text-danger">(*)</span></label>
                <input type="number" class="form-control" name="weight" required>
                @error('weight')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group col-md-4">
                <label for="exampleFormControlSelect1">Length(inch)<span class="text-danger">(*)</span></label>
                <input type="number" class="form-control" name="length" required>
                @error('length')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>


            <div class="form-group">
                <label for="exampleFormControlSelect1">Description</label>
                <textarea name="description" class="form-control" cols="30" rows="10"></textarea>
                @error('description')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="exampleFormControlSelect1">Address<span class="text-danger">(*)</span></label>
                <textarea name="address" class="form-control" cols="30"
                    rows="10">{{ auth()->user()->main_address }}</textarea>
                @error('address')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleFormControlSelect1">Image</label>
                <div id="product_img"></div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Save changes</button>
    </div>

</form>

<script type="text/javascript" src="{{asset('backend')}}/assets/js/image-uploader.min.js"></script>
<script>
    $("#product_img").spartanMultiImagePicker({
        fieldName: 'product_img',
        maxCount: 1,
        rowHeight: '100px',
        groupClassName: 'col-xl-6 col-md-6 col-sm-6 col-xs-6',
        maxFileSize: '',
        dropFileLabel: "Drag & Drop",
        onExtensionErr: function (index, file) {
            console.log(index, file, 'extension err');
            alert('Please only input png or jpg type file')
        },
        onSizeErr: function (index, file) {
            console.log(index, file, 'file size too big');
            alert('File size too big');
        }
    });

</script>
