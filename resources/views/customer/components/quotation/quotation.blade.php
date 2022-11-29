@extends('components.modals.order_detail.quotation.quotation')

@section('quotation-description')
    <p class="text-dark font-12 mb-2">List of services and their respective estimated pricing that will be provided to complete your order.
        Please review and approve, or edit quotation if you'd like to renegotiate the pricing.
    </p>
@endsection

@section('quotation-no-active')
    <div class="col-12 mb-3 text-center text-dark">
        <p class="font-14 mb-2">View latest quotations' documents below.</p>
    </div>
@endsection

@section('quotation-action')
    <div class="col-lg-6 offset-lg-3 mb-3">
        <button type="button" id="approve-quotation-form" class="btn btn-success btn-block" onclick="updateStatus(this, 'approve')">
            Approve Quotation
        </button>
    </div>
@endsection

@include('customer.components.quotation.js_quotation')
