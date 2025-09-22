<!-- Fixed Inventory Modal for {{ $coilSer->name }} -->
<div class="modal fade" id="manageInventory{{ $coilSer->id }}" tabindex="-1" role="dialog"
     aria-labelledby="manageInventoryLabel{{ $coilSer->id }}" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="manageInventoryLabel{{ $coilSer->id }}">
                    <i class="fas fa-warehouse me-2"></i>
                    إدارة مخزون التانكات: {{ $coilSer->name }}
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form 
            action="{{route('coils.addInventory',parameters: [$coilSer->id])}}"
                 method="POST" id="inventoryForm{{ $coilSer->id }}">
                @csrf
                <input type="hidden" name="coilSer_id" value="{{ $coilSer->id }}">
                
                <div class="modal-body">
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i>
                        <strong>إدارة المخزون للتانك:</strong> {{ $coilSer->name }} - {{ $coilSer->brand->name ?? 'غير معروف' }}
                    </div>

                    <!-- Inventory Items Container -->
                    <div id="inventoryItems{{ $coilSer->id }}">
                        <!-- Initial Inventory Item -->
                        <div class="inventory-item card mb-3" data-item-index="0">
                            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                <h6 class="mb-0">عنصر المخزون #1</h6>
                                <button type="button" class="btn btn-sm btn-danger remove-item" style="display: none;">
                                    <i class="fas fa-trash"></i> حذف
                                </button>
                            </div>
                            <div class="card-body">
                                <!-- Color and Flavor Selection -->
                                <div class="row mb-3">
                                    @if($coilSer->coilsOhms && $coilSer->coilsOhms->count() > 0)
                                    <div class="col-md-6">
                                        <label class="font-weight-bold text-primary">المقاومه</label>
                                        <select name="inventories[0][device_color_id]" class="form-control">
                                            <option value="">اختر المقاومه</option>
                                            @foreach($coilSer->coilsOhms as $coilsOhm)
                                                <option value="{{ $coilsOhm->id }}">{{ $coilsOhm->resistance }}Ω--{{$coilsOhm->vaping_style}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @endif
                                </div>

                                <!-- Inventory Details -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="font-weight-bold">الكمية <span class="text-danger">*</span></label>
                                        <input type="number" name="inventories[0][stock_quantity]" class="form-control" placeholder="0" min="0" required>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="font-weight-bold">سعر التكلفة</label>
                                        <input type="number" name="inventories[0][cost_price]" class="form-control" placeholder="0.00" min="0" step="0.01">
                                    </div>

                                    <div class="col-md-4">
                                        <label class="font-weight-bold">رقم الدفعة</label>
                                        <input type="text" name="inventories[0][batch_number]" class="form-control" placeholder="اختياري">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Add More Button -->
                    <div class="text-center mb-4">
                        <button type="button" class="btn btn-success" id="addMoreItem{{ $coilSer->id }}">
                            <i class="fas fa-plus me-1"></i> إضافة عنصر آخر
                        </button>
                    </div>

                    <!-- Existing Inventory Display -->
                    @if(isset($coilSer->inventories) && $coilSer->inventories->count() > 0)
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
                                    <th>الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($coilSer->inventories as $inventory)
                                <tr>
                                    <td>
                                        @if($inventory->coil)
                                            <span class="badge badge-info">{{ $inventory->coil->resistance }}Ω</span>
                                        @endif
                                     
                                    </td>
                                    <td>{{ $inventory->stock_quantity ?? 0 }} وحده</td>
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
                                    <td>
                                        <button type="button" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="alert alert-warning text-center mt-4">
                        <h6><i class="fas fa-exclamation-triangle"></i> لا يوجد مخزون مسجل</h6>
                        <p>قم بإضافة المخزون الأول لهذا الملف</p>
                    </div>
                    @endif 
                </div>
                
                <!-- Modal Footer -->
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
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


