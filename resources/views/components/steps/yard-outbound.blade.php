@props(['step' => 1])

<div class="row px-0 mb-3 px-lg-3 font-14">
    <div class="col-12 d-md-flex align-items-center justify-content-center mb-4">
        <div class="d-flex align-items-center justify-content-center">
            <div class="border {{ ($step > 1) ? 'border-success bg-success' : (($step == 1) ? 'border-primary bg-primary' : 'border-secondary')}} rounded-circle d-flex align-items-center justify-content-center" style="width: 30px; height: 30px">
                <p class="mb-0 {{ ($step >= 1) ? 'text-white' : 'text-secondary'}}">1</p>
            </div>
            <p class="mb-0 ml-2 {{ ($step == 1) ? 'text-dark' : 'text-secondary'}}">Input Data</p>
        </div>

        <div class="d-flex align-items-center justify-content-center">
            <div class="d-none d-md-block border-top {{ ($step > 1) ? 'border-primary' : 'border-secondary'}} mx-2" style="width: 20px; height: 1px"></div>
            <div class="d-block d-md-none border-right {{ ($step > 1) ? 'border-primary' : 'border-secondary'}} mx-2" style="width: 1px; height: 15px"></div>
        </div>

        <div class="d-flex align-items-center justify-content-center">
            <div class="border {{ ($step > 2) ? 'border-success bg-success' : (($step == 2) ? 'border-primary bg-primary' : 'border-secondary')}} rounded-circle d-flex align-items-center justify-content-center" style="width: 30px; height: 30px">
                <p class="mb-0 {{ ($step >= 2) ? 'text-white' : 'text-secondary'}}">2</p>
            </div>
            <p class="mb-0 ml-2 {{ ($step == 2) ? 'text-dark' : 'text-secondary'}}">Choose Containers</p>
        </div>

        <div class="d-flex align-items-center justify-content-center">
            <div class="d-none d-md-block border-top {{ ($step > 2) ? 'border-primary' : 'border-secondary'}} mx-2" style="width: 20px; height: 1px"></div>
            <div class="d-block d-md-none border-right {{ ($step > 2) ? 'border-primary' : 'border-secondary'}} mx-2" style="width: 1px; height: 15px"></div>
        </div>

        <div class="d-flex align-items-center justify-content-center">
            <div class="border {{ ($step > 3) ? 'border-success bg-success' : (($step == 3) ? 'border-primary bg-primary' : 'border-secondary')}} rounded-circle d-flex align-items-center justify-content-center" style="width: 30px; height: 30px">
                <p class="mb-0 {{ ($step >= 3) ? 'text-white' : 'text-secondary'}}">3</p>
            </div>
            <p class="mb-0 ml-2 {{ ($step == 3) ? 'text-dark' : 'text-secondary'}}">Finalize Order</p>
        </div>
    </div>
</div>
