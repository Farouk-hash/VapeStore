<!-- Add Device Form (Initially Hidden) -->
<div id="addDeviceFormContainer" class="card mb-4">
    
    <div class="card-header bg-primary text-white">
        <h4 class="mb-0">
            <i class="mdi mdi-plus-circle"></i>
            إضافة جهاز جديد - {{ $brand->name ?? 'العلامة التجارية' }}
        </h4>
        <button type="button" class="close text-white" aria-label="إغلاق" wire:click="cancelForm">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <div class="card-body">
        <form id="addDeviceForm" wire:submit.prevent='save'>
            
            <!-- Basic Information -->
            <div class="form-section">
                <h5 class="section-title">المعلومات الأساسية</h5>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="device_name">اسم الجهاز *</label>
                            <input type="text" class="form-control" id="device_name" wire:model.defer="name" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="device_model">الموديل</label>
                            <input type="text" class="form-control" id="device_model" wire:model.defer="model">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="device_release_year">سنة الإصدار</label>
                            <input type="number" class="form-control" id="device_release_year" wire:model.defer="release_year" 
                                   min="2000" max="{{ date('Y') }}" value="{{ date('Y') }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="device_sku">SKU (كود المنتج)</label>
                            <input type="text" class="form-control" id="device_sku" wire:model.defer="sku">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="device_price">السعر (اختياري)</label>
                            <input type="number" class="form-control" id="device_price" wire:model.defer="price" step="0.01" min="0">
                        </div>
                    </div>

                    @if($categories)
                        <div class="form-section">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="section-title mb-0">التصنيفات المتاحة</h5>   
                            </div>
                                        
                            <div class="form-group flavor-field-group">
                                <div class="input-group">

                                    <select class="form-control" wire:model.live="category_id">
                                        <option value="">اختر تصنيف</option>
                                        @foreach($categories as $index => $category)
                                            <option value="{{ $category->id }}">{{ $category->slug }}</option>
                                        @endforeach
                                        
                                    </select>
                                </div>
                            </div>
                        </div>
                    @endif
                    
                    @if($category_id == 2)
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="device_puffs">عدد الانفاس</label>
                                <input type="number" class="form-control" id="device_puffs" wire:model.defer="device_puffs" step="1" min="0">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="device_puffs_nicotine_strength">نوع النيكوتين</label>
                                <input type="text" class="form-control" id="device_puffs_nicotine_strength" wire:model.defer="device_puffs_nicotine_strength">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="device_puffs_nicotine_type">درجه النيكوتين</label>
                                <input type="number" class="form-control" id="device_puffs_nicotine_type" wire:model.defer="device_puffs_nicotine_type" step="1" min="0">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="device_puffs_ice_type">نوع الايس</label>
                                <input type="text" class="form-control" id="device_puffs_ice_type" wire:model.defer="device_puffs_ice_type" placeholder="Ice , Non-Ice , Mixed">
                            </div>
                        </div>
                    @endif

                </div>

                <div class="form-group">
                    <label for="device_description">وصف الجهاز</label>
                    <textarea class="form-control" id="device_description" wire:model.defer="description" rows="3"></textarea>
                </div>

                
            </div>

            <!-- Colors Section -->
            <div class="form-section">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="section-title mb-0">الألوان المتاحة</h5>
                    <button type="button" class="btn btn-sm btn-outline-primary" wire:click="addColorField">
                        <i class="mdi mdi-plus"></i> إضافة لون آخر
                    </button>
                </div>
                
                @if($colorFields && count($colorFields) > 0)
                    @foreach($colorFields as $index => $colorField)
                    <div class="form-group color-field-group">
                        <div class="input-group">
                            <input type="text" class="form-control" 
                                   wire:model="colorFields.{{ $index }}" 
                                   placeholder="اسم اللون">
                            @if($index > 0)
                            <div class="input-group-append">
                                <button class="btn btn-outline-danger" type="button" 
                                        wire:click="removeColorField({{ $index }})">
                                    <i class="mdi mdi-close"></i>
                                </button>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="form-group">
                        <input type="text" class="form-control" id="device_colors" name="colors" 
                               placeholder="مثال: أسود، أبيض، أزرق، أحمر">
                        <small class="form-text text-muted">اكتب الألوان مفصولة بفاصلة أو فاصلة منقوطة</small>
                    </div>
                @endif
                
                <div id="colors_preview" class="tags-preview mt-2"></div>
            </div>

            <!-- Features Section -->
            <div class="form-section">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="section-title mb-0">الميزات</h5>
                    <button type="button" class="btn btn-sm btn-outline-primary" wire:click="addFeatureField">
                        <i class="mdi mdi-plus"></i> إضافة ميزة أخرى
                    </button>
                </div>
                
                @if($featureFields && count($featureFields) > 0)
                    @foreach($featureFields as $index => $featureField)
                    <div class="form-group feature-field-group">
                        <div class="input-group">
                            <input type="text" class="form-control" 
                                   wire:model="featureFields.{{ $index }}" 
                                   placeholder="اسم الميزة">
                            @if($index > 0)
                            <div class="input-group-append">
                                <button class="btn btn-outline-danger" type="button" 
                                        wire:click="removeFeatureField({{ $index }})">
                                    <i class="mdi mdi-close"></i>
                                </button>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="form-group">
                        <input type="text" class="form-control" id="device_features" name="features" 
                               placeholder="مثال: شحن سريع، مقاوم للماء، بلوتوث، شاشة OLED">
                        <small class="form-text text-muted">اكتب الميزات مفصولة بفاصلة</small>
                    </div>
                @endif
                
                <div id="features_preview" class="tags-preview mt-2"></div>
            </div>

            <!-- Flavors Section -->
            <div class="form-section">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="section-title mb-0">النكهات المتاحة</h5>
                    <button type="button" class="btn btn-sm btn-outline-primary" wire:click="addFlavorField">
                        <i class="mdi mdi-plus"></i> إضافة نكهة أخرى
                    </button>
                </div>
                
                @if($flavorFields && count($flavorFields) > 0)
                    @foreach($flavorFields as $index => $flavorField)
                    <div class="form-group flavor-field-group">
                        <div class="input-group">
                            <select class="form-control" wire:model="flavorFields.{{ $index }}">
                                <option value="">اختر نكهة</option>
                                @foreach($flavors as $flavor)
                                    <option value="{{ $flavor->id }}">{{ $flavor->name }}</option>
                                @endforeach
                            </select>
                            @if($index > 0)
                            <div class="input-group-append">
                                <button class="btn btn-outline-danger" type="button" 
                                        wire:click="removeFlavorField({{ $index }})">
                                    <i class="mdi mdi-close"></i>
                                </button>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="form-group">
                        <select class="form-control select2-flavors" id="device_flavors" name="flavors[]" multiple>
                            @foreach($flavors as $flavor)
                                <option value="{{ $flavor->id }}">{{ $flavor->name }}</option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">اختر النكهات المتاحة لهذا الجهاز (للأجهزة المملوءة مسبقاً)</small>
                    </div>
                @endif
                
                <div id="flavors_preview" class="tags-preview mt-2"></div>
            </div>



            
            <!-- Specifications Section -->
            <div class="form-section">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="section-title mb-0">المواصفات التقنية</h5>
                    <button type="button" class="btn btn-sm btn-outline-primary" wire:click="addSpecField">
                        <i class="mdi mdi-plus"></i> إضافة مواصفة أخرى
                    </button>
                </div>
                
                @if($specFields && count($specFields) > 0)
                    <div id="specs_container">
                        @foreach($specFields as $index => $specField)
                        <div class="spec-row mb-2">
                            <div class="row">
                                <div class="col-md-5">
                                    <input type="text" class="form-control spec-key" 
                                           wire:model="specFields.{{ $index }}.key"
                                           placeholder="مثال: سعة البطارية">
                                </div>
                                <div class="col-md-5">
                                    <input type="text" class="form-control spec-value" 
                                           wire:model="specFields.{{ $index }}.value"
                                           placeholder="مثال: 3000mAh">
                                </div>
                                <div class="col-md-2">
                                    @if($index > 0)
                                    <button type="button" class="btn btn-danger remove-spec" 
                                            wire:click="removeSpecField({{ $index }})">
                                        <i class="mdi mdi-close"></i>
                                    </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div id="specs_container">
                        <div class="spec-row">
                            <div class="row">
                                <div class="col-md-5">
                                    <input type="text" class="form-control spec-key" name="spec_keys[]" placeholder="مثال: سعة البطارية">
                                </div>
                                <div class="col-md-5">
                                    <input type="text" class="form-control spec-value" name="spec_values[]" placeholder="مثال: 3000mAh">
                                </div>
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-danger remove-spec" style="display: none;">
                                        <i class="mdi mdi-close"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-secondary btn-sm mt-2" id="add_spec_btn">
                        <i class="mdi mdi-plus"></i> إضافة مواصفة
                    </button>
                @endif
            </div>

            <!-- Images Section -->
    <div class="flavor-form-section">
        <h4 class="flavor-form-section-title">صور النكهة</h4>
        <div class="flavor-form-group">
            <label class="flavor-form-label">اختر الصور (يمكنك رفع أكثر من صورة)</label>
            <input type="file" wire:model="images" class="form-control" accept="image/*" multiple>
            
            <div wire:loading wire:target="images" class="text-info mt-2">
                جاري رفع الصور...
            </div>

            <div class="mt-3 d-flex flex-wrap gap-2">
                @if($images)
                    @foreach($images as $index=>$image)
                        <div class="position-relative">
                            <img src="{{ $image->temporaryUrl() }}" 
                                 class="img-thumbnail rounded" 
                                 style="width: 120px; height: 120px; object-fit: cover;">
                            <button type="button" 
                                    wire:click="removeImage({{ $index}})"
                                    class="btn btn-sm btn-danger position-absolute top-0 end-0 rounded-circle p-1">
                                <i class="mdi mdi-close"></i>
                            </button>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>


            <div class="form-actions mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="mdi mdi-content-save"></i> حفظ الجهاز
                </button>
                <button type="button" class="btn btn-secondary" id="cancelAddDevice" wire:click="cancelForm">
                    <i class="mdi mdi-close"></i> إلغاء
                </button>
            </div>
        </form>
    </div>
</div>

