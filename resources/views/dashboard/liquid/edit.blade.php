<!-- Liquid Edit Modal -->
<div class="modal fade" id="edit{{ $liquid->id }}" tabindex="-1" role="dialog"
     aria-labelledby="editLiquidModalLabel{{ $liquid->id }}" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="editLiquidModalLabel{{ $liquid->id }}">
                    <i class="fas fa-flask me-2"></i>
                    Edit Liquid: {{ $liquid->name }}
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <form action="{{ route('liquid.update', $liquid->id) }}" method="post" autocomplete="off">
                @method('PUT')
                @csrf
                
                <div class="modal-body">
                    <div class="row">
                        <!-- Name -->
                        <div class="col-md-6 form-group">
                            <label for="name{{ $liquid->id }}" class="font-weight-bold">
                                <i class="fas fa-tag me-1"></i>Name <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   name="name" 
                                   id="name{{ $liquid->id }}" 
                                   class="form-control" 
                                   value="{{ old('name', $liquid->name) }}" 
                                   placeholder="Enter liquid name" 
                                   required>
                        </div>

                        <!-- Nicotine Type -->
                        <div class="col-md-6 form-group">
                            <label for="nicotine_type{{ $liquid->id }}" class="font-weight-bold">
                                <i class="fas fa-vial me-1"></i>Nicotine Type
                            </label>
                            <select name="nicotine_type" id="nicotine_type{{ $liquid->id }}" class="form-control">
                                <option value="salt" {{ old('nicotine_type', $liquid->nicotine_type) == 'salt' ? 'selected' : '' }}>Salt</option>
                                <option value="freebase" {{ old('nicotine_type', $liquid->nicotine_type) == 'freebase' ? 'selected' : '' }}>Freebase</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Vape Style -->
                        <div class="col-md-6 form-group">
                            <label for="vape_style{{ $liquid->id }}" class="font-weight-bold">
                                <i class="fas fa-smoking me-1"></i>Vape Style
                            </label>
                            <select name="vape_style" id="vape_style{{ $liquid->id }}" class="form-control">
                                <option value="DL" {{ old('vape_style', $liquid->vape_style) == 'DL' ? 'selected' : '' }}>DL</option>
                                <option value="MTL" {{ old('vape_style', $liquid->vape_style) == 'MTL' ? 'selected' : '' }}>MTL</option>
                            </select>
                        </div>

                        <!-- VG/PG Ratio -->
                        <div class="col-md-6 form-group">
                            <label for="vg_pg_ratio{{ $liquid->id }}" class="font-weight-bold">
                                <i class="fas fa-balance-scale me-1"></i>VG/PG Ratio
                            </label>
                            <input type="text" 
                                   name="vg_pg_ratio" 
                                   id="vg_pg_ratio{{ $liquid->id }}" 
                                   class="form-control" 
                                   value="{{ old('vg_pg_ratio', $liquid->vg_pg_ratio) }}" 
                                   placeholder="e.g. 70/30">
                        </div>
                    </div>

                    <div class="row">
                        <!-- Bottle Size -->
                        <div class="col-md-6 form-group">
                            <label for="bottle_size_ml{{ $liquid->id }}" class="font-weight-bold">
                                <i class="fas fa-wine-bottle me-1"></i>Bottle Size (ml)
                            </label>
                            <input type="number" 
                                   name="bottle_size_ml" 
                                   id="bottle_size_ml{{ $liquid->id }}" 
                                   class="form-control" 
                                   value="{{ old('bottle_size_ml', $liquid->bottle_size_ml) }}">
                        </div>

                        <!-- Flavour -->
                        <div class="col-md-6 form-group">
                            <label for="flavour_id{{ $liquid->id }}" class="font-weight-bold">
                                <i class="fas fa-ice-cream me-1"></i>Flavour
                            </label>
                            <select name="flavour_id" id="flavour_id{{ $liquid->id }}" class="form-control">
                                @foreach($flavours as $flavour)
                                    <option value="{{ $flavour->id }}" {{ old('flavour_id', $liquid->flavour_id) == $flavour->id ? 'selected' : '' }}>
                                        {{ $flavour->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Nicotine Strengths -->
                    <div class="form-group">
                        <label class="font-weight-bold">
                            <i class="fas fa-burn me-1"></i>Nicotine Strengths (mg)
                        </label>
                        <div id="nicotine-strengths-{{ $liquid->id }}" class="nicotine-strengths-container">
                            @foreach($liquid->nicotine_strengths as $index => $strength)
                                <div class="input-group mb-2 strength-input-group">
                                    <input type="number" 
                                           step="0.1" 
                                           name="nicotine_strengths[]" 
                                           class="form-control" 
                                           value="{{ $strength }}"
                                           min="0"
                                           placeholder="Enter mg"
                                           required>
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-outline-danger btn-sm" onclick="removeStrengthField(this)">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                            
                            <!-- Ensure at least one field exists if no strengths -->
                            @if(count($liquid->nicotine_strengths) > 0)
                                <div class="input-group mb-2 strength-input-group">
                                    <input type="number" 
                                           step="0.1" 
                                           name="nicotine_strengths[]" 
                                           class="form-control" 
                                           min="0"
                                           placeholder="Enter mg"
                                           required>

                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-outline-danger btn-sm" onclick="removeStrengthField(this)">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <button type="button" class="btn btn-sm btn-primary" onclick="addStrengthField({{ $liquid->id }})">
                            <i class="fas fa-plus"></i> Add Strength
                        </button>
                    </div>

                    <!-- Status -->
                    <div class="form-group">
                        <label for="is_active{{ $liquid->id }}" class="font-weight-bold">
                            <i class="fas fa-toggle-on me-1"></i>Status
                        </label>
                        <select class="form-control" id="is_active{{ $liquid->id }}" name="is_active" required>
                            <option value="1" {{ old('is_active', $liquid->is_active) == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('is_active', $liquid->is_active) == 0 ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                </div>
                
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times me-1"></i>Cancel
                    </button>
                    <button type="submit" class="btn btn-info">
                        <i class="fas fa-save me-1"></i>Update Liquid
                    </button>
                </div>
                
            </form>
        </div>
    </div>
</div>

<script>
function addStrengthField(id) {
    const container = document.getElementById(`nicotine-strengths-${id}`);
    const newField = document.createElement('div');
    newField.className = 'input-group mb-2 strength-input-group';
    newField.innerHTML = `
        <input type="number" 
               step="0.1" 
               name="nicotine_strengths[]" 
               class="form-control" 
               min="0"
               placeholder="Enter mg"
               required>
        <div class="input-group-append">
            <button type="button" class="btn btn-outline-danger btn-sm" onclick="removeStrengthField(this)">
                <i class="fas fa-trash"></i>
            </button>
        </div>
    `;
    container.appendChild(newField);
    
    // Focus on the new input
    const newInput = newField.querySelector('input');
    newInput.focus();
}

function removeStrengthField(button) {
    const container = button.closest('.nicotine-strengths-container');
    const inputGroups = container.querySelectorAll('.strength-input-group');
    
    // Prevent removing the last field
    if (inputGroups.length > 1) {
        button.closest('.strength-input-group').remove();
    } else {
        alert('At least one nicotine strength is required.');
    }
}

// Form validation before submit
document.addEventListener('DOMContentLoaded', function() {
    const forms = document.querySelectorAll('form[action*="liquid.update"]');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const strengthInputs = form.querySelectorAll('input[name="nicotine_strengths[]"]');
            let hasValidStrength = false;
            
            strengthInputs.forEach(input => {
                if (input.value && parseFloat(input.value) >= 0) {
                    hasValidStrength = true;
                }
            });
            
            if (!hasValidStrength) {
                e.preventDefault();
                alert('Please enter at least one valid nicotine strength.');
                return false;
            }
        });
    });
});
</script>