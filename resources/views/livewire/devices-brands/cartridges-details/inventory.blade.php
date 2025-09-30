<div >
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="manageInventoryLabel{{ $device->id }}">
                    <i class="fas fa-warehouse me-2"></i>
                    إدارة مخزون الجهاز: {{ $device->name }}
                </h5>
                <button type="button" class="close text-white" wire:click="cancel">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form wire:submit.prevent="submit">
                
                <div class="modal-body">
               

                    <!-- Inventory Items Container -->
                    <div >
                        <!-- Initial Inventory Item -->
                        <div class="inventory-item card mb-3" data-item-index="0">
                            

                                <!-- Inventory Details -->
                                @foreach($inventories as $index => $detail)
                                    <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                        <h6 class="mb-0">عنصر المخزون {{$index+1}}</h6>
                                        @if($index > 0)
                                            <button type="button" wire:click="remove({{$index}})">
                                                <i class="fas fa-trash"></i> حذف
                                            </button>
                                        @endif
                                    </div>
                                            <div class="card-body">
                                                <!-- Color and Flavor Selection -->
                                                <div class="row mb-3">
                                                    @if($device->variants && $device->variants->count() > 0)
                                                    <div class="col-md-6">
                                                        <label class="font-weight-bold text-primary">المقاومه (اختياري)</label>
                                                        <select wire:model.defer="inventories.{{$index}}.cartridge_variant_id" class="form-control">
                                                            <option value="">اختر المقاومه</option>
                                                            @foreach($device->variants as $variant)
                                                                <option value="{{ $variant->id }}">{{$variant->resistance}}-{{ $variant->vaping_style }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    @endif

                                                    
                                                </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label class="font-weight-bold">الكمية <span class="text-danger">*</span></label>
                                                            <input type="number" wire:model.defer="inventories.{{$index}}.stock_quantity" class="form-control" placeholder="0" min="0" required>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <label class="font-weight-bold">سعر التكلفة</label>
                                                            <input type="number" wire:model.defer="inventories.{{$index}}.base_price" class="form-control" placeholder="0.00" min="0" step="0.01">
                                                        </div>

                                                        <div class="col-md-4">
                                                            <label class="font-weight-bold">رقم الدفعة</label>
                                                            <input type="text" wire:model.defer="inventories.{{$index}}.batch_number" class="form-control" placeholder="اختياري">
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Add More Button -->
                                    <div class="text-center mb-4">
                                        <button type="button" class="btn btn-success" wire:click="addMoreItem">
                                            <i class="fas fa-plus me-1"></i> إضافة عنصر آخر
                                        </button>
                                    </div>

                                <!-- Existing Inventory Display -->
                                @if(isset($device->inventories) && $device->inventories->count() > 0)
                                <hr class="my-4">
                                <h6 class="text-primary mb-3">
                                    <i class="fas fa-list"></i> المخزون الحالي
                                </h6>
                                
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead class="bg-light">
                                            <tr>
                                                <th>المتغير</th>
                                                <th>الكمية</th>
                                                <th>الحالة</th>
                                                <th>سعر البيع</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($device->inventories as $inventory)
                                            <tr>
                                                <td>
                                                    <span class="badge badge-info">{{ $inventory->cartridgeVariants->resistance }}</span>
                                                   
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
                            </div>
                
                <!-- Modal Footer -->
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" wire:click="cancel">
                        <i class="fas fa-times me-1"></i> إلغاء
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> حفظ المخزون
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>


