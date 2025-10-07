<div class="row row-sm">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                
                <!-- Brand Header -->
                <div class="text-center mb-4">
                    <h2 class="text-primary">{{ $devices[0]->brand->name }}</h2>
                    <p class="text-muted">{{ $devices[0]->brand->description ?? 'عرض جميع النكهات والخيارات المتاحة' }}</p>
                </div>

@if($showEditForm)
    @if($slug == 'tanks')
        <livewire:devices-brands.tanks-details.edit :id="$id" >
    @elseif($slug =='coils-pods')
        <livewire:devices-brands.coils-details.edit :id="$id" >
    @elseif($slug == 'cartridges')
        <livewire:devices-brands.cartridges-details.edit :id="$id" >
    @else
        <livewire:devices-brands.items-details.edit :id="$id" >
    @endif

@elseif($showInventoryForm)
    @if($slug == 'tanks')
        <livewire:devices-brands.tanks-details.inventory :id="$id" >
    @elseif($slug =='coils-pods')
        <livewire:devices-brands.coils-details.inventory :id="$id" >
    @elseif($slug == 'cartridges')
        <livewire:devices-brands.cartridges-details.inventory :id="$id" >
    @else
        <livewire:devices-brands.items-details.inventory :id="$id" >
    @endif
  
@elseif($showDetails)
    @if($slug == 'tanks')
        <livewire:devices-brands.tanks-details.details :id="$id" :forceDetails="$forceDetails">
    @elseif($slug =='coils-pods')
        <livewire:devices-brands.coils-details.details :id="$id" :forceDetails="$forceDetails">
    @elseif($slug == 'cartridges')
        <livewire:devices-brands.cartridges-details.details :id="$id" :forceDetails="$forceDetails">
    @else
        <livewire:devices-brands.items-details.details :id="$id" :forceDetails="$forceDetails">
    @endif

@else 

    <div class="text-center">
        <button class="add-flavor-main-btn" type="button" wire:click="$set('showDeviceFormVariable',true)">
            <i class="mdi mdi-plus-circle"></i>
            إضافة جهاز جديدة
        </button>
    </div>

    @if($showDeviceFormVariable)
        {{-- Tanks --}}
        @if($slug === 'tanks')
            <livewire:devices-brands.tanks-details.create-item :id="$devices[0]->brand->id" >
        {{-- Coils-Pods --}}
        @elseif($slug === 'coils-pods')
            <livewire:devices-brands.coils-details.create-item :id="$devices[0]->brand->id" >
        {{-- Cartridges --}}
        @elseif($slug === 'cartridges')
            <livewire:devices-brands.cartridges-details.create-item :id="$devices[0]->brand->id" >
        {{-- Devices  --}}
        @else 
            <livewire:devices-brands.items-details.create-item :id="$devices[0]->brand->id" :slug="$slug">
        @endif
    @else

        <!-- Statistics -->
        <div class="stats-row">
            <div class="row">
                <div class="col-md-3">
                    <div class="stat-item">
                        <div class="stat-number">{{ $devices->count() }}</div>
                        <div class="stat-label">إجمالي الأجهزة</div>
                    </div>
                </div>
                @foreach ($statistics as $index => $sta )
                    <div class="col-md-3">
                        <div class="stat-item">
                            <div class="stat-number">{{ $sta['value'] }}</div>
                            <div class="stat-label">{{$sta['label']}}</div>
                        </div>
                    </div>
                @endforeach
                
                
            </div>
        </div>

        @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
        @endif

        @if (session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
        @endif

        <div id="flavoursContainer">
            @forelse($devices as $device)
                
                <div class="flavour-card" data-flavour-id="{{ $device->id }}">
                    <div class="flavour-header d-flex justify-content-between align-items-center">
                        <!-- Title -->
                        <div>
                            <h3 class="flavour-title mb-0">{{ $device->name }}</h3>
                        </div>

                        <!-- Middle: Release year & category -->
                        <div class="device-meta small me-auto ms-3">
                            <span class="fw-bold">{{ $device->release_year }}</span>
                            <small class="ms-2">{{ $device->category->slug }}</small>
                        </div>

                        <!-- Buttons -->
                        <div class="inventory-management d-flex gap-2">
                            <button class="btn btn-success btn-sm rounded-pill px-3 shadow-sm" wire:click="edit({{$device->id}})">
                                <i class="fas fa-pen me-1"></i> تعديل
                            </button>

                            <button class="btn btn-primary btn-sm rounded-pill px-3 shadow-sm" wire:click="getDetails({{$device->id}})">
                                <i class="fas fa-eye me-1"></i> عرض التفاصيل
                            </button>

                            <button class="btn btn-warning btn-sm rounded-pill px-3 shadow-sm" wire:click="inventory({{$device->id}})">
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

