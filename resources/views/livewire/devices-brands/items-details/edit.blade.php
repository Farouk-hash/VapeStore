<div>

    <div id="editDeviceFormContainer" class="card mb-4">
        <div class="card-header bg-warning text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">
                <i class="mdi mdi-pencil"></i>
                تعديل الجهاز - {{ $brand->name ?? 'العلامة التجارية' }}
            </h4>
            <button type="button" class="close text-white" aria-label="إغلاق" wire:click="cancelEdit">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="card-body">
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="إغلاق">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @if (session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="إغلاق">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <form wire:submit.prevent="update">
                <div class="form-section">
                    <h5 class="section-title">المعلومات الأساسية</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_device_name">اسم الجهاز *</label>
                                <input type="text" class="form-control" id="edit_device_name" wire:model.defer="name" required>
                                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_device_model">الموديل</label>
                                <input type="text" class="form-control" id="edit_device_model" wire:model.defer="release_year">
                                @error('model') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    @if($category_id == 2)
                        <div class="row">
                            <div class="col-md-4">
                                <label>عدد النفخات</label>
                                <input type="number" class="form-control" wire:model.defer="device_puffs">
                                @error('device_puffs') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-4">
                                <label>نوع النيكوتين</label>
                                <input type="text" class="form-control" wire:model.defer="device_puffs_nicotine_type">
                                @error('device_puffs_nicotine_type') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-4">
                                <label>تركيز النيكوتين</label>
                                <input type="text" class="form-control" wire:model.defer="device_puffs_nicotine_strength">
                                @error('device_puffs_nicotine_strength') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-4">
                                <label>نوع التبريد (Ice)</label>
                                <input type="text" class="form-control" wire:model.defer="device_puffs_ice_type">
                                @error('device_puffs_ice_type') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    @endif

                    <div class="form-group mt-3">
                        <label for="edit_device_description">وصف الجهاز</label>
                        <textarea class="form-control" id="edit_device_description" wire:model.defer="description" rows="3"></textarea>
                        @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="form-section">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="section-title mb-0">الألوان المتاحة</h5>
                        <button type="button" class="btn btn-sm btn-outline-warning" wire:click="addColorField">
                            <i class="mdi mdi-plus"></i> إضافة لون آخر
                        </button>
                    </div>
                    
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
                        @error('colorFields.'.$index) <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    @endforeach
                </div>

                <div class="form-section">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="section-title mb-0">المميزات</h5>
                        <button type="button" class="btn btn-sm btn-outline-warning" wire:click="addFeatureField">
                            <i class="mdi mdi-plus"></i> إضافة ميزة أخرى
                        </button>
                    </div>

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
                        @error('featureFields.'.$index) <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    @endforeach
                </div>

                @if($category_id === 2 )
                <div class="form-section">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="section-title mb-0">النكهات المتاحة</h5>
                        <button type="button" class="btn btn-sm btn-outline-warning" wire:click="addFlavorField">
                            <i class="mdi mdi-plus"></i> إضافة نكهة أخرى
                        </button>
                    </div>
                    
                    @foreach($flavorFields as $index => $flavorField)
                    <div class="form-group flavor-field-group">
                        <div class="input-group">
                            <select class="form-control" wire:model="flavorFields.{{ $index }}">
                                <option value="">اختر النكهة</option>
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
                        @error('flavorFields.'.$index) <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    @endforeach
                </div>
                @endif
                
                <div class="form-section">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="section-title mb-0">المواصفات الفنية</h5>
                        <button type="button" class="btn btn-sm btn-outline-warning" wire:click="addSpecField">
                            <i class="mdi mdi-plus"></i> إضافة مواصفة أخرى
                        </button>
                    </div>
                    
                    <div id="specs_container">
                        @foreach($specFields as $index => $specField)
                        <div class="spec-row mb-2">
                            <div class="row">
                                <div class="col-md-5">
                                    <input type="text" class="form-control spec-key" 
                                           wire:model="specFields.{{ $index }}.key"
                                           placeholder="مثال: سعة البطارية">
                                    @error('specFields.'.$index.'.key') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-5">
                                    <input type="text" class="form-control spec-value" 
                                           wire:model="specFields.{{ $index }}.value"
                                           placeholder="مثال: 3000mAh">
                                    @error('specFields.'.$index.'.value') <span class="text-danger">{{ $message }}</span> @enderror
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
                </div>

                <div class="form-section">
                    <h5 class="section-title">الصور</h5>

                    <div class="mb-3 d-flex flex-wrap gap-3">
                        @foreach($existingImages as $image)
                            <div class="position-relative">
                                <img src="{{ asset('storage/devices/'.$image->url) }}"
                                    class="img-thumbnail rounded"
                                    style="width: 120px; height: 120px; object-fit: cover;">
                                <button type="button"
                                        wire:click="removeExistingImage({{ $image->id }})"
                                        class="btn btn-sm btn-danger position-absolute top-0 end-0 rounded-circle p-1"
                                        style="z-index: 5;">
                                    <i class="mdi mdi-close"></i>
                                </button>
                            </div>
                        @endforeach
                    </div>


                    <div class="form-group">
                        <label>إضافة صور جديدة</label>
                        <input type="file" wire:model="images" class="form-control" accept="image/*" multiple>
                        <div wire:loading wire:target="images" class="text-info mt-2">جاري رفع الصور...</div>
                        @error('images.*') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mt-3 d-flex flex-wrap gap-2">
                        @if($images)
                            @foreach($images as $index=>$image)
                                <div class="position-relative">
                                    <img src="{{ $image->temporaryUrl() }}"
                                         class="img-thumbnail rounded"
                                         style="width: 120px; height: 120px; object-fit: cover;">
                                    <button type="button"
                                            wire:click="removeImage({{ $index }})"
                                            class="btn btn-sm btn-danger position-absolute top-0 end-0 rounded-circle p-1">
                                        <i class="mdi mdi-close"></i>
                                    </button>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>

                <div class="form-actions mt-4">
                    <button type="submit" class="btn btn-warning">
                        <i class="mdi mdi-content-save"></i> حفظ التعديلات
                    </button>
                    <button type="button" class="btn btn-secondary" wire:click="cancelEdit">
                        <i class="mdi mdi-close"></i> إلغاء
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
