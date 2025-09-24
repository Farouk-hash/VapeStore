
<!-- row opened -->
<div class="row row-sm">
    <div class="col-xl-12">
        <div class="card">        
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title mg-b-0">قائمة العلامات التجارية</h4>
                    <i class="mdi mdi-dots-horizontal text-gray"></i>
                </div>
                <p class="tx-12 tx-gray-500 mb-2">
                    يعرض هذا الجدول جميع العلامات التجارية المسجّلة مع تفاصيل الدولة، الحالة، عدد النكهات المرتبطة،
                    بالإضافة إلى تواريخ الإضافة والتحديث مع إمكانية التعديل، الحذف أو عرض التفاصيل.
                </p>
            </div>
            @if(session('success'))
                {{session('success')}}
            @endif
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table text-md-nowrap" id="example1">
                        <thead>
                            <tr>
                                <th class="wd-15p border-bottom-0">الاسم</th>
                                <th class="wd-20p border-bottom-0">الدولة</th>
                                <th class="wd-10p border-bottom-0">الحالة</th>
                                <th class="wd-10p border-bottom-0">عدد النكهات</th>
                                <th class="wd-15p border-bottom-0">تاريخ الإضافة</th>
                                <th class="wd-10p border-bottom-0">تاريخ التحديث</th>
                                <th class="wd-25p border-bottom-0">الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($brands as $brand )
                                <tr>
                                    <td>{{$brand->name}}</td>
                                    <td>{{$brand->country}}</td>
                                    <td>
                                        @if($brand->is_active)
                                            <span class="text-success">نشط</span>
                                        @else
                                            <span class="text-danger">غير نشط</span>
                                        @endif
                                    </td>
                                    <td>{{$brand->flavours_count}}</td>
                                    <td>{{$brand->created_at}}</td>
                                    <td>{{$brand->updated_at}}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-primary dropdown-toggle" type="button" id="dropdownMenuButton{{ $brand->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                الإجراءات
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $brand->id }}">

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
                                                        {{-- onclick="window.location.href='{{ route('brands.show', $brand->id) }}'" --}}
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

@section('js')

@endsection
