@extends('dashboard.layouts.master')
@section('css')
<!--- Internal Select2 css-->
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
<style>
    .employment-history-section {
        display: none;
        margin-top: 20px;
        padding: 20px;
        border: 2px dashed #ddd;
        border-radius: 5px;
        background-color: #f9f9f9;
    }
    .employment-history-item {
        background: white;
        padding: 15px;
        margin-bottom: 15px;
        border-radius: 5px;
        border: 1px solid #eee;
    }
    .employment-history-item .row {
        margin-bottom: 15px;
    }
</style>
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الموظفين</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">
                    / اضافه موظف</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
				

    <div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="main-content-label mg-b-5">
                    اضافه موظف
                </div>
                <form action="{{ route('employee.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="pd-30 pd-sm-40 bg-gray-200">

                        <div class="row row-xs align-items-center mg-b-20">
                            <div class="col-md-4">
                                <label class="form-label mg-b-0">الاسم</label>
                            </div>
                            <div class="col-md-8 mg-t-5 mg-md-t-0">
                                <input class="form-control" name="name" value="{{ old('name') }}" placeholder="Enter your firstname" type="text">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row row-xs align-items-center mg-b-20">
                            <div class="col-md-4">
                                <label class="form-label mg-b-0">الايميل</label>
                            </div>
                            <div class="col-md-8 mg-t-5 mg-md-t-0">
                                <input class="form-control" name="email" value="{{ old('email') }}" placeholder="Enter your email" type="email">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row row-xs align-items-center mg-b-20">
                            <div class="col-md-4">
                                <label class="form-label mg-b-0">الرقم القومي</label>
                            </div>
                            <div class="col-md-8 mg-t-5 mg-md-t-0">
                                <input class="form-control" name="nationalID" value="{{ old('nationalID') }}" placeholder="اكتب الرقم القومي" type="text">
                                @error('nationalID')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row row-xs align-items-center mg-b-20">
                            <div class="col-md-4">
                                <label class="form-label mg-b-0">رقم الهاتف</label>
                            </div>
                            <div class="col-md-8 mg-t-5 mg-md-t-0">
                                <input class="form-control" name="phone" value="{{ old('phone') }}" placeholder="اكتب رقم هاتف الموظف" type="text">
                                @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row row-xs align-items-center mg-b-20">
                            <div class="col-md-4">
                                <label class="form-label mg-b-0">ملف تعريفي</label>
                            </div>
                            <div class="col-md-8 mg-t-5 mg-md-t-0">
                                <input class="form-control" name="bioData" value="{{ old('bioData') }}" placeholder=" اكتب ملف تعرفي"type="text">
                                @error('bioData')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row row-xs align-items-center mg-b-20">
                            <div class="col-md-4">
                                <label class="form-label mg-b-0">كلمه المرور</label>
                            </div>
                            <div class="col-md-8 mg-t-5 mg-md-t-0">
                                <input class="form-control" name="password" placeholder="اكتب كلمه المرور" type="password">
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row row-xs align-items-center mg-b-20">
                            <div class="col-md-4">
                                <label class="form-label mg-b-0">تأكيد كلمه المرور</label>
                            </div>
                            <div class="col-md-8 mg-t-5 mg-md-t-0">
                                <input class="form-control" name="password_confirmation" placeholder="اكتب كلمه المرور مره اخري" type="password">
                                @error('password_confirmation')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row row-xs align-items-center mg-b-20">
                            <div class="col-md-4">
                                <label class="form-label mg-b-0">صورة الموظف</label>
                            </div>
                            <div class="col-md-8 mg-t-5 mg-md-t-0">
                                <input class="form-control" name="image" type="file" accept="image/*">
                                @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Toggle Button for Employment History -->
                        <div class="row row-xs align-items-center mg-b-20">
                            <div class="col-md-4">
                                <label class="form-label mg-b-0">الخبرات السابقة</label>
                            </div>
                            <div class="col-md-8 mg-t-5 mg-md-t-0">
                                <button type="button" id="toggle-employment-history" class="btn btn-info">
                                    <i class="fas fa-plus"></i> إضافة الخبرات السابقة
                                </button>
                            </div>
                        </div>

                        <!-- Employment History Section (Hidden by default) -->
                        <div id="employment-history-section" class="employment-history-section">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="text-primary">الخبرات السابقة</h5>
                                <button type="button" id="add-employment-history" class="btn btn-primary btn-sm">
                                    <i class="fas fa-plus"></i> إضافة خبرة جديدة
                                </button>
                            </div>
                            
                            <div id="employment-history-wrapper">
                                <!-- Employment history items will be added here -->
                            </div>
                        </div>

                        <div class="row mg-t-20">
                            <div class="col-12">
                                <button class="btn btn-main-primary pd-x-30 mg-r-5 mg-t-5" type="submit">انشاء حساب</button>
                                <button 
                                    class="btn btn-dark pd-x-30 mg-t-5" type="button"
                                    onclick="window.history.back();">رجوع
                                </button>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection
@section('js')
{{-- Employee History --}}
<script>
    let historyIndex = 0;
    let isHistorySectionVisible = false;

    // Toggle employment history section visibility
    document.getElementById('toggle-employment-history').addEventListener('click', function () {
        const section = document.getElementById('employment-history-section');
        const button = this;
        const icon = button.querySelector('i');
        
        if (!isHistorySectionVisible) {
            // Show section and add first item if none exist
            section.style.display = 'block';
            button.innerHTML = '<i class="fas fa-minus"></i> إخفاء الخبرات السابقة';
            button.classList.remove('btn-info');
            button.classList.add('btn-warning');
            
            // Add first employment history item if wrapper is empty
            if (document.getElementById('employment-history-wrapper').children.length === 0) {
                addEmploymentHistoryItem();
            }
            
            isHistorySectionVisible = true;
        } else {
            // Hide section
            section.style.display = 'none';
            button.innerHTML = '<i class="fas fa-plus"></i> إضافة الخبرات السابقة';
            button.classList.remove('btn-warning');
            button.classList.add('btn-info');
            isHistorySectionVisible = false;
        }
    });

    // Add employment history item
    document.getElementById('add-employment-history').addEventListener('click', function () {
        addEmploymentHistoryItem();
    });

    function addEmploymentHistoryItem() {
        const wrapper = document.getElementById('employment-history-wrapper');

        const newItem = document.createElement('div');
        newItem.classList.add('employment-history-item');
        newItem.setAttribute('data-index', historyIndex);
        newItem.innerHTML = `
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h6 class="text-secondary mb-0">الخبرة رقم ${historyIndex + 1}</h6>
                <button type="button" class="btn btn-danger btn-sm remove-history">
                    <i class="fas fa-trash"></i> حذف
                </button>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <label class="form-label">اسم الشركة السابقة</label>
                    <input type="text" name="employment_history[${historyIndex}][company_name]" class="form-control" placeholder="اكتب اسم الشركة">
                </div>
                <div class="col-md-6">
                    <label class="form-label">موقع الشركة السابقة</label>
                    <input type="text" name="employment_history[${historyIndex}][website]" class="form-control" placeholder="اكتب موقع الشركة">
                </div>
                <div class="col-md-6">
                    <label class="form-label">المسمى الوظيفي</label>
                    <input type="text" name="employment_history[${historyIndex}][position_title]" class="form-control" placeholder="اكتب المسمى الوظيفي">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <label class="form-label">تاريخ البداية</label>
                    <input type="date" name="employment_history[${historyIndex}][start_date]" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label">تاريخ الانتهاء</label>
                    <input type="date" name="employment_history[${historyIndex}][end_date]" class="form-control">
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <label class="form-label">ملاحظات</label>
                    <textarea name="employment_history[${historyIndex}][notes]" class="form-control" rows="3" placeholder="اكتب أي ملاحظات إضافية"></textarea>
                </div>
            </div>
        `;

        wrapper.appendChild(newItem);
        historyIndex++;
        
        // Update the "Add new experience" button text to show count
        updateAddButtonText();
    }

    // Remove employment history item
    document.addEventListener('click', function(e){
        if(e.target && (e.target.classList.contains('remove-history') || e.target.closest('.remove-history'))) {
            const button = e.target.classList.contains('remove-history') ? e.target : e.target.closest('.remove-history');
            const item = button.closest('.employment-history-item');
            
            if (item) {
                item.remove();
                updateAddButtonText();
                
                // If no items left, hide the section
                const wrapper = document.getElementById('employment-history-wrapper');
                if (wrapper.children.length === 0) {
                    document.getElementById('toggle-employment-history').click();
                }
            }
        }
    });

    function updateAddButtonText() {
        const wrapper = document.getElementById('employment-history-wrapper');
        const count = wrapper.children.length;
        const addButton = document.getElementById('add-employment-history');
        addButton.innerHTML = `<i class="fas fa-plus"></i> إضافة خبرة جديدة (${count} خبرات حالياً)`;
    }

    // Handle form submission to ensure proper array structure
    document.querySelector('form').addEventListener('submit', function(e) {
        const wrapper = document.getElementById('employment-history-wrapper');
        const items = wrapper.querySelectorAll('.employment-history-item');
        
        // Re-index all employment history items to ensure proper array indexing
        items.forEach((item, index) => {
            const inputs = item.querySelectorAll('input, textarea');
            inputs.forEach(input => {
                const name = input.name;
                if (name && name.includes('employment_history')) {
                    // Replace the index in the name attribute
                    input.name = name.replace(/employment_history\[\d+\]/, `employment_history[${index}]`);
                }
            });
        });
        
        console.log('Form submitted with employment history items:', items.length);
    });
</script>
@endsection