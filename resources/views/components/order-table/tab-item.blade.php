@aware(['defaulttype' => 'outstanding', 'id'])
@props(['type', 'label', 'badgeClass' => 'badge-light'])

<li class="nav-item">
    <a {{ $attributes->class(['nav-link', 'active' => ($type == $defaulttype)]) }}
        id="order-table-{{ $id }}-tabs-{{ $type }}-tab" data-type="{{ $type }}" data-toggle="pill" href="#order-table-{{ $id }}-tabs-{{ $type }}" role="tab" aria-controls="order-table-{{ $id }}-tabs-{{ $type }}" aria-selected="true">{{ ucwords($label ?? $type) }}
        <span {{ $attributes->class(['badge', $badgeClass]) }} data-type="{{ $type }}">0</span>
    </a>
</li>
