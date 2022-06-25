<div class="dashboard-sidebar">
    <div class="profile-top">
        @php
        $main_company=App\Models\VendorCompany::where('user_id',Auth::user()->id)->first();
        @endphp
        <div class="profile-image">
            @if($main_company)
            <img src="{{ asset('uploads/vendorcompany/'.$main_company->image) }}" alt="" class="img-fluid">
            @endif
        </div>

        <div class="profile-detail">
            @if($main_company)
            <h5>{{$main_company->company_name }}</h5>
            <h6>{{$main_company->company_address }}</h6>
            <h6>{{$main_company->email }}</h6>
            @else

            @endif
        </div>
    </div>
    <div class="faq-tab">
        <ul class="nav nav-tabs" id="top-tab" role="tablist">
            <li class="nav-item"><a data-bs-toggle="tab" class="nav-link active" href="#dashboard">dashboard</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ url('/vendor/shopwiseproduct') }}">Add products</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ url('/vendor/shop') }}">All Shop</a>
            <li class="nav-item"><a class="nav-link" href="{{ url('/vendor/product') }}">All products</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('vendor.order') }}">orders</a>
            </li>
            <li class="nav-item"><a class="nav-link" href="{{ url('/vendor/edit') }}">profile</a>
            </li>
            <li class="nav-item"><a class="nav-link" href="{{ route('vendor.edit') }}">Edit Company</a>
            </li>
            <li class="nav-item"><a class="nav-link" href="{{ url('/vendor/myorder') }}">My Cart Order</a>
            </li>
            <li class="nav-item"><a class="nav-link" data-toggle="modal" data-bs-target="#logout"
                    href="{{ url('logout') }}">logout</a>
            </li>
        </ul>
    </div>
</div>
