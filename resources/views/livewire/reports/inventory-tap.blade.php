<div class="row g-4">

    <div class="col-12 mb-4 fade-in-right">
        <select wire:model="selectedCategory" wire:change="onCategoryChanged" class="form-select w-auto">
            <option value="">جميع التصنيفات</option>
            @foreach ($this->categories as $category)
                <option value="{{ $category->id }}">{{ $category->slug }}</option>
            @endforeach
        </select>
    </div>

    <!-- Inventory Stats -->
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm bg-gradient-info h-100">
            <div class="card-body text-center text-black">
                <i class="fas fa-exclamation-triangle bg-white text-primary rounded-circle mb-3" style="font-size: 3rem;"></i>
                <h3 class="fw-bold">{{$totalItemsCount}}</h3>
                <p class="mb-0">إجمالي الأصناف</p>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm bg-gradient-warning h-100">
            <div class="card-body text-center text-black">
                <i class="fas fa-exclamation-triangle bg-white text-warning rounded-circle mb-3" style="font-size: 3rem;"></i>
                <h3 class="fw-bold">{{$totalItemsLowStock}}</h3>
                <p class="mb-0">أصناف قليلة المخزون</p>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm bg-gradient-primary h-100">
            <div class="card-body text-center text-black">
                <i class="fas fa-coins bg-white text-success rounded-circle mb-3" style="font-size: 3rem;"></i>
                <h3 class="fw-bold">{{number_format($summationItems , 2 ,'.',',')}}</h3>
                <p class="mb-0">قيمة المخزون</p>
            </div>
        </div>
    </div>

    <!-- Inventory Table -->
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-header border-0 bg-light">
                <h5 class="fw-bold mb-0 d-flex align-items-center">
                    <i class="fas fa-list text-primary me-2"></i>
                    تفاصيل المخزون
                </h5>
            </div>
            @if(count($items)!=0)
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="fw-bold text-dark">المنتج</th>
                                    <th class="fw-bold text-dark">الفئة</th>
                                    <th class="fw-bold text-dark">المخزون</th>
                                    <th class="fw-bold text-dark">السعر</th>
                                    <th class="fw-bold text-dark">القيمة</th>
                                    <th class="fw-bold text-dark">الحالة</th>
                                </tr>
                            </thead>
                            <tbody>
                                    @foreach ($items as $item)
                                        <tr>
                                            <td class="fw-semibold">{{$item['name']}}</td>
                                            <td>{{$item['category']}}</td>
                                            <td class="fw-bold">{{$item['quantities']}}</td>
                                            <td>{{$item['base_price']}}</td>
                                            <td class="text-success fw-bold">
                                                {{ number_format($item['quantities'] * $item['base_price'], 2, '.', ',') }}
                                            </td>
                                            <td><span class="badge bg-{{$item['status'] == 'in_stock'? 'success' : 'warning'}}">{{$item['status'] == 'in_stock' ?'متوفر':'غير متوفر'}}</span></td>
                                        </tr>
                                    @endforeach
                            
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            @else
                <div class="card-body">
                    <div class="alert alert-warning text-center mb-0" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        لا يوجد مخزون حاليًا
                    </div>
                </div>
            
            @endif
        </div>
    </div>

</div>