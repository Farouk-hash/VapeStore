@extends('dashboard.layouts.master')

@section('css')
<link href="{{ URL::asset('dashboard/plugins/jquery-nice-select/css/nice-select.css') }}" rel="stylesheet"/>
<link href="{{ URL::asset('dashboard/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
<style>
.flavour-card {
        transition: all 0.3s ease;
        border: 1px solid #e9ecef;
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        margin-bottom: 20px;
    }
    
    .flavour-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    }
    
    .flavour-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 20px;
        border-radius: 10px 10px 0 0;
    }
    
    .flavour-title {
        font-size: 22px;
        font-weight: 700;
        margin: 0;
    }
    
    .liquid-options {
        padding: 20px;
    }
    
    .option-selector {
        background: #f8f9fa;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 20px;
    }
    
    .option-group {
        margin-bottom: 15px;
    }
    
    .option-group:last-child {
        margin-bottom: 0;
    }
    
    .option-label {
        font-weight: 600;
        color: #495057;
        margin-bottom: 8px;
        font-size: 14px;
    }
    
    .option-buttons {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }
    
    .option-btn {
        padding: 6px 12px;
        border: 2px solid #dee2e6;
        background: white;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
        min-width: 60px;
        text-align: center;
    }
    
    .option-btn:hover {
        border-color: #007bff;
        background: #e3f2fd;
    }
    
    .option-btn.active {
        background: #007bff;
        border-color: #007bff;
        color: white;
    }
    
    .option-btn.vape-mtl.active {
        background: #28a745;
        border-color: #28a745;
    }
    
    .option-btn.vape-dl.active {
        background: #dc3545;
        border-color: #dc3545;
    }
    
    .option-btn.nic-salt.active {
        background: #17a2b8;
        border-color: #17a2b8;
    }
    
    .option-btn.nic-freebase.active {
        background: #6f42c1;
        border-color: #6f42c1;
    }
    
    .liquid-details {
        background: #ffffff;
        border: 2px solid #007bff;
        border-radius: 8px;
        padding: 15px;
        margin-top: 15px;
        display: none;
    }
    
    .liquid-details.show {
        display: block;
        animation: slideDown 0.3s ease;
    }
    
    @keyframes slideDown {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .detail-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 15px;
        margin-bottom: 15px;
    }
    
    .detail-item {
        text-align: center;
        padding: 10px;
        background: #f8f9fa;
        border-radius: 6px;
    }
    
    .detail-value {
        font-size: 16px;
        font-weight: 700;
        color: #007bff;
        display: block;
    }
    
    .detail-label {
        font-size: 11px;
        color: #6c757d;
        text-transform: uppercase;
        font-weight: 600;
        margin-top: 5px;
    }
    
    .strengths-container {
        background: #e3f2fd;
        padding: 15px;
        border-radius: 6px;
        margin-top: 15px;
    }
    

 
  
 
    .stats-row {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 8px;
        margin-bottom: 20px;
    }
    
    .stat-item {
        text-align: center;
    }
    
    .stat-number {
        font-size: 28px;
        font-weight: bold;
        color: #007bff;
    }
    
    .stat-label {
        font-size: 12px;
        color: #6c757d;
        text-transform: uppercase;
        font-weight: 600;
    }

    /* Strength Management Styles */
    .strength-item {
        display: inline-flex;
        align-items: center;
        margin: 2px;
        background: linear-gradient(45deg, #007bff, #0056b3);
        border-radius: 15px;
        overflow: hidden;
    }

    .strength-badge {
        display: inline-block;
        color: white;
        padding: 4px 12px;
        font-size: 11px;
        font-weight: bold;
        margin: 0;
    }

    .strength-actions {
        display: flex;
        background: rgba(255,255,255,0.2);
    }

    .strength-btn {
        background: none;
        border: none;
        color: white;
        padding: 4px 6px;
        cursor: pointer;
        font-size: 10px;
        transition: background 0.2s;
    }

    .strength-btn:hover {
        background: rgba(255,255,255,0.3);
    }

    .add-strength-btn {
        background: #28a745;
        border: none;
        color: white;
        padding: 6px 12px;
        border-radius: 15px;
        font-size: 11px;
        font-weight: bold;
        cursor: pointer;
        margin: 5px 0;
        transition: all 0.2s;
    }

    .add-strength-btn:hover {
        background: #218838;
        transform: translateY(-1px);
    }

    .strength-input {
        display: none;
        margin: 5px 0;
    }

    .strength-input input {
        width: 80px;
        padding: 4px 8px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 11px;
    }

    .strength-input button {
        padding: 4px 8px;
        margin-left: 5px;
        border: none;
        border-radius: 4px;
        font-size: 10px;
        cursor: pointer;
    }

    .strength-save {
        background: #28a745;
        color: white;
    }

    .strength-cancel {
        background: #6c757d;
        color: white;
    }

    /* Add New Liquid Styles */
    .add-liquid-btn {
        background: linear-gradient(45deg, #17a2b8, #138496) !important;
        border: none !important;
        color: white !important;
        padding: 12px 20px !important;
        border-radius: 25px !important;
        font-size: 14px !important;
        font-weight: bold !important;
        cursor: pointer !important;
        margin: 15px auto !important;
        display: block !important;
        transition: all 0.3s !important;
        box-shadow: 0 4px 15px rgba(23, 162, 184, 0.3) !important;
        text-align: center !important;
    }

    .add-liquid-btn:hover {
        background: linear-gradient(45deg, #138496, #117a8b) !important;
        transform: translateY(-2px) !important;
        box-shadow: 0 6px 20px rgba(23, 162, 184, 0.4) !important;
    }

    .no-match-container {
        background: #fff3cd !important;
        border: 2px dashed #ffc107 !important;
        border-radius: 8px !important;
        padding: 20px !important;
        margin: 15px 0 !important;
        text-align: center !important;
        display: none !important;
    }

    .no-match-container.show {
        display: block !important;
        animation: slideDown 0.3s ease !important;
    }

    .no-match-text {
        color: #856404 !important;
        margin-bottom: 15px !important;
        font-weight: 600 !important;
    }

    /* Liquid Form Styles */
    .liquid-form-container {
        background: #e8f4fd;
        border: 2px solid #17a2b8;
        border-radius: 8px;
        padding: 20px;
        margin: 15px 0;
        display: none;
    }

    .liquid-form-container.show {
        display: block;
        animation: slideDown 0.3s ease;
    }

    .liquid-form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
        margin-bottom: 15px;
    }

    .liquid-form-group {
        display: flex;
        flex-direction: column;
    }

    .liquid-form-label {
        font-weight: 600;
        color: #495057;
        margin-bottom: 5px;
        font-size: 13px;
    }

    .liquid-form-input {
        padding: 8px 12px;
        border: 2px solid #dee2e6;
        border-radius: 6px;
        font-size: 13px;
        transition: border-color 0.2s;
    }

    .liquid-form-input:focus {
        outline: none;
        border-color: #17a2b8;
    }

    .liquid-form-actions {
        display: flex;
        gap: 10px;
        justify-content: center;
        margin-top: 15px;
    }

    .liquid-form-btn {
        padding: 8px 16px;
        border: none;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
    }

    .liquid-form-save {
        background: #28a745;
        color: white;
    }

    .liquid-form-save:hover {
        background: #218838;
    }

    .liquid-form-cancel {
        background: #6c757d;
        color: white;
    }

    .liquid-form-cancel:hover {
        background: #5a6268;
    }

    .custom-vg-pg {
        display: none;
    }

    /* Loading state */
    .loading {
        opacity: 0.7;
        pointer-events: none;
    }

    .option-btn.unavailable {
    border-color: #f8d7da;
    background: #f8f9fa;
    color: #6c757d;
    border-style: dashed;
    opacity: 0.7;
}

.option-btn.unavailable:hover {
    border-color: #dc3545;
    background: #f5c6cb;
    color: #721c24;
}

.option-btn.unavailable.active {
    background: #dc3545;
    border-color: #dc3545;
    color: white;
    border-style: solid;
}

/* Add Flavor Button */
.add-flavor-main-btn {
    background: linear-gradient(45deg, #28a745, #20c997) !important;
    border: none !important;
    color: white !important;
    padding: 15px 30px !important;
    border-radius: 30px !important;
    font-size: 16px !important;
    font-weight: bold !important;
    cursor: pointer !important;
    margin: 20px auto !important;
    display: block !important;
    transition: all 0.3s !important;
    box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3) !important;
    text-align: center !important;
    min-width: 250px;
}

.add-flavor-main-btn:hover {
    background: linear-gradient(45deg, #218838, #1e9b7a) !important;
    transform: translateY(-3px) !important;
    box-shadow: 0 6px 25px rgba(40, 167, 69, 0.4) !important;
}

/* Add Flavor Form */
.add-flavor-form-container {
    background: #f0f8f0;
    border: 2px solid #28a745;
    border-radius: 12px;
    padding: 25px;
    margin: 20px 0;
    display: none;
}

.add-flavor-form-container.show {
    display: block;
    animation: slideDown 0.4s ease;
}

.add-flavor-form-header {
    background: linear-gradient(135deg, #28a745, #20c997);
    color: white;
    padding: 15px 20px;
    border-radius: 8px;
    margin: -25px -25px 20px -25px;
    text-align: center;
}

.add-flavor-form-title {
    font-size: 18px;
    font-weight: bold;
    margin: 0;
}

.flavor-form-section {
    background: white;
    border-radius: 8px;
    padding: 20px;
    margin-bottom: 20px;
    border: 1px solid #e9ecef;
}

.flavor-form-section-title {
    font-size: 16px;
    font-weight: 600;
    color: #495057;
    margin-bottom: 15px;
    padding-bottom: 8px;
    border-bottom: 2px solid #e9ecef;
}

.flavor-form-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 15px;
    margin-bottom: 15px;
}

.flavor-form-group {
    display: flex;
    flex-direction: column;
}

.flavor-form-label {
    font-weight: 600;
    color: #495057;
    margin-bottom: 8px;
    font-size: 14px;
}

.flavor-form-input {
    padding: 10px 15px;
    border: 2px solid #dee2e6;
    border-radius: 8px;
    font-size: 14px;
    transition: all 0.2s;
}

.flavor-form-input:focus {
    outline: none;
    border-color: #28a745;
    box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
}

.flavor-form-select {
    padding: 10px 15px;
    border: 2px solid #dee2e6;
    border-radius: 8px;
    font-size: 14px;
    background-color: white;
    transition: all 0.2s;
}

.flavor-form-select:focus {
    outline: none;
    border-color: #28a745;
    box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
}

/* Multiple Vape Styles Selection */
.vape-styles-container, .nicotine-types-container {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-top: 5px;
}

.style-checkbox {
    display: flex;
    align-items: center;
    padding: 8px 15px;
    border: 2px solid #dee2e6;
    border-radius: 20px;
    cursor: pointer;
    transition: all 0.2s;
    background: white;
}

.style-checkbox:hover {
    border-color: #28a745;
    background: #f8f9fa;
}

.style-checkbox.selected {
    background: #28a745;
    border-color: #28a745;
    color: white;
}

.style-checkbox input {
    margin-right: 8px;
}

/* Nicotine Strengths */
.strengths-builder {
    background: #f8f9fa;
    border-radius: 8px;
    padding: 15px;
    margin-top: 10px;
}

.strengths-list-builder {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin-bottom: 15px;
    min-height: 40px;
    align-items: flex-start;
}

.strength-tag {
    display: inline-flex;
    align-items: center;
    background: #007bff;
    color: white;
    padding: 5px 10px;
    border-radius: 15px;
    font-size: 12px;
    font-weight: 600;
}

.strength-tag .remove-strength {
    margin-left: 8px;
    background: rgba(255,255,255,0.3);
    border: none;
    color: white;
    border-radius: 50%;
    width: 18px;
    height: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    font-size: 10px;
    transition: background 0.2s;
}

.strength-tag .remove-strength:hover {
    background: rgba(255,255,255,0.5);
}

.strength-input-builder {
    display: flex;
    gap: 10px;
    align-items: center;
}

.strength-input-builder input {
    width: 100px;
    padding: 8px 12px;
    border: 2px solid #dee2e6;
    border-radius: 6px;
    font-size: 13px;
}

.add-strength-builder-btn {
    background: #17a2b8;
    border: none;
    color: white;
    padding: 8px 15px;
    border-radius: 6px;
    font-size: 12px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s;
}

.add-strength-builder-btn:hover {
    background: #138496;
}

/* Form Actions */
.flavor-form-actions {
    display: flex;
    gap: 15px;
    justify-content: center;
    margin-top: 25px;
    padding-top: 20px;
    border-top: 2px solid #e9ecef;
}

.flavor-form-btn {
    padding: 12px 25px;
    border: none;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s;
    min-width: 120px;
}

.flavor-form-save {
    background: #28a745;
    color: white;
}

.flavor-form-save:hover {
    background: #218838;
    transform: translateY(-1px);
}

.flavor-form-cancel {
    background: #6c757d;
    color: white;
}

.flavor-form-cancel:hover {
    background: #5a6268;
    transform: translateY(-1px);
}

.inventory-management {
    margin-top: 15px;
    text-align: center;
    padding-top: 15px;
    border-top: 1px solid #e9ecef;
}

.inventory-management .btn {
    transition: all 0.2s ease;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.inventory-management .btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.15);
}
</style>
@endsection

@section('page-header')
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">العلامات التجارية</h4>
            <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ $brand->name }}</span>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="row row-sm">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                
                <!-- Brand Header -->
                <div class="text-center mb-4">
                    <h2 class="text-primary">{{ $brand->name }}</h2>
                    <p class="text-muted">{{ $brand->description ?? 'عرض جميع النكهات والخيارات المتاحة' }}</p>
                </div>


<div class="text-center">
    <button class="add-flavor-main-btn" id="addFlavorBtn">
        <i class="mdi mdi-plus-circle"></i>
        إضافة نكهة جديدة
    </button>
</div>

<!-- Add Flavor Form -->
<div class="add-flavor-form-container" id="addFlavorFormContainer">
    <div class="add-flavor-form-header">
        <h3 class="add-flavor-form-title">
            <i class="mdi mdi-flask-outline"></i>
            إضافة نكهة جديدة إلى {{ $brand->name }}
        </h3>
    </div>
    
    <!-- Basic Information -->
    <div class="flavor-form-section">
        <h4 class="flavor-form-section-title">المعلومات الأساسية</h4>
        <div class="flavor-form-grid">
            <div class="flavor-form-group">
                <label class="flavor-form-label">اسم النكهة *</label>
                <input type="text" class="flavor-form-input" id="flavorName" placeholder="مثال: فراولة كريمية" required>
            </div>
            <div class="flavor-form-group">
                <label class="flavor-form-label">وصف النكهة (اختياري)</label>
                <input type="text" class="flavor-form-input" id="flavorDescription" placeholder="وصف مختصر للنكهة">
            </div>
        </div>
    </div>
    
    <!-- Liquid Properties -->
    <div class="flavor-form-section">
        <h4 class="flavor-form-section-title">خصائص السائل</h4>
        
        <!-- Vape Styles -->
        <div class="flavor-form-group">
            <label class="flavor-form-label">أساليب الفيب المتاحة *</label>
            <div class="vape-styles-container">
                <div class="style-checkbox" data-value="MTL">
                    <input type="checkbox" value="MTL">
                    <span>MTL</span>
                </div>
                <div class="style-checkbox" data-value="DL">
                    <input type="checkbox" value="DL">
                    <span>DL</span>
                </div>
                <div class="style-checkbox" data-value="SaltNic">
                    <input type="checkbox" value="SaltNic">
                    <span>SaltNic</span>
                </div>
            </div>
        </div>
        
        <!-- Nicotine Types -->
        <div class="flavor-form-group" style="margin-top: 20px;">
            <label class="flavor-form-label">أنواع النيكوتين المتاحة *</label>
            <div class="nicotine-types-container">
                <div class="style-checkbox" data-value="Salt">
                    <input type="checkbox" value="Salt">
                    <span>Salt (ملحي)</span>
                </div>
                <div class="style-checkbox" data-value="Freebase">
                    <input type="checkbox" value="Freebase">
                    <span>Freebase (حر)</span>
                </div>
                <div class="style-checkbox" data-value="DL">
                    <input type="checkbox" value="DL">
                    <span>DL</span>
                </div>
            </div>
        </div>
        
        <div class="flavor-form-grid" style="margin-top: 20px;">
            <div class="flavor-form-group">
                <label class="flavor-form-label">نسبة VG/PG *</label>
                <select class="flavor-form-select" id="vgPgRatio" required>
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
                <select class="flavor-form-select" id="bottleSize" required>
                    <option value="">اختر الحجم</option>
                    <option value="10">10 مل</option>
                    <option value="30">30 مل</option>
                    <option value="60">60 مل</option>
                    <option value="100">100 مل</option>
                    <option value="120">120 مل</option>
                </select>
            </div>
        </div>
        
        <!-- Custom VG/PG -->
        <div class="flavor-form-grid" id="customVgPgRow" style="display: none; margin-top: 15px;">
            <div class="flavor-form-group">
                <label class="flavor-form-label">نسبة VG مخصصة</label>
                <input type="number" class="flavor-form-input" id="customVg" placeholder="70" min="0" max="100">
            </div>
            <div class="flavor-form-group">
                <label class="flavor-form-label">نسبة PG مخصصة</label>
                <input type="number" class="flavor-form-input" id="customPg" placeholder="30" min="0" max="100">
            </div>
        </div>

    </div>
    
    <!-- Nicotine Strengths -->
    <div class="flavor-form-section">
        <h4 class="flavor-form-section-title">تراكيز النيكوتين</h4>
        <div class="strengths-builder">
            <label class="flavor-form-label">التراكيز المتاحة (مجم)</label>
            <div class="strengths-list-builder" id="strengthsList">
                <span class="text-muted">لا توجد تراكيز مضافة بعد</span>
            </div>
            <div class="strength-input-builder">
                <input type="number" id="strengthInput" placeholder="التركيز (مجم)" min="0" max="50" step="0.5">
                <button type="button" class="add-strength-builder-btn" id="addStrengthBtn">
                    <i class="mdi mdi-plus"></i> إضافة
                </button>
            </div>
        </div>
    </div>
    
    <div class="flavor-form-section">
        <h4 class="flavor-form-section-title">صور النكهة</h4>
        <div class="flavor-form-group">
            <label class="flavor-form-label">اختر الصور (يمكنك رفع أكثر من صورة)</label>
            <input type="file" id="flavorImages" name="images[]" class="flavor-form-input" accept="image/*" multiple>
            <div id="imagePreviewContainer" class="mt-2 d-flex flex-wrap gap-2"></div>
        </div>
    </div>



    <div class="flavor-form-actions">
        <button type="button" class="flavor-form-btn flavor-form-save" id="saveFlavorBtn">
            <i class="mdi mdi-check"></i> حفظ النكهة
        </button>
        <button type="button" class="flavor-form-btn flavor-form-cancel" id="cancelFlavorBtn">
            <i class="mdi mdi-close"></i> إلغاء
        </button>
    </div>
</div>









                <!-- Statistics -->
                <div class="stats-row">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="stat-item">
                                <div class="stat-number">{{ $brand->flavours->count() }}</div>
                                <div class="stat-label">النكهات</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="stat-item">
                                <div class="stat-number">{{ $brand->flavours->flatMap->liquids->count() }}</div>
                                <div class="stat-label">إجمالي الخيارات</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="stat-item">
                                <div class="stat-number">{{ $brand->flavours->flatMap->liquids->flatMap->strengthNic->count() }}</div>
                                <div class="stat-label">التراكيز المتاحة</div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Flavours Grid -->
                <div id="flavoursContainer">
                    @forelse($brand->flavours as $flavour)
                        <div class="flavour-card" data-flavour-id="{{ $flavour->id }}">
                            <div class="flavour-header">
                                <h3 class="flavour-title">{{ $flavour->name }}</h3>
                                <small>{{ $flavour->liquids->count() }} خيار متاح</small>
                                <div class="inventory-management" style="margin-top: 15px; text-align: center;">
                                    <button class="btn btn-success" data-toggle="modal" data-target="#edit{{ $flavour->id }}" style="border-radius: 20px; padding: 8px 20px; font-size: 12px; font-weight: 600;">
                                        <i class="fas fa-warehouse me-1"></i>
                                        تغديل
                                    </button>
                                </div>
                            </div>
                            
                            <div class="liquid-options">
                                @php
                                    $vapeStyles = $flavour->liquids->pluck('vape_style')->unique();
                                    $nicotineTypes = $flavour->liquids->pluck('nicotine_type')->unique();
                                @endphp
                                
                               <div class="option-selector">

                                <div class="option-group">
                                    <div class="option-label">أسلوب الفيب:</div>
                                    <div class="option-buttons">
                                        @php
                                            // All possible vape styles
                                            $allVapeStyles = ['MTL', 'DL', 'SaltNic'];
                                            $existingVapeStyles = $flavour->liquids->pluck('vape_style')->unique()->toArray();
                                        @endphp
                                        
                                        @foreach($allVapeStyles as $style)
                                            @php
                                                $exists = in_array($style, $existingVapeStyles);
                                                $buttonClass = $exists ? 'option-btn vape-option vape-' . strtolower($style) : 'option-btn vape-option vape-' . strtolower($style) . ' unavailable';
                                            @endphp
                                            <button class="{{ $buttonClass }}" 
                                                    data-flavour="{{ $flavour->id }}" 
                                                    data-type="vape_style" 
                                                    data-value="{{ $style }}"
                                                    data-exists="{{ $exists ? 'true' : 'false' }}">
                                                {{ $style }}
                                                @if(!$exists)
                                                    <i class="mdi mdi-plus-circle-outline" style="font-size: 10px; margin-left: 3px;"></i>
                                                @endif
                                            </button>
                                        @endforeach
                                    </div>
                                </div>
                                
                                <div class="option-group">
                                    <div class="option-label">نوع النيكوتين:</div>
                                    <div class="option-buttons">
                                        @php
                                            // All possible nicotine types
                                            $allNicotineTypes = ['Salt', 'Freebase', 'DL'];
                                            $existingNicotineTypes = $flavour->liquids->pluck('nicotine_type')->unique()->toArray();
                                        @endphp
                                        
                                        @foreach($allNicotineTypes as $type)
                                            @php
                                                $exists = in_array($type, $existingNicotineTypes);
                                                $buttonClass = $exists ? 'option-btn nicotine-option nic-' . strtolower($type) : 'option-btn nicotine-option nic-' . strtolower($type) . ' unavailable';
                                            @endphp
                                            <button class="{{ $buttonClass }}" 
                                                    data-flavour="{{ $flavour->id }}" 
                                                    data-type="nicotine_type" 
                                                    data-value="{{ $type }}"
                                                    data-exists="{{ $exists ? 'true' : 'false' }}">
                                                {{ $type }}
                                                @if(!$exists)
                                                    <i class="mdi mdi-plus-circle-outline" style="font-size: 10px; margin-left: 3px;"></i>
                                                @endif
                                            </button>
                                        @endforeach
                                    </div>
                                </div>



                                

                        

                            </div>

                                <!-- Dynamic Liquid Details -->
                                @foreach($flavour->liquids as $liquid)
                                    <div class="liquid-details" 
                                         data-flavour="{{ $flavour->id }}"
                                         data-vape="{{ $liquid->vape_style }}" 
                                         data-nicotine="{{ $liquid->nicotine_type }}">
                                        
                                        <div class="detail-grid">
                                            <div class="detail-item">
                                                <span class="detail-value">{{ $liquid->vape_style }}</span>
                                                <div class="detail-label">أسلوب الفيب</div>
                                            </div>
                                            <div class="detail-item">
                                                <span class="detail-value">{{ $liquid->nicotine_type }}</span>
                                                <div class="detail-label">نوع النيكوتين</div>
                                            </div>
                                            <div class="detail-item">
                                                <span class="detail-value">{{ $liquid->vg_pg_ratio ?? 'N/A' }}</span>
                                                <div class="detail-label">VG/PG</div>
                                            </div>
                                            <div class="detail-item">
                                                <span class="detail-value">{{ $liquid->bottle_size_ml ?? 'N/A' }}ml</span>
                                                <div class="detail-label">حجم الزجاجة</div>
                                            </div>
                                        </div>

                                        @if($liquid->strengthNic && $liquid->strengthNic->count() > 0)
                                            <div class="strengths-container" data-liquid-id="{{ $liquid->id }}">
                                                <strong style="display: block; margin-bottom: 10px; color: #495057;">
                                                    تراكيز النيكوتين المتاحة:
                                                </strong>
                                                <div class="strengths-list">
                                                    @foreach($liquid->strengthNic->sortBy('strength') as $strength)
                                                        <div class="strength-item" data-strength-id="{{ $strength->id }}">
                                                            <span class="strength-badge">{{ $strength->strength }} مجم</span>
                                                            <div class="strength-actions">
                                                                <button class="strength-btn delete-strength" title="حذف">
                                                                    <i class="mdi mdi-delete"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <button class="add-strength-btn" data-liquid-id="{{ $liquid->id }}">
                                                    <i class="mdi mdi-plus"></i> إضافة تركيز جديد
                                                </button>
                                                <div class="strength-input">
                                                    <input type="number" placeholder="التركيز (مجم)" min="0" max="50" step="0.5">
                                                    <button class="strength-save">حفظ</button>
                                                    <button class="strength-cancel">إلغاء</button>
                                                </div>
                                            </div>

            <div>
                <!--  Inventory Management Button -->
                <div class="inventory-management" style="margin-top: 15px; text-align: center;">
                    <button class="btn btn-success" data-toggle="modal" data-target="#addInventory{{ $liquid->id }}" style="border-radius: 20px; padding: 8px 20px; font-size: 12px; font-weight: 600;">
                        <i class="fas fa-warehouse me-1"></i>
                        إدارة المخزون
                    </button>
                    <a href="{{ route('liquid.show', $liquid->id) }}" class="btn btn-success" style="border-radius: 20px;">
                            <i class="fas fa-warehouse me-1"></i>
                            عرض التفاصيل
                    </a>

                </div>
            
            </div>
                                        @else
                                            <div class="strengths-container" data-liquid-id="{{ $liquid->id }}">
                                                <strong style="display: block; margin-bottom: 10px; color: #495057;">
                                                    تراكيز النيكوتين المتاحة:
                                                </strong>
                                                <div class="strengths-list">
                                                    <span class="text-muted">لا توجد تراكيز متاحة</span>
                                                </div>
                                                <button class="add-strength-btn" data-liquid-id="{{ $liquid->id }}">
                                                    <i class="mdi mdi-plus"></i> إضافة تركيز جديد
                                                </button>
                                                <div class="strength-input">
                                                    <input type="number" placeholder="التركيز (مجم)" min="0" max="50" step="0.5">
                                                    <button class="strength-save">حفظ</button>
                                                    <button class="strength-cancel">إلغاء</button>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                                    
                                <!-- No Match Container with Add New Liquid Form -->
                                <div class="no-match-container" data-flavour-id="{{ $flavour->id }}">
                                    <div class="no-match-text">
                                        <i class="mdi mdi-information-outline"></i>
                                        لا توجد خيارات متاحة للفلاتر المحددة
                                    </div>
                                    <button class="add-liquid-btn" 
                                            data-flavour-id="{{ $flavour->id }}"
                                            data-flavour-name="{{ $flavour->name }}">
                                        <i class="mdi mdi-plus-circle"></i>
                                        إضافة خيار جديد لهذه النكهة
                                    </button>
                                    
                                    <!-- Liquid Form -->
                                    <div class="liquid-form-container">
                                        <div class="liquid-form-row">
                                            <div class="liquid-form-group">
                                                <label class="liquid-form-label">نسبة VG/PG:</label>
                                                <select class="liquid-form-input vg-pg-input">
                                                    <option value="">اختر النسبة</option>
                                                    <option value="70/30">70/30</option>
                                                    <option value="60/40">60/40</option>
                                                    <option value="50/50">50/50</option>
                                                    <option value="80/20">80/20</option>
                                                    <option value="custom">مخصص</option>
                                                </select>
                                            </div>
                                            <div class="liquid-form-group">
                                                <label class="liquid-form-label">حجم الزجاجة (مل):</label>
                                                <select class="liquid-form-input bottle-size-input">
                                                    <option value="">اختر الحجم</option>
                                                    <option value="10">10 مل</option>
                                                    <option value="30">30 مل</option>
                                                    <option value="60">60 مل</option>
                                                    <option value="100">100 مل</option>
                                                    <option value="120">120 مل</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <!-- Custom VG/PG input (hidden by default) -->
                                        <div class="liquid-form-row custom-vg-pg">
                                            <div class="liquid-form-group">
                                                <label class="liquid-form-label">نسبة VG مخصصة:</label>
                                                <input type="number" class="liquid-form-input custom-vg-input" placeholder="70" min="0" max="100">
                                            </div>
                                            <div class="liquid-form-group">
                                                <label class="liquid-form-label">نسبة PG مخصصة:</label>
                                                <input type="number" class="liquid-form-input custom-pg-input" placeholder="30" min="0" max="100">
                                            </div>
                                        </div>
                                        
                                        <div class="liquid-form-actions">
                                            <button class="liquid-form-btn liquid-form-save">
                                                <i class="mdi mdi-check"></i> حفظ الخيار الجديد
                                            </button>
                                            <button class="liquid-form-btn liquid-form-cancel">
                                                <i class="mdi mdi-close"></i> إلغاء
                                            </button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    @empty
                        <div class="alert alert-info text-center">
                            <h5>لا توجد نكهات متاحة</h5>
                            <p>لم يتم إضافة أي نكهات لهذه العلامة التجارية بعد.</p>
                        </div>
                    @endforelse
                </div>

                <!-- No Results -->
                <div id="noResults" class="alert alert-warning text-center" style="display: none;">
                    <i class="mdi mdi-magnify fa-2x mb-3"></i>
                    <h5>لا توجد نتائج</h5>
                    <p>لا توجد نكهات تطابق الفلاتر المحددة.</p>
                </div>

            </div>
        </div>
    </div>
</div>

@forelse($brand->flavours as $flavour)
    @include('dashboard.flavours.edit')

    @foreach($flavour->liquids as $liquid)
        @include('dashboard.liquid.add-inventory')
    @endforeach
@empty
@endforelse
@endsection

@section('js')
<script src="{{ URL::asset('dashboard/plugins/select2/js/select2.min.js') }}"></script>

<script>
    $(document).ready(function() {
    
    // Configuration
    const config = {
        routes: {
            addStrength: '{{ route("brands.liquid-strength.add") }}',
            deleteStrength: '{{ route("brands.liquid-strength.delete", "PLACEHOLDER") }}',
            addLiquid: '{{ route("brands.liquid.add") ?? "#" }}' ,// Add this route to your web.php,
            addFlavour: '{{ route("brands.flavor.add", $brand->id) ?? "#" }}'

        },
        csrfToken: '{{ csrf_token() }}'
    };

    // Utility Functions
    function showLoading(element, originalText) {
        $(element).prop('disabled', true).html('<i class="mdi mdi-loading mdi-spin"></i> جاري التحميل...');
    }

    function hideLoading(element, originalText) {
        $(element).prop('disabled', false).html(originalText);
    }

    function showError(message) {
        alert('خطأ: ' + message);
    }

    function showSuccess(message) {
        alert('نجح: ' + message);
    }

    // Individual Option Selection
    $(document).on('click', '.option-btn', function() {
        const $this = $(this);
        const flavourId = $this.data('flavour');
        const type = $this.data('type');
        const value = $this.data('value');
        
        // Toggle active state within the same group
        const $group = $this.closest('.option-group');
        $group.find('.option-btn').removeClass('active');
        $this.addClass('active');
        
        // Show matching liquid details
        updateLiquidDisplay(flavourId);
    });

    // Update Liquid Display
    function updateLiquidDisplay(flavourId) {
        const $flavourCard = $(`.flavour-card[data-flavour-id="${flavourId}"]`);
        const selectedVape = $flavourCard.find('.vape-option.active').data('value');
        const selectedNicotine = $flavourCard.find('.nicotine-option.active').data('value');
        
        // Hide all liquid details and no-match containers for this flavour
        $flavourCard.find('.liquid-details').removeClass('show');
        $flavourCard.find('.no-match-container').removeClass('show');
        
        // Show matching liquid details or no-match container
        if (selectedVape && selectedNicotine) {
            const $matchingLiquid = $flavourCard.find(
                `.liquid-details[data-vape="${selectedVape}"][data-nicotine="${selectedNicotine}"]`
            );
            
            if ($matchingLiquid.length > 0) {
                $matchingLiquid.addClass('show');
            } else {
                $flavourCard.find('.no-match-container').addClass('show');
            }
        }
    }

    // Reset individual flavour selections
    function resetFlavourSelections() {
        $('.option-btn').removeClass('active');
        $('.liquid-details').removeClass('show');
        $('.no-match-container').removeClass('show');
        $('.liquid-form-container').removeClass('show');
        $('.add-liquid-btn').show();
        
        // Clear all forms
        $('.liquid-form-input').val('');
        $('.custom-vg-pg').hide();
        
        // Auto-select first options for each flavour
        $('.flavour-card').each(function() {
            const $card = $(this);
            $card.find('.vape-option:first, .nicotine-option:first').addClass('active');
            updateLiquidDisplay($card.data('flavour-id'));
        });
    }

    // Initialize - auto-select first options
    $('.flavour-card').each(function() {
        const $card = $(this);
        $card.find('.vape-option:first, .nicotine-option:first').addClass('active');
        updateLiquidDisplay($card.data('flavour-id'));
    });

    // Strength Management
    $(document).on('click', '.add-strength-btn', function() {
        const $container = $(this).closest('.strengths-container');
        const $input = $container.find('.strength-input');
        $input.show();
        $input.find('input').focus().val('');
    });

    $(document).on('click', '.strength-cancel', function() {
        const $input = $(this).closest('.strength-input');
        $input.hide();
    });

    $(document).on('click', '.strength-save', function() {
        const $this = $(this);
        const $container = $this.closest('.strengths-container');
        const $input = $container.find('.strength-input');
        const liquidId = $container.data('liquid-id');
        const strengthValue = $input.find('input').val();
        
        if (!strengthValue || strengthValue <= 0) {
            showError('يرجى إدخال تركيز صحيح');
            return;
        }
        
        showLoading($this, '<i class="mdi mdi-check"></i> حفظ');
        
        $.ajax({
            url: config.routes.addStrength,
            method: 'POST',
            data: {
                liquid_id: liquidId,
                strength: strengthValue,
                _token: config.csrfToken
            },
            success: function(response) {
                if (response.success) {
                    location.reload();
                } else {
                    showError(response.message || 'فشل إضافة التركيز');
                }
            },
            error: function(xhr) {
                console.error('Add Strength Error:', xhr.responseText);
                showError('حدث خطأ أثناء إضافة التركيز');
            },
            complete: function() {
                hideLoading($this, '<i class="mdi mdi-check"></i> حفظ');
            }
        });
    });

    // Delete Strength
    $(document).on('click', '.delete-strength', function() {
        if (confirm('هل أنت متأكد من حذف هذا التركيز؟')) {
            const $item = $(this).closest('.strength-item');
            const strengthId = $item.data('strength-id');
            
            $.ajax({
                url: config.routes.deleteStrength.replace('PLACEHOLDER', strengthId),
                method: 'DELETE',
                data: {
                    _token: config.csrfToken
                },
                success: function(response) {
                    if (response.success) {
                        $item.fadeOut(300, function() {
                            $(this).remove();
                            
                            const $container = $item.closest('.strengths-container');
                            if ($container.find('.strength-item').length === 0) {
                                $container.find('.strengths-list').html('<span class="text-muted">لا توجد تراكيز متاحة</span>');
                            }
                        });
                    } else {
                        showError(response.message || 'فشل حذف التركيز');
                    }
                },
                error: function(xhr) {
                    console.error('Delete Strength Error:', xhr.responseText);
                    showError('حدث خطأ أثناء حذف التركيز');
                }
            });
        }
    });

    // Add New Liquid Form Management
    $(document).on('click', '.add-liquid-btn', function() {
        const $container = $(this).closest('.no-match-container');
        const $flavourCard = $container.closest('.flavour-card');
        
        // Get selected values from the current flavour card
        const selectedVape = $flavourCard.find('.vape-option.active').data('value');
        const selectedNicotine = $flavourCard.find('.nicotine-option.active').data('value');
        
        if (!selectedVape || !selectedNicotine) {
            showError('يرجى تحديد نوع الفيب ونوع النيكوتين أولاً');
            return;
        }
        
        $(this).hide();
        $container.find('.liquid-form-container').addClass('show');
    });

    // VG/PG Selection Handler
    $(document).on('change', '.vg-pg-input', function() {
        const $container = $(this).closest('.liquid-form-container');
        const $customRow = $container.find('.custom-vg-pg');
        
        if ($(this).val() === 'custom') {
            $customRow.show();
        } else {
            $customRow.hide();
            $customRow.find('input').val('');
        }
    });

    // Form Cancel
    $(document).on('click', '.liquid-form-cancel', function() {
        const $container = $(this).closest('.no-match-container');
        
        $container.find('.liquid-form-container').removeClass('show');
        $container.find('.add-liquid-btn').show();
        
        // Clear form inputs
        $container.find('.liquid-form-input').val('');
        $container.find('.custom-vg-pg').hide();
    });

    // Form Submit
    $(document).on('click', '.liquid-form-save', function() {
        const $this = $(this);
        const $container = $this.closest('.no-match-container');
        const $formContainer = $this.closest('.liquid-form-container');
        const $flavourCard = $container.closest('.flavour-card');
        
        // Get form data
        const flavourId = $container.data('flavour-id');
        
        // Get selected values from the current flavour card
        const selectedVape = $flavourCard.find('.vape-option.active').data('value');
        const selectedNicotine = $flavourCard.find('.nicotine-option.active').data('value');
        
        let vgPgRatio = $formContainer.find('.vg-pg-input').val();
        const bottleSize = $formContainer.find('.bottle-size-input').val();
        
        // Handle custom VG/PG
        if (vgPgRatio === 'custom') {
            const customVg = parseInt($formContainer.find('.custom-vg-input').val()) || 0;
            const customPg = parseInt($formContainer.find('.custom-pg-input').val()) || 0;
            
            if (!customVg || !customPg || (customVg + customPg) !== 100) {
                showError('يرجى إدخال نسب VG/PG صحيحة (المجموع يجب أن يساوي 100)');
                return;
            }
            
            vgPgRatio = `${customVg}/${customPg}`;
        }
        
        // Validate inputs
        if (!selectedVape || !selectedNicotine) {
            showError('يرجى تحديد نوع الفيب ونوع النيكوتين أولاً');
            return;
        }
        
        if (!vgPgRatio) {
            showError('يرجى اختيار نسبة VG/PG');
            return;
        }
        
        if (!bottleSize) {
            showError('يرجى اختيار حجم الزجاجة');
            return;
        }
        
        showLoading($this, '<i class="mdi mdi-check"></i> حفظ الخيار الجديد');
        
        // AJAX call to add new liquid
        $.ajax({
            url: config.routes.addLiquid,
            method: 'POST',
            data: {
                flavour_id: flavourId,
                vape_style: selectedVape,
                nicotine_type: selectedNicotine,
                vg_pg_ratio: vgPgRatio,
                bottle_size_ml: bottleSize,
                _token: config.csrfToken
            },
            success: function(response) {
                if (response.success) {
                    showSuccess('تم إضافة الخيار الجديد بنجاح');
                    setTimeout(() => location.reload(), 1000);
                } else {
                    showError(response.message || 'فشل إضافة الخيار الجديد');
                }
            },
            error: function(xhr) {
                console.error('Add Liquid Error:', xhr.responseText);
                let errorMessage = 'حدث خطأ أثناء إضافة الخيار الجديد';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                }
                showError(errorMessage);
            },
            complete: function() {
                hideLoading($this, '<i class="mdi mdi-check"></i> حفظ الخيار الجديد');
            }
        });
    });


// ========================================
// ADD FLAVOR FORM FUNCTIONALITY
// ========================================

let selectedStrengths = [];

$(document).on('click', '#addFlavorBtn', function() {
    $('#addFlavorFormContainer').addClass('show');
    $('html, body').animate({
        scrollTop: $('#addFlavorFormContainer').offset().top - 50
    }, 500);
});

$(document).on('click', '#cancelFlavorBtn', function() {
    resetFlavorForm();
});

$(document).on('click', '.style-checkbox', function() {
    const $checkbox = $(this).find('input[type="checkbox"]');
    const isChecked = $checkbox.prop('checked');
    $checkbox.prop('checked', !isChecked);
    $(this).toggleClass('selected', !isChecked);
});

$(document).on('change', '#vgPgRatio', function() {
    const $customRow = $('#customVgPgRow');
    if ($(this).val() === 'custom') {
        $customRow.show();
    } else {
        $customRow.hide();
        $('#customVg, #customPg').val('');
    }
});

$(document).on('click', '#addStrengthBtn', function() {
    const strengthValue = parseFloat($('#strengthInput').val());
    
    if (!strengthValue || strengthValue <= 0 || strengthValue > 50) {
        showError('يرجى إدخال تركيز صحيح (0-50 مجم)');
        return;
    }
    
    if (selectedStrengths.includes(strengthValue)) {
        showError('هذا التركيز مضاف مسبقاً');
        return;
    }
    
    selectedStrengths.push(strengthValue);
    selectedStrengths.sort((a, b) => a - b);
    updateStrengthsList();
    $('#strengthInput').val('');
});

$(document).on('keypress', '#strengthInput', function(e) {
    if (e.which === 13) {
        $('#addStrengthBtn').click();
    }
});

$(document).on('click', '.remove-strength', function() {
    const strength = parseFloat($(this).data('strength'));
    selectedStrengths = selectedStrengths.filter(s => s !== strength);
    updateStrengthsList();
});

function updateStrengthsList() {
    const $list = $('#strengthsList');
    if (selectedStrengths.length === 0) {
        $list.html('<span class="text-muted">لا توجد تراكيز مضافة بعد</span>');
        return;
    }
    let html = '';
    selectedStrengths.forEach(strength => {
        html += `
            <div class="strength-tag">
                ${strength} مجم
                <button type="button" class="remove-strength" data-strength="${strength}">
                    <i class="mdi mdi-close"></i>
                </button>
            </div>
        `;
    });
    $list.html(html);
}

$(document).on('click', '#saveFlavorBtn', function() {
    const $this = $(this);

    const flavorName = $('#flavorName').val().trim();
    const selectedVapeStyles = $('.vape-styles-container .style-checkbox.selected').map(function() {
        return $(this).data('value');
    }).get();
    const selectedNicotineTypes = $('.nicotine-types-container .style-checkbox.selected').map(function() {
        return $(this).data('value');
    }).get();
    let vgPgRatio = $('#vgPgRatio').val();
    const bottleSize = $('#bottleSize').val();
    
    if (!flavorName) {
        showError('يرجى إدخال اسم النكهة');
        return;
    }
    if (selectedVapeStyles.length === 0) {
        showError('يرجى اختيار أسلوب فيب واحد على الأقل');
        return;
    }
    if (selectedNicotineTypes.length === 0) {
        showError('يرجى اختيار نوع نيكوتين واحد على الأقل');
        return;
    }
    if (!vgPgRatio) {
        showError('يرجى اختيار نسبة VG/PG');
        return;
    }
    if (!bottleSize) {
        showError('يرجى اختيار حجم الزجاجة');
        return;
    }
    
    if (vgPgRatio === 'custom') {
        const customVg = parseInt($('#customVg').val()) || 0;
        const customPg = parseInt($('#customPg').val()) || 0;
        if (!customVg || !customPg || (customVg + customPg) !== 100) {
            showError('يرجى إدخال نسب VG/PG صحيحة (المجموع يجب أن يساوي 100)');
            return;
        }
        vgPgRatio = `${customVg}/${customPg}`;
    }
    
    showLoading($this, '<i class="mdi mdi-check"></i> حفظ النكهة');

// Create FormData object
let formData = new FormData();

formData.append('brand_id', {{ $brand->id }});
formData.append('name', flavorName);
formData.append('description', $('#flavorDescription').val().trim());
formData.append('vg_pg_ratio', vgPgRatio);
formData.append('bottle_size_ml', bottleSize);
formData.append('_token', config.csrfToken);

// Arrays -> either JSON.stringify or append one by one
formData.append('vape_styles', JSON.stringify(selectedVapeStyles));
formData.append('nicotine_types', JSON.stringify(selectedNicotineTypes));
formData.append('strengths', JSON.stringify(selectedStrengths));

// Append images
let images = $('#flavorImages')[0].files;
for (let i = 0; i < images.length; i++) {
    formData.append('images[]', images[i]);
}

// Send via AJAX
$.ajax({
    url: config.routes.addFlavour,
    method: 'POST',
    data: formData,
    processData: false,  // <-- MUST
    contentType: false,  // <-- MUST
    success: function(response) {
        if (response.success) {
            showSuccess('تم إضافة النكهة بنجاح');
            setTimeout(() => location.reload(), 1500);
        } else {
            showError(response.message || 'فشل إضافة النكهة');
        }
    },
    error: function(xhr) {
        console.error('Add Flavor Error:', xhr.responseText);
        showError('حدث خطأ أثناء إضافة النكهة');
    },
    complete: function() {
        hideLoading($this, '<i class="mdi mdi-check"></i> حفظ النكهة');
    }
});



});

function resetFlavorForm() {
    $('#addFlavorFormContainer').removeClass('show');
    $('#flavorName, #flavorDescription').val('');
    $('.style-checkbox').removeClass('selected').find('input').prop('checked', false);
    $('#vgPgRatio, #bottleSize').val('');
    $('#customVgPgRow').hide();
    $('#customVg, #customPg').val('');
    selectedStrengths = [];
    updateStrengthsList();
}



});


</script>
@endsection