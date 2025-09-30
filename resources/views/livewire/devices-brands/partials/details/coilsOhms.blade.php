<!-- Colors Section -->
@if($device->coilsOhms && $device->coilsOhms->count() > 0)
<div class="card mb-3 border shadow-sm">
    <div class="card-header bg-light d-flex justify-content-between align-items-center py-3">
        <h6 class="mb-0 text-dark fw-bold">
            <i class="mdi mdi-palette text-primary me-2"></i> المقاومات المتاحة
        </h6>
        <span class="section-toggle text-primary">
            <i class="mdi mdi-chevron-down"></i>
        </span>
    </div>
    <div class="card-body">
        
        <div class="row">
            @foreach($device->coilsOhms as $coilsOhm)
                <div class="col-md-6 mb-3">
                    <div class="card shadow-sm border rounded p-3 h-100">
                        <h6 class="fw-bold text-primary mb-3">
                            <i class="mdi mdi-resistor me-1"></i> {{ $coilsOhm->name }}
                        </h6>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2">
                                <span class="fw-bold text-secondary">Resistance:</span>
                                <span class="badge bg-secondary">{{ $coilsOhm->resistance }}</span>
                            </li>
                            <li class="mb-2">
                                <span class="fw-bold text-info">Wattage Range:</span>
                                <span class="badge bg-info">{{ $coilsOhm->wattage_range }}</span>
                            </li>
                            <li class="mb-2">
                                <span class="fw-bold text-success">Vaping Style:</span>
                                <span class="badge bg-success">{{ $coilsOhm->vaping_style }}</span>
                            </li>
                            <li>
                                <span class="fw-bold text-dark">Description:</span>
                                <p class="mt-1 mb-0 text-muted small text-wrap">
                                    {{ $coilsOhm->description }}
                                </p>
                            </li>
                        </ul>
                    </div>
                </div>
            @endforeach
        </div>


    </div>
</div>
@else
<div class="alert alert-warning mb-3">
    <i class="fas fa-exclamation-triangle me-2"></i> لا توجد ألوان متاحة
</div>
@endif

