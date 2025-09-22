<div class="container my-5 p-4 bg-light rounded-3 shadow-lg">

    <div class="mb-4">
        <label for="brand" class="form-label fw-bold">🏷️ اختر الماركة</label>
        <select id="brand" wire:model="selectedBrand" wire:change="onBrandChanged" class="form-select shadow-sm">
            <option value="">-- اختر ماركة --</option>
            @foreach($brands as $brand)
                <option value="{{ $brand->id }}">{{ $brand->name }} {{$brand->id}}</option>
            @endforeach
        </select>
    </div>


    @if($tanks)
        <div class="mb-4">
            <label for="flavor" class="form-label fw-bold">🍭 اختر التانك</label>
            <select id="flavor" wire:model="selectedTank" wire:change="onTankChanged" class="form-select shadow-sm">
                <option value="">-- اختر جهاز --</option>
                @foreach($tanks as $tank)
                    <option value="{{ $tank->id }}">{{ $tank->name }} {{$tank->id}}</option>
                @endforeach
            </select>
        </div>
        
        @if($selectedTanks && $selectedTanks->count() > 0)
            <div class="d-flex flex-column gap-4">
                @foreach($selectedTanks as $tank)
                        @if($tank->sum('stock_quantity') > 0)
                            <?php 
                                $qtyData = $quantities[$tank->id] ?? null; 
                                $calculatedQuantity = isset($qtyData['quantity']) ? (int)$qtyData['quantity'] : 0 ; 
                             ?>
                            <div class="card border-0 shadow-sm">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start mb-3">
                                        <div>
                                            <h6 class="fw-bold mb-1">{{ $tank->tankDetails()['name'] }}</h6>
                                            <small class="text-muted">
                                                السعر الأساسي: <span class="fw-semibold">{{ $tank->base_price }}</span>
                                            </small>
                                        </div>

                                        <span class="badge {{ $tank->tankDetails()['quantities'] > 0 ? 'bg-success' : 'bg-danger' }} rounded-pill px-3 py-2">
                                            {{ $tank->tankDetails()['quantities'] - $calculatedQuantity   }} وحدة متاحة
                                        </span>
                                    </div>

                                    <div class="d-flex flex-wrap justify-content-end align-items-center gap-3">
                                        <input 
                                            type="number"
                                            min="1"
                                            max="{{ $tank->tankDetails()['quantities'] }}"
                                            wire:model.lazy="quantities.{{ $tank->tank_id }}_{{$tank->id}}"
                                            class="form-control w-auto shadow-sm"
                                            placeholder="ادخل الكمية">

                                       
                                        
                                        @if($qtyData)
                                            <span class="fw-semibold text-primary">
                                                💰 الإجمالي: {{ $qtyData['total_price_per_item'] }}
                                            </span>
                                        @endif

                                        @error('quantities.' . $tank->tank_id . '_' . $tank->id)
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        @endif
                @endforeach
            </div>

           

        @elseif($selectedTanks)
            <div class="alert alert-warning mt-4 shadow-sm border-0">
                ⚠️ لا توجد متغيرات متاحة للتانك المختارة.
            </div>
        @endif 
    @else 
        <div class="alert alert-warning mt-4 shadow-sm border-0">
            ⚠️ لا توجد متغيرات متاحة للتانكات.
        </div>
    @endif
    
</div>
