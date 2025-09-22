<div class="container my-5 p-4 bg-light rounded-3 shadow-lg">

    <div class="mb-4">
        <label for="brand" class="form-label fw-bold">🏷️ اختر الماركة</label>
        <select id="brand" wire:model="selectedBrand" wire:change="onBrandChanged" class="form-select shadow-sm">
            <option value="">-- اختر ماركة --</option>
            @foreach($brands as $brand)
                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-4">
        <label for="category" class="form-label fw-bold">📂 اختر التصنيف</label>
        <select id="category" wire:model="selectedCategory" wire:change="onCategoryChanged" class="form-select shadow-sm">
            <option value="">-- اختر تصنيف --</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }} -- {{$category->id}}</option>
            @endforeach
        </select>
        @if($selectedCategory)
            <button class="btn btn-outline-primary shadow-sm rounded-2 px-3 py-1" type='button' 
            wire:click='onResetCategories'>اعاده تعيين التصنيفات</button>
        @endif
    </div>

    @if($devices)
        <div class="mb-4">
            <label for="flavor" class="form-label fw-bold">🍭 اختر الجهاز</label>
            <select id="flavor" wire:model="selectedDevice" wire:change="onDeviceChanged" class="form-select shadow-sm">
                <option value="">-- اختر جهاز --</option>
                @foreach($devices as $device)
                    <option value="{{ $device->id }}">{{ $device->name }}</option>
                @endforeach
            </select>
        </div>
        @if($selectedDevices && $selectedDevices->count() > 0)
            <div class="d-flex flex-column gap-4">
                @foreach($selectedDevices as $device)
                        @if($device->sum('stock_quantity') > 0)
                            <?php 
                                $qtyData = $quantities[$device->id] ?? null; 
                                $calculatedQuantity = isset($qtyData['quantity']) ? (int)$qtyData['quantity']:0;
                            ?>
                            <div class="card border-0 shadow-sm">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start mb-3">
                                        <div>
                                            <h6 class="fw-bold mb-1">{{ $device->deviceDetails()['name'] }}</h6>
                                            
                                            <small class="text-muted">
                                                السعر الأساسي: <span class="fw-semibold">{{ $device->base_price }}</span>
                                            </small>
                                        </div>

                                        <span class="badge {{ $device->deviceDetails()['quantities'] > 0 ? 'bg-success' : 'bg-danger' }} rounded-pill px-3 py-2">
                                            {{ $device->deviceDetails()['quantities'] - $calculatedQuantity  }} وحدة متاحة
                                        </span>
                                    </div>

                                    <div class="d-flex flex-wrap justify-content-end align-items-center gap-3">
                                        <input 
                                            type="number"
                                            min="1"
                                            max="{{ $device->deviceDetails()['quantities'] }}"
                                            wire:model.lazy="quantities.{{ $device->device_id }}_{{$device->id}}"
                                            class="form-control w-auto shadow-sm"
                                            placeholder="ادخل الكمية">

                                        
                                        
                                        @if($qtyData)
                                            <span class="fw-semibold text-primary">
                                                💰 الإجمالي: {{ $qtyData['total_price_per_item'] }}
                                            </span>
                                        @endif

                                        @error('quantities.' . $device->device_id . '_' . $device->id)
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        @endif
                @endforeach
            </div>

           

        @elseif($selectedDevices)
            <div class="alert alert-warning mt-4 shadow-sm border-0">
                ⚠️ لا توجد متغيرات متاحة للنكهة المختارة.
            </div>
        @endif 
    @else 
        <div class="alert alert-warning mt-4 shadow-sm border-0">
            ⚠️ لا توجد متغيرات متاحة للاجهزه.
        </div>
    @endif
    
</div>
