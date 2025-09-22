<!-- Component Edit Modal with Flavors -->
<div class="modal fade" id="edit{{ $component->id }}" tabindex="-1" role="dialog"
     aria-labelledby="editComponentModalLabel{{ $component->id }}" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="editComponentModalLabel{{ $component->id }}">
                    <i class="fas fa-edit me-2"></i>
                    Edit Component: {{ $component->name }}
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <form action="{{ route('components.update', $component->id) }}" method="post" autocomplete="off">
                @method('PUT')
                @csrf
                
                <div class="modal-body">
                    <div class="row">
                        <!-- Left Column -->
                        <div class="col-md-6">
                            <!-- Component Name -->
                            <div class="form-group">
                                <label for="name{{ $component->id }}" class="font-weight-bold">
                                    <i class="fas fa-cogs me-1"></i>Component Name <span class="text-danger">*</span>
                                </label>
                                <input type="text" 
                                       name="name" 
                                       id="name{{ $component->id }}" 
                                       class="form-control" 
                                       value="{{ old('name', $component->name) }}" 
                                       placeholder="Enter component name" 
                                       required>
                                <small class="form-text text-muted">Enter a unique component name</small>
                            </div>

                            <!-- Category -->
                            <div class="form-group">
                                <label for="category_id{{ $component->id }}" class="font-weight-bold">
                                    <i class="fas fa-list me-1"></i>Category <span class="text-danger">*</span>
                                </label>
                                <select class="form-control" 
                                        id="category_id{{ $component->id }}" 
                                        name="category_id" 
                                        required>
                                    <option value="" disabled>--Choose Category--</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" 
                                                {{ old('category_id', $component->category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <small class="form-text text-muted">
                                    Current category: 
                                    <span class="badge badge-info">
                                        <i class="fas fa-tag me-1"></i>{{ $component->category->name ?? 'Not assigned' }}
                                    </span>
                                </small>
                            </div>

                           
                        </div>

                        <!-- Right Column - Flavors -->
                        <div class="col-md-6">
                            <!-- Current Flavors Display -->
                            <div class="mb-3">
                                <label class="font-weight-bold">
                                    <i class="fas fa-palette me-1"></i>Currently Assigned Flavors:
                                </label>
                                <div class="current-flavors-display p-2 bg-light rounded">
                                    @if($component->flavours && $component->flavours->count() > 0)
                                        @foreach($component->flavours as $flavor)
                                            <span class="badge badge-info me-1 mb-1">
                                                <i class="fas fa-circle me-1" style="color: {{ $flavor->color ?? '#fff' }}"></i>
                                                {{ $flavor->name }}
                                            </span>
                                        @endforeach
                                        <small class="d-block text-muted mt-1">{{ $component->flavours->count() }} flavor(s) assigned</small>
                                    @else
                                        <small class="text-muted">No flavors currently assigned</small>
                                    @endif
                                </div>
                            </div>

                            <!-- Flavors Selection -->
                            <div class="form-group">
                                <label class="font-weight-bold">
                                    <i class="fas fa-palette me-1"></i>Available Flavors 
                                    <span class="flavor-count-edit" id="flavor-count-edit-{{ $component->id }}">0 selected</span>
                                </label>
                                <div class="flavor-selection-edit" style="max-height: 250px; overflow-y: auto; border: 1px solid #ced4da; border-radius: 0.375rem; padding: 10px; background-color: white;">
                                    <!-- Select All Option -->
                                    <div class="custom-control custom-checkbox" style="font-weight: bold; border-bottom: 1px solid #dee2e6; padding-bottom: 8px; margin-bottom: 10px;">
                                        <input type="checkbox" 
                                               class="custom-control-input" 
                                               id="select_all_flavors_edit_{{ $component->id }}"
                                               onchange="toggleAllFlavorsEdit({{ $component->id }}, this.checked)">
                                        <label class="custom-control-label" for="select_all_flavors_edit_{{ $component->id }}">
                                            <i class="fas fa-check-double me-1"></i>Select All Flavors
                                        </label>
                                    </div>
                                    
                                    <!-- Individual Flavor Checkboxes -->
                                    @foreach($flavors as $flavor)
                                        <div class="custom-control custom-checkbox mb-2">
                                            <input type="checkbox" 
                                                   name="flavor_ids[]" 
                                                   value="{{ $flavor->id }}" 
                                                   class="custom-control-input flavor-checkbox-edit" 
                                                   id="edit_component_{{ $component->id }}_flavor_{{ $flavor->id }}"
                                                   onchange="updateFlavorCountEdit({{ $component->id }})"
                                                   {{ $component->flavours->contains($flavor->id) ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="edit_component_{{ $component->id }}_flavor_{{ $flavor->id }}">
                                                <i class="fas fa-circle me-1" style="color: {{ $flavor->color ?? '#6c757d' }}"></i>
                                                {{ $flavor->name }}
                                                @if($flavor->description)
                                                    <small class="text-muted d-block">{{ Str::limit($flavor->description, 40) }}</small>
                                                @endif
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                                <small class="form-text text-muted">Select flavors that are compatible with this component</small>
                            </div>
                        </div>
                    </div>

                    <!-- Component Info Card -->
                    <div class="card bg-light border-0 mt-3">
                        <div class="card-body py-2">
                            <div class="row text-sm">
                                <div class="col-sm-4">
                                    <strong class="text-muted">Created:</strong>
                                    <span>{{ $component->created_at }}</span>
                                </div>
                                <div class="col-sm-4">
                                    <strong class="text-muted">Last Updated:</strong>
                                    <span>{{ $component->updated_at }}</span>
                                </div>
                                <div class="col-sm-4">
                                    <strong class="text-muted">Total Flavors:</strong>
                                    <span class="badge badge-warning">{{ $component->flavours->count() ?? 0 }}</span>
                                </div>
                            </div>
                            @if($component->category && $component->category->description)
                            <div class="row text-sm mt-2">
                                <div class="col-sm-12">
                                    <strong class="text-muted">Category Description:</strong>
                                    <span>{{ $component->category->description }}</span>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Hidden ID field -->
                    <input type="hidden" name="id" value="{{ $component->id }}">
                </div>
                
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times me-1"></i>Cancel
                    </button>
                    <button type="submit" class="btn btn-info">
                        <i class="fas fa-save me-1"></i>Update Component
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- JavaScript for Flavor Management -->
<script>
function toggleAllFlavorsEdit(componentId, selectAll) {
    const modal = document.querySelector(`#edit${componentId}`);
    const flavorCheckboxes = modal.querySelectorAll('.flavor-checkbox-edit');
    
    flavorCheckboxes.forEach(checkbox => {
        checkbox.checked = selectAll;
    });
    
    updateFlavorCountEdit(componentId);
}

function updateFlavorCountEdit(componentId) {
    const modal = document.querySelector(`#edit${componentId}`);
    const checkedFlavors = modal.querySelectorAll('.flavor-checkbox-edit:checked');
    const countElement = modal.querySelector(`#flavor-count-edit-${componentId}`);
    const selectAllCheckbox = modal.querySelector(`#select_all_flavors_edit_${componentId}`);
    
    const count = checkedFlavors.length;
    countElement.textContent = `${count} selected`;
    
    // Update select all checkbox state
    if (selectAllCheckbox) {
        const allFlavors = modal.querySelectorAll('.flavor-checkbox-edit');
        selectAllCheckbox.checked = count === allFlavors.length;
        selectAllCheckbox.indeterminate = count > 0 && count < allFlavors.length;
    }
}

// Initialize flavor count when modal is opened
document.addEventListener('DOMContentLoaded', function() {
    // Listen for modal show events
    $('[id^="edit"]').on('shown.bs.modal', function() {
        const componentId = this.id.replace('edit', '');
        updateFlavorCountEdit(componentId);
    });
});
</script>
