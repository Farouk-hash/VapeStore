<div class="row row-sm">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                
                <!-- Brand Header -->
                <div class="text-center mb-4">
                    <h2 class="text-primary">{{ $brand->name }}</h2>
                    <p class="text-muted">{{ $brand->description ?? 'عرض جميع النكهات والخيارات المتاحة' }}</p>
                </div>

@if($showEditForm)
    <livewire:liquids-brands.items-details.edit :id="$id" >

@elseif($showInventoryForm)
    <livewire:liquids-brands.items-details.inventory :id="$id" >
  
@elseif($showDetails)
    <livewire:liquids-brands.items-details.details :id="$id">

@else 

    <div class="text-center">
        <button class="add-flavor-main-btn" type="button" wire:click="$set('showFlavorFormVariable',true)">
            <i class="mdi mdi-plus-circle"></i>
            إضافة نكهة جديدة
        </button>
    </div>

    @if($showFlavorFormVariable)
        <livewire:liquids-brands.items-details.create-item :id="$brand->id">
    
    @else

        <!-- Statistics -->
        <div class="stats-row">
            <div class="row">
                <div class="col-md-4">
                    <div class="stat-item">
                        <div class="stat-number">{{ $brand->flavours->count() }}</div>
                        <div class="stat-label">النكهات</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-item">
                        <div class="stat-number">{{ $brand->flavours->flatMap->liquids->count() }}</div>
                        <div class="stat-label">إجمالي الخيارات</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-item">
                        <div class="stat-number">{{ $brand->flavours->flatMap->liquids->flatMap->strengthNic->count() }}</div>
                        <div class="stat-label">التراكيز المتاحة</div>
                    </div>
                </div>
            </div>
        </div>


        <div id="flavoursContainer">
    @forelse($brand->flavours as $flavour)
        <div class="flavour-card" data-flavour-id="{{ $flavour->id }}">
            <div class="flavour-header d-flex justify-content-between align-items-center">
                <!-- Title & options count -->
                <div>
                    <h3 class="flavour-title mb-0">{{ $flavour->name }}</h3>
                    <small>{{ $flavour->liquids->count() }} خيار متاح</small>
                </div>

                <!-- Smooth rounded buttons -->
                <div class="inventory-management d-flex gap-2">
                    <button class="btn btn-success btn-sm rounded-pill px-3 shadow-sm" wire:click="edit({{$flavour->id}})">
                        <i class="fas fa-pen me-1"></i> تعديل
                    </button>

                    <button class="btn btn-primary btn-sm rounded-pill px-3 shadow-sm" wire:click="getDetails({{$flavour->id}})">
                        <i class="fas fa-eye me-1"></i> عرض التفاصيل
                    </button>

                    <button class="btn btn-warning btn-sm rounded-pill px-3 shadow-sm" wire:click="inventory({{$flavour->id}})">
                        <i class="fas fa-warehouse me-1"></i> إدارة المخزون
                    </button>
                </div>
            </div>
        </div>
    @empty
        <div class="alert alert-info text-center">
            <h5>لا توجد نكهات متاحة</h5>
            <p>لم يتم إضافة أي نكهات لهذه العلامة التجارية بعد.</p>
        </div>
    @endforelse
</div>


        <!-- No Results -->
        <div id="noResults" class="alert alert-warning text-center" style="display: none;">
            <i class="mdi mdi-magnify fa-2x mb-3"></i>
            <h5>لا توجد نتائج</h5>
            <p>لا توجد نكهات تطابق الفلاتر المحددة.</p>
        </div>
    @endif

            </div>
        </div>
    </div>
</div>
@endif

