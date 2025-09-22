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
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
        @if($selectedCategory)
            <button class="btn btn-outline-primary shadow-sm rounded-2 px-3 py-1" type='button' 
            wire:click='onResetCategories'>اعاده تعيين التصنيفات</button>
        @endif
    </div>
    @if($selectedCategory)
        <label for="components" class="form-label fw-bold">🧩 اختر المكونات</label>
        <select id="components" 
                wire:model="selectedComponents" 
                wire:change="onComponentsChanged" 
                class="form-select shadow-sm" 
                multiple>
            @foreach($filteredComponents as $component)
                <option value="{{ $component['id'] }}">{{ $component['name'] }}</option>
            @endforeach
        </select>

        <small class="text-muted">يمكنك اختيار أكثر من مكون بالضغط مع الاستمرار على Ctrl (Windows) أو ⌘ (Mac)</small>
    @endif



    {{-- اختيار النكهة --}}
    @if($flavors)
        <div class="mb-4">
            <label for="flavor" class="form-label fw-bold">🍭 اختر النكهة</label>
            <select id="flavor" wire:model="selectedFlavor" wire:change="onFlavorChanged" class="form-select shadow-sm">
                <option value="">-- اختر نكهة --</option>
                @foreach($flavors as $flavor)
                    <option value="{{ $flavor->id }}">{{ $flavor->name }}</option>
                @endforeach
            </select>
        </div>

        {{-- قائمة السوائل --}}
        @if($selectedLiquids && $selectedLiquids->count() > 0)
            <div class="d-flex flex-column gap-4">
                @foreach($selectedLiquids as $liquid)
                    @foreach($liquid->strengthNic as $strength)
                        @if($strength->inventories->sum('stock_received') > 0)
                            <div class="card border-0 shadow-sm">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start mb-3">
                                        <div>
                                            <h6 class="fw-bold mb-1">{{ $liquid->nicotine_type }} - {{ $liquid->vape_style }}</h6>
                                            <small class="text-muted d-block mb-1">
                                                التركيز: <span class="fw-semibold">{{ $strength->strength }}</span>
                                            </small>
                                            <small class="text-muted">
                                                السعر الأساسي: <span class="fw-semibold">{{ $strength->inventories[0]->base_price }}</span>
                                            </small>
                                        </div>

                                        <span class="badge {{ $strength->inventories->sum('stock_received') > 0 ? 'bg-success' : 'bg-danger' }} rounded-pill px-3 py-2">
                                            {{ $strength->inventories->sum('stock_received') }} وحدة متاحة
                                        </span>
                                    </div>

                                    <div class="d-flex flex-wrap justify-content-end align-items-center gap-3">
                                        <input 
                                            type="number"
                                            min="1"
                                            max="{{ $strength->inventories->sum('stock_received') }}"
                                            wire:model.lazy="quantities.{{ $liquid->id }}_{{ $strength->id }}"
                                            class="form-control w-auto shadow-sm"
                                            placeholder="ادخل الكمية">

                                        <?php 
                                            $qtyData = $quantities[$strength->id] ?? null; 
                                        ?>
                                        
                                        @if($qtyData)
                                            <span class="fw-semibold text-primary">
                                                💰 الإجمالي: {{ $qtyData['total_price_per_item'] }}
                                            </span>
                                        @endif

                                        @error('quantities.' . $liquid->id . '_' . $strength->id)
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endforeach
            </div>

           

        @elseif($selectedFlavor)
            <div class="alert alert-warning mt-4 shadow-sm border-0">
                ⚠️ لا توجد متغيرات متاحة للنكهة المختارة.
            </div>
        @endif
    @endif
    
</div>
