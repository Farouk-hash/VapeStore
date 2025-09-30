


<!-- Additional Information Section -->
    <div class="card mb-3 border shadow-sm">
        <div class="card-header bg-light d-flex justify-content-between align-items-center py-3">
            <h6 class="mb-0 text-dark fw-bold">
                <i class="mdi mdi-information text-primary me-2"></i> الوصف
            </h6>
            <span class="section-toggle text-primary">
                <i class="mdi mdi-chevron-down"></i>
            </span>
        </div>
        <div class="card-body">
            <p class="text-muted mb-0 lh-lg">
                {{ $device->description ?? $device->category->description ?? 'لا يوجد وصف متوفر' }}
            </p>
        </div>
    </div>
