<div class="container my-5 p-4 bg-light rounded-3 shadow-lg">

    <div class="mb-4">
        <label for="brand" class="form-label fw-bold">🏷️ اختر الماركة</label>
        <select id="brand" wire:model="selectedBrand" wire:change="onBrandChanged" class="form-select shadow-sm">
            <option value="">-- اختر ماركة --</option>
            @foreach($brands as $brand)
                <option value="{{ $brand->id }}">{{ $brand->name }}-{{$brand->id}}</option>
            @endforeach
        </select>
    </div>


    @if($coilSeries)
        <div class="mb-4">
            <label for="flavor" class="form-label fw-bold">🧬 اختر الكويل</label>
            <select id="flavor" wire:model="selectedCoilSeries" wire:change="onCoilSeriesChanged" class="form-select shadow-sm">
                <option value="">-- اختر جهاز --</option>
                @foreach($coilSeries as $coilSer)
                    <option value="{{ $coilSer->id }}">{{ $coilSer->name }}</option>
                @endforeach
            </select>
        </div>
        @if($selectedCoilSeriesInventories && count($selectedCoilSeriesInventories) > 0)
        <div class="d-flex flex-column gap-4">
            @foreach($selectedCoilSeriesInventories as $grouped_ids => $selectedCoilSeriesInventory)
                        {{-- @if($selectedCoilSeriesInventory->total_quantity > 0) --}}
                            <div class="card border-0 shadow-sm">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start mb-3">
                                        <?php 
                                            $qtyData = $quantities[$selectedCoilSeriesInventory->id] ?? null; 
                                            $calculatedQuantity = isset($qtyData) ? (int)$qtyData['quantity'] : 0 ;
                                        ?>
                                        <div>
                                            <h6 class="fw-bold mb-1">{{ $selectedCoilSeriesInventory->coilSeriesDetails()['name'] }}</h6>
                                            {{-- <small class="text-muted d-block mb-1">
                                                التركيز: <span class="fw-semibold">{{ $strength->strength }}</span>
                                            </small> --}}
                                            <small class="text-muted">
                                                السعر الأساسي: <span class="fw-semibold">{{ $selectedCoilSeriesInventory->base_price }}</span>
                                            </small>
                                        </div>

                                        <span class="badge {{ $selectedCoilSeriesInventory->coilSeriesDetails()['quantities'] > 0 ? 'bg-success' : 'bg-danger' }} rounded-pill px-3 py-2">
                                            {{ $selectedCoilSeriesInventory->coilSeriesDetails()['quantities'] - $calculatedQuantity }} وحدة متاحة
                                        </span>
                                    </div>

                                    <div class="d-flex flex-wrap justify-content-end align-items-center gap-3">
                                        <input 
                                            type="number"
                                            min="1"
                                            max="{{ $selectedCoilSeriesInventory->coilSeriesDetails()['quantities'] }}"
                                            wire:model.lazy="quantities.{{ $selectedCoilSeriesInventory->coil_series_id }}_{{$selectedCoilSeriesInventory->id}}_{{$selectedCoilSeriesInventory->coil_id}}"
                                            class="form-control w-auto shadow-sm"
                                            placeholder="ادخل الكمية">

                                        
                                        
                                        @if($qtyData)
                                            <span class="fw-semibold text-primary">
                                                💰 الإجمالي: {{ $qtyData['total_price_per_item'] }}
                                            </span>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        {{-- @else  --}}
                            {{-- ------ --}}
                        {{-- @endif --}}
                @endforeach
            </div>

           

        @elseif($selectedCoilSeriesInventories)
            <div class="alert alert-warning mt-4 shadow-sm border-0">
                ⚠️ لا توجد متغيرات متاحة للكويلز المختارة.
            </div>
        @endif 
        
    @else 
        <div class="alert alert-warning mt-4 shadow-sm border-0">
            ⚠️ لا توجد متغيرات متاحة للكويلز.
        </div>
    @endif
    
</div>
