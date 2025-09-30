<div>
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            
            <!-- Modal Header -->
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title">
                    <i class="fas fa-flask me-2"></i>
                    اضافه مخزون الي: {{ $flavour->name }}
                </h5>
                <!-- Close button -->
                <button type="button" class="close text-white" wire:click="cancel">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Livewire Form: prevent default submit -->
            <form wire:submit.prevent="submit">

                <div class="modal-body">
                    
                    <!-- Section: Available nicotine concentrations -->
                    <div class="mt-3 p-3 border rounded bg-white">
                        <h6 class="font-weight-bold mb-3">تركيزات النيكوتين</h6>
                        
                        <!-- Loop through flavour liquids and show options -->
                        @if($flavour->liquids && $flavour->liquids->count() > 0)
                            @foreach($flavour->liquids as $liq)
                                <div class="d-inline-block me-2 mb-2">
                                    <span class="badge badge-info p-2 d-flex align-items-center rounded-pill">
                                        <i class="fas fa-cog me-1"></i>
                                        
                                        <!-- Button triggers Livewire to fetch nicotine strengths -->
                                        <button type="button" 
                                                class="btn btn-link text-white p-0 border-0 text-decoration-none me-2" 
                                                wire:click="getdNicStrenghts({{$liq->id}})">
                                            {{ $liq->nicotine_type }} {{$liq->vape_style}} {{$liq->vg_pg_ratio}} {{$liq->bottle_size_ml}} ml
                                        </button>
                                        
                                    </span>
                                </div>
                            @endforeach
                        @endif
                    </div>

                    <!-- Success message after submit -->
                    @if($successMessage)
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>
                            {{ $successMessage }}
                        </div>
                    @endif

                    <!-- Section: Nicotine strengths form fields -->
                    @forelse($strengthNic as $index => $strength)
                        <div class="d-flex gap-3 mb-3 align-items-end flex-wrap">
                            
                            <!-- Strength label -->
                            <div>
                                <label class="font-weight-bold text-primary">Strength</label>
                                <div class="form-control-plaintext font-weight-bold">
                                    {{ $strength->strength }} mg
                                </div>
                            </div>

                            <!-- Quantity input -->
                            <div>
                                <label class="font-weight-bold">الكمية <span class="text-danger">*</span></label>
                                <input type="number" wire:model="inventoryArray.{{$index}}.stock_quantity" class="form-control" min="0">
                            </div>

                            <!-- Base Price input -->
                            <div>
                                <label class="font-weight-bold">السعر الأساسي <span class="text-danger">*</span></label>
                                <input type="number" wire:model="inventoryArray.{{$index}}.base_price" class="form-control" min="0" step="0.1">
                            </div>

                            <!-- Batch Code input -->
                            <div>
                                <label class="font-weight-bold">كود الدفعة</label>
                                <input type="text" wire:model="inventoryArray.{{$index}}.batch_code" class="form-control">
                            </div>

                            <!-- Expiry Date input -->
                            <div>
                                <label class="font-weight-bold">تاريخ الانتهاء</label>
                                <input type="date" wire:model="inventoryArray.{{$index}}.expiry_date" class="form-control">
                            </div>
                        </div>

                        <!-- Divider between strength groups -->
                        @if(!$loop->last)
                            <hr class="my-3">
                        @endif

                    @empty
                        <!-- Warning if no nicotine strength is selected -->
                        <div class="alert alert-warning text-center">
                            <h5><i class="fas fa-exclamation-triangle"></i> لم يتم اختيار قيمه تركيز النيكوتين</h5>
                        </div>
                    @endforelse
                </div>
                
                <!-- Modal Footer -->
                <div class="modal-footer bg-light">
                    <!-- Cancel button -->
                    <button type="button" class="btn btn-secondary" wire:click="cancel">
                        <i class="fas fa-times me-1"></i>الغاء
                    </button>
                    <!-- Submit button -->
                    <button type="submit" class="btn btn-info">
                        <i class="fas fa-save me-1"></i>اضافه مخزون
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
