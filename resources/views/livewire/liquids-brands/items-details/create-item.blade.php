<!-- Add Flavor Form -->
<div class="add-flavor-form-container">
    <div class="add-flavor-form-header d-flex justify-content-between align-items-center bg-info text-white p-3 rounded-top">
        <h3 class="add-flavor-form-title mb-0">
            <i class="fas fa-flask"></i>
            إضافة نكهة جديدة إلى {{ $brand->name }}
        </h3>

        <button type="button" class="close text-white" aria-label="إغلاق" wire:click="cancelForm">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>


    
    <!-- Basic Information -->
    <div class="flavor-form-section">
        <h4 class="flavor-form-section-title">المعلومات الأساسية</h4>
        <div class="flavor-form-grid">
            <div class="flavor-form-group">
                <label class="flavor-form-label">اسم النكهة *</label>
                <input type="text" class="flavor-form-input" wire:model="name" placeholder="مثال: فراولة كريمية" required>
            </div>
            <div class="flavor-form-group">
                <label class="flavor-form-label">وصف النكهة (اختياري)</label>
                <input type="text" class="flavor-form-input" wire:model="description" placeholder="وصف مختصر للنكهة">
            </div>
        </div>
    </div>
    
    <!-- Liquid Properties -->
    <div class="flavor-form-section">
        <h4 class="flavor-form-section-title">خصائص السائل</h4>
        
        @foreach($liquidProperties as $index => $property)
        <div class="property-set-container" style="border: 1px solid #e0e0e0; padding: 20px; margin-bottom: 20px; border-radius: 8px;">
            <div class="property-set-header" style="display: flex; justify-content: between; align-items: center; margin-bottom: 15px;">
                <h5 style="margin: 0;">مجموعة الخصائص #{{ $index + 1 }}</h5>
                @if($index > 0)
                <button type="button" 
                        wire:click="removePropertySet({{ $index }})" 
                        class="btn btn-sm btn-outline-danger">
                    <i class="mdi mdi-delete"></i> حذف
                </button>
                @endif
            </div>
            
            <div class="flavor-form-grid">
                <!-- Vape Style -->
                <div class="flavor-form-group">
                    <label class="flavor-form-label">أسلوب الفيب *</label>
                    <select class="flavor-form-select" wire:model="liquidProperties.{{ $index }}.vape_style" required>
                        <option value="">اختر أسلوب الفيب</option>
                        @foreach ($vappingStyles as $vs)
                            <option value="{{ $vs }}">{{ $vs }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Nicotine Type -->
                <div class="flavor-form-group">
                    <label class="flavor-form-label">نوع النيكوتين *</label>
                    <select class="flavor-form-select" wire:model="liquidProperties.{{ $index }}.nicotine_type" required>
                        <option value="">اختر نوع النيكوتين</option>
                        @foreach ($nicTypes as $nt)
                            <option value="{{ $nt }}">{{ $nt }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Nicotine Strengths -->
            <div class="strengths-builder" style="margin-top: 15px;">
                <label class="flavor-form-label">تراكيز النيكوتين (مجم) *</label>
                <div class="strengths-list-builder" style="margin-bottom: 10px;">
                    @forelse ($property['strengths'] as $strengthIndex => $strength)
                        <span class="strength-item" style="display: inline-flex; align-items: center; background: #f8f9fa; padding: 5px 10px; margin: 5px; border-radius: 20px;">
                            {{ $strength }} مجم
                            <button type="button" 
                                    wire:click="removeStrength({{ $index }}, {{ $strengthIndex }})" 
                                    class="btn btn-sm btn-outline-danger rounded-circle d-flex align-items-center justify-content-center ms-2"
                                    style="width: 24px; height: 24px;">
                                <i class="mdi mdi-close"></i>
                            </button>
                        </span>
                    @empty
                        <span class="text-muted">لا توجد تراكيز مضافة بعد</span>
                    @endforelse
                </div>

                <div class="strength-input-builder" style="display: flex; gap: 10px;">
                    <input type="number" 
                           wire:model="strengthInput" 
                           placeholder="التركيز (مجم)" 
                           min="0" max="50" step="0.5"
                           style="flex: 1;">
                    <button type="button" 
                            class="btn btn-primary" 
                            wire:click="addStrengthBtn({{ $index }})">
                        <i class="mdi mdi-plus"></i> إضافة تركيز
                    </button>
                </div>
            </div>

            <!-- Add Properties Button -->
            <div class="text-end mt-3">
                <button type="button" 
                        class="btn btn-success" 
                        wire:click="addLiquidProperties({{ $index }})">
                    <i class="mdi mdi-check"></i> حفظ الخصائص
                </button>
            </div>
        </div>
        @endforeach

        <!-- Add New Property Set Button -->
        <div class="text-center mt-3">
            <button type="button" 
                    class="btn btn-outline-primary" 
                    wire:click="addNewPropertySet">
                <i class="mdi mdi-plus"></i> إضافة مجموعة خصائص جديدة
            </button>
        </div>
    </div>

    @if($errorMessage)
        <div class="alert alert-danger mt-3">
            {{ $errorMessage }}
        </div>
    @endif

    <!-- VG/PG Ratio and Bottle Size -->
    <div class="flavor-form-section">
        <h4 class="flavor-form-section-title">إعدادات عامة</h4>
        <div class="flavor-form-grid">
            <div class="flavor-form-group">
                <label class="flavor-form-label">نسبة VG/PG *</label>
                <select class="flavor-form-select" wire:model.live="vgPgRatio" required>
                    <option value="">اختر النسبة</option>
                    <option value="70/30">70/30</option>
                    <option value="60/40">60/40</option>
                    <option value="50/50">50/50</option>
                    <option value="80/20">80/20</option>
                    <option value="custom">مخصص</option>
                </select>
            </div>
            <div class="flavor-form-group">
                <label class="flavor-form-label">حجم الزجاجة (مل) *</label>
                <select class="flavor-form-select" wire:model="bottleSize" required>
                    <option value="">اختر الحجم</option>
                    <option value="10">10 مل</option>
                    <option value="30">30 مل</option>
                    <option value="60">60 مل</option>
                    <option value="100">100 مل</option>
                    <option value="120">120 مل</option>
                </select>
            </div>
        </div>
        
        @if($showCustomVgPg)
            <!-- Custom VG/PG -->
            <div class="flavor-form-grid" style="margin-top: 15px;">
                <div class="flavor-form-group">
                    <label class="flavor-form-label">نسبة VG مخصصة</label>
                    <input type="number" class="flavor-form-input" wire:model="customVg" placeholder="70" min="0" max="100">
                </div>
                <div class="flavor-form-group">
                    <label class="flavor-form-label">نسبة PG مخصصة</label>
                    <input type="number" class="flavor-form-input" wire:model="customPg" placeholder="30" min="0" max="100">
                </div>
            </div>
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
                    @foreach($images as $image)
                        <div class="position-relative">
                            <img src="{{ $image->temporaryUrl() }}" 
                                 class="img-thumbnail rounded" 
                                 style="width: 120px; height: 120px; object-fit: cover;">
                            <button type="button" 
                                    wire:click="removeImage({{ $loop->index }})"
                                    class="btn btn-sm btn-danger position-absolute top-0 end-0 rounded-circle p-1">
                                <i class="mdi mdi-close"></i>
                            </button>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

    <div class="flavor-form-actions">
        <button type="button" class="flavor-form-btn flavor-form-save" wire:click.stop="saveFlavorBtn">
            <i class="mdi mdi-check"></i> حفظ النكهة
        </button>
        <button type="button" class="flavor-form-btn flavor-form-cancel" wire:click="cancelForm">
            <i class="mdi mdi-close"></i> إلغاء
        </button>
    </div>
</div>