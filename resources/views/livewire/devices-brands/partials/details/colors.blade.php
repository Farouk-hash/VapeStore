<!-- Colors Section -->
@if($device->colors && $device->colors->count() > 0)
<div class="card mb-3 border shadow-sm">
    <div class="card-header bg-light d-flex justify-content-between align-items-center py-3">
        <h6 class="mb-0 text-dark fw-bold">
            <i class="mdi mdi-palette text-primary me-2"></i> الألوان المتاحة
        </h6>
        <span class="section-toggle text-primary">
            <i class="mdi mdi-chevron-down"></i>
        </span>
    </div>
    <div class="card-body">
        <div class="d-flex flex-wrap gap-2">
            @foreach($device->colors as $color)
            <span class="badge bg-primary fs-6 px-3 py-2">{{ $color->name ?? $color->value }}</span>
            @endforeach
        </div>
    </div>
</div>
@else
<div class="alert alert-warning mb-3">
    <i class="fas fa-exclamation-triangle me-2"></i> لا توجد ألوان متاحة
</div>
@endif
