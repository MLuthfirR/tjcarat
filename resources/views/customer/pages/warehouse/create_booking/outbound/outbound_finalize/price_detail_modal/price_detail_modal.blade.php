<div class="modal fade" id="price-detail-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header border-0">
                <div class="modal-title w-100">
                    <div class="row">
                        <div class="col-10 col-sm-11">
                            <div class="row">
                                <div class="col-6">
                                    <h5 class="modal-title-text modal-ticket-number text-left">Price Detail</h5>
                                </div>
                                <div class="col-6">
                                    {{-- <p class="text-right mb-1 mx-3 w-100 font-14">Last updated: <span id="last-updated-detail-date">-</span> <a href="javascript:" onclick="refreshOrderDetail(this)"><i class="fas fa-sync-alt" id="refresh-detail-button"></i></a></p> --}}
                                </div>
                            </div>
                        </div>
                        <div class="col-2 col-sm-1">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-body px-0">
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        function emptyPriceDetail() {
            $('#price-detail-modal').find('.modal-body').empty();
        }

        function populatePriceDetailContainer(containers_charges, total_amt) {
            containers_charges.forEach((container_charges, index) => {
                $('#price-detail-modal').find('.modal-body').append(`
                    <div class="mx-3 mx-lg-5 mb-3 p-3 bg-light" style="border-radius: 8px">
                        <div>
                            <p class="mb-0 text-secondary">Container</p>
                            <h5 class="font-weight-medium text-dark">${container_charges.container_number}</h5>
                        </div>
                        <p class="mb-2 text-secondary">Charges</p>
                        <div id="price-detail-${index}" class="bg-white shadow-sm py-2 px-3" style="border-radius: 8px">
                            <div class="row mb-3">
                                <div class="col-6 col-md-4 font-weight-medium">Charge</div>
                                <div class="col-4 d-none d-md-block font-weight-medium">Qty</div>
                                <div class="col-6 col-md-4 font-weight-medium text-right">Price</div>
                            </div>
                        </div>
                    </div>
                `);
                container_charges.charges.forEach(charge => {
                    $('#price-detail-'+index).append(`
                    <div class="row">
                        <div class="col-12 col-md-4">
                            <h5 class="mb-0 font-14 font-weight-medium text-dark">${charge.CHARGE_CODE}</h5>
                            <p class="mb-2 text-secondary font-12">${charge.CHARGE_DESC}</p>
                        </div>
                        <div class="col-6 col-md-4">
                            <p class="text-dark font-14">${charge.CHARGE_QTY} <span class="text-secondary">@ Rp${formatPrice(charge.QUOT_PRICE)}</span></p>
                        </div>
                        <div class="col-6 col-md-4">
                            <p class="font-14 font-weight-medium text-dark text-right">Rp${formatPrice(charge.TOTAL_AMOUNT)}</p>
                        </div>
                    </div>
                `);
                });
            });
            $('#price-detail-modal').find('.modal-body').append(`
                <div class="mx-3 mx-lg-5 mb-3 px-3 text-right">
                    <div class="px-2">
                        <p class="mb-0 font-14 text-secondary">Total Price</p>
                        <h5 class="text-dark font-weight-medium">Rp${formatPrice(total_amt)}</h5>
                    </div>
                </div>
            `);
        }

        function populatePriceDetailBL(bl_no, charges, total_amt) {
            $('#price-detail-modal').find('.modal-body').append(`
                <div class="mx-3 mx-lg-5 mb-3 p-3 bg-light" style="border-radius: 8px">
                    <div>
                        <p class="mb-0 text-secondary">B/L</p>
                        <h5 class="font-weight-medium text-dark">${bl_no}</h5>
                    </div>
                    <p class="mb-2 text-secondary">Charges</p>
                    <div id="price-detail-${bl_no}" class="bg-white shadow-sm py-2 px-3" style="border-radius: 8px">
                        <div class="row mb-3">
                            <div class="col-6 col-md-4 font-weight-medium">Charge</div>
                            <div class="col-4 d-none d-md-block font-weight-medium">Qty</div>
                            <div class="col-6 col-md-4 font-weight-medium text-right">Price</div>
                        </div>
                    </div>
                </div>
                <div class="mx-3 mx-lg-5 mb-3 px-3 text-right">
                    <div class="px-2">
                        <p class="mb-0 font-14 text-secondary">Total Price</p>
                        <h5 class="text-dark font-weight-medium">Rp${formatPrice(total_amt)}</h5>
                    </div>
                </div>
            `);
            charges.forEach(charge => {
                $('#price-detail-'+bl_no).append(`
                    <div class="row">
                        <div class="col-12 col-md-4">
                            <h5 class="mb-0 font-14 font-weight-medium text-dark">${charge.CHARGE_CODE}</h5>
                            <p class="mb-2 text-secondary font-12">${charge.CHARGE_DESC}</p>
                        </div>
                        <div class="col-6 col-md-4">
                            <p class="text-dark font-14">${charge.CHARGE_QTY} <span class="text-secondary">@ Rp${formatPrice(charge.QUOT_PRICE)}</span></p>
                        </div>
                        <div class="col-6 col-md-4">
                            <p class="font-14 font-weight-medium text-dark text-right">Rp${formatPrice(charge.TOTAL_AMOUNT)}</p>
                        </div>
                    </div>
                `);
            });
        }

</script>
@endpush
