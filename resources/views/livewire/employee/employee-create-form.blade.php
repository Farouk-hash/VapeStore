


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


<div class="row">
<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="main-content-label mg-b-5">
                اضافه موظف
            </div>
                <div class="pd-30 pd-sm-40 bg-gray-200">

                    <div class="row row-xs align-items-center mg-b-20">
                        <div class="col-md-4">
                            <label class="form-label mg-b-0">الاسم</label>
                        </div>
                        <div class="col-md-8 mg-t-5 mg-md-t-0">
                            <input class="form-control" 
                            wire:model="name" value="{{ old('name') }}" 
                            placeholder="Enter your firstname" type="text" required>
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
                            <input class="form-control" 
                            wire:model="email"
                            value="{{ old('email') }}" placeholder="Enter your email" type="email" required>
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
                            <input class="form-control" 
                            wire:model="nationalID"
                            value="{{ old('nationalID') }}" placeholder="اكتب الرقم القومي" type="text" required>
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
                            <input class="form-control" 
                            wire:model="phone"
                            value="{{ old('phone') }}" placeholder="اكتب رقم هاتف الموظف" type="text" required>
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
                            <input class="form-control" 
                            wire:model="bioData"
                            value="{{ old('bioData') }}" placeholder=" اكتب ملف تعرفي"type="text" required>
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
                            <input class="form-control"
                            wire:model="password"
                            placeholder="اكتب كلمه المرور" type="password">
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
                            <input class="form-control" wire:model="password_confirmation" 
                            placeholder="اكتب كلمه المرور مره اخري" type="password" required>
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
                            <input class="form-control" wire:model="image" type="file" accept="image/*">
                            @error('image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                   
    

<div>
    {{-- Toggle Button --}}
    <button type="button" wire:click="onShowExCreateForm" 
            class="btn {{ $showExCreateForm ? 'btn-warning' : 'btn-info' }}">
        <i class="fas {{ $showExCreateForm ? 'fa-minus' : 'fa-plus' }}"></i>
        {{ $showExCreateForm ? 'إخفاء الخبرات السابقة' : 'إضافة الخبرات السابقة' }}
    </button>

    {{-- Employment History Section --}}
    @if($showExCreateForm)
        <div id="employment-history-section" class="mt-4">
            <h5 class="mb-3">الخبرات السابقة</h5>

            {{-- Dynamic Items --}}
            @foreach($employmentHistory as $index => $history)
                <div class="employment-history-item border rounded p-3 mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h6 class="text-secondary mb-0">الخبرة رقم {{ $index + 1 }}</h6>
                        <button type="button" class="btn btn-danger btn-sm"
                                wire:click="removeHistory({{ $index }})">
                            <i class="fas fa-trash"></i> حذف
                        </button>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label">اسم الشركة السابقة</label>
                            <input type="text" wire:model="employmentHistory.{{ $index }}.company_name" 
                                   class="form-control" placeholder="اكتب اسم الشركة">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">موقع الشركة السابقة</label>
                            <input type="text" wire:model="employmentHistory.{{ $index }}.website" 
                                   class="form-control" placeholder="اكتب موقع الشركة">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">المسمى الوظيفي</label>
                            <input type="text" wire:model="employmentHistory.{{ $index }}.position_title" 
                                   class="form-control" placeholder="اكتب المسمى الوظيفي">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">تاريخ البداية</label>
                            <input type="date" wire:model="employmentHistory.{{ $index }}.start_date" 
                                   class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">تاريخ الانتهاء</label>
                            <input type="date" wire:model="employmentHistory.{{ $index }}.end_date" 
                                   class="form-control">
                        </div>
                        <div class="col-12">
                            <label class="form-label">ملاحظات</label>
                            <textarea wire:model="employmentHistory.{{ $index }}.notes" 
                            class="form-control" rows="3"
                            placeholder="اكتب أي ملاحظات إضافية"></textarea>
                        </div>
                    </div>
                </div>
            @endforeach

            {{-- Add Button --}}
            <button type="button" id="add-employment-history" 
                    class="btn btn-success"
                    wire:click="addHistory">
                <i class="fas fa-plus"></i>
                إضافة خبرة جديدة ({{ count($employmentHistory) }} خبرات حالياً)
            </button>
        </div>
    @endif
</div>


                    <div class="row mg-t-20">
                        <div class="col-12">
                            <button class="btn btn-main-primary pd-x-30 mg-r-5 mg-t-5" type="button" wire:click="create">انشاء حساب</button>
                            
                        </div>
                    </div>

                </div>

            </div>
    </div>
</div>
</div>


