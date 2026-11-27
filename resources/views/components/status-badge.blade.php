@props(['status'])

@php
    $statuses = [
        'active' => [
            'label' => 'Aktif',
            'class' => 'bg-brand-softer text-fg-brand-strong',
        ],
        'published' => [
            'label' => 'Dipublikasikan',
            'class' => 'bg-brand-softer text-fg-brand-strong',
        ],

        'completed' => [
            'label' => 'Selesai',
            'class' => 'bg-success-soft text-fg-success-strong',
        ],
        'approved' => [
            'label' => 'Disetujui',
            'class' => 'bg-success-soft text-fg-success-strong',
        ],

        'pending' => [
            'label' => 'Menunggu',
            'class' => 'bg-warning-soft text-fg-warning',
        ],
        'processing' => [
            'label' => 'Diproses',
            'class' => 'bg-warning-soft text-fg-warning',
        ],

        'rejected' => [
            'label' => 'Ditolak',
            'class' => 'bg-danger-soft text-fg-danger-strong',
        ],
        'inactive' => [
            'label' => 'Tidak Aktif',
            'class' => 'bg-danger-soft text-fg-danger-strong',
        ],
        'cancelled' => [
            'label' => 'Dibatalkan',
            'class' => 'bg-danger-soft text-fg-danger-strong',
        ],

        'draft' => [
            'label' => 'Draft',
            'class' => 'bg-neutral-secondary-medium text-heading',
        ],
    ];

    $currentStatus = $statuses[strtolower($status)] ?? [
        'label' => ucfirst($status),
        'class' => 'bg-neutral-primary-soft text-heading',
    ];
@endphp

<span
    {{ $attributes->merge([
        'class' => 'inline-flex items-center px-2 py-1 text-sm font-medium rounded ' . $currentStatus['class'],
    ]) }}>
    {{ $currentStatus['label'] }}
</span>
