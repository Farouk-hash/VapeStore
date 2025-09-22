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

 
    @if($items)
        <div class="mb-4">
            <label for="flavor" class="form-label fw-bold">🍭 اختر العنصر</label>
            <select id="flavor" wire:model="selectedProduct" wire:change="onProductChanged" class="form-select shadow-sm">
                <option value="">-- اختر عنصر --</option>
                @foreach($items as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div> 
        @if($selectedProducts && $selectedProducts->count() > 0)
            <div class="d-flex flex-column gap-4">
                @foreach($selectedProducts as $index => $product)
                        @if($product['quantities'] > 0)
                            <?php 
                                $qtyData = $quantities[$product['foreignId'].$selectedItem] ?? null; 
                                $calculatedQuantity = isset($qtyData['quantity']) ? (int)$qtyData['quantity']:0;
                            ?>
                            <div class="card border-0 shadow-sm">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start mb-3">
                                        <div>
                                            <h6 class="fw-bold mb-1">{{ $product['name'] }}</h6>
                                        
                                        </div>

                                        <span class="badge bg-danger rounded-pill px-3 py-2">
                                            {{ $product['quantities'] - $calculatedQuantity  }} وحدة متاحة
                                        </span>
                                    </div>

                                    <div class="d-flex flex-wrap justify-content-end align-items-center gap-3">
                                        <input 
                                            type="number"
                                            min="1"
                                            max="{{ $product['quantities'] }}"
                                            wire:model.lazy="quantities.{{ $product['foreignId'] }}"
                                            class="form-control w-auto shadow-sm"
                                            placeholder="ادخل الكمية">

                                        
                                  

                                        @error('quantities.' . $product['foreignId'] . '_' . $product['id'])
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        @endif
                @endforeach
            </div>

           

        @elseif(count($selectedProducts)==0)
            <div class="alert alert-warning mt-4 shadow-sm border-0">
                ⚠️ لا توجد متغيرات متاحة للعنصر المحدد.
            </div>
        @endif 
    @else 
        <div class="alert alert-warning mt-4 shadow-sm border-0">
            ⚠️ لا توجد متغيرات متاحة للعناصر.
        </div>
    @endif
    
</div>
