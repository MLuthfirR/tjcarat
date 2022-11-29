@if (Str::startsWith(Route::currentRouteName(), 'mgmt.'))
    <button type="button" class="btn btn-outline-danger btn-sm font-12" onclick="updateStatus(this, 'cancelled')">Cancel Order</button>
@else
    <p class="text-muted font-12 m-0">Order can only be cancelled by management</p>
    <p class="text-muted font-12 m-0">Please contact us for cancellation request</p>
@endif
