<!-- flavour Edit Modal with Components -->
<div class="modal fade" id="edit{{ $flavour->id }}" tabindex="-1" role="dialog"
     aria-labelledby="editflavourModalLabel{{ $flavour->id }}" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="editflavourModalLabel{{ $flavour->id }}">
                    <i class="fas fa-palette me-2"></i>
                    Edit flavour: {{ $flavour->name }}
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <form action="{{ route('flavours.update', $flavour->id) }}" method="post" autocomplete="off">
                @method('PUT')
                @csrf
                
                <div class="modal-body">
                    <div class="row">
                        <!-- Left Column -->
                        <div class="col-md-6">
                            <!-- flavour Name -->
                            <div class="form-group">
                                <label for="name{{ $flavour->id }}" class="font-weight-bold">
                                    <i class="fas fa-palette me-1"></i>flavour Name <span class="text-danger">*</span>
                                </label>
                                <input type="text" 
                                       name="name" 
                                       id="name{{ $flavour->id }}" 
                                       class="form-control" 
                                       value="{{ old('name', $flavour->name) }}" 
                                       placeholder="Enter flavour name" 
                                       required>
                                <small class="form-text text-muted">Enter a unique flavour name</small>
                            </div>

                            <!-- Brand -->
                            <div class="form-group">
                                <label for="brand_id{{ $flavour->id }}" class="font-weight-bold">
                                    <i class="fas fa-tags me-1"></i>Brand <span class="text-danger">*</span>
                                </label>
                                <select class="form-control" 
                                        id="brand_id{{ $flavour->id }}" 
                                        name="brand_id" 
                                        required>
                                    <option value="" disabled>--Choose Brand--</option>
                                    @foreach($brands as $brand)
                                        <option value="{{ $brand->id }}" 
                                                {{ old('brand_id', $flavour->brand_id) == $brand->id ? 'selected' : '' }}>
                                            {{ $brand->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <small class="form-text text-muted">
                                    Current brand: 
                                    <span class="badge badge-info">
                                        <i class="fas fa-tag me-1"></i>{{ $flavour->brand->name ?? 'Not assigned' }}
                                    </span>
                                </small>
                            </div>

                           
                        </div>

                        <!-- Right Column - Components -->
                        <div class="col-md-6">
                            <!-- Current Components Display -->
                            <div class="mb-3">
                                <label class="font-weight-bold">
                                    <i class="fas fa-cogs me-1"></i>Currently Assigned Components:
                                </label>
                                <div class="current-components-display p-2 bg-light rounded">
                                    @if($flavour->components && $flavour->components->count() > 0)
                                        @foreach($flavour->components as $component)
                                            <span class="badge badge-info me-1 mb-1">
                                                <i class="fas fa-cog me-1" style="color: {{ $component->color ?? '#fff' }}"></i>
                                                {{ $component->name }}
                                            </span>
                                        @endforeach
                                        <small class="d-block text-muted mt-1">{{ $flavour->components->count() }} component(s) assigned</small>
                                    @else
                                        <small class="text-muted">No components currently assigned</small>
                                    @endif
                                </div>
                            </div>

                            <!-- Components Selection -->
                            <div class="form-group">
                                <label class="font-weight-bold">
                                    <i class="fas fa-cogs me-1"></i>Available Components 
                                    <span class="component-count-edit" id="component-count-edit-{{ $flavour->id }}">0 selected</span>
                                </label>
                                <div class="component-selection-edit" style="max-height: 250px; overflow-y: auto; border: 1px solid #ced4da; border-radius: 0.375rem; padding: 10px; background-color: white;">
                                    <!-- Select All Option -->
                                    <div class="custom-control custom-checkbox" style="font-weight: bold; border-bottom: 1px solid #dee2e6; padding-bottom: 8px; margin-bottom: 10px;">
                                        <input type="checkbox" 
                                               class="custom-control-input" 
                                               id="select_all_components_edit_{{ $flavour->id }}"
                                               onchange="toggleAllComponentsEdit({{ $flavour->id }}, this.checked)">
                                        <label class="custom-control-label" for="select_all_components_edit_{{ $flavour->id }}">
                                            <i class="fas fa-check-double me-1"></i>Select All Components
                                        </label>
                                    </div>
                                    
                                    <!-- Individual Component Checkboxes -->
                                    @foreach($components as $component)
                                        <div class="custom-control custom-checkbox mb-2">
                                            <input type="checkbox" 
                                                   name="component_ids[]" 
                                                   value="{{ $component->id }}" 
                                                   class="custom-control-input component-checkbox-edit" 
                                                   id="edit_flavour_{{ $flavour->id }}_component_{{ $component->id }}"
                                                   onchange="updateComponentCountEdit({{ $flavour->id }})"
                                                   {{ $flavour->components->contains($component->id) ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="edit_flavour_{{ $flavour->id }}_component_{{ $component->id }}">
                                                <i class="fas fa-cog me-1" style="color: {{ $component->color ?? '#6c757d' }}"></i>
                                                {{ $component->name }}
                                                @if($component->description)
                                                    <small class="text-muted d-block">{{ Str::limit($component->description, 40) }}</small>
                                                @endif
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                                <small class="form-text text-muted">Select components that are compatible with this flavour</small>
                            </div>
                        </div>
                    </div>

                    <!-- flavour Info Card -->
                    <div class="card bg-light border-0 mt-3">
                        <div class="card-body py-2">
                            <div class="row text-sm">
                                <div class="col-sm-4">
                                    <strong class="text-muted">Created:</strong>
                                    <span>{{ $flavour->created_at }}</span>
                                </div>
                                <div class="col-sm-4">
                                    <strong class="text-muted">Last Updated:</strong>
                                    <span>{{ $flavour->updated_at }}</span>
                                </div>
                                <div class="col-sm-4">
                                    <strong class="text-muted">Total Components:</strong>
                                    <span class="badge badge-warning">{{ $flavour->components->count() ?? 0 }}</span>
                                </div>
                            </div>
                            @if($flavour->brand && $flavour->brand->description)
                            <div class="row text-sm mt-2">
                                <div class="col-sm-12">
                                    <strong class="text-muted">Brand Description:</strong>
                                    <span>{{ $flavour->brand->description }}</span>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Hidden ID field -->
                    {{-- <input type="hidden" name="id" value="{{ $flavour->id }}"> --}}
                    <input type="hidden" name="brand_id" value="{{ $brand->id }}">

                </div>
                
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times me-1"></i>Cancel
                    </button>
                    <button type="submit" class="btn btn-info">
                        <i class="fas fa-save me-1"></i>Update flavour
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- JavaScript for Component Management -->
<script>
function toggleAllComponentsEdit(flavourId, selectAll) {
    const modal = document.querySelector(`#edit${flavourId}`);
    const componentCheckboxes = modal.querySelectorAll('.component-checkbox-edit');
    
    componentCheckboxes.forEach(checkbox => {
        checkbox.checked = selectAll;
    });
    
    updateComponentCountEdit(flavourId);
}

function updateComponentCountEdit(flavourId) {
    const modal = document.querySelector(`#edit${flavourId}`);
    const checkedComponents = modal.querySelectorAll('.component-checkbox-edit:checked');
    const countElement = modal.querySelector(`#component-count-edit-${flavourId}`);
    const selectAllCheckbox = modal.querySelector(`#select_all_components_edit_${flavourId}`);
    
    const count = checkedComponents.length;
    countElement.textContent = `${count} selected`;
    
    // Update select all checkbox state
    if (selectAllCheckbox) {
        const allComponents = modal.querySelectorAll('.component-checkbox-edit');
        selectAllCheckbox.checked = count === allComponents.length;
        selectAllCheckbox.indeterminate = count > 0 && count < allComponents.length;
    }
}

// Initialize component count when modal is opened
document.addEventListener('DOMContentLoaded', function() {
    // Listen for modal show events
    $('[id^="edit"]').on('shown.bs.modal', function() {
        const flavourId = this.id.replace('edit', '');
        updateComponentCountEdit(flavourId);
    });
});
</script>