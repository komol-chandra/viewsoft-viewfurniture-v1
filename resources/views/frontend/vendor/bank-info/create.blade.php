@extends('layouts.frontend')
@section('title', 'Bank Info')

@section('content')

<section class="order-histry-area section-tb-padding">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="order-history">
                    @include('frontend.customerDashboard.include.sidebar')
                    <div class="profile-form">
                        <form action="{{ url('/vendor-bank-info') }}" method="post">
                            @csrf
                            @if(auth()->user()->is_vendor == 1)

                            <ul class="pro-input-label">
                                <li>
                                    <br>
                                    <label>Bank Account Name *</label>
                                    <input type="text" name="bank_name" id="bank_name" placeholder="Bank Account Name"
                                        value="{{ old('bank_name') ?? auth()->user()->bank_name }}">
                                    @error('bank_name')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </li>
                                <li>
                                    <br>
                                    <label>Bank Account Number*</label>
                                    <input type="text" name="bank_account_number" id="bank_account_number"
                                        placeholder="Bank Account Number"
                                        value="{{ old('bank_account_number') ?? auth()->user()->bank_account_number }}">
                                    @error('bank_account_number')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </li>
                                <li>
                                    <br>
                                    <label>Name of Bank*</label>
                                    <input type="text" name="name_of_bank" id="name_of_bank" placeholder="Name of Bank"
                                        value="{{ old('name_of_bank') ?? auth()->user()->name_of_bank }}">
                                    @error('name_of_bank')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </li>
                                <li>
                                    <br>
                                    <label> Your Bank Address</label>
                                    <input type="text" name="bank_address" id="bank_address"
                                        placeholder="Your Bank Address"
                                        value="{{ old('bank_address') ?? auth()->user()->bank_address }}">
                                    @error('bank_address')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </li>
                                <li>
                                    <br>
                                    <label>Routing Number</label>
                                    <input type="text" name="routing_number" id="routing_number"
                                        placeholder="Routing Number"
                                        value="{{ old('routing_number') ?? auth()->user()->routing_number }}">
                                    @error('routing_number')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </li>
                                <li>
                                    <br>
                                    <label>iBAN</label>
                                    <input type="text" name="i_ban" id="i_ban" placeholder="iBAN"
                                        value="{{ old('i_ban') ?? auth()->user()->i_ban }}">
                                    @error('i_ban')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </li>
                                <li>
                                    <br>
                                    <label>Swift Code</label>
                                    <input type="text" name="swift_code" id="swift_code" placeholder="Swift Code"
                                        value="{{ old('swift_code') ?? auth()->user()->swift_code }}">
                                    @error('swift_code')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </li>
                                <li>
                                    <br>
                                    <label>Mobile Bank Name</label>
                                    <input type="text" name="mobile_bank_name" id="mobile_bank_name"
                                        placeholder="ex: Bkash , Rocket"
                                        value="{{ old('mobile_bank_name') ?? auth()->user()->mobile_bank_name }}">
                                    @error('mobile_bank_name')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </li>
                                <li>
                                    <br>
                                    <label>Mobile Bank Number</label>
                                    <input type="text" name="mobile_bank_number" id="mobile_bank_number"
                                        placeholder="Mobile Bank Number"
                                        value="{{ old('mobile_bank_number') ?? auth()->user()->mobile_bank_number }}">
                                    @error('mobile_bank_number')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </li>
                                <li>
                                    <br>
                                    <label for="">Trade Licence Id</label>
                                    <input type="text" name="trade_licence" id="trade_licence"
                                        placeholder="Trade Licence Id"
                                        value="{{ old('trade_licence') ?? auth()->user()->trade_licence }}">
                                    @error('trade_licence')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </li>

                            </ul>
                            @endif
                            <ul class="pro-submit">
                                <li>
                                    <button type="submit" class="btn btn-style1">Update profile</button>
                                </li>
                            </ul>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
