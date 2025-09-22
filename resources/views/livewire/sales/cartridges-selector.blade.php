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

    <div class="mb-4">

        <div class="d-flex">
            
            <div class="me-3 flex-fill">
            <label for="cartridgeType" class="form-label fw-bold">📂 اختر التصنيف</label>
                <select id="cartridgeType" wire:model="selectedCartridgeType" wire:change="onSubChanged" class="form-select shadow-sm">
                        <option value="">-- اختر تصنيف --</option>
                        @foreach($cartridgeTypes as $key=>$cartridgeType)
                            <option value="{{ $cartridgeType }}">{{ $cartridgeType }}</option>
                        @endforeach
                </select>
            </div>

            <div class="me-3 flex-fill">
            <label for="vapingStyle" class="form-label fw-bold">📂 اختر الفيب</label>
                <select id="vapingStyle" wire:model="selectedVapingStyle" wire:change="onSubChanged" class="form-select shadow-sm">
                        <option value="">-- اختر تصنيف --</option>
                        @foreach($vapingStyles as $key=>$vapingStyle)
                            <option value="{{ $vapingStyle }}">{{ $vapingStyle }}</option>
                        @endforeach
                </select>
            </div>



            
            <div class="me-3 flex-fill">
            <label for="cartridgeMaterial" class="form-label fw-bold">⚙️ اختر المادة</label>
                <select id="cartridgeMaterial" wire:model="selectedCartridgeMaterial" wire:change="onSubChanged" class="form-select shadow-sm">
                    <option value="">-- اختر تصنيف --</option>
                    @foreach($cartridgeMaterials as $key=>$cartridgeMaterial)
                    <option value="{{ $cartridgeMaterial }}">{{ $cartridgeMaterial }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex-fill">
                <label for="cartridgeCoilType" class="form-label fw-bold">🌀 نوع الكويل</label>
                <select id="cartridgeCoilType" wire:model="selectedCartridgeCoilType" wire:change="onSubChanged" class="form-select shadow-sm">
                    <option value="">-- اختر تصنيف --</option>
                    @foreach($cartridgeCoilTypes as $key=>$cartridgeCoilType)
                    <option value="{{ $cartridgeCoilType }}">{{ $cartridgeCoilType }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">🔍 طريقة المطابقة</label>
                <select wire:model="matchMode" wire:change="onSubChanged" class="form-select w-auto shadow-sm">
                    <option value="any">أي من المحددات </option>
                    <option value="all">كل المحددات </option>
                </select>
            </div>

        </div>

        @if($selectedCartridgeType)
            <button class="btn btn-outline-primary shadow-sm rounded-2 px-3 py-1 mt-3" type="button" wire:click="onReset">
            اعاده تعيين التصنيفات
            </button>
        @endif
    </div>




    @if($cartridges)
        <div class="mb-4">
            <label for="flavor" class="form-label fw-bold">💊 اختر الخرطوشه</label>
            <select id="flavor" wire:model="selectedCartridge" wire:change="onCartridgeChanged" class="form-select shadow-sm">
                <option value="">-- اختر جهاز --</option>
                @foreach($cartridges as $cartridge)
                    <option value="{{ $cartridge->id }}">{{ $cartridge->name }}-{{$cartridge->capacity_ml}} ml</option>
                @endforeach
            </select>
        </div>
        
        @if($selectedcartridges && count($selectedcartridges) > 0)
            <div class="d-flex flex-column gap-4">
                @foreach($selectedcartridges as $groupIds => $cartridge)
                        @if($cartridge->sum('stock_quantity') > 0)
                            <div class="card border-0 shadow-sm">
                                <div class="card-body">
                                    <?php 
                                        $qtyData = $quantities[$cartridge->id] ?? null; 
                                        $calculatedQuantity = isset($qtyData) ? (int)$qtyData['quantity'] : 0 ;
                                    ?>
                                    <div class="d-flex justify-content-between align-items-start mb-3">
                                        <div>
                                            <h6 class="fw-bold mb-1">{{ $cartridge->cartridgeDetails()['name'] }}</h6>
                                            {{-- <small class="text-muted d-block mb-1">
                                                التركيز: <span class="fw-semibold">{{ $strength->strength }}</span>
                                            </small> --}}
                                            <small class="text-muted">
                                                السعر الأساسي: <span class="fw-semibold">{{ $cartridge->base_price }}</span>
                                            </small>
                                        </div>

                                        <span class="badge {{ $cartridge->cartridgeDetails()['quantities'] > 0 ? 'bg-success' : 'bg-danger' }} rounded-pill px-3 py-2">
                                            {{ $cartridge->cartridgeDetails()['quantities'] - $calculatedQuantity }} وحدة متاحة
                                        </span>
                                    </div>

                                    <div class="d-flex flex-wrap justify-content-end align-items-center gap-3">
                                        <input 
                                            type="number"
                                            min="1"
                                            max="{{ $cartridge->cartridgeDetails()['quantities'] }}"
                                            wire:model.lazy="quantities.{{ $cartridge->cartridge_id }}_{{$cartridge->id}}"
                                            class="form-control w-auto shadow-sm"
                                            placeholder="{{$cartridge->cartridge_id}}-{{$cartridge->id}}ادخل الكمية">

                                       
                                        
                                        @if($qtyData)
                                            <span class="fw-semibold text-primary">
                                                💰 الإجمالي: {{ $qtyData['total_price_per_item'] }}
                                            </span>
                                        @endif

                                        @error('quantities.' . $cartridge->cartridge_id . '_' . $cartridge->id)
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        @endif
                @endforeach
            </div>

           

        @elseif($selectedcartridges)
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
