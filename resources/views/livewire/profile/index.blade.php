

<!-- row -->
<div class="row row-sm">
    <div class="col-lg-4">
        <div class="card mg-b-20">
            <div class="card-body">
                <div class="pl-0">
                    
                    <div class="main-profile-overview">
                        
                        <div class="main-profile-overview text-center">

    <!-- Profile image section -->
    <div class="position-relative d-inline-block">
        <!-- Profile image -->
        <img alt="Profile"
             src="{{
                $image
                    ? $image->temporaryUrl()
                    : ($images && $images->isNotEmpty()
                        ? asset('storage/'.$guard.'/' . $images->first()->url)
                        : asset('assets/img/faces/6.jpg'))
             }}"
             class="rounded-circle img-fluid mb-2"
             style="width:128px; height:128px; object-fit:cover;">

        <!-- Hidden file input -->
        <input type="file"
               wire:model="image"
               id="imageUpload"
               accept="image/*"
               class="d-none">

        <!-- Camera icon button -->
        <button type="button"
                class="btn btn-light btn-sm rounded-circle shadow position-absolute bottom-0 end-0"
                onclick="document.getElementById('imageUpload').click();"
                title="تغيير الصورة">
            <i class="fas fa-camera"></i>
        </button>
    </div>

    <!-- Save / Cancel buttons under image -->
    @if($image)
        <div class="mt-2 d-flex justify-content-center gap-2">
            <button type="button"
                    wire:click="uploadImageAction"
                    class="btn btn-primary btn-sm">
                حفظ
            </button>
            <button type="button"
                    wire:click="$set('image', null)"
                    class="btn btn-secondary btn-sm">
                إلغاء
            </button>
        </div>
    @endif

    @error('image')
        <span class="text-danger small d-block mt-1">{{ $message }}</span>
    @enderror

    <!-- Profile details (below image) -->
    <div class="mt-3">
        <h5 class="main-profile-name mb-1">{{ $user->name }}</h5>

        @if($guard!=='admin')
            <div class="d-flex justify-content-center align-items-center mb-2">
                <span class="pulse{{ $user->account_active == 1 ? '' : '-danger' }} me-2"></span>
                <p class="mb-0 fw-bold"
                   style="color: {{ $user->account_active == 1 ? 'green' : 'red' }};">
                    {{ $user->account_active == 0 ? 'غير مفعل':'مفعل' }}
                </p>
            </div>

            <h6>Bio</h6>
            <div class="main-profile-bio">
                {{ $user->bioData ?? 'لا يوجد ملف تعريفي' }}
            </div>
        @endif
    </div>
</div>

<hr class="my-4">
<label class="main-content-label tx-13 mg-b-20">الحضور</label>

@if(count($weeks)!=0)
{{-- Toggle Button --}}
<button type="button" wire:click="toggleAttendance"
    class="btn {{ $showAttendance ? 'btn-warning' : 'btn-info' }}">
    <i class="fas {{ $showAttendance ? 'fa-minus' : 'fa-plus' }}"></i>
    {{ $showAttendance ? 'إخفاء مواعيد الحضور السابقة' : 'اظهار مواعيد الحضور السابقة' }}
</button>

    @if($showAttendance)
            <div id="attendance-weeks">
                @foreach ($weeks as $week)
                    <div class="week-item skill-bar mb-4 clearfix mt-3">
                        <span>الأسبوع بدءًا من {{ $week['start']->format('d M Y') }}</span>
                        <div class="progress mt-2 d-flex" style="gap:4px;">
                            @foreach ($week['days'] as $day)
                                <div class="progress-bar {{ $day['attended'] ? 'bg-success-gradient' : 'bg-secondary' }}"
                                    style="width: calc(100% / 7)"></div>
                            @endforeach
                        </div>
                        <div class="d-flex justify-content-between mt-1">
                            @foreach ($week['days'] as $day)
                                <small>{{ \Carbon\Carbon::parse($day['date'])->format('D') }}</small>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-3 d-flex justify-content-between">
        {{-- Previous --}}
        <button wire:click="prevPage"
            class="btn btn-outline-secondary"
            @if($offset==0) disabled @endif>
            السابق
        </button>

        {{-- Next --}}
        <button wire:click="nextPage"
            class="btn btn-outline-primary"
            @if($offset + $limit >= $totalWeeks) disabled @endif>
            التالي
        </button>
    </div>

    
    @endif



    @else
    <span style="color: red;">لا يوجد حضور</span>
@endif

                    </div><!-- main-profile-overview -->
                                     </div>
                                </div>
                            </div>
                        </div>

        <div class="col-lg-8">
            <div class="row row-sm">
            
            <div class="col-sm-12 col-xl-4 col-lg-12 col-md-12">
                <div class="card ">
                    <div class="card-body">
                        <div class="counter-status d-flex md-mb-0">
                            <div class="counter-icon bg-primary-transparent">
                                <i class="icon-layers text-primary"></i>
                            </div>
                            <div class="mr-auto">
                                <h5 class="tx-13">عدد الفواتير</h5>
                                <h2 class="mb-0 tx-22 mb-1 mt-1">{{$user->bills->count()}}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-xl-4 col-lg-12 col-md-12">
                <div class="card ">
                    <div class="card-body">
                        <div class="counter-status d-flex md-mb-0">
                            <div class="counter-icon bg-success-transparent">
                                <i class="fas fa-coins text-success"></i>
                            </div>
                            <div class="mr-auto">
                                <h5 class="tx-13">اجمالي الارباح</h5>
                                <h2 class="mb-0 tx-22 mb-1 mt-1">{{number_format($billStats['total_price_sum'],2,'.',',')}}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-xl-4 col-lg-12 col-md-12">
                <div class="card ">
                    <div class="card-body">
                        <div class="counter-status d-flex md-mb-0">
                            <div class="counter-icon bg-warning-transparent">
                                <i class="fas fa-tags text-warning"></i>
                            </div>
                            <div class="mr-auto">
                                <h5 class="tx-13">عدد الخصومات</h5>
                                <h2 class="mb-0 tx-22 mb-1 mt-1">{{$billStats['discounted_bills_count']}}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-xl-4 col-lg-12 col-md-12">
                <div class="card ">
                    <div class="card-body">
                        <div class="counter-status d-flex md-mb-0">
                            <div class="counter-icon bg-danger-transparent">
                                <i class="fas fa-percent text-danger"></i>
                            </div>
                            <div class="mr-auto">
                                <h5 class="tx-13">اجمالي الخصومات</h5>
                                <h2 class="mb-0 tx-22 mb-1 mt-1">{{number_format($billStats['total_discount_value'] , 2,'.',',')}}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-xl-4 col-lg-12 col-md-12">
                <div class="card ">
                    <div class="card-body">
                        <div class="counter-status d-flex md-mb-0">
                            <div class="counter-icon bg-primary-transparent">
                                <i class="fas fa-cash-register text-primary"></i>
                            </div>
                            <div class="mr-auto">
                                <h5 class="tx-13">اجمالي الارباح بعد الخصومات</h5>
                                <h2 class="mb-0 tx-22 mb-1 mt-1">{{number_format($billStats['total_after_discount_sum'],2,'.',',')}}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-sm-12 col-xl-4 col-lg-12 col-md-12">
                <div class="card ">
                    <div class="card-body">
                        <div class="counter-status d-flex md-mb-0">
                            <div class="counter-icon bg-success-transparent">
                                <i class="fas fa-rocket text-success"></i>
                            </div>
                            <div class="mr-auto">
                                <h5 class="tx-13">المنتجات المباعه</h5>
                                <h2 class="mb-0 tx-22 mb-1 mt-1">{{$billStats['totalProductsQuantities']}}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="tabs-menu ">
                    <!-- Tabs -->
                    <ul class="nav nav-tabs profile navtab-custom panel-tabs">
                        <li class="active">
                            <a href="#home" data-toggle="tab" aria-expanded="true"> <span class="visible-xs"><i class="las la-user-circle tx-16 mr-1"></i></span> <span class="hidden-xs">الملف</span> </a>
                        </li>

                        <li class="active">
                            <a href="#employeeActions" data-toggle="tab" aria-expanded="true"> <span class="visible-xs"><i class="las la-coins tx-16 mr-1"></i></span> <span class="hidden-xs">عمليات البيع</span> </a>
                        </li>

                        <li class="">
                            <a href="#settings" data-toggle="tab" aria-expanded="false"> <span class="visible-xs"><i class="las la-cog tx-16 mr-1"></i></span> <span class="hidden-xs">الاعدادات</span> </a>
                        </li>
                    </ul>
                </div>
                <div class="tab-content border-left border-bottom border-right border-top-0 p-4">
                    
                    <div class="tab-pane active" id="home">
                        <h4 class="tx-15 text-uppercase mb-3">ملف تعريفي</h4>
                        <p class="m-b-5">
                            {{$user->bioData ?? 'لا يوجد ملف تعريفي'}}
                        </p>
                        
                        @if($guard !=='admin')
                            <h4 class="tx-15 text-uppercase mt-3">الخبرات</h4>
                            <div class="m-t-30">
                                @forelse ($user->history as $historyDetails)
                                    <div class="p-t-10">

                                        {{-- If we are editing this history --}}
                                        @if($editingId === $historyDetails->id)
                                            
                                            {{-- Editable form --}}
                                            <input type="text" 
                                                class="form-control mb-2"
                                                wire:model.defer="historyData.{{$historyDetails->id}}.company_name"
                                                placeholder="Company Name">

                                            <input type="text" 
                                                class="form-control mb-2"
                                                wire:model.defer="historyData.{{$historyDetails->id}}.position_title"
                                                placeholder="Position Title">
                                            <input type="date" 
                                                class="form-control mb-2"
                                                wire:model.defer="historyData.{{$historyDetails->id}}.end_date">

                                            <input type="date" 
                                                class="form-control mb-2"
                                                wire:model.defer="historyData.{{$historyDetails->id}}.start_date">

                                        
                                            <textarea class="form-control mb-2"
                                                    wire:model.defer="historyData.{{$historyDetails->id}}.notes"
                                                    placeholder="Notes"></textarea>

                                            <button type="button" class="btn btn-success btn-sm"
                                                    wire:click="updateEmployeeExpert({{ $historyDetails->id }})">
                                                Save
                                            </button>

                                            <button type="button" class="btn btn-secondary btn-sm"
                                                    wire:click="$set('editingId', null)">
                                                Cancel
                                            </button>

                                        @else
                                            {{-- Normal display --}}
                                            <h5 class="text-primary m-b-5 tx-14">{{ $historyDetails->position_title }}</h5>
                                            <p>{{ $historyDetails->company_name }} / {{ $historyDetails->website ?? 'لا يوجد موقع للمكان' }}</p>
                                            <p><b>{{ \Carbon\Carbon::parse($historyDetails->start_date)->format('Y') }} -
                                                {{ \Carbon\Carbon::parse($historyDetails->end_date)->format('Y') }}</b></p>
                                            <p class="text-muted tx-13 m-b-0">{{ $historyDetails->notes }}</p>

                                            <button type="button" class="btn btn-primary btn-sm"
                                                    wire:click="$set('editingId', {{ $historyDetails->id }})">
                                                تعديل
                                                <i class="fas fa-pen"></i>
                                            </button>

                                            <button type="button" class="btn btn-danger btn-sm"
                                                    wire:click="removeEmployeeExpert({{ $historyDetails->id }})">
                                                حذف
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        @endif
                                    </div>
                                    <hr>
                                @empty
                                    <div class="p-t-10">
                                        <span style="color: red;">لا توجد خبرات محدده</span>
                                    </div>
                                @endforelse
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
                                                class="btn btn-secondary"
                                                wire:click="addHistory">
                                            <i class="fas fa-plus"></i>
                                            إضافة خبرة جديدة ({{ count($employmentHistory) }} خبرات حالياً)
                                        </button>

                                        @if(count($employmentHistory) !== 0)
                                        <button type="button" id="add-employment-history" 
                                                class="btn btn-success"
                                                wire:click="createHistory">
                                            <i class="fas fa-pen"></i>
                                            تأكيد
                                        </button>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>
                                @endif

                            
                    </div>
                  
                    <div class="tab-pane active" id="employeeActions">
                        <div class="row">
                            @foreach ($user->bills as $bill )
                                <div clak2ss="col-sm-4">
                                    <div class="border p-1 card thumb">
                                        <a href="{{route('bills.show',$bill->id)}}" class="image-popup" title="Screenshot-2"> 
                                            <h4 class="text-center tx-14 mt-3 mb-0">{{$bill->customer->name}}</h4>
                                            <div class="ga-border"></div>
                                            <p class="text-muted text-center">
                                                <small>اجمالي الفاتوره : {{$bill->total_price}}</small>
                                            </p>
                                            <hr>
                                            <p class="text-muted text-center">
                                                <small>اجمالي الفاتوره بعد الخصم :{{$bill->total_after_discount}}</small>
                                            </p>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                            
                            
                        
                            

                            {{-- <button id="showMoreSellingActions" class="btn btn-primary mt-3">عرض المزيد من عمليات البيع</button> --}}
                        </div>

                    </div>
                    
                    <div class="tab-pane" id="settings">

                            <div class="form-group">
                                <label for="name">الاسم</label>
                                <input type="text" id="name" wire:model='name' class="form-control"> 
                            </div>
                            <div class="form-group">
                                <label for="email">الايميل</label>
                                <input type="email"  id="email" wire:model='email' class="form-control">
                            </div>

                            @if($guard !== 'admin')
                                <div class="form-group">
                                    <label for="nationalID">الرقم القومي</label>
                                    <input type="text"  id="nationalID" wire:model='nationalID' class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="phone">رقم الهاتف</label>
                                    <input type="string"  id="phone" wire:model='phone' class="form-control">
                                </div>
                                
                                <div class="form-group">
                                    <label for="AboutMe">الملف التعريفي</label>
                                    <textarea id="AboutMe" class="form-control" wire:model ='bioData'>
                                        {{$user->bioData ?? 'لا يوجد ملف تعريفي '}}
                                    </textarea>
                                </div>
                            @endif

                            <button 
                            class="btn btn-primary waves-effect waves-light w-md" 
                            type="button" wire:click="updateEmployeeProfile">حفظ</button>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->


