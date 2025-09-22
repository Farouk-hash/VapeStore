<!-- Inventory Modal for {{ $liquid->name }} -->
        <div class="modal fade" id="addInventory{{ $liquid->id }}" tabindex="-1" role="dialog"
             aria-labelledby="addInventoryLabel{{ $liquid->id }}" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-info text-white">
                        <h5 class="modal-title" id="addInventoryLabel{{ $liquid->id }}">
                            <i class="fas fa-flask me-2"></i>
                            Add Inventory Liquid: {{ $flavour->name }} - {{ $liquid->vape_style }}/{{ $liquid->nicotine_type }}
                        </h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form action="{{ route('liquid.addInventory' , [$brand->id]) }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle"></i>
                                <strong>Adding inventory for:</strong> {{ $flavour->name }} ({{ $liquid->vape_style }}/{{ $liquid->nicotine_type }})
                            </div>

                            @forelse($liquid->strengthNic as $index => $strength)
                               <div class="d-flex gap-3 mb-3 align-items-end flex-wrap">
                                    <div>
                                        <label class="font-weight-bold text-primary">Strength</label>
                                        <div class="form-control-plaintext font-weight-bold">
                                            {{ $strength->strength }} mg
                                        </div>
                                        <input type="hidden" name="inventories[{{ $index }}][strength_id]" value="{{ $strength->id }}">
                                    </div>

                                    <div>
                                        <label class="font-weight-bold">Quantity <span class="text-danger">*</span></label>
                                        <input type="number" name="inventories[{{ $index }}][stock_quantity]" class="form-control" placeholder="0" min="0">
                                    </div>

                                    <div>
                                        <label class="font-weight-bold">Base Price <span class="text-danger">*</span></label>
                                        <input type="number" name="inventories[{{ $index }}][base_price]" class="form-control" placeholder="0" min="0" step="0.1">
                                    </div>

                                    <div>
                                        <label class="font-weight-bold">Batch Code</label>
                                        <input type="text" name="inventories[{{ $index }}][batch_code]" class="form-control" placeholder="Optional">
                                    </div>

                                    <div>
                                        <label class="font-weight-bold">Expiry Date</label>
                                        <input type="date" name="inventories[{{ $index }}][expiry_date]" class="form-control" min="{{ date('Y-m-d') }}">
                                    </div>
                                </div>

                                @if(!$loop->last)
                                    <hr class="my-3">
                                @endif
                            @empty
                                <div class="alert alert-warning text-center">
                                    <h5><i class="fas fa-exclamation-triangle"></i> No Strengths Available</h5>
                                    <p>Add nicotine strengths to this liquid first by editing it.</p>
                                </div>
                            @endforelse
                        </div>
                        
                        <!-- Modal Footer -->
                        <div class="modal-footer bg-light">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                <i class="fas fa-times me-1"></i>Cancel
                            </button>
                            <button type="submit" class="btn btn-info">
                                <i class="fas fa-save me-1"></i>ADD INVENTORY
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>