
@section('css')

@endsection

@section('page-header')

@endsection


<div>

    <!-- row opened -->
    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card">

                
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-md-nowrap" id="example1">
                            <thead>
                                <tr>
                                    <th class="wd-20p border-bottom-0">الاسم</th>
                                    <th class="wd-15p border-bottom-0">السعر</th>
                                    <th class="wd-25p border-bottom-0">فعال</th>
                                    <th class="wd-25p border-bottom-0">عدد المنتجات</th>
                                    <th class="wd-20p border-bottom-0">الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($groups as $group )
                                <tr>
                                    <td>{{$group->name}}</td>
                                    <td>{{$group->price}}</td>
                                    <td style="color:{{$group->valid ? 'green' : 'red'}};">{{$group->valid == 1 ? 'مفعل' : 'غير مفعل'}}</td>
                                    <td>{{$group->details->sum('quantity')}}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-primary dropdown-toggle" 
                                                    type="button" id="dropdownMenuButton{{ $group->id }}" 
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                الإجراءات
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $group->id }}">
                                          
                                                <button type="buttom" wire:click="changeActivation({{$group->id}})" class="dropdown-item text-warning">
                                                    <i class="las la-ban"></i> تعديل التفعيل
                                                </button>

                                                <button type="buttom" wire:click="deleteGroupInventory({{$group->id}})" class="dropdown-item text-danger">
                                                    <i class="las la-trash"></i> حذف
                                                </button>

                                                <button type="buttom" wire:click="getGroupInventoryDetails({{$group->id}})" class="dropdown-item text-success">
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

</div>


