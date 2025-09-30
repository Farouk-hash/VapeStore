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
                            <input type="text" class="form-control" placeholder="2000,2001,..." wire:model.defer="model">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="device_release_year">سنة الإصدار</label>
                            <input type="number" class="form-control" placeholder="2000,2001,.." wire:model.defer="release_year" 
                                   min="2000" max="{{ date('Y') }}" value="{{ date('Y') }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="tank_type">نوع التانك *</label>
                            <input type="text" class="form-control" id="tank_type" placeholder="mtl , subohm , podtank" wire:model.defer="type" >
                        </div>
                    </div>
                   <div class="col-md-4">
                        <div class="form-group">
                            <label for="tank_vaping_style">استيل التانك *</label>
                            <input type="text" class="form-control" id="tank_vaping_style" placeholder="RDL,MTL,DL" wire:model.defer="vaping_style" >
                        </div>
                    </div>
                   
                   
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
                @endif
                
                <div id="colors_preview" class="tags-preview mt-2"></div>
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
                @endif
            </div>

            <!-- Images Section -->
            <div class="flavor-form-section">
                <h4 class="flavor-form-section-title">صور التانك</h4>
                <div class="flavor-form-group">
                    <label class="flavor-form-label">اختر الصور (يمكنك رفع أكثر من صورة)</label>
                    <input type="file" wire:model.defer="images" class="form-control" accept="image/*" multiple>
                    
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

