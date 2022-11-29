<div class="d-md-flex align-items-center justify-content-center nav nav-tabs border-0" role="tablist">
    <a class="p-2 border border-secondary active" id="step1-tab" data-toggle="tab" href="#step1" role="tab" aria-controls="step1" aria-selected="true" style="border-radius: 8px;">
        <div class="d-flex align-items-center justify-content-center">
            <div class="border border-primary bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 30px; height: 30px">
                <p class="mb-0">1</p>
            </div>
            <p class="mb-0 ml-2 text-dark">Input Data</p>
        </div>
    </a>

    <div class="d-flex align-items-center justify-content-center">
        <div class="d-none d-md-block border-top {{ 'border-secondary'}} mx-2" style="width: 20px; height: 1px"></div>
        <div class="d-block d-md-none border-right {{ 'border-secondary'}} mx-2" style="width: 1px; height: 15px"></div>
    </div>

    <a class="steps-tab p-2 disabled" id="step2-tab" data-toggle="tab" href="#step2" role="tab" aria-controls="step2" aria-selected="false" style="border-radius: 8px;">
        <div class="d-flex align-items-center justify-content-center">
            <div class="border border-secondary text-secondary rounded-circle d-flex align-items-center justify-content-center" style="width: 30px; height: 30px">
                <p class="mb-0">2</p>
            </div>
            <p class="mb-0 ml-2 text-secondary">Choose Cargo / Containers</p>
        </div>
    </a>

    <div class="d-flex align-items-center justify-content-center">
        <div class="d-none d-md-block border-top {{ 'border-secondary'}} mx-2" style="width: 20px; height: 1px"></div>
        <div class="d-block d-md-none border-right {{ 'border-secondary'}} mx-2" style="width: 1px; height: 15px"></div>
    </div>

    <a class="steps-tab p-2 disabled" id="step3-tab" data-toggle="tab" href="#step3" role="tab" aria-controls="step3" aria-selected="false" style="border-radius: 8px;">
        <div class="d-flex align-items-center justify-content-center">
            <div class="border border-secondary text-secondary rounded-circle d-flex align-items-center justify-content-center" style="width: 30px; height: 30px">
                <p class="mb-0">3</p>
            </div>
            <p class="mb-0 ml-2 text-secondary">Finalize Order</p>
        </div>
    </a>
</div>

@push('scripts')
    <script>
        $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {
            $(e.target).addClass('border border-secondary'); // newly activated tab
            $(e.relatedTarget).removeClass('border border-secondary'); // previous active tab
        });

        function resetSteps() {
            $('#step1-tab > div > div').removeClass('border-success bg-success').addClass('border-primary bg-primary text-white');
            $('#step1-tab > div > p').removeClass('text-secondary').addClass('text-dark');

            $('#step2-tab > div > div').removeClass('border-success bg-success border-primary bg-primary text-white').addClass('border-secondary text-secondary');
            $('#step2-tab > div > p').removeClass('text-dark').addClass('text-secondary');

            $('#step3-tab > div > div').removeClass('border-success bg-success border-primary bg-primary text-white').addClass('border-secondary text-secondary');
            $('#step3-tab > div > p').removeClass('text-dark').addClass('text-secondary');

            $('.steps-tab').addClass('disabled');
        }

        function advanceStep(step_number) {
            $(`#step${step_number}-tab > div > div`).removeClass('border-secondary text-secondary').addClass('border-primary bg-primary text-white');
            $(`#step${step_number}-tab > div > p`).removeClass('text-secondary').addClass('text-dark');

            $(`#step${step_number-1}-tab > div > div`).removeClass('border-primary bg-primary').addClass('border-success bg-success');
            $(`#step${step_number-1}-tab > div > p`).removeClass('text-dark').addClass('text-secondary');

            $(`#step${step_number}-tab`).removeClass('disabled').tab('show');
        }

        function gotoStep(step_number) {
            $(`#step${step_number}-tab`).tab('show');
        }

</script>
@endpush
