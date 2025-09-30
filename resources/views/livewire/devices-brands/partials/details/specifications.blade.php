<!-- Specifications Section -->
@if($device->speces && $device->speces->count() > 0)
<div class="card mb-3 border shadow-sm">
    <div class="card-header bg-light d-flex justify-content-between align-items-center py-3">
        <h6 class="mb-0 text-dark fw-bold">
            <i class="mdi mdi-cog text-primary me-2"></i> المواصفات التقنية
        </h6>
        <span class="section-toggle text-primary">
            <i class="mdi mdi-chevron-down"></i>
        </span>
    </div>
    <div class="card-body">
        <div class="row g-3">
            @foreach($device->speces as $spec)
            <div class="col-md-6">
                <div class="border rounded p-3 bg-white">
                    <div class="text-muted small mb-1">{{ $spec->spec_key }}</div>
                    <div class="fw-bold text-dark">{{ $spec->spec_value }}</div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif
