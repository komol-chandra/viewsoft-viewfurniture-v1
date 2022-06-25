<section class="section-b-padding pro-page-content">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="pro-page-tab">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#tab-1">Description</a>
                        </li>

                        {{-- <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#tab-3">Video</a>
                        </li> --}}
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#tab-5">SPECIFICATION</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#tab-2">Reviews</a>
                        </li>
                        @if($product->Vendor !=null)
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#tab-4">VENDOR INFO</a>
                        </li>
                        @endif



                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="tab-1">
                            <div class="tab-1content">
                                {!! $product->product_details !!}
                            </div>

                        </div>
                        <div class="tab-pane fade show" id="tab-2">
                            <h4 class="reviews-title">Customer reviews</h4>
                            <div class="customer-reviews t-desk-2">
                                <span class="p-rating">
                                    @for ($i = 1; $i <= $product->review_avg_review_star; $i++)
                                        <i class="fa fa-star e-star"></i>
                                        @endfor
                                        @for ($j = $product->review_avg_review_star + 1; $j <= 5; $j++) <i
                                            class="fa fa-star-o"></i>
                                            @endfor
                                </span>
                                <p class="review-desck">({{ $product->review_count }} reviews)</p>
                            </div>
                            @forelse ($product->Review as $review)
                            <div class="customer-reviews">
                                <span class="p-rating">
                                    @for ($i = 1; $i <= $review->review_star; $i++)
                                        <i class="fa fa-star e-star"></i>
                                        @endfor
                                        @for ($j = $review->review_star + 1; $j <= 5; $j++) <i class="fa fa-star-o"></i>
                                            @endfor

                                </span><br>
                                <span class="reviews-editor">{{ $review->customer->name }} <span
                                        class="review-name">on</span>{{ $review->created_at }}</span>
                                <p class="r-description">{{ $review->review_details }}</p>
                            </div>
                            @empty
                            <div class="col-md-4">
                                <div class="media">
                                    <label>No reviews yet</label>
                                </div>
                            </div>
                            @endforelse


                        </div>

                        @if($product->Vendor !=null)
                        <div class="tab-pane fade show text-center" id="tab-4">
                            <div class="pro-availabale">
                                <span class="available">Vendor Info:</span>
                                <span class="pro-instock">
                                    <a class="btn btn-style1 btn-style-asif"
                                        href="{{url('vendor-shop'.'/'.$product->Vendor->id)}}">
                                        {{ $product->Vendor->name }}
                                    </a>
                                </span>
                            </div>
                        </div>

                        @endif
                        {{-- <div class="tab-pane fade show" id="tab-3">
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe height="630" src="https://www.youtube.com/embed/0etCKCAsImI"
                                    title="YouTube video player"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen></iframe>
                            </div>
                        </div> --}}
                        <div class="tab-pane fade show" id="tab-5">
                            <div class="more-description table-responsive">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <h6>Qty</h6>
                                            </td>
                                            <td>
                                                <h6 style="margin-left: 50px">{{ $product->product_qty }}</h6>
                                            </td>
                                        </tr>
                                        @if($product->Brand !=null)
                                        <tr>
                                            <td>
                                                <h6>Brand </h6>
                                            </td>
                                            <td>
                                                <h6 style="margin-left: 50px">{{ $product->Brand->name }}
                                                </h6>
                                            </td>
                                        </tr>
                                        @endif

                                        <tr>
                                            <td>
                                                <h6>Type</h6>
                                            </td>
                                            <td>
                                                <h6 style="margin-left: 50px">
                                                    @if($product->product_condition
                                                    !=NULL)
                                                    @php
                                                    if($product->product_condition=="1" ||
                                                    $product->product_condition==1){
                                                    $text = "New";
                                                    }else if($product->product_condition=="2"){
                                                    $text = "Used";
                                                    }else if($product->product_condition=="3"){
                                                    $text = "Used(Good)";
                                                    }else if($product->product_condition=="4"){
                                                    $text = "Used(Like Good)";
                                                    } else{
                                                    $text = "";
                                                    }
                                                    @endphp
                                                    {{ $text }}

                                                    @else Null
                                                    @endif
                                                </h6>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                                <table>
                                    <tbody>
                                        @if($product->style !=NULL)
                                        <tr>
                                            <td>
                                                <h6>
                                                    Style
                                                </h6>
                                            </td>
                                            <td>
                                                <h6 style="margin-left: 50px">
                                                    {{ $product->style }}
                                                </h6>

                                            </td>
                                        </tr>
                                        @endif
                                        @if($product->product_materials !=NULL)
                                        <tr>
                                            <td>
                                                <h6>
                                                    Materials
                                                </h6>
                                            </td>
                                            <td>
                                                <h6 style="margin-left: 50px">
                                                    {{ $product->product_materials }}
                                                </h6>

                                            </td>
                                        </tr>
                                        @endif
                                        @if($product->product_gender !=NULL)
                                        <tr>
                                            <td>
                                                <h6>
                                                    Gender Type
                                                </h6>
                                            </td>
                                            <td>
                                                <h6 style="margin-left: 50px">
                                                    {{ $product->product_gender }}
                                                </h6>
                                            </td>
                                        </tr>
                                        @endif
                                        @if($product->age_group !=NULL)
                                        <tr>
                                            <td>
                                                <h6>Age Group </h6>
                                            </td>
                                            <td>
                                                <h6 style="margin-left: 50px">
                                                    {{ $product->age_group }}</h6>
                                            </td>
                                        </tr>
                                        @endif
                                        @if($product->product_weight !=NULL)
                                        <tr>
                                            <td>
                                                <h6>Weight</h6>
                                            </td>
                                            <td>
                                                <h6 style="margin-left: 50px">
                                                    {{ $product->product_weight }}</h6>
                                            </td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
