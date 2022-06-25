<h2>In your Custom Choose Product</h2>
<ul class="order-history">
    <li class="order-details">
        <span>Product:</span>
        <span>Total</span>
    </li>

    <li class="order-details">
        <span>{{ $cartData->Product->product_name }}:</span>
        <span>৳ {{ $cartData->custom_product_price}}</span>
    </li>

    <!-- defult setup variable  -->
    @php
    $subtotal = round($cartData->custom_product_price);
    $shopping_charge = round($subtotal * (shoppingChargeDefault() /100));
    $grand_total =round($subtotal + $shopping_charge);
    $minimum_pay = round($grand_total * (15 / 100));
    @endphp


    <li class="order-details">
        <span>Subtotal:</span>
        <span>৳ {{ $subtotal }}</span>
    </li>

    <li class="order-details">
        <span>Shipping Charge <span id="shipping_percent">({{ shoppingChargeDefault() }} %)</span>:</span>
        <span id="shopping_amount">৳ {{$shopping_charge }}</span>
    </li>
    <li class="order-details" id="cupon_hidden" style="display: none">
        <span>Cupon Discount:</span>
        <label for="free-shipping">
            <span id="cupon_amount"></span> <span id="cupon_type"></span>
        </label>
        <input type="hidden" id="cupon_amount_hidden" name="cupon_amount_hidden" />
        <input type="hidden" id="cupon_type_hidden" name="cupon_type_hidden" />
        <input type="hidden" id="cupon_id_hidden" name="cupon_id_hidden" />
        <input type="hidden" id="cupon_discounted_amount_hidden" name="cupon_discounted_amount_hidden" />

    </li>

    <li class="order-details" id="cupon_discounted_hidden" style="display: none">
        <span>Discounted Amount:</span>
        <label for="free-shipping"> - <span id="cupon_discounted_amount"> </span> </label>
    </li>
    <li class="order-details" id="full_paid_offer_hidden" style="display: none">
        <span>Full Paid Discount: <span id="" class="">{{ round(fullPaidOffer()) }}
                % off</span></span>
        <span id="fullPaidAmount" class="fullPaidAmount"></span>
        <input type="hidden" id="full_paid_offer_amount_vlaue" class="paid_value" name="full_paid_offer_amount_value" />
    </li>
    <li class="order-details">
        <span>Total:</span>
        <span id="delfult_grand_total_amount">৳
            {{ $grand_total }}</span>
    </li>


    <li class="order-details" id="min_payment_text">
        <span id="" class="text-danger">Please send minimum 15% of total amount using bkash to confirm the order </span>
    </li>
    <li class="order-details" id="max_payment_text" style="display: none">
        <span id="" class="text-danger">Please send full amount using bkash to confirm the order </span>
    </li>
    <li class="order-details">
        <span> Bkash merchant (Payment) :</span>
        <h5 id="">{{ $companyInformation->bkash_number }}</h5>
    </li>

    <li class="order-details">
        <span> Minimum payable amount(15%) :</span>
        <h6 id="minimum_pay">৳ {{ $minimum_pay }}</h6>
    </li>
    <li class="order-details">
        <span> Pay :</span>
        <input type="number" class="form-group advance_pay" name="advance_pay" id="advance_pay" placeholder=""
            onchange="paymentCheck()" required />
        @error('advance_pay')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </li>
    <li class="order-details">
        <span> Mobile number :</span>
        <input type="text" class="form-group" name="payment_mobile" id="payment_mobile" placeholder="" required />
        @error('payment_mobile')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </li>
    <li class="order-details">
        <span> Transaction id :</span>
        <input type="text" class="form-group" name="transaction_id" id="transaction_id" placeholder="" required />
        @error('transaction_id')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </li>
    {{-- @php
    $wallet=davitBalance(auth()->user()->id) + wallet(auth()->user()->id) -
    paidAmount(auth()->user()->id)- creditBalance(auth()->user()->id);
    @endphp
    @if ($wallet != null && $wallet > 200)
    <li class="order-details">
        <input type="checkbox" name="wallet_value" id="wallet_value">
        <label for="wallet_value">Use 200 taka from
            wallet</label>
    </li>

    @endif
    <li id="hidden_wallet" style="display: none">Wallet
        <div class="shipping">
            <div class="shopping-option">
                <label for="free-shipping" id=""> - 200</label>
            </div>
        </div>
    </li> --}}
</ul>
<ul class="order-form">
    <input type="hidden" name="product_request" value="{{ $cartData->id}}">
    <input type="hidden" name="product_request_type" value="custom_product">
    <input type="hidden" id="shopping_amount" name="delivery_charge" value="{{shoppingChargeDefault() }}">
    <input type="hidden" id="delfult_grand_total_amount_2" name="total_amount" value="{{ $grand_total }}">
    <input type="hidden" name="total_item" id="total_item" value="1">
    <input type="hidden" name="total_qty" id="total_qty" value="1">
    <input type="hidden" name="customer_id" value="{{ auth()->user()->id }}">
    <input type="hidden" name="total_price_hidden" id="total_price_hidden" value="{{ $subtotal }}">
    <input type="hidden" name="check_minimum_pay" id="check_minimum_pay" class="check_minimum_pay"
        value="{{ $minimum_pay }}">
</ul>
<div class="checkout-btn">
    <button type="submit" id="order_btn" disabled class="btn btn-style1">Place order</button>
</div>
