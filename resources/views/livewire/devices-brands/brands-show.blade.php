<!-- row opened -->
<div class="row row-sm">
    <div class="col-xl-12">
        <div class="card">


            <div class="card-header pb-0">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="card-title mg-b-0">قائمة ماركات الأجهزة</h4>
                    <i class="mdi mdi-dots-horizontal text-gray"></i>
                </div>
                <p class="tx-12 tx-gray-500 mb-2">
                    هذا الجدول يعرض جميع الماركات المرتبطة بالفئة الحالية مع تفاصيل الدولة، الموقع الإلكتروني والوصف.
                </p>

                <!-- Dropdown for categories -->
                <div class="mt-3">
                    <label for="categoryFilter" class="font-weight-bold">اختر الفئة:</label>
                    <select id="categoryFilter" class="form-control w-auto d-inline-block"
                            wire:model.live="selectedCategory">
                        <option value="">كل الفئات</option>
                        @foreach($slugCategories as $category)
                            <option value="{{ $category->slug }}_{{$category->id}}">
                                {{ $category->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table text-md-nowrap" id="example1">
                        <thead>
                            <tr>
                                <th class="wd-20p border-bottom-0">الاسم</th>
                                <th class="wd-15p border-bottom-0">الدولة</th>
                                <th class="wd-20p border-bottom-0">الموقع الإلكتروني</th>
                                <th class="wd-25p border-bottom-0">الوصف</th>
                                <th class="wd-25p border-bottom-0">التفعيل</th>
                                <th class="wd-25p border-bottom-0">عدد المنتجات</th>
                                <th class="wd-20p border-bottom-0">الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($deviceBrands as $brand)
                                <tr>
                                    <td>{{ $brand->name }}</td>
                                    <td>{{ $brand->country }}</td>
                                    <td>
                                        @if($brand->website)
                                            <a href="{{ $brand->website }}" target="_blank">{{ $brand->website }}</a>
                                        @else
                                            <span class="text-muted">—</span>
                                        @endif
                                    </td>
                                    <td>{{ substr($brand->description, 0, 30) ?? 'لا يوجد وصف حالي'}}</td>
                                    <td>{{ $brand->is_active ? 'مفعل':'غير مفعل'}}</td>
                                    <td>{{$brand->items_count ?? 0}}</td>

                                    <td>

                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-primary dropdown-toggle" 
                                                    type="button" id="dropdownMenuButton{{ $brand->id }}" 
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                الإجراءات
                                            </button>
                                                <div class="dropdown-menu w-100" aria-labelledby="dropdownMenuButton{{ $brand->id }}">
                                                <!-- Edit Button -->
                                                <button type="button" 
                                                        class="dropdown-item modal-effect text-info" 
                                                        wire:click="editBrandForm({{ $brand->id }})">
                                                    <i class="las la-pen"></i> تعديل
                                                </button>

                                               <button type="button" 
                                                    class="dropdown-item modal-effect text-secondary" 
                                                    wire:click="changeActivation({{ $brand->id }})">

                                                    @if($brand->is_active)
                                                        <i class="las la-times-circle"></i> تعطيل
                                                    @else
                                                        <i class="las la-check-circle"></i> تفعيل
                                                    @endif
                                                </button>

                                                <button type="button" 
                                                        class="dropdown-item modal-effect text-danger" 
                                                        wire:click="deleteBrand({{ $brand->id }})">
                                                    <i class="las la-trash"></i> حذف
                                                </button>

                                                <!-- Show Details Button -->
                                                <button type="button" 
                                                        class="dropdown-item modal-effect text-warning" 
                                                        wire:click="showDetails({{$brand->id}})"
                                                        >
                                                    <i class="las la-eye"></i> عرض التفاصيل
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
