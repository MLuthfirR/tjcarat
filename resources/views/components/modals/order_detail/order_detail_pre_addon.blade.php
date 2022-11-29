@include('components.modals.order_detail.order_submitted.order_submitted_banner')
@include('components.modals.order_detail.order_completed.order_completed_banner')

@if (Str::startsWith(Route::currentRouteName(), 'admin.'))
    @include('admin.components.outstanding_order_tasks.outstanding_order_tasks')
    @include('admin.components.proforma_rejected.proforma_rejected_banner')
@else
    @include('components.modals.order_detail.proforma_rejected.proforma_rejected_banner')
@endif
