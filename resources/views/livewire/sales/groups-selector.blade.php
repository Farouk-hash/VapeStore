<div class="container my-5 p-4 bg-light rounded-3 shadow-lg">

    <!-- Group Selector Section -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">إضافة عرض جديد</h5>
        </div>
        <div class="card-body">
            <div class="row align-items-end">
                <div class="col-md-8">
                    <label for="brand" class="form-label fw-bold">🏷️ اختر العرض</label>
                    <select id="brand" wire:model="selectedGroupInventoryVariable" class="form-select shadow-sm">
                        <option value="">-- اختر عرض --</option>
                        @foreach($groupsInventories as $groupInventory)
                            <option value="{{ $groupInventory->id }}">{{ $groupInventory->name }} - {{ $groupInventory->price }} ج.م</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <button wire:click="addGroupToSelection" class="btn btn-primary w-100">
                        <i class="fas fa-plus"></i> إضافة العرض
                    </button>
                </div>
            </div>
        </div>
    </div>


    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Selected Groups Section -->
    @if(!empty($selectedGroups))
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">العروض المختارة ({{ count($selectedGroups) }})</h5>
                <div>
                    <span class="badge bg-success fs-6 me-2">الإجمالي: {{ $this->getTotalPrice() }} ج.م</span>
                    <button wire:click="clearAllSelections" class="btn btn-outline-danger btn-sm">
                        <i class="fas fa-trash"></i> مسح الكل
                    </button>
                </div>
            </div>
            
            <div class="card-body">
                @foreach($selectedGroups as $groupId => $group)
                    <div class="border rounded p-3 mb-3">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <h6 class="fw-bold text-primary">{{ $group['name'] }}</h6>
                                <small class="text-muted">سعر الوحدة: {{ $group['price'] }} ج.م</small>
                            </div>
                            <button wire:click="removeGroupFromSelection({{ $groupId }})" class="btn btn-outline-danger btn-sm">
                                <i class="fas fa-times"></i> حذف
                            </button>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label class="form-label">الكمية:</label>
                                <input 
                                    type="number"
                                    min="1"
                                    wire:model.lazy="quantities.{{ $groupId }}"
                                    wire:change="updateGroupQuantity({{ $groupId }}, $event.target.value)"
                                    class="form-control"
                                    value="{{ $quantities[$groupId] ?? 1 }}"
                                >
                            </div>
                            <div class="col-md-3 d-flex align-items-end">
                                <strong>الإجمالي: {{ $group['price'] * ($quantities[$groupId] ?? 1) }} ج.م</strong>
                            </div>
                        </div>

                        <!-- Group Details -->
                        <div class="row">
                            @foreach($group['details'] as $detail)
                                <?php 
                                    $groupQuantity = $detail->details($detail->source)['quantity'];
                                    $inventoryQuantity = $detail->details($detail->source)['inventory_quantity'];
                                    $selectedQuantity = $quantities[$groupId] ?? 1;
                                    $calculatedQuantity = $groupQuantity * $selectedQuantity;
                                    $remainingQuantity = $inventoryQuantity - $calculatedQuantity;
                                ?>
                                <div class="col-md-4 mb-2">
                                    <div class="card border-0 shadow-sm h-100">
                                        <div class="card-body p-2">
                                            <h6 class="fw-bold mb-1 small">{{ $detail->details($detail->source)['name'] }}</h6>
                                            <small class="text-muted d-block">الكمية في العرض: {{ $groupQuantity }}</small>
                                            <small class="text-muted d-block">الكمية في المخزن: {{ $inventoryQuantity }}</small>
                                            <small class="text-muted d-block">المطلوب: {{ $calculatedQuantity }}</small>
                                            <small class="d-block {{ $remainingQuantity >= 0 ? 'text-success' : 'text-danger' }}">
                                                المتبقي: {{ $remainingQuantity }}
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                @endforeach

                {{-- <!-- Submit Button -->
                <div class="text-center mt-4">
                    <button wire:click="submitOrder" class="btn btn-success btn-lg px-5">
                        <i class="fas fa-shopping-cart"></i>
                        تأكيد العرض 
                    </button>
                </div> --}}
            </div>
        </div>
    @else
        <div class="alert alert-info text-center">
            <i class="fas fa-info-circle"></i>
            لم يتم اختيار أي عروض بعد. قم بإضافة عرض من الأعلى.
        </div>
    @endif
</div>