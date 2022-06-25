@extends('layouts.backend')
@section('title', 'Payment Request Report')
@section('content')
<style>
    <style>
div.dataTables_wrapper div.dataTables_length select {

  height: 33px;
}
div.dataTables_wrapper div.dataTables_filter input {

    height: 25px;
}
</style>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Toolbar-->
    <div class="toolbar" id="kt_toolbar">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div data-kt-place="true" data-kt-place-mode="prepend" data-kt-place-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center me-3 flex-wrap mb-5 mb-lg-0 lh-1">
                <!--begin::Title-->
                <h1 class="d-flex align-items-center text-dark fw-bolder my-1 fs-3">Payment Request Report</h1>
                <!--end::Title-->
            </div>

        </div>
        <!--end::Container-->
    </div>
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container-fluid">
            <div class="card mb-10">
                <div class="card-body d-flex align-items-center p-5 p-lg-8">
                    <div class="row">
                      
                        <form action="{{url('/admin/payment-request-pay',$user->id)}}" method="post">@csrf
                            <form id="kt_modal_new_card_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" action="#" data-select2-id="select2-data-kt_modal_new_card_form">
                                <div class="d-flex flex-column mb-7 fv-row fv-plugins-icon-container">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                        <span class="required"> wallet</span>
                                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a card holder's name" aria-label="Specify a card holder's name"></i>
                                    </label>
                                    <!--end::Label-->
                                    <input type="text" class="form-control form-control-solid" placeholder="" disabled value="{{ $wallet }}">
                                <div class="fv-plugins-message-container invalid-feedback"></div></div>
                                <!--begin::Input group-->
                                <div class="d-flex flex-column mb-7 fv-row fv-plugins-icon-container">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                        <span class="required">Requested Amount</span>
                                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a card holder's name" aria-label="Specify a card holder's name"></i>
                                    </label>
                                    <!--end::Label-->
                                    <input type="number" disabled class="form-control form-control-solid" placeholder="" name="" value="{{ $payment_requests->request_amount}}">
                                <div class="fv-plugins-message-container invalid-feedback"></div></div>
                                <div class="d-flex flex-column mb-7 fv-row fv-plugins-icon-container">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                        <span class="required">Send Amount</span>
                                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a card holder's name" aria-label="Specify a card holder's name"></i>
                                    </label>
                                    <!--end::Label-->
                                    <input type="number" class="form-control form-control-solid" placeholder="" name="send_amount" value="{{ $payment_requests->request_amount}}" required>
                                <div class="fv-plugins-message-container invalid-feedback"></div></div>
                                <!--end::Input group-->
                                <!--begin::Actions-->
                                <div class="text-center pt-15">
                                    <button type="reset" id="kt_modal_new_card_cancel" class="btn btn-white me-3">Discard</button>
                                    <button type="submit" id="kt_modal_new_card_submit" class="btn btn-primary">
                                        <span class="indicator-label">Submit</span>
                                        <span class="indicator-progress">Please wait...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </button>
                                </div>

                                <!--end::Actions-->
                            <div></div></form>
                        </form>
                    </div>
                </div>
            </div>
            
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
</div>
@endsection