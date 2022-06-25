@extends('layouts.backend')
@section('title', 'Vendor List')
@section('content')
<style>
    <style>div.dataTables_wrapper div.dataTables_length select {

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
            <div data-kt-place="true" data-kt-place-mode="prepend"
                data-kt-place-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                class="page-title d-flex align-items-center me-3 flex-wrap mb-5 mb-lg-0 lh-1">
                <!--begin::Title-->
                <h1 class="d-flex align-items-center text-dark fw-bolder my-1 fs-3">Vendor List</h1>
                <!--end::Title-->
            </div>

        </div>
        <!--end::Container-->
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-5 mb-xl-8">
                <div class="card-body py-3">
                    <!--begin::Table container-->
                    <div class="table-responsive">
                        <!--begin::Table-->
                        <table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3"
                            id="dataTableExample1" class="data-table" style="width:100%">
                            <thead class="text-center">
                                <tr class="fw-bolder text-muted">
                                    <th>#</th>
                                    <th class="min-w-140px">Name</th>
                                    <th class="min-w-140px">Devision</th>
                                    <th class="min-w-140px">City</th>
                                    <th class="min-w-140px">Address</th>
                                    <th class="min-w-140px">Phone</th>
                                    <th class="min-w-140px">Email</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @if($data!=null)
                                @foreach($data as $key => $val)
                                <tr>
                                    <td class="text-dark  text-hover-primary fs-6"> {{ ++$key }} </td>
                                    <td>{{ $val->name  }}</td>
                                    @if($val->division)
                                    @php
                                    $division=Devfaysal\BangladeshGeocode\Models\Division::where('id',$val->division)->first();
                                    @endphp
                                    <td>
                                        {{ $division->name  }}
                                    </td>
                                    @else
                                    <td>N/A</td>
                                    @endif
                                    @if($val->city)
                                    @php
                                    $city=Devfaysal\BangladeshGeocode\Models\District::where('id',$val->city)->first();
                                    @endphp
                                    <td>
                                        {{ $city->name  }}
                                    </td>
                                    @else
                                    <td>N/A</td>
                                    @endif
                                    <td>{{ $val->main_address  }}</td>
                                    <td>{{ $val->phone  }}</td>
                                    <td>{{ $val->email  }}</td>

                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                        <!--end::Table-->
                    </div>
                    <!--end::Table container-->
                </div>
                <!--begin::Body-->
            </div>
        </div>
    </div>
</div>
@endsection
