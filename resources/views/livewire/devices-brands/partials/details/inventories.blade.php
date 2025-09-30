<!-- Inventory Section -->
@if(isset($device->inventories) && $device->inventories->count() > 0)
<div class="card border shadow-sm mt-4">
    <div class="card-header bg-light d-flex justify-content-between align-items-center py-3">
        <h6 class="mb-0 text-primary fw-bold">
            <i class="fas fa-list me-2"></i> المخزون الحالي
        </h6>
    </div>
    
    <div class="collapse show" id="inventoryTable">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="border-0">المتغير</th>
                            <th class="border-0">الكمية</th>
                            <th class="border-0">الحالة</th>
                            <th class="border-0">سعر البيع</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- {{$device->inventories[0]->deviceFlavor->component->name}} --}}
                        @foreach($device->inventories as $inventory)
                        <tr class="border-bottom">
                            <td>
                                
                                @if(isset($sk))
                                    <span class="badge bg-info me-1">{{ $inventory->{$item}->{$sk} }}</span>
                                @else 
                                
                                    @if ($item === 'deviceFlavor')
                                        <span class="badge bg-info me-1">
                                            {{ $inventory->deviceFlavor->component->name ?? 'غير محدد' }}
                                        </span>
                                    @elseif ($item === 'deviceColor')
                                        <span class="badge bg-info me-1">
                                            {{ $inventory->deviceColor->name ?? 'غير محدد' }}
                                        </span>
                                    @endif

                                @endif

                            </td>
                            <td>
                                <span class="fw-bold text-dark">{{ $inventory->stock_quantity ?? 0 }}</span>
                            </td>
                            <td>
                                @if(($inventory->stock_quantity ?? 0) > 0)
                                    <span class="badge bg-success">متاح</span>
                                @else
                                    <span class="badge bg-danger">غير متاح</span>
                                @endif
                            </td>
                            <td>
                                @if(isset($inventory->base_price))
                                    <span class="fw-bold text-success">{{ number_format($inventory->base_price, 2) }} جنيه</span>
                                @else
                                    <span class="text-muted">غير محدد</span>
                                @endif
                            </td>
                            
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@else
<div class="alert alert-warning text-center mt-4">
    <div class="alert-icon">
        <i class="fas fa-exclamation-triangle fa-2x mb-3"></i>
    </div>
    <h6 class="fw-bold">لا يوجد مخزون مسجل</h6>
    <p class="mb-0">قم بإضافة المخزون الأول لهذا الجهاز</p>
</div>
@endif
