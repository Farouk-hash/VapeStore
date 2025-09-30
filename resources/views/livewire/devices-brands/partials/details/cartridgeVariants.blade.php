<!-- Colors Section -->
@if($device->variants && $device->variants->count() > 0)
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
                @foreach($device->variants as $variant)
                    <div class="col-md-6 mb-3">
                        <div class="card shadow-sm border rounded p-3 h-100">
                            
                            <ul class="list-unstyled mb-0">
                                <li class="mb-2">
                                    <span class="fw-bold text-secondary">Resistance:</span>
                                    <span class="badge bg-secondary">{{ $variant->resistance }}</span>
                                </li>
                                
                                <li class="mb-2">
                                    <span class="fw-bold text-success">Vaping Style:</span>
                                    <span class="badge bg-success">{{ $variant->vaping_style }}</span>
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


