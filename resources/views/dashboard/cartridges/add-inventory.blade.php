<!-- Fixed Inventory Modal for {{ $cartridge->name }} -->
<div class="modal fade" id="manageInventory{{ $cartridge->id }}" tabindex="-1" role="dialog"
     aria-labelledby="manageInventoryLabel{{ $cartridge->id }}" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="manageInventoryLabel{{ $cartridge->id }}">
                    <i class="fas fa-warehouse me-2"></i>
                    إدارة مخزون الخراطيش: {{ $cartridge->name }}
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form 
            action="{{route('cartridges.addInventory',parameters: [$cartridge->id])}}"
                 method="POST" id="inventoryForm{{ $cartridge->id }}">
                @csrf
                <input type="hidden" name="cartridge_id" value="{{ $cartridge->id }}">
                
                <div class="modal-body">
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i>
                        <strong>إدارة المخزون للتانك:</strong> {{ $cartridge->name }} - {{ $cartridge->brand->name ?? 'غير معروف' }}
                    </div>

                    <!-- Inventory Items Container -->
                    <div id="inventoryItems{{ $cartridge->id }}">
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
                                    @if($cartridge->variants && $cartridge->variants->count() > 0)
                                    <div class="col-md-6">
                                        <label class="font-weight-bold text-primary">المقاومه</label>
                                        <select name="inventories[0][device_color_id]" class="form-control">
                                            <option value="">اختر المقاومه</option>
                                            @foreach($cartridge->variants as $variant)
                                                <option value="{{ $variant->id }}">{{ $variant->resistance }}Ω--{{$variant->vaping_style}}</option>
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
                        <button type="button" class="btn btn-success" id="addMoreItem{{ $cartridge->id }}">
                            <i class="fas fa-plus me-1"></i> إضافة عنصر آخر
                        </button>
                    </div>

                    <!-- Existing Inventory Display -->
                     @if(isset($cartridge->inventories) && $cartridge->inventories->count() > 0)
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
                                    <th>تاريخ البدأ</th>
                                    <th>سعر البيع</th>
                                    <th>الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cartridge->inventories as $inventory)
                                <tr>
                                    <td>
                                        @if($inventory->cartridge)
                                            <span class="badge badge-info">{{ $inventory->cartridge->resistance}}Ω</span>
                                        @endif
                                     
                                    </td>
                                    <td>{{ $inventory->stock_quantity ?? 0 }} وحده</td>
                                    <td>
                                        <span class="badge badge-success">متاح</span>
                                    </td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($inventory->displayed_at)->diffForHumans() }}
                                    </td>
                                    <td>
                                        {{ number_format($inventory->base_price, 2) }} جنيه
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


