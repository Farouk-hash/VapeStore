<div>
    <div  role="document">
        <div >
            <div class="modal-header bg-info text-white">
                <h5  id="editflavourModalLabel{{ $flavour->id }}">
                    <i class="fas fa-palette me-2"></i>
                    تعديل النكهة: {{ $flavour->name }}
                </h5>
                <button type="button" class="close text-white" aria-label="إغلاق" wire:click="cancel">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <form wire:submit.prevent="updateFlavour">
                <div class="modal-body">
                    <div class="row">

                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="name{{ $flavour->id }}" class="font-weight-bold">
                                    <i class="fas fa-palette me-1"></i>اسم النكهة <span class="text-danger">*</span>
                                </label>
                                <input type="text" 
                                       wire:model="name" 
                                       class="form-control @error('name') is-invalid @enderror" 
                                       id="name{{ $flavour->id }}"
                                       placeholder="أدخل اسم النكهة" 
                                       required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">أدخل اسمًا فريدًا للنكة</small>
                            </div>

                            <div class="form-group">
                                <label for="brand_id{{ $flavour->id }}" class="font-weight-bold">
                                    <i class="fas fa-tags me-1"></i>العلامة التجارية <span class="text-danger">*</span>
                                </label>
                                <select class="form-control @error('brand_id') is-invalid @enderror" 
                                        id="brand_id{{ $flavour->id }}" 
                                        wire:model="brand_id" 
                                        required>
                                    <option value="">--اختر العلامة التجارية--</option>
                                    @foreach($brands as $brand)
                                        <option value="{{ $brand->id }}">
                                            {{ $brand->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('brand_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">
                                    العلامة الحالية: 
                                    <span class="badge badge-info">
                                        <i class="fas fa-tag me-1"></i>{{ $flavour->brand->name ?? 'غير محددة' }}
                                    </span>
                                </small>
                            </div>


                          <div class="mb-3">
                                <label class="font-weight-bold">
                                    <i class="fas fa-cogs me-1"></i>الخصائص الحالية:
                                </label>
                                <div class="current-components-display p-2 bg-light rounded">
                                    @if($flavour->liquids && $flavour->liquids->count() > 0)
                                        @foreach($flavour->liquids as $liq)
                                            <div class="d-inline-block me-2 mb-2">
                                                <span class="badge badge-info p-2 d-flex align-items-center rounded-pill">
                                                    <i class="fas fa-cog me-1"></i>
                                                    <button type="button" class="btn btn-link text-white p-0 border-0 text-decoration-none me-2" 
                                                            wire:click="getdNicStrenghts({{$liq->id}})">
                                                        {{ $liq->nicotine_type }} {{$liq->vape_style}} {{$liq->vg_pg_ratio}} {{$liq->bottle_size_ml}} ml
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-outline-light rounded-circle p-0" 
                                                            style="width: 20px; height: 20px; display: flex; align-items: center; justify-content: center;"
                                                            wire:click="removeLiquidProperty({{$liq->id}})">
                                                        <i class="fas fa-times" style="font-size: 10px;"></i>
                                                    </button>
                                                </span>
                                            </div>
                                        @endforeach
                                        
                                        <div class="mt-2">
                                            <small class="text-muted">{{ $flavour->liquids->count() }} تركيز/تركيزات محددة</small>
                                        </div>
                                        
                                        <button type="button" class="btn btn-sm btn-outline-info mt-2" 
                                                wire:click="$set('showLiquidProperty', true)">
                                            <i class="fas fa-plus me-1"></i>اضافة خاصية جديدة
                                        </button>
                                        
                                        @if($showLiquidProperty)
                                            <div class="mt-3 p-3 border rounded bg-white">
                                                <h6 class="font-weight-bold mb-3">إضافة خاصية جديدة</h6>
                                                
                                                <div class="row">
                                                    <!-- Vape Style -->
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="font-weight-bold">أسلوب الفيب *</label>
                                                            <select class="form-control" wire:model="vape_style" required>
                                                                <option value="">اختر أسلوب الفيب</option>
                                                                @foreach ($vappingStyles as $vs)
                                                                    <option value="{{ $vs }}">{{ $vs }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <!-- Nicotine Type -->
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="font-weight-bold">نوع النيكوتين *</label>
                                                            <select class="form-control" wire:model="nicotine_type" required>
                                                                <option value="">اختر نوع النيكوتين</option>
                                                                @foreach ($nicTypes as $nt)
                                                                    <option value="{{ $nt }}">{{ $nt }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row mt-2">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="font-weight-bold">نسبة VG/PG *</label>
                                                            <select class="form-control" wire:model.live="vgPgRatio" required>
                                                                <option value="">اختر النسبة</option>
                                                                <option value="70/30">70/30</option>
                                                                <option value="60/40">60/40</option>
                                                                <option value="50/50">50/50</option>
                                                                <option value="80/20">80/20</option>
                                                                <option value="custom">مخصص</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="font-weight-bold">حجم الزجاجة (مل) *</label>
                                                            <select class="form-control" wire:model="bottleSize" required>
                                                                <option value="">اختر الحجم</option>
                                                                <option value="10">10 مل</option>
                                                                <option value="30">30 مل</option>
                                                                <option value="60">60 مل</option>
                                                                <option value="100">100 مل</option>
                                                                <option value="120">120 مل</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                @if($showCustomVgPg)
                                                    <div class="row mt-2">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="font-weight-bold">نسبة VG مخصصة</label>
                                                                <input type="number" class="form-control" wire:model="customVg" 
                                                                    placeholder="70" min="0" max="100">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="font-weight-bold">نسبة PG مخصصة</label>
                                                                <input type="number" class="form-control" wire:model="customPg" 
                                                                    placeholder="30" min="0" max="100">
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                                <!-- Add Properties Button -->
                                                <div class="text-end mt-3">
                                                    <button type="button" class="btn btn-secondary me-2" 
                                                            wire:click="$set('showLiquidProperty',false)">
                                                        <i class="fas fa-times me-1"></i> إلغاء
                                                    </button>
                                                    <button type="button" class="btn btn-success" 
                                                            wire:click="addLiquidProperties">
                                                        <i class="fas fa-check me-1"></i> حفظ الخصائص
                                                    </button>
                                                </div>
                                            </div>
                                        @endif
                                        
                                        @if($selectedNicStrenghts)
                                            <div class="mt-3 p-3 border rounded bg-white">
                                                <h6 class="font-weight-bold mb-3">تركيزات النيكوتين</h6>
                                                
                                                @foreach($nicStrenghts as $ns)
                                                
                                                    <div class="d-inline-block me-2 mb-2">

                                                    

                                                        <span class="badge badge-info p-2 d-flex align-items-center rounded-pill">
                                                            <i class="fas fa-cog me-1"></i>
                                                            {{ $ns->strength }} مجم
                                                            <button type="button" class="btn btn-link text-white p-0 border-0 text-decoration-none me-2" 
                                                                    wire:click="removeStrength({{$ns->id}})">
                                                                <i class="fas fa-times"></i>
                                                            </button>
                                                        </span>
                                                    </div>
                                                @endforeach

                                                <div class="mt-3">
                                                    <div class="input-group">
                                                        <input type="number" 
                                                            class="form-control" 
                                                            wire:model="strengthInput" 
                                                            placeholder="التركيز (مجم)" 
                                                            min="0" max="50" step="0.5">
                                                        <button type="button" 
                                                                class="btn btn-primary" 
                                                                wire:click="addStrengthBtn">
                                                            <i class="fas fa-plus me-1"></i> إضافة تركيز
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                    @else
                                        <small class="text-muted">لا توجد خصائص حالياً</small>
                                        <button type="button" class="btn btn-sm btn-outline-info mt-2 d-block" 
                                                wire:click="$set('showLiquidProperty', true)">
                                            <i class="fas fa-plus me-1"></i>اضافة خاصية جديدة
                                        </button>
                                    @endif
                                </div>
                            </div>
                            </div>

                            <div class="col-md-6">

                                <div class="mb-3">
                                    <label class="font-weight-bold">
                                        <i class="fas fa-cogs me-1"></i>المكونات الحالية:
                                    </label>
                                    <div class="current-components-display p-2 bg-light rounded">
                                        @if($flavour->components && $flavour->components->count() > 0)
                                            @foreach($flavour->components as $component)
                                                <span class="badge badge-info me-1 mb-1">
                                                    <i class="fas fa-cog me-1"></i>
                                                    {{ $component->name }}
                                                </span>
                                            @endforeach
                                            <small class="d-block text-muted mt-1">{{ $flavour->components->count() }} مكون/مكونات محددة</small>
                                        @else
                                            <small class="text-muted">لا توجد مكونات حالياً</small>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="font-weight-bold">
                                        <i class="fas fa-cogs me-1"></i>المكونات المتاحة
                                        <span class="component-count-edit" id="component-count-edit-{{ $flavour->id }}">
                                            {{ count($component_ids) }} مختار
                                        </span>
                                    </label>
                                    <div class="component-selection-edit" style="max-height: 250px; overflow-y: auto; border: 1px solid #ced4da; border-radius: 0.375rem; padding: 10px; background-color: white;">

                                        @foreach($components as $component)
                                            <div class="custom-control custom-checkbox mb-2">
                                                <input type="checkbox" 
                                                    wire:model="component_ids" 
                                                    value="{{ $component->id }}" 
                                                    class="custom-control-input component-checkbox-edit" 
                                                    id="edit_flavour_{{ $flavour->id }}_component_{{ $component->id }}">
                                                <label class="custom-control-label" for="edit_flavour_{{ $flavour->id }}_component_{{ $component->id }}">
                                                    <i class="fas fa-cog me-1" style="color: {{ $component->color ?? '#6c757d' }}"></i>
                                                    {{ $component->name }}
                                                    @if($component->description)
                                                        <small class="text-muted d-block">{{ Str::limit($component->description, 40) }}</small>
                                                    @endif
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                    @error('component_ids')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">اختر المكونات المتوافقة مع هذه النكهة</small>
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
                                            <label class="flavor-form-label">الصور الحاليه :</label>
                                            @if($oldImages->count()!==0)

                                                @foreach($oldImages as $image)
                                                    <div class="position-relative d-inline-block me-2 mb-2">
                                                        <img src="{{URL::asset("storage/flavors/$image->url") }}" 
                                                            class="img-thumbnail rounded" 
                                                            style="width: 120px; height: 120px; object-fit: cover;">

                                                        <button type="button" 
                                                                wire:click="removeImage({{ $image->id }} , '{{$image->url}}' )"
                                                                class="btn btn-sm btn-danger position-absolute top-0 end-0 rounded-circle p-1"
                                                                style="width: 24px; height: 24px; display: flex; align-items: center; justify-content: center;">
                                                            <i class="mdi mdi-close" style="font-size: 12px;"></i>
                                                        </button>

                                                    </div>
                                                @endforeach

                                            @else 
                                                <label class="flavor-form-label" style="color: red;">لا توجد صور الحاليه</label>
                                            @endif

                                        </div>

                                        <div class="mt-3 d-flex flex-wrap gap-2">
                                            @if($images)

                                                @foreach($images as $image)
                                                    <div class="position-relative d-inline-block me-2 mb-2">
                                                        <img src="{{ $image->temporaryUrl() }}" 
                                                            class="img-thumbnail rounded" 
                                                            style="width: 120px; height: 120px; object-fit: cover;">
                                                        <button type="button" 
                                                                wire:click="removeImage({{ $loop->index }})"
                                                                class="btn btn-sm btn-danger position-absolute top-0 end-0 rounded-circle p-1"
                                                                style="width: 24px; height: 24px; display: flex; align-items: center; justify-content: center;">
                                                            <i class="mdi mdi-close" style="font-size: 12px;"></i>
                                                        </button>
                                                    </div>
                                                @endforeach

                                                <div class="mt-2">
                                                    <button type="button" 
                                                            wire:click="saveImages"
                                                            class="btn btn-sm btn-success rounded-pill px-3">
                                                        <i class="fas fa-check me-1"></i>حفظ
                                                    </button>
                                                </div>
                                            @endif

                                        </div>

                                    </div>
                                </div>

                            </div>                            
                    </div>


                    



                    <div class="card bg-light border-0 mt-3">
                        <div class="card-body py-2">
                            <div class="row text-sm">
                                <div class="col-sm-4">
                                    <strong class="text-muted">تم الإنشاء:</strong>
                                    <span>{{ $flavour->created_at }}</span>
                                </div>
                                <div class="col-sm-4">
                                    <strong class="text-muted">آخر تحديث:</strong>
                                    <span>{{ $flavour->updated_at }}</span>
                                </div>
                                <div class="col-sm-4">
                                    <strong class="text-muted">إجمالي المكونات:</strong>
                                    <span class="badge badge-warning">{{ $flavour->components->count() }}</span>
                                </div>
                            </div>
                            @if($flavour->brand && $flavour->brand->description)
                            <div class="row text-sm mt-2">
                                <div class="col-sm-12">
                                    <strong class="text-muted">وصف العلامة التجارية:</strong>
                                    <span>{{ $flavour->brand->description }}</span>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                </div>
                
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" wire:click="cancel" wire:loading.attr="disabled">
                        <i class="fas fa-times me-1"></i>إلغاء
                    </button>

                    <button type="submit" class="btn btn-info" wire:loading.attr="disabled">
                        <i class="fas fa-save me-1"></i>
                        <span wire:loading.remove>تحديث النكهة</span>
                        <span wire:loading>
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            جاري التحديث...
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
