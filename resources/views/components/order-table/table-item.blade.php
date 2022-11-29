@aware(['defaulttype' => 'outstanding', 'headers' => ['', 'Ticket No.', 'Created Date', 'Customer', 'Location', 'Status', '' ], 'id'])
@props(['type', 'actionApi'])

<div {{ $attributes->class(['tab-pane', 'show' => ($type == $defaulttype), 'active' => ($type == $defaulttype)]) }}
        id="order-table-{{ $id }}-tabs-{{ $type }}" role="tabpanel" aria-labelledby="order-table-{{ $id }}-tabs-{{ $type }}-tab" data-type="{{ $type }}" data-api="{{ $actionApi }}">
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-interactive no-wrap v-middle mb-0 w-100" id="order-table-{{ $id }}-{{ $type }}-table">
                    <thead>
                        <tr class="border-0">
                            @foreach ($headers as $header)
                                <th class="border-0 font-14 font-weight-medium text-muted px-2">{{ $header }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
