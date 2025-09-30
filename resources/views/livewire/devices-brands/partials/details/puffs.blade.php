<!-- Puffs Section -->
@if($device->puffs && $device->puffs->count() > 0)
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
            <div class="row">
                @foreach($device->puffs as $puff)
                    <div class="col-md-6 mb-3">
                        <div class="card shadow-sm border rounded p-3 h-100">
                            <h6 class="fw-bold text-primary mb-3">
                                <i class="mdi mdi-resistor me-1"></i> {{ $puff->value }}
                            </h6>
                            <ul class="list-unstyled mb-0">
                                <li class="mb-2">
                                    <span class="fw-bold text-secondary">Nic Strength:</span>
                                    <span class="badge bg-secondary">{{ $puff->nicotine_strength }}</span>
                                </li>
                                <li class="mb-2">
                                    <span class="fw-bold text-info">Nic Type:</span>
                                    <span class="badge bg-info">{{ $puff->nicotine_type }}</span>
                                </li>
                                <li class="mb-2">
                                    <span class="fw-bold text-success">Ice Type:</span>
                                    <span class="badge bg-success">{{ $puff->ice_type }}</span>
                                </li>
                                
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>

    </div>
</div>
@endif
