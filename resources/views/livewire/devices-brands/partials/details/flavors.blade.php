<!-- Flavors Section -->
@if($device->flavors && $device->flavors->count() > 0)
<div class="card mb-3 border shadow-sm">
    <div class="card-header bg-light d-flex justify-content-between align-items-center py-3">
        <h6 class="mb-0 text-dark fw-bold">
            <i class="mdi mdi-cup text-primary me-2"></i> النكهات المتاحة
        </h6>
        <span class="section-toggle text-primary">
            <i class="mdi mdi-chevron-down"></i>
        </span>
    </div>
    <div class="card-body">
        <div class="d-flex flex-wrap gap-2">
            @foreach($device->flavors as $componentFlavor)
            <span class="badge bg-warning text-dark fs-6 px-3 py-2">
                <i class="fas fa-ice-cream me-1"></i> {{ $componentFlavor->name }}
            </span>
            @endforeach
        </div>
    </div>
</div>
@else 
<div class="alert alert-warning mb-3">
    <i class="fas fa-exclamation-triangle me-2"></i> لا توجد نكهات متاحة
</div>
@endif 
