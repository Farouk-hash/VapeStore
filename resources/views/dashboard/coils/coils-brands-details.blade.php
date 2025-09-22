@extends('dashboard.layouts.master')

@section('css')
<link href="{{ URL::asset('dashboard/plugins/jquery-nice-select/css/nice-select.css') }}" rel="stylesheet"/>
<link href="{{ URL::asset('dashboard/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
<style>
.device-card {
    transition: all 0.3s ease;
    border: 1px solid #e9ecef;
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    margin-bottom: 20px;
}

.device-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

.device-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 20px;
    border-radius: 10px 10px 0 0;
    position: relative;
}

.device-title {
    font-size: 22px;
    font-weight: 700;
    margin: 0;
}

.device-release-year {
    position: absolute;
    top: 15px;
    left: 15px;
    background: rgba(255,255,255,0.2);
    padding: 5px 10px;
    border-radius: 15px;
    font-size: 12px;
    font-weight: 600;
}

.device-options {
    padding: 20px;
}

.specs-container {
    background: #f8f9fa;
    border-radius: 8px;
    padding: 15px;
    margin-bottom: 20px;
}

.spec-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 15px;
    margin-bottom: 15px;
}

.spec-item {
    text-align: center;
    padding: 12px;
    background: white;
    border-radius: 8px;
    border: 1px solid #dee2e6;
}

.spec-value {
    font-size: 16px;
    font-weight: 700;
    color: #007bff;
    display: block;
    margin-bottom: 5px;
}

.spec-label {
    font-size: 11px;
    color: #6c757d;
    text-transform: uppercase;
    font-weight: 600;
}

.colors-section {
    margin: 20px 0;
}

.colors-grid {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-top: 10px;
}

.color-item {
    padding: 8px 15px;
    border: 2px solid #dee2e6;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    background: white;
    transition: all 0.2s;
}

.color-item:hover {
    border-color: #007bff;
    background: #e3f2fd;
}

.features-section {
    margin: 20px 0;
}

.features-list {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin-top: 10px;
}

.feature-tag {
    background: linear-gradient(45deg, #28a745, #20c997);
    color: white;
    padding: 6px 12px;
    border-radius: 15px;
    font-size: 11px;
    font-weight: 600;
}

.flavors-section {
    margin: 20px 0;
}

.flavors-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 10px;
    margin-top: 10px;
}

.flavor-item {
    text-align: center;
    padding: 10px;
    background: #fff3cd;
    border: 1px solid #ffc107;
    border-radius: 8px;
    font-size: 12px;
    font-weight: 600;
    color: #856404;
}
/* Select2 Custom Styles */
.select2-container--default .select2-selection--multiple {
    border: 1px solid #ced4da;
    border-radius: 4px;
    min-height: 38px;
    padding: 2px;
}

.select2-container--default .select2-selection--multiple .select2-selection__choice {
    background: linear-gradient(45deg, #28a745, #20c997);
    color: white;
    border: none;
    border-radius: 15px;
    padding: 4px 10px;
    margin: 3px;
    font-size: 12px;
    font-weight: 600;
}

.select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
    color: white;
    margin-right: 5px;
    font-size: 14px;
}

.select2-container--default .select2-selection--multiple .select2-selection__choice__remove:hover {
    color: #ffcc00;
}

.select2-container--default .select2-search--inline .select2-search__field {
    margin-top: 5px;
    min-height: 26px;
}

/* Tags preview for selected flavors */
.flavor-tag {
    background: linear-gradient(45deg, #28a745, #20c997);
    color: white;
    padding: 6px 12px;
    border-radius: 15px;
    font-size: 11px;
    font-weight: 600;
    margin: 3px;
    display: inline-block;
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

.add-device-btn {
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

.add-device-btn:hover {
    background: linear-gradient(45deg, #218838, #1e9b7a) !important;
    transform: translateY(-3px) !important;
    box-shadow: 0 6px 25px rgba(40, 167, 69, 0.4) !important;
}

.device-actions {
    margin-top: 20px;
    text-align: center;
    padding-top: 15px;
    border-top: 1px solid #e9ecef;
}

.device-action-btn {
    margin: 0 5px;
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    transition: all 0.2s ease;
    border: none;
    cursor: pointer;
}

.btn-edit {
    background: #17a2b8;
    color: white;
}

.btn-edit:hover {
    background: #138496;
    transform: translateY(-1px);
}

.btn-inventory {
    background: #28a745;
    color: white;
}

.btn-inventory:hover {
    background: #218838;
    transform: translateY(-1px);
}

.btn-details {
    background: #6f42c1;
    color: white;
}

.btn-details:hover {
    background: #5a32a3;
    transform: translateY(-1px);
}
/* Collapsible Section Styles */
.collapsible-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    cursor: pointer;
    padding: 10px 15px;
    background: #f8f9fa;
    border-radius: 8px;
    transition: all 0.3s ease;
    margin-bottom: 10px;
    border: 1px solid #dee2e6;
}

.collapsible-header:hover {
    background: #e9ecef;
    border-color: #007bff;
}

.collapsible-header h5 {
    margin: 0;
    color: #495057;
    font-weight: 600;
    font-size: 14px;
}

.collapsible-toggle {
    display: flex;
    align-items: center;
    font-size: 12px;
    color: #6c757d;
    font-weight: 500;
}

.collapsible-arrow {
    margin-left: 8px;
    transition: transform 0.3s ease;
    font-size: 14px;
}

.collapsible-header.expanded .collapsible-arrow {
    transform: rotate(180deg);
}

.collapsible-content {
    overflow: hidden;
    transition: max-height 0.3s ease, opacity 0.3s ease;
    max-height: 0;
    opacity: 0;
}

.collapsible-content.show {
    opacity: 1;
    margin-bottom: 15px;
}

.items-preview {
    display: flex;
    flex-wrap: wrap;
    gap: 5px;
    margin-left: 10px;
}

.preview-item {
    background: #e3f2fd;
    color: #1976d2;
    padding: 2px 8px;
    border-radius: 10px;
    font-size: 10px;
    font-weight: 500;
}

.preview-more {
    background: #ffc107;
    color: #856404;
    padding: 2px 8px;
    border-radius: 10px;
    font-size: 10px;
    font-weight: 600;
}

</style>
@endsection

@section('page-header')
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">الكويلز</h4>
            <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ الكويلز</span>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="row row-sm">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                
                <!-- Category Header -->
                <div class="text-center mb-4">
                    <h2 class="text-primary">الكويلز</h2>
                    <p class="text-muted">عرض جميع الكويلز المتاحة</p>
                </div>

                <!-- Add Device Button -->
                <div class="text-center">
                    <button class="add-device-btn" id="addDeviceBtn">
                        <i class="mdi mdi-plus-circle"></i>
                        إضافة كويلز جديد
                    </button>
                </div>

                <!-- Statistics -->
                <div class="stats-row">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="stat-item">
                                <div class="stat-number">{{ $coilSeries->count() }}</div>
                                <div class="stat-label">إجمالي الكويلز</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="stat-item">
                                <div class="stat-number">{{ $coilSeries->flatMap->coilsOhms->count() }}</div>
                                <div class="stat-label">المقاومات المتاحة</div>
                            </div>
                        </div>
                        {{-- RDL : 5(COUNTS) , MTL: 10(COUNTS) , etc.... --}}
                        @foreach ($coilVapingStyles as $coilVapingStyleKey=>$coilVapingStyleValue)
                            <div class="col-md-4">
                                <div class="stat-item">
                                    <div class="stat-number">{{$coilVapingStyleValue}}</div>
                                    <div class="stat-label">{{$coilVapingStyleKey}}</div>
                                </div>
                            </div>
                        @endforeach
                        
                    </div>
                </div>




<!-- Add Device Form (Initially Hidden) -->

<div id="addDeviceFormContainer" class="card mb-4" style="display: none;">
    <div class="card-header bg-primary text-white">
        <h4 class="mb-0">
            <i class="mdi mdi-plus-circle"></i>
            إضافة كويل جديد - {{ $coilSeries[0]->brand->name ?? 'العلامة التجارية' }}
        </h4>
    </div>
    <div class="card-body">
        <form id="addDeviceForm">
            @csrf
            <input type="hidden" name="brand_id" value="{{ $coilSeries[0]->brand->id ?? '' }}">
            <input type="hidden" name="category_id" value="{{ $coilSeries[0]->category->id ?? '' }}">
            
            <!-- Basic Information -->
            <div class="form-section">
                <h5 class="section-title">المعلومات الأساسية</h5>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="coil_name">اسم الكويل *</label>
                            <input type="text" class="form-control" id="coil_name" name="name" required>
                        </div>
                    </div>
                    
                </div>

                <div class="form-group">
                    <label for="tank_description">وصف الجهاز</label>
                    <textarea class="form-control" id="tank_description" name="description" rows="3"></textarea>
                </div>
            </div>

            
        <!-- Specifications Section -->

        <div class="form-section">
            <h5 class="section-title">المواصفات التقنية للفتائل</h5>
    
            <div id="coils_container">
                <!-- First Coil -->
                <div class="coil-item card mb-4" data-coil-index="0">
                    <div class="card-header bg-light d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">فتيلة #1</h6>
                        <button type="button" class="btn btn-sm btn-danger remove-coil" style="display: none;">
                            <i class="mdi mdi-close"></i> حذف
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">اسم الفتيلة *</label>
                                <input type="text" class="form-control" name="coils[0][name]" placeholder="مثال: GTX Coil 0.15Ω" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">المقاومة (Ω) *</label>
                                <input type="number" class="form-control" name="coils[0][resistance]" placeholder="مثال: 0.15" step="0.01" min="0.1" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">مدى الواط (Wattage) *</label>
                                <input type="text" class="form-control" name="coils[0][wattage_range]" placeholder="مثال: 60-75W" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">نمط التدخين *</label>
                                <select class="form-control" name="coils[0][vaping_style]" required>
                                    <option value="">اختر نمط التدخين</option>
                                    <option value="mtl">MTL (فم إلى رئة)</option>
                                    <option value="rdl">RDL (مقيد إلى الرئة)</option>
                                    <option value="dl">DL (مباشر إلى الرئة)</option>
                                </select>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label class="form-label">وصف الفتيلة</label>
                                    <textarea class="form-control" name="coils[0][description]" placeholder="وصف تفصيلي للفتيلة وأدائها..." rows="2"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="button" class="btn btn-success" id="add_coil_btn">
                    <i class="mdi mdi-plus"></i> إضافة فتيلة أخرى
                </button>
            </div>
        </div>

            <!-- Images Section -->
            <div class="form-section">
                <h5 class="section-title">صور الجهاز</h5>
                <div class="form-group">
                    <label for="device_images">صور الجهاز (يمكن اختيار أكثر من صورة)</label>
                    <input type="file" class="form-control-file" id="device_images" name="images[]" multiple accept="image/*">
                    <small class="form-text text-muted">الصور المقبولة: JPG, PNG, GIF. الحجم الأقصى: 2MB لكل صورة</small>
                </div>
            </div>

            <div class="form-actions mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="mdi mdi-content-save"></i> حفظ الجهاز
                </button>
                <button type="button" class="btn btn-secondary" id="cancelAddDevice">
                    <i class="mdi mdi-close"></i> إلغاء
                </button>
            </div>
        </form>
    </div>
</div>






                <!-- Devices Grid -->
                <div id="devicesContainer">
                    @forelse($coilSeries as $coilSer)
                        <div class="device-card" data-device-id="{{ $coilSer->id }}">
                            <div class="device-header">
                                <h3 class="device-title">{{ $coilSer->name }}</h3>
                                <small>{{ $coilSer->description ?? 'جهاز متطور للفيب' }}</small>                           
                            </div>
                            
                            <div class="device-options">
                                
                                <!-- Specifications Section -->
                                @if($coilSer->coilsOhms && $coilSer->coilsOhms->count() > 0)
                                    <div class="collapsible-section">
                                        <div class="collapsible-header"  data-target="#specs-{{ $coilSer->id }}">
                                            <h5>
                                                <i class="mdi mdi-cog"></i> المواصفات التقنية
                                            </h5>
                                            <div class="collapsible-toggle">
                                                <span>{{ $coilSer->coilsOhms->count() }} مقاومات</span>
                                                @if($coilSer->coilsOhms->count() > 1)
                                                    <div class="items-preview">
                                                        @foreach($coilSer->coilsOhms->take(2) as $ohm)
                                                            <span class="preview-item">{{ $ohm->resistance }}Ω</span>
                                                        @endforeach
                                                        <span class="preview-more">+{{ $coilSer->coilsOhms->count() - 2 }}</span>
                                                    </div>
                                                @endif
                                                <i class="mdi mdi-chevron-down collapsible-arrow"></i>
                                            </div>
                                        </div>
                                        <div class="collapsible-content" id="specs-{{ $coilSer->id }}">
                                            <div class="specs-container">
                                                <div class="spec-grid">
                                                    @foreach($coilSer->coilsOhms as $ohm)
                                                        <div class="spec-item">
                                                            <span class="spec-value">{{ $ohm->resistance }}Ω</span>
                                                            <div class="spec-label">{{ $ohm->vaping_style }}</div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                            
                                <!-- Device Actions -->
                                <div class="device-actions">
                                    <button class="device-action-btn btn-edit" data-toggle="modal" data-target="#editDevice{{ $coilSer->id }}">
                                        <i class="fas fa-edit"></i>
                                        تعديل
                                    </button>
                                    
                                    <button class="device-action-btn btn-inventory" data-toggle="modal" data-target="#manageInventory{{ $coilSer->id }}">
                                        <i class="fas fa-warehouse"></i>
                                        إدارة المخزون
                                    </button>
                                    
                                    <a 
                                    {{-- href="{{ route('devicesCategories.show', ['categorySlug'=>$categorySlug , 'brandId'=> $devices[0]->brand->id, 'deviceId'=>$device->id]) }}"  --}}
                                    class="device-action-btn btn-details">
                                        <i class="fas fa-eye"></i>
                                        عرض التفاصيل
                                    </a>
                                </div>

                            </div>
                        </div>
                        @include('dashboard.coils.add-inventory') 

                        <script>
                        // Store device data in JavaScript for dynamic use (THIS GOES INSIDE THE DEVICE LOOP)
                        window.deviceData = window.deviceData || {};
                        window.deviceData[{{ $coilSer->id }}] = {
                            colors: [
                                @if($coilSer->coilsOhms && $coilSer->coilsOhms->count() > 0)
                                    @foreach($coilSer->coilsOhms as $coilsOhm)
                                        {
                                            id: {{ $coilsOhm->id }},
                                            value: @json($coilsOhm->resistance),
                                            vapingStyle:@json($coilsOhm->vaping_style),
                                        },
                                    @endforeach
                                @endif
                            ],
                           
                        };
                        </script>  

                    @empty
                        <div class="alert alert-info text-center">
                            <h5>لا توجد تانكات متاحة</h5>
                            <p>لم يتم إضافة أي تانك في هذه الفئة بعد.</p>
                        </div>
                    @endforelse
                </div>

                <!-- No Results -->
                <div id="noResults" class="alert alert-warning text-center" style="display: none;">
                    <i class="mdi mdi-magnify fa-2x mb-3"></i>
                    <h5>لا توجد نتائج</h5>
                    <p>لا توجد أجهزة تطابق الفلاتر المحددة.</p>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Include Modals for each device -->
{{-- @forelse($devices as $device) --}}
    {{-- Edit Device Modal --}}
    {{-- @include('dashboard.devices.edit', ['device' => $device]) --}}
    
    {{-- Inventory Management Modal --}}
    {{-- @include('dashboard.devices.inventory', ['device' => $device]) --}}
{{-- @empty --}}
{{-- @endforelse --}}

@endsection

@section('js')
<script src="{{ URL::asset('dashboard/plugins/select2/js/select2.min.js') }}"></script>

<script>
$(document).ready(function() {
        const config = {
        routes: {
            addCoil: '{{ route("coils.store") ?? "#" }}',
            
        },
        csrfToken: '{{ csrf_token() }}'
    };
    // ========================================
    // COLLAPSIBLE SECTIONS FUNCTIONALITY
    // ========================================
    
    $(document).on('click', '.collapsible-header', function(e) {
        e.preventDefault();
        e.stopPropagation();
        
        const $header = $(this);
        const targetSelector = $header.data('target');
        const $content = $(targetSelector);
        
        if ($content.length === 0) {
            console.error('Target content not found:', targetSelector);
            return;
        }
        
        // Toggle the expanded class for arrow animation
        $header.toggleClass('expanded');
        
        // Toggle the content visibility
        if ($content.hasClass('show')) {
            // Collapse the content
            const currentHeight = $content[0].scrollHeight;
            $content.css('max-height', currentHeight + 'px');
            
            // Force reflow
            $content[0].offsetHeight;
            
            // Animate to collapsed state
            $content.removeClass('show').css({
                'max-height': '0',
                'opacity': '0'
            });
        } else {
            // Expand the content
            $content.addClass('show');
            const targetHeight = $content[0].scrollHeight;
            
            $content.css({
                'max-height': targetHeight + 'px',
                'opacity': '1'
            });
            
            // After animation completes, set max-height to auto for flexibility
            setTimeout(() => {
                if ($content.hasClass('show')) {
                    $content.css('max-height', 'none');
                }
            }, 300);
        }
    });

    // Initialize sections - Auto-expand sections with few items
    function initializeCollapsibleSections() {
        $('.collapsible-section').each(function() {
            const $section = $(this);
            const $header = $section.find('.collapsible-header');
            const $content = $section.find('.collapsible-content');
            
            // Extract item count from the toggle text
            const toggleText = $header.find('.collapsible-toggle span').first().text();
            const match = toggleText.match(/\d+/);
            const itemCount = match ? parseInt(match[0]) : 0;
            
            // Auto-expand if section has 3 or fewer items
            if (itemCount <= 3) {
                $header.addClass('expanded');
                $content.addClass('show').css({
                    'max-height': 'none',
                    'opacity': '1'
                });
            } else {
                // Ensure collapsed state for sections with many items
                $header.removeClass('expanded');
                $content.removeClass('show').css({
                    'max-height': '0',
                    'opacity': '0'
                });
            }
        });
    }
    






    // Show/hide form
    $(document).on('click', '#addDeviceBtn', function() {
        $('#addDeviceFormContainer').slideDown();
        $('html, body').animate({
            scrollTop: $('#addDeviceFormContainer').offset().top - 50
        }, 500);
    });

    $(document).on('click', '#cancelAddDevice', function() {
        $('#addDeviceFormContainer').slideUp();
        $('#addDeviceForm')[0].reset();
        resetForm();
    });

    // Tags preview functionality
    function updateTagsPreview(inputId, previewId) {
        const input = $('#' + inputId);
        const preview = $('#' + previewId);
        const value = input.val().trim();
        
        preview.empty();
        
        if (value) {
            const tags = value.split(/[,،;؛]/).map(tag => tag.trim()).filter(tag => tag);
            tags.forEach(tag => {
                preview.append(`<span class="tag-item">${tag}</span>`);
            });
        }
    }



// Initialize flavors select2 when document is ready
$(document).ready(function() {
    let coilCount = $('#coils_container .coil-item').length;
    
    // Add new coil
    $('#add_coil_btn').on('click', function() {
        const newCoilHtml = createNewCoil(coilCount);
        $('#coils_container').append(newCoilHtml);
        coilCount++;
        updateRemoveButtons();
    });
    
    // Remove coil
    $(document).on('click', '.remove-coil', function() {
        const coilItems = $('.coil-item');
        if (coilItems.length > 1) {
            $(this).closest('.coil-item').remove();
            coilCount--;
            updateRemoveButtons();
            reindexCoils();
        }
    });
    
    // Create new coil HTML
    function createNewCoil(index) {
        const coilNumber = index + 1;
        return `
            <div class="coil-item card mb-4" data-coil-index="${index}">
                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                    <h6 class="mb-0">Coil #${coilNumber}</h6>
                    <button type="button" class="btn btn-sm btn-danger remove-coil">
                        <i class="mdi mdi-close"></i> Delete
                    </button>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Coil Name *</label>
                            <input type="text" class="form-control" name="coils[${index}][name]" placeholder="Example: GTX Coil 0.15Ω" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Resistance (Ω) *</label>
                            <input type="number" class="form-control" name="coils[${index}][resistance]" placeholder="Example: 0.15" step="0.01" min="0.1" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Wattage Range *</label>
                            <input type="text" class="form-control" name="coils[${index}][wattage_range]" placeholder="Example: 60-75W" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Vaping Style *</label>
                            <select class="form-control" name="coils[${index}][vaping_style]" required>
                                <option value="">Select Vaping Style</option>
                                <option value="mtl">MTL (Mouth to Lung)</option>
                                <option value="rdl">RDL (Restricted Direct Lung)</option>
                                <option value="dl">DL (Direct Lung)</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label class="form-label">Coil Description</label>
                            <textarea class="form-control" name="coils[${index}][description]" placeholder="Detailed description of the coil and its performance..." rows="2"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        `;
    }
    
    // Update remove buttons visibility
    function updateRemoveButtons() {
        const coilItems = $('.coil-item');
        coilItems.each(function(index) {
            const removeBtn = $(this).find('.remove-coil');
            if (index === 0 && coilItems.length === 1) {
                removeBtn.hide();
            } else {
                removeBtn.show();
            }
        });
    }
    
    // Reindex all coils after removal
    function reindexCoils() {
        $('.coil-item').each(function(newIndex) {
            $(this).attr('data-coil-index', newIndex);
            $(this).find('.card-header h6').text('Coil #' + (newIndex + 1));
            
            // Update all input names with new index
            $(this).find('input, select, textarea').each(function() {
                const name = $(this).attr('name');
                if (name && name.includes('coils[')) {
                    const newName = name.replace(/coils\[\d+\]/, 'coils[' + newIndex + ']');
                    $(this).attr('name', newName);
                }
            });
        });
        
        coilCount = $('.coil-item').length;
    }
    
    // Initialize remove buttons
    updateRemoveButtons();
    
    // Form submission
    $(document).on('submit', '#addDeviceForm', function(e) {
        e.preventDefault();
        
        // Collect form data
        const formData = new FormData(this);
        
        // Extract coil data as array
        const coilsData = [];
        $('.coil-item').each(function(index) {
            const coilData = {
                name: $(this).find('input[name="coils['+index+'][name]"]').val(),
                resistance: $(this).find('input[name="coils['+index+'][resistance]"]').val(),
                wattage_range: $(this).find('input[name="coils['+index+'][wattage_range]"]').val(),
                vaping_style: $(this).find('select[name="coils['+index+'][vaping_style]"]').val(),
                description: $(this).find('textarea[name="coils['+index+'][description]"]').val()
            };
            coilsData.push(coilData);
        });
        
        // Add coil data to formData
        formData.append('coils_data', JSON.stringify(coilsData));
        
        // Log coil data for verification
        console.log('Coils Data:', coilsData);
        
        submitCoilForm(formData);
    });
    
    function submitCoilForm(formData) {
        const submitBtn = $('#addDeviceForm').find('button[type="submit"]');
        const originalText = submitBtn.html();
        
        // Show loading state
        submitBtn.prop('disabled', true);
        submitBtn.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Saving...');
        
        // AJAX request to submit the form data
        $.ajax({
            url: config.routes.addCoil, // Replace with your actual endpoint
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // For Laravel CSRF protection
            },
            success: function(response) {
                // Reset button state
                submitBtn.prop('disabled', false);
                submitBtn.html(originalText);
                
                if (response.success) {
                    // Show success message
                    alert('Coil data submitted successfully!');
                    
                    // Reset form
                    $('#addDeviceForm')[0].reset();
                    $('#coils_container').find('.coil-item').not(':first').remove();
                    coilCount = 1;
                    updateRemoveButtons();
                    reindexCoils();
                } else {
                    // Show error message
                    alert('Error: ' + response.message);
                }
            },
            error: function(xhr, status, error) {
                // Reset button state
                submitBtn.prop('disabled', false);
                submitBtn.html(originalText);
                
                // Show error message
                alert('Error submitting form: ' + error);
            }
        });
    }
    
    // Cancel button handler
    $('#cancelAddDevice').on('click', function() {
        $('#addDeviceForm')[0].reset();
        // Reset coil items to only one
        $('#coils_container').find('.coil-item').not(':first').remove();
        coilCount = 1;
        updateRemoveButtons();
        reindexCoils();
    });
});



});
</script>


<script>
// Wait for the modal to be shown before initializing the JavaScript
$(document).on('show.bs.modal', '[id^="manageInventory"]', function () {
    const modal = $(this);
    const modalId = modal.attr('id');
    const deviceId = parseInt(modalId.replace('manageInventory', ''));
    
    const addMoreBtn = $('#addMoreItem' + deviceId);
    const inventoryItems = $('#inventoryItems' + deviceId);
    
    // Get device data from the global object
    const deviceInfo = window.deviceData[deviceId];
    
    // Get current item count from existing items
    let itemCount = inventoryItems.find('.inventory-item').length;

    // Function to create a new inventory item HTML
    function createNewInventoryItem(index) {
        const itemNumber = index + 1;
        
        // Build the HTML manually with actual device data
        let html = `
            <div class="inventory-item card mb-3" data-item-index="${index}">
                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                    <h6 class="mb-0">عنصر المخزون #${itemNumber}</h6>
                    <button type="button" class="btn btn-sm btn-danger remove-item">
                        <i class="fas fa-trash"></i> حذف
                    </button>
                </div>
                <div class="card-body">
                    <div class="row mb-3">`;
        
        // Add color selection if device has colors
        if (deviceInfo.colors && deviceInfo.colors.length > 0) {
            html += `
                <div class="col-md-6">
                    <label class="font-weight-bold text-primary">المقاومه</label>
                    <select name="inventories[${index}][device_color_id]" class="form-control">
                        <option value="">اختر المقاومه</option>`;
            
            deviceInfo.colors.forEach(color => {
                html += `<option value="${color.id}">${color.value}${color.vapingStyle}</option>`;
            });
            
            html += `</select>
                        </div>`;
        }

       
        // Add the rest of the form fields
        html += `
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label class="font-weight-bold">الكمية <span class="text-danger">*</span></label>
                            <input type="number" name="inventories[${index}][stock_quantity]" class="form-control" placeholder="0" min="0" required>
                        </div>
                        <div class="col-md-4">
                            <label class="font-weight-bold">سعر التكلفة</label>
                            <input type="number" name="inventories[${index}][cost_price]" class="form-control" placeholder="0.00" min="0" step="0.01">
                        </div>
                        <div class="col-md-4">
                            <label class="font-weight-bold">رقم الدفعة</label>
                            <input type="text" name="inventories[${index}][batch_number]" class="form-control" placeholder="اختياري">
                        </div>
                    </div>
                </div>
            </div>`;
        
        return html;
    }

    // Remove any existing event listeners for this specific modal to avoid duplicates
    addMoreBtn.off('click.inventory' + deviceId);
    
    // Add more item functionality with namespaced event
    addMoreBtn.on('click.inventory' + deviceId, function() {
        const newItemHtml = createNewInventoryItem(itemCount);
        const $newItem = $(newItemHtml);
        inventoryItems.append($newItem);
        itemCount++;

        // Show remove buttons on all items within this modal
        updateRemoveButtons();

        // Add event listener to the new remove button with namespaced event
        $newItem.find('.remove-item').on('click.inventory' + deviceId, function() {
            $newItem.remove();
            itemCount--;
            updateRemoveButtons();
            reindexItems();
        });
    });

    // Remove item functionality for existing items within this specific modal
    modal.off('click.inventory' + deviceId, '.remove-item');
    modal.on('click.inventory' + deviceId, '.remove-item', function() {
        const modalItems = modal.find('.inventory-item');
        if (modalItems.length > 1) {
            $(this).closest('.inventory-item').remove();
            itemCount--;
            updateRemoveButtons();
            reindexItems();
        }
    });

    // Update visibility of remove buttons within this modal
    function updateRemoveButtons() {
        const $items = modal.find('.inventory-item');
        $items.each(function(index) {
            const $removeBtn = $(this).find('.remove-item');
            if (index === 0 && $items.length === 1) {
                $removeBtn.hide();
            } else {
                $removeBtn.show();
            }
        });
    }

    // Reindex all items after removal within this modal
    function reindexItems() {
        modal.find('.inventory-item').each(function(index) {
            $(this).attr('data-item-index', index);
            $(this).find('.card-header h6').text('عنصر المخزون #' + (index + 1));
            
            // Update input names
            $(this).find('select, input').each(function() {
                const name = $(this).attr('name');
                if (name) {
                    const newName = name.replace(/\[\d+\]/, '[' + index + ']');
                    $(this).attr('name', newName);
                }
            });
        });
        
        itemCount = modal.find('.inventory-item').length;
    }

    // Initialize remove buttons state for this modal
    updateRemoveButtons();
});

// Clean up event listeners when modal is hidden
$(document).on('hidden.bs.modal', '[id^="manageInventory"]', function () {
    const modal = $(this);
    const modalId = modal.attr('id');
    const deviceId = modalId.replace('manageInventory', '');
    
    // Remove namespaced event listeners
    $('#addMoreItem' + deviceId).off('click.inventory' + deviceId);
    modal.off('click.inventory' + deviceId, '.remove-item');
});
</script>  
@endsection