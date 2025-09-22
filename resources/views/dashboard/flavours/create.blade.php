@extends('dashboard.layouts.master')
@section('css')
<style>
.flavor-form-container {
    border: 1px solid #e9ecef;
    border-radius: 8px;
    padding: 20px;
    margin-bottom: 15px;
    background-color: #f8f9fa;
}

.remove-flavor-btn {
    position: absolute;
    top: 10px;
    right: 10px;
}

.add-flavor-btn {
    background: linear-gradient(45deg, #17a2b8, #138496);
    border: none;
    color: white;
    padding: 12px 24px;
    border-radius: 25px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.add-flavor-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(23,162,184,0.3);
    color: white;
}

.flavor-counter {
    background: #17a2b8;
    color: white;
    border-radius: 50%;
    width: 30px;
    height: 30px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    margin-right: 10px;
}

/* Component selection styles */
.component-selection {
    max-height: 200px;
    overflow-y: auto;
    border: 1px solid #ced4da;
    border-radius: 0.375rem;
    padding: 10px;
    background-color: white;
}

.component-checkbox {
    margin-bottom: 8px;
}

.component-checkbox:last-child {
    margin-bottom: 0;
}

.select-all-components {
    font-weight: bold;
    border-bottom: 1px solid #dee2e6;
    padding-bottom: 8px;
    margin-bottom: 10px;
}

.component-count {
    background: #ffc107;
    color: #212529;
    font-size: 0.75rem;
    padding: 2px 6px;
    border-radius: 10px;
    margin-left: 5px;
}
</style>
@endsection

@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    
</div>
<!-- breadcrumb -->
@endsection

@section('content')
<!-- row -->
<div class="row row-sm">
    <div class="col-lg-10 col-xl-10 col-md-12 col-sm-12">
        <div class="card box-shadow-0">
            <div class="card-header">
                <h4 class="card-title mb-1">Multiple Flavors Form with Components</h4>
                <p class="mb-2">Add multiple flavors with their associated components. Click the + button to add more forms.</p>
            </div>
            <div class="card-body pt-0">
                <form class="form-horizontal" action="{{route('flavours.store')}}" method="POST" id="flavorsForm">
                    @csrf
                    
                    <!-- Container for all flavor forms -->
                    <div id="flavor-forms-container">
                        <!-- Initial flavor form -->
                        <div class="flavor-form-container" data-flavor-index="0">
                            <div class="d-flex align-items-center mb-3">
                                <span class="flavor-counter">1</span>
                                <h5 class="mb-0">Flavor #1</h5>
                                <button type="button" class="btn btn-danger btn-sm remove-flavor-btn" onclick="removeFlavorForm(0)" style="display: none;">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="flavors_0_name">
                                            <i class="fas fa-palette me-1"></i>Flavor Name <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" 
                                               name="flavors[0][name]" 
                                               class="form-control" 
                                               id="flavors_0_name" 
                                               placeholder="Enter flavor name" 
                                               required>
                                        <small class="form-text text-muted">Enter a unique flavor name</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="flavors_0_brand_id">
                                            <i class="fas fa-tags me-1"></i>Brand <span class="text-danger">*</span>
                                        </label>
                                        <select name="flavors[0][brand_id]" 
                                                class="form-control" 
                                                id="flavors_0_brand_id" 
                                                required>
                                            <option value="" disabled selected>--Choose Brand--</option>
                                            @foreach($brands as $brand)
                                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                            @endforeach
                                        </select>
                                        <small class="form-text text-muted">Select the flavor brand</small>
                                    </div>
                                </div>
                            </div>

                            <!-- Components Selection -->
                            <div class="form-group">
                                <label>
                                    <i class="fas fa-cogs me-1"></i>Available Components 
                                    <span class="component-count" id="component-count-0">0 selected</span>
                                </label>
                                <div class="component-selection" id="component-selection-0">
                                    <!-- Select All Option -->
                                    <div class="custom-control custom-checkbox select-all-components">
                                        <input type="checkbox" 
                                               class="custom-control-input select-all-checkbox" 
                                               id="select_all_components_0"
                                               onchange="toggleAllComponents(0, this.checked)">
                                        <label class="custom-control-label" for="select_all_components_0">
                                            <i class="fas fa-check-double me-1"></i>Select All Components
                                        </label>
                                    </div>
                                    
                                    <!-- Individual Component Checkboxes -->
                                    @foreach($components as $component)
                                        <div class="custom-control custom-checkbox component-checkbox">
                                            <input type="checkbox" 
                                                   name="flavors[0][component_ids][]" 
                                                   value="{{ $component->id }}" 
                                                   class="custom-control-input component-checkbox-input" 
                                                   id="flavors_0_component_{{ $component->id }}"
                                                   onchange="updateComponentCount(0)">
                                            <label class="custom-control-label" for="flavors_0_component_{{ $component->id }}">
                                                <i class="fas fa-cog me-1" style="color: {{ $component->color ?? '#6c757d' }}"></i>
                                                {{ $component->name }}
                                                @if($component->description)
                                                    <small class="text-muted d-block">{{ Str::limit($component->description, 40) }}</small>
                                                @endif
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                                <small class="form-text text-muted">Select components that are compatible with this flavor</small>
                            </div>

                            <div class="form-group mb-0">
                                <div class="custom-checkbox custom-control">
                                    <input type="hidden" name="flavors[0][is_active]" value="0">
                                    <input type="checkbox" 
                                           name="flavors[0][is_active]" 
                                           value="1" 
                                           class="custom-control-input" 
                                           id="flavors_0_is_active" 
                                           checked>
                                    <label for="flavors_0_is_active" class="custom-control-label">
                                        <i class="fas fa-toggle-on me-1"></i>Active Status
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Add Flavor Button -->
                    <div class="text-center mb-4">
                        <button type="button" class="btn add-flavor-btn" onclick="addFlavorForm()">
                            <i class="fas fa-plus me-2"></i> Add Another Flavor
                        </button>
                    </div>

                    <!-- Submit Button -->
                    <div class="form-group mb-0 mt-4 justify-content-center text-center">
                        <button type="submit" class="btn btn-info btn-lg px-5">
                            <i class="fas fa-save me-2"></i>
                            Submit All Flavors (<span id="flavor-count">1</span>)
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- main-content closed -->
@endsection

@section('js')
<script>
let flavorIndex = 0;
let flavorCount = 1;

// Get data for dynamic forms
const brands = @json($brands);
const components = @json($components);

function addFlavorForm() {
    flavorIndex++;
    flavorCount++;
    
    const container = document.getElementById('flavor-forms-container');
    
    // Build brand options
    let brandOptions = '<option value="" disabled selected>--Choose Brand--</option>';
    brands.forEach(brand => {
        brandOptions += `<option value="${brand.id}">${brand.name}</option>`;
    });
    
    // Build component checkboxes
    let componentCheckboxes = `
        <div class="custom-control custom-checkbox select-all-components">
            <input type="checkbox" 
                   class="custom-control-input select-all-checkbox" 
                   id="select_all_components_${flavorIndex}"
                   onchange="toggleAllComponents(${flavorIndex}, this.checked)">
            <label class="custom-control-label" for="select_all_components_${flavorIndex}">
                <i class="fas fa-check-double me-1"></i>Select All Components
            </label>
        </div>
    `;
    
    components.forEach(component => {
        componentCheckboxes += `
            <div class="custom-control custom-checkbox component-checkbox">
                <input type="checkbox" 
                       name="flavors[${flavorIndex}][component_ids][]" 
                       value="${component.id}" 
                       class="custom-control-input component-checkbox-input" 
                       id="flavors_${flavorIndex}_component_${component.id}"
                       onchange="updateComponentCount(${flavorIndex})">
                <label class="custom-control-label" for="flavors_${flavorIndex}_component_${component.id}">
                    <i class="fas fa-cog me-1" style="color: ${component.color || '#6c757d'}"></i>
                    ${component.name}
                    ${component.description ? `<small class="text-muted d-block">${component.description.substring(0, 40)}${component.description.length > 40 ? '...' : ''}</small>` : ''}
                </label>
            </div>
        `;
    });
    
    const newFlavorForm = `
        <div class="flavor-form-container animate__animated animate__fadeInUp" data-flavor-index="${flavorIndex}">
            <div class="d-flex align-items-center mb-3">
                <span class="flavor-counter">${flavorCount}</span>
                <h5 class="mb-0">Flavor #${flavorCount}</h5>
                <button type="button" class="btn btn-danger btn-sm remove-flavor-btn" onclick="removeFlavorForm(${flavorIndex})">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="flavors_${flavorIndex}_name">
                            <i class="fas fa-palette me-1"></i>Flavor Name <span class="text-danger">*</span>
                        </label>
                        <input type="text" 
                               name="flavors[${flavorIndex}][name]" 
                               class="form-control" 
                               id="flavors_${flavorIndex}_name" 
                               placeholder="Enter flavor name" 
                               required>
                        <small class="form-text text-muted">Enter a unique flavor name</small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="flavors_${flavorIndex}_brand_id">
                            <i class="fas fa-tags me-1"></i>Brand <span class="text-danger">*</span>
                        </label>
                        <select name="flavors[${flavorIndex}][brand_id]" 
                                class="form-control" 
                                id="flavors_${flavorIndex}_brand_id" 
                                required>
                            ${brandOptions}
                        </select>
                        <small class="form-text text-muted">Select the flavor brand</small>
                    </div>
                </div>
            </div>

            <!-- Components Selection -->
            <div class="form-group">
                <label>
                    <i class="fas fa-cogs me-1"></i>Available Components 
                    <span class="component-count" id="component-count-${flavorIndex}">0 selected</span>
                </label>
                <div class="component-selection" id="component-selection-${flavorIndex}">
                    ${componentCheckboxes}
                </div>
                <small class="form-text text-muted">Select components that are compatible with this flavor</small>
            </div>

            <div class="form-group mb-0">
                <div class="custom-checkbox custom-control">
                    <input type="hidden" name="flavors[${flavorIndex}][is_active]" value="0">
                    <input type="checkbox" 
                           name="flavors[${flavorIndex}][is_active]" 
                           value="1" 
                           class="custom-control-input" 
                           id="flavors_${flavorIndex}_is_active" 
                           checked>
                    <label for="flavors_${flavorIndex}_is_active" class="custom-control-label">
                        <i class="fas fa-toggle-on me-1"></i>Active Status
                    </label>
                </div>
            </div>
        </div>
    `;
    
    container.insertAdjacentHTML('beforeend', newFlavorForm);
    updateFlavorCount();
    showRemoveButtons();
    
    // Scroll to the new form
    const newForm = container.lastElementChild;
    newForm.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
}

function removeFlavorForm(index) {
    const formToRemove = document.querySelector(`[data-flavor-index="${index}"]`);
    if (formToRemove) {
        formToRemove.style.animation = 'fadeOutUp 0.3s ease-out';
        setTimeout(() => {
            formToRemove.remove();
            flavorCount--;
            updateFlavorCount();
            updateFlavorNumbers();
            hideRemoveButtonsIfNeeded();
        }, 300);
    }
}

function toggleAllComponents(flavorIndex, selectAll) {
    const componentContainer = document.querySelector(`#component-selection-${flavorIndex}`);
    const componentCheckboxes = componentContainer.querySelectorAll('.component-checkbox-input');
    
    componentCheckboxes.forEach(checkbox => {
        checkbox.checked = selectAll;
    });
    
    updateComponentCount(flavorIndex);
}

function updateComponentCount(flavorIndex) {
    const componentContainer = document.querySelector(`#component-selection-${flavorIndex}`);
    const checkedComponents = componentContainer.querySelectorAll('.component-checkbox-input:checked');
    const countElement = document.querySelector(`#component-count-${flavorIndex}`);
    const selectAllCheckbox = document.querySelector(`#select_all_components_${flavorIndex}`);
    
    const count = checkedComponents.length;
    countElement.textContent = `${count} selected`;
    
    // Update select all checkbox state
    if (selectAllCheckbox) {
        const allComponents = componentContainer.querySelectorAll('.component-checkbox-input');
        selectAllCheckbox.checked = count === allComponents.length;
        selectAllCheckbox.indeterminate = count > 0 && count < allComponents.length;
    }
}

function updateFlavorCount() {
    document.getElementById('flavor-count').textContent = flavorCount;
}

function updateFlavorNumbers() {
    const flavorForms = document.querySelectorAll('.flavor-form-container');
    flavorForms.forEach((form, index) => {
        const counter = form.querySelector('.flavor-counter');
        const title = form.querySelector('h5');
        counter.textContent = index + 1;
        title.textContent = `Flavor #${index + 1}`;
    });
}

function showRemoveButtons() {
    const removeButtons = document.querySelectorAll('.remove-flavor-btn');
    if (removeButtons.length > 1) {
        removeButtons.forEach(btn => btn.style.display = 'block');
    }
}

function hideRemoveButtonsIfNeeded() {
    const removeButtons = document.querySelectorAll('.remove-flavor-btn');
    if (removeButtons.length <= 1) {
        removeButtons.forEach(btn => btn.style.display = 'none');
    }
}

// Form validation before submit
document.getElementById('flavorsForm').addEventListener('submit', function(e) {
    const flavorForms = document.querySelectorAll('.flavor-form-container');
    let hasErrors = false;
    
    flavorForms.forEach(form => {
        const nameInput = form.querySelector('input[name*="[name]"]');
        const brandSelect = form.querySelector('select[name*="[brand_id]"]');
        
        // Validate name
        if (!nameInput.value.trim()) {
            hasErrors = true;
            nameInput.classList.add('is-invalid');
        } else {
            nameInput.classList.remove('is-invalid');
        }
        
        // Validate brand
        if (!brandSelect.value) {
            hasErrors = true;
            brandSelect.classList.add('is-invalid');
        } else {
            brandSelect.classList.remove('is-invalid');
        }
    });
    
    if (hasErrors) {
        e.preventDefault();
        alert('Please fill in all required fields (Flavor Name and Brand) before submitting.');
        return false;
    }
});

// Initialize component counts for existing forms
document.addEventListener('DOMContentLoaded', function() {
    updateComponentCount(0);
});
</script>

@endsection