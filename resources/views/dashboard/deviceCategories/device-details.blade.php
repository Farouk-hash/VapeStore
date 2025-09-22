@extends('dashboard.layouts.master')

@section('css')
<!--Internal Nice-select css-->
<link href="{{ URL::asset('dashboard/plugins/jquery-nice-select/css/nice-select.css') }}" rel="stylesheet"/>
<!-- Internal Select2 css -->
<link href="{{ URL::asset('dashboard/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
<style>
.device-details-container {
    padding: 20px;
}
.device-image {
    max-width: 100%;
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}
.specs-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 15px;
    margin: 20px 0;
}
.spec-item {
    background: #f8f9fa;
    padding: 15px;
    border-radius: 8px;
    text-align: center;
}
.spec-value {
    font-size: 18px;
    font-weight: bold;
    color: #007bff;
    display: block;
}
.spec-label {
    font-size: 12px;
    color: #6c757d;
    text-transform: uppercase;
}
.color-badge {
    display: inline-block;
    padding: 8px 15px;
    margin: 5px;
    border-radius: 20px;
    background: #e3f2fd;
    border: 2px solid #007bff;
    font-weight: 600;
}
.feature-tag {
    display: inline-block;
    padding: 6px 12px;
    margin: 5px;
    border-radius: 15px;
    background: linear-gradient(45deg, #28a745, #20c997);
    color: white;
    font-size: 12px;
    font-weight: 600;
}
.flavor-item {
    display: inline-block;
    padding: 6px 12px;
    margin: 5px;
    border-radius: 15px;
    background: #fff3cd;
    border: 1px solid #ffc107;
    color: #856404;
    font-size: 12px;
    font-weight: 600;
}

/* Expandable sections */
.expandable-section {
    margin-bottom: 15px;
}
.section-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 15px;
    background: #f8f9fa;
    border-radius: 8px;
    cursor: pointer;
    border: 1px solid #dee2e6;
    transition: all 0.3s ease;
}
.section-header:hover {
    background: #e9ecef;
    border-color: #007bff;
}
.section-header h6 {
    margin: 0;
    display: flex;
    align-items: center;
    gap: 8px;
}
.section-toggle {
    font-size: 14px;
    color: #6c757d;
    transition: transform 0.3s ease;
}
.section-header.expanded .section-toggle {
    transform: rotate(180deg);
}
.section-content {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.3s ease, opacity 0.3s ease;
    opacity: 0;
}
.section-content.expanded {
    max-height: 500px;
    opacity: 1;
    padding: 15px;
    border: 1px solid #dee2e6;
    border-top: none;
    border-radius: 0 0 8px 8px;
    background: white;
}

/* Modal styles */
.modal-content {
    border-radius: 10px;
    border: none;
}
.modal-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border-radius: 10px 10px 0 0;
}
.modal-body {
    max-height: 400px;
    overflow-y: auto;
}
.modal-item {
    padding: 10px;
    margin: 5px 0;
    border-radius: 6px;
    background: #f8f9fa;
    border-left: 4px solid #007bff;
}
</style>
@endsection

@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <h4 class="content-title mb-0">تفاصيل الجهاز</h4>
</div>
<!-- breadcrumb -->
@endsection

@section('content')
<!-- row -->
<div class="row row-sm">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body device-details-container">
                <div class="row row-sm">
                    <!-- Left side: device image -->
                    <div class="col-xl-5 col-lg-12 col-md-12">
                        <div class="text-center">
                            <img src="{{ $device->image_url ?? URL::asset('dashboard/img/ecommerce/device-default.png') }}" 
                                 alt="صورة الجهاز" class="device-image">
                        </div>
                    </div>

                    <!-- Right side: device details -->
                    <div class="col-xl-7 col-lg-12 col-md-12 mt-4 mt-xl-0">
                        <h4 class="product-title mb-1">{{ $device->name }}</h4>
                        <p class="text-muted tx-13 mb-1">
                            العلامة التجارية: <strong>{{ $device->brand->name ?? 'غير معروف' }}</strong>
                        </p>
                        <p class="text-muted tx-13 mb-1">
                            الفئة: <strong>{{ $device->category->name ?? 'غير مصنف' }}</strong>
                        </p>

                        @if($device->release_year)
                        <p class="text-muted tx-13 mb-3">
                            سنة الإصدار: <strong>{{ $device->release_year }}</strong>
                        </p>
                        @endif

                        <!-- Specifications -->
                        @if($device->speces && $device->speces->count() > 0)
                        <div class="expandable-section">
                            <div class="section-header" data-target="specs-section">
                                <h6><i class="mdi mdi-cog"></i> المواصفات التقنية</h6>
                                <span class="section-toggle"><i class="mdi mdi-chevron-down"></i></span>
                            </div>
                            <div class="section-content" id="specs-section">
                                <div class="specs-grid">
                                    @foreach($device->speces as $spec)
                                    <div class="spec-item">
                                        <span class="spec-value">{{ $spec->spec_value }}</span>
                                        <span class="spec-label">{{ $spec->spec_key }}</span>
                                    </div>
                                    @endforeach
                                </div>
                                <button class="btn btn-sm btn-outline-primary mt-3 view-all-btn" data-type="specs">
                                    <i class="mdi mdi-eye"></i> عرض الكل في نافذة منبثقة
                                </button>
                            </div>
                        </div>
                        @endif

                        <!-- Colors -->
                        @if($device->colors && $device->colors->count() > 0)
                        <div class="expandable-section">
                            <div class="section-header" data-target="colors-section">
                                <h6><i class="mdi mdi-palette"></i> الألوان المتاحة</h6>
                                <span class="section-toggle"><i class="mdi mdi-chevron-down"></i></span>
                            </div>
                            <div class="section-content" id="colors-section">
                                <div class="mb-3">
                                    @foreach($device->colors as $color)
                                    <span class="color-badge">{{ $color->name }}</span>
                                    @endforeach
                                </div>
                                <button class="btn btn-sm btn-outline-primary mt-3 view-all-btn" data-type="colors">
                                    <i class="mdi mdi-eye"></i> عرض الكل في نافذة منبثقة
                                </button>
                            </div>
                        </div>
                        @endif

                        <!-- Features -->
                        @if($device->features && $device->features->count() > 0)
                        <div class="expandable-section">
                            <div class="section-header" data-target="features-section">
                                <h6><i class="mdi mdi-star"></i> الميزات</h6>
                                <span class="section-toggle"><i class="mdi mdi-chevron-down"></i></span>
                            </div>
                            <div class="section-content" id="features-section">
                                <div class="mb-3">
                                    @foreach($device->features as $feature)
                                    <span class="feature-tag">{{ $feature->name }}</span>
                                    @endforeach
                                </div>
                                <button class="btn btn-sm btn-outline-primary mt-3 view-all-btn" data-type="features">
                                    <i class="mdi mdi-eye"></i> عرض الكل في نافذة منبثقة
                                </button>
                            </div>
                        </div>
                        @endif

                        <!-- Flavors -->
                        @if($device->flavors && $device->flavors->count() > 0)
                        <div class="expandable-section">
                            <div class="section-header" data-target="flavors-section">
                                <h6><i class="mdi mdi-cup"></i> النكهات المتاحة</h6>
                                <span class="section-toggle"><i class="mdi mdi-chevron-down"></i></span>
                            </div>
                            <div class="section-content" id="flavors-section">
                                <div class="mb-3">
                                    @foreach($device->flavors as $componentFlavor)
                                    <span class="flavor-item">{{ $componentFlavor->component->name }}</span>
                                    @endforeach
                                </div>
                                <button class="btn btn-sm btn-outline-primary mt-3 view-all-btn" data-type="flavors">
                                    <i class="mdi mdi-eye"></i> عرض الكل في نافذة منبثقة
                                </button>
                            </div>
                        </div>
                        @endif

                        <!-- Additional Information -->
                        @if($device->category->description)
                        <div class="expandable-section">
                            <div class="section-header" data-target="description-section">
                                <h6><i class="mdi mdi-information"></i> الوصف</h6>
                                <span class="section-toggle"><i class="mdi mdi-chevron-down"></i></span>
                            </div>
                            <div class="section-content" id="description-section">
                                <p class="text-muted">{{ $device->category->description }}</p>
                            </div>
                        </div>
                        @endif



                         <!-- Existing Inventory Display -->
                    @if(isset($device->inventories) && $device->inventories->count() > 0)
                    <hr class="my-4">
                    <h6 class="text-primary mb-3">
                        <i class="fas fa-list"></i> المخزون الحالي
                        <button type="button" class="btn btn-sm btn-outline-secondary table-toggle-btn" id="toggleInventoryTable">
                            <i class="fas fa-chevron-down table-toggle-icon"></i> إظهار/إخفاء
                        </button>
                    </h6>
                    
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="bg-light">
                                <tr>
                                    <th>المتغير</th>
                                    <th>الكمية</th>
                                    <th>الحالة</th>
                                    <th>سعر البيع</th>
                                    <th>الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- need to be fixed  --}}
                                @foreach($device->inventories as $inventory)
                                <tr>
                                    <td>
                                        @if($inventory->deviceColor)
                                            <span class="badge badge-info">{{ $inventory->deviceColor->name }}</span>
                                        @endif
                                        @if($inventory->deviceFlavor)
                                            <span class="badge badge-warning">{{ $inventory->deviceFlavor->name }}</span>
                                        @endif
                                        @if(!$inventory->deviceColor && !$inventory->deviceFlavor)
                                            <span class="text-muted">النسخة الأساسية</span>
                                        @endif
                                    </td>
                                    <td>{{ $inventory->stock_quantity ?? 0 }}</td>
                                    <td>
                                        <span class="badge badge-success">متاح</span>
                                    </td>
                                    <td>
                                        @if(isset($inventory->base_price))
                                            {{ number_format($inventory->base_price, 2) }} جنيه
                                        @else
                                            <span class="text-muted">غير محدد</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="alert alert-warning text-center mt-4">
                        <h6><i class="fas fa-exclamation-triangle"></i> لا يوجد مخزون مسجل</h6>
                        <p>قم بإضافة المخزون الأول لهذا الجهاز</p>
                    </div>
                    @endif


                        <!-- Action Buttons -->
                        <div class="mt-4">
                            <a href="{{ url()->previous() }}" class="btn btn-light">
                                <i class="fas fa-arrow-left"></i> رجوع
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /row -->

<!-- Modal for viewing all items -->
<div class="modal fade" id="viewAllModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">العناصر</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modalContent">
                <!-- Content will be populated by JavaScript -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')

<script>
$(document).ready(function() {
    // Expandable sections functionality
    $('.section-header').click(function() {
        const target = $(this).data('target');
        const $content = $('#' + target);
        
        $(this).toggleClass('expanded');
        $content.toggleClass('expanded');
        
        // Close other sections when opening one
        if ($(this).hasClass('expanded')) {
            $('.section-header').not(this).removeClass('expanded');
            $('.section-content').not($content).removeClass('expanded');
        }
    });

    // View all button functionality
    $('.view-all-btn').click(function() {
        const type = $(this).data('type');
        let title = '';
        let content = '';

        switch(type) {
            case 'specs':
                title = 'جميع المواصفات التقنية';
                content = '<div class="specs-list">';
                @foreach($device->speces as $spec)
                content += `
                    <div class="modal-item">
                        <strong>{{ $spec->spec_key }}:</strong> {{ $spec->spec_value }}
                    </div>
                `;
                @endforeach
                content += '</div>';
                break;

            case 'colors':
                title = 'جميع الألوان المتاحة';
                content = '<div class="colors-list">';
                @foreach($device->colors as $color)
                content += `
                    <div class="modal-item">
                        <span class="color-badge">{{ $color->name }}</span>
                    </div>
                `;
                @endforeach
                content += '</div>';
                break;

            case 'features':
                title = 'جميع الميزات';
                content = '<div class="features-list">';
                @foreach($device->features as $feature)
                content += `
                    <div class="modal-item">
                        <span class="feature-tag">{{ $feature->name }}</span>
                    </div>
                `;
                @endforeach
                content += '</div>';
                break;

            case 'flavors':
                title = 'جميع النكهات المتاحة';
                content = '<div class="flavors-list">';
                @foreach($device->flavors as $componentFlavor)
                content += `
                    <div class="modal-item">
                        <span class="flavor-item">{{ $componentFlavor->component->name }}</span>
                    </div>
                `;
                @endforeach
                content += '</div>';
                break;
        }

        $('#modalTitle').text(title);
        $('#modalContent').html(content);
        $('#viewAllModal').modal('show');
    });

    // Inventory table expand/collapse functionality
    function setupInventoryTableToggle() {
        const inventoryTable = $('#inventoryTable');
        const toggleBtn = $('#toggleInventoryTable');
        
        // Check if table exists
        if (inventoryTable.length) {
            // Add toggle button if it doesn't exist
            if (toggleBtn.length === 0) {
                const tableHeader = inventoryTable.closest('.card').find('.card-header');
                tableHeader.append(`
                    <button id="toggleInventoryTable" class="btn btn-sm btn-outline-secondary float-left">
                        <i class="fas fa-chevron-down"></i> إظهار/إخفاء الجدول
                    </button>
                `);
            }
            
            // Toggle functionality
            $('#toggleInventoryTable').click(function() {
                inventoryTable.toggleClass('d-none');
                $(this).find('i').toggleClass('fa-chevron-down fa-chevron-up');
                
                // Update button text
                const isVisible = !inventoryTable.hasClass('d-none');
                $(this).html(`<i class="fas ${isVisible ? 'fa-chevron-up' : 'fa-chevron-down'}"></i> ${isVisible ? 'إخفاء' : 'إظهار'} الجدول`);
            });
            
            // Initially hide the table if it has many rows
            if (inventoryTable.find('tbody tr').length > 5) {
                inventoryTable.addClass('d-none');
                $('#toggleInventoryTable').html('<i class="fas fa-chevron-down"></i> إظهار الجدول');
            }
        }
    }

    // Alternative approach: Add expand/collapse to existing inventory section
    function enhanceInventorySection() {
        const inventorySection = $('h6.text-primary:contains("المخزون الحالي")').closest('.card-body');
        
        if (inventorySection.length) {
            // Find the table
            const inventoryTable = inventorySection.find('table');
            
            if (inventoryTable.length) {
            
                // Wrap table in a container for better control
                inventoryTable.wrap('<div class="table-container" style="transition: all 0.3s ease;"></div>');
                
                // Toggle functionality
                $('#toggleInventoryTable').click(function() {
                    const tableContainer = inventoryTable.parent('.table-container');
                    const isVisible = tableContainer.is(':visible');
                    
                    if (isVisible) {
                        tableContainer.slideUp(300);
                        $(this).find('.table-toggle-icon').removeClass('fa-chevron-up').addClass('fa-chevron-down');
                        $(this).html('<i class="fas fa-chevron-down table-toggle-icon"></i> إظهار');
                    } else {
                        tableContainer.slideDown(300);
                        $(this).find('.table-toggle-icon').removeClass('fa-chevron-down').addClass('fa-chevron-up');
                        $(this).html('<i class="fas fa-chevron-up table-toggle-icon"></i> إخفاء');
                    }
                });
                
                // Initially hide if many rows
                if (inventoryTable.find('tbody tr').length > 3) {
                    inventoryTable.parent('.table-container').hide();
                    $('#toggleInventoryTable').html('<i class="fas fa-chevron-down table-toggle-icon"></i> إظهار');
                }
            }
        }
    }

    // Call the enhancement function
    enhanceInventorySection();

    // Auto-expand first section with content
    setTimeout(function() {
        $('.section-header:first').click();
    }, 100);
});
</script>

<style>
.table-toggle-btn {
    cursor: pointer;
    transition: all 0.3s ease;
    padding: 5px 10px;
    border-radius: 4px;
}

.table-toggle-btn:hover {
    background-color: #f8f9fa;
}

.table-toggle-icon {
    transition: transform 0.3s ease;
}

.table-container {
    overflow: hidden;
    transition: max-height 0.3s ease;
}

/* Smooth animation for table expansion */
.table-container.collapsed {
    max-height: 0;
    overflow: hidden;
}

.table-container.expanded {
    max-height: 1000px; /* Adjust based on your table size */
}
</style>
@endsection