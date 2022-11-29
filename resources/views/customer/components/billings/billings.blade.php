@extends('components.modals.order_detail.billings.billings')

@section('billings-action')
    <div class="row reject-proforma-container billings-action-elmt d-none">
        <div class="col-4 offset-4 mb-3">
            <button type="button" class="btn btn-block btn-sm btn-outline-danger border-0" onclick="rejectProforma(this)">Reject Proforma</button>
        </div>
    </div>
@endsection

@include('customer.components.billings.js_billings')
