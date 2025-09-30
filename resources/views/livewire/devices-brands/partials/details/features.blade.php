@if($device->features && $device->features->count() > 0)
<div class="card mb-3 border shadow-sm">
    <div class="card-header bg-light d-flex justify-content-between align-items-center py-3">
        <h6 class="mb-0 text-dark fw-bold">
            <i class="mdi mdi-star text-primary me-2"></i> الميزات
        </h6>
        <span class="section-toggle text-primary">
            <i class="mdi mdi-chevron-down"></i>
        </span>
    </div>
    <div class="card-body">
        <div class="d-flex flex-wrap gap-2">
            @foreach($device->features as $feature)
            <span class="badge bg-success fs-6 px-3 py-2">
                <i class="fas fa-check me-1"></i> {{ $feature->name }}
            </span>
            @endforeach
        </div>
    </div>
</div>
@endif
