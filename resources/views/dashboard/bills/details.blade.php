@extends('dashboard.layouts.master')

@section('css')
<style>
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

/* Notes form styles */
.notes-form {
    display: none;
    background: #f8f9fa;
    border: 2px dashed #007bff;
    border-radius: 10px;
    padding: 20px;
    margin: 20px 0;
    animation: slideDown 0.3s ease-out;
}

.notes-form.show {
    display: block;
}

.notes-form .form-control {
    border-radius: 8px;
    border: 1px solid #dee2e6;
    transition: border-color 0.3s ease;
}

.notes-form .form-control:focus {
    border-color: #007bff;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}

.notes-form-header {
    background: white;
    padding: 15px;
    border-radius: 8px;
    margin-bottom: 20px;
    border: 1px solid #dee2e6;
}
</style>
@endsection

@section('page-header')
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">الموظفين</h4>
            <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ عمليات البيع/ تفصايل الفاتوره</span>
        </div>
    </div>
    
    <!-- Add Notes Button -->
    <div class="my-auto">
        <button type="button" class="btn btn-primary" id="toggleNotesBtn">
            <i class="fas fa-plus"></i> إضافة ملاحظات
        </button>
    </div>
</div>
@endsection

@section('content')

<!-- Notes Form Section (Hidden by default) -->
<div class="row row-sm">
    <div class="col-xl-12">
        <div id="notesFormContainer" class="notes-form">
            <div class="notes-form-header">
                <h5 class="text-primary mb-0">
                    <i class="fas fa-sticky-note"></i> إضافة ملاحظات للفاتورة
                </h5>
            </div>
            
            <form id="notesForm" action="{{ route('bills.edit', $bill->id) }}" method="POST">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="noteTitle" class="form-label">عنوان الملاحظة</label>
                            <input type="text" class="form-control" id="noteTitle" name="title" 
                                   placeholder="اكتب عنوان الملاحظة..." required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="notePriority" class="form-label">الأولوية</label>
                            <select class="form-control" id="notePriority" name="priority">
                                <option value="low">منخفضة</option>
                                <option value="medium" selected>متوسطة</option>
                                <option value="high">عالية</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="form-group mb-3">
                    <label for="noteBody" class="form-label">نص الملاحظة</label>
                    <textarea class="form-control" id="noteBody" name="body" rows="4" 
                              placeholder="اكتب ملاحظاتك هنا..." required></textarea>
                </div>
                
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> حفظ الملاحظة
                    </button>
                    <button type="button" class="btn btn-secondary" id="cancelNotesBtn">
                        <i class="fas fa-times"></i> إلغاء
                    </button>
                    <button type="reset" class="btn btn-warning">
                        <i class="fas fa-undo"></i> مسح الحقول
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- row -->
<div class="row row-sm">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <div class="row row-sm">

                    <!-- Left side: Bill summary details -->
                    <div class="col-xl-6 col-lg-12 col-md-12">
                        <div class="p-3">
                            <h5 class="mb-3 text-primary">ملخص الفاتورة</h5>
                            
                            <div class="mb-3">
                                <p class="text-muted tx-13 mb-1">
                                    <span class=""> سعر الفاتوره :</span>
                                    <strong class="text-dark">{{ $bill->total_price }}</strong>
                                </p>
                                <p class="text-muted tx-13 mb-1">
                                    <span class="">قيمه الخصم :</span>
                                    <strong class="text-danger">{{ $bill->discount_value }}</strong>
                                </p>
                                <p class="text-muted tx-13 mb-3">
                                    <span class="">المبلغ بعد الخصم :</span>
                                    <strong class="text-success">{{ $bill->total_after_discount }}</strong>
                                </p>
                                <p class="text-muted tx-13 mb-3">
                                    <span class="">تاريخ الإنشاء:</span>
                                    <strong class="text-success">
                                        {{ $bill->created_at->format('Y-m-d H:i') }}
                                        (منذ {{ $bill->created_at->diffForHumans() }})
                                    </strong>
                                </p>
                            </div>

                            <hr>

                            <div class="mb-3">
                                <p class="text-muted tx-13 mb-3">
                                    اجمالي عدد المنتجات <strong class="text-info">{{ $bill->details->count() }}</strong>
                                </p>
                                
                                @foreach ($billGroupByCounts as $key => $value)
                                    <p class="text-muted tx-13 mb-3">
                                        <strong class="text-info">{{ $value }}</strong> {{$key}} 
                                    </p>
                                @endforeach

                                <p class="text-muted tx-13 mb-3">
                                    اسم العميل 
                                    <a 
                                    href="{{route('livewire.customers',$bill->customer->id)}}"
                                    >
                                    <strong class="">{{ $bill->customer->name }}</strong></a>
                                </p>
                                <p class="text-muted tx-13 mb-3">
                                    رقم هاتف العميل <strong class="text-dark">{{ $bill->customer->phone }}</strong>
                                </p>
                            </div>

                            <!-- Action Buttons -->
                            <div class="mt-4">
                                <a href="{{ url()->previous() }}" class="btn btn-light">
                                    <i class="fas fa-arrow-left"></i> رجوع
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Right side: Bill items details and Notes -->
                    <div class="col-xl-6 col-lg-12 col-md-12">
                        @if(count($detailsModified[0])>0 )
                            <div class="p-3">
                                <div class="expandable-section">
                                    <div class="section-header" data-target="specs-section">
                                        <h6><i class="mdi mdi-cog"></i> تفاصيل الفاتوره</h6>
                                        <span class="section-toggle"><i class="mdi mdi-chevron-down"></i></span>
                                    </div>
                                    <div class="section-content" id="specs-section">
                                        <div class="specs-grid">
                                            @foreach($detailsModified as $detail)
                                            <div class="spec-item">
                                                <a href="{{$detail['route']}}">
                                                <span class="spec-value">{{ $detail['item_identity'] }}</span>
                                                <span class="spec-label">الكمية: {{ $detail['quantity'] }}</span>
                                                <hr>
                                                <span class="spec-label">الاجمالي: {{ $detail['line_total'] }}</span>

                                                </a>
                                            </div>
                                            @endforeach
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        @endif
                        
                        
                            <div class="p-3">
                                <div class="expandable-section">
                                    <div class="section-header" data-target="notes-section">
                                        <h6><i class="mdi mdi-note-text"></i> الملاحظات</h6>
                                        <span class="section-toggle"><i class="mdi mdi-chevron-down"></i></span>
                                    </div>

                                    <div class="section-content" id="notes-section">
                                        <div class="specs-grid">
                                            @forelse($bill->notes as $note)
                                            <div class="spec-item">
                                                <span class="spec-value">{{ $note->title }} (<span style="color:{{ $note->read == 0 ? 'red':'green'}};">{{ $note->read == 0 ? 'لم تقرأ':'قرأت' }}</span>)</span>
                                                <span class="spec-label">{{ $note->notes }}</span><br>
                                                <span class="spec-label">{{ $note->created_at->diffForHumans() }}</span>

                                                <hr>
                                                <span class="spec-label">
                                                    الاولويه: 
                                                    <span class="badge badge-{{ $note->priority == 'high' ? 'danger' : ($note->priority == 'medium' ? 'warning' : 'success') }}">
                                                        {{ $note->priority == 'high' ? 'عالية' : ($note->priority == 'medium' ? 'متوسطة' : 'منخفضة') }}
                                                    </span>
                                                </span>
                                            </div>
                                            @empty
                                                <span class="badge badge-warning">
                                                   لا توجد ملاحظات
                                                </span>
                                                
                                            @endforelse
                                        </div>
                                        
                                    </div>
                                </div>
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
    // Notes form toggle functionality
    $('#toggleNotesBtn').click(function() {
        const $form = $('#notesFormContainer');
        const $btn = $(this);
        
        if ($form.hasClass('show')) {
            // Hide form
            $form.removeClass('show');
            $btn.html('<i class="fas fa-plus"></i> إضافة ملاحظات');
            $btn.removeClass('btn-warning').addClass('btn-primary');
        } else {
            // Show form
            $form.addClass('show');
            $btn.html('<i class="fas fa-minus"></i> إخفاء الملاحظات');
            $btn.removeClass('btn-primary').addClass('btn-warning');
            
        }
    });

    // Cancel notes button
    $('#cancelNotesBtn').click(function() {
        $('#toggleNotesBtn').click(); // Trigger the toggle to hide form
        $('#notesForm')[0].reset(); // Reset form
    });
    

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

    
});
</script>
@endsection