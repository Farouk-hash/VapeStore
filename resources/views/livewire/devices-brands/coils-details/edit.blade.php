<div>

    <div id="editDeviceFormContainer" class="card mb-4">
        <div class="card-header bg-warning text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">
                <i class="mdi mdi-pencil"></i>
                تعديل الجهاز - {{ $coilSeries->name ?? 'العلامة التجارية' }}
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
                      
                    </div>

                   

                    <div class="form-group mt-3">
                        <label for="edit_device_description">وصف الجهاز</label>
                        <textarea class="form-control" id="edit_device_description" wire:model.defer="description" rows="3"></textarea>
                        @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                

               
                
                
                <div class="form-section">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="section-title mb-0">المواصفات الفنية</h5>
                        <button type="button" class="btn btn-sm btn-outline-warning" wire:click="addCoilVairants">
                            <i class="mdi mdi-plus"></i> إضافة مواصفة أخرى
                        </button>
                    </div>
                    
                    <div id="specs_container">
                        @foreach($variants as $index => $variant)
                            <div class="spec-row mb-3">
                                <div class="row g-2 align-items-center">
                                    <div class="col-md-2">
                                        <input type="text" class="form-control"
                                            wire:model="variants.{{ $index }}.name"
                                            placeholder="اسم المواصفة">
                                        @error('variants.'.$index.'.name') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    
                                    <div class="col-md-2">
                                        <input type="text" class="form-control"
                                            wire:model="variants.{{ $index }}.resistance"
                                            placeholder="المقاومة">
                                        @error('variants.'.$index.'.resistance') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    
                                    <div class="col-md-2">
                                        <input type="text" class="form-control"
                                            wire:model="variants.{{ $index }}.wattage_range"
                                            placeholder="نطاق الواط">
                                        @error('variants.'.$index.'.wattage_range') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    
                                    <div class="col-md-2">
                                        <input type="text" class="form-control"
                                            wire:model="variants.{{ $index }}.vaping_style"
                                            placeholder="أسلوب التدخين">
                                        @error('variants.'.$index.'.vaping_style') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <input type="text" class="form-control"
                                            wire:model="variants.{{ $index }}.description"
                                            placeholder="الوصف">
                                        @error('variants.'.$index.'.description') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <div class="col-md-1 text-center">
                                        @if($index > 0)
                                            <button type="button" class="btn btn-danger btn-sm"
                                                    wire:click="removeCoilVairants({{ $index }})">
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
                                <img src="{{ asset('storage/coils/'.$image->url) }}"
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
