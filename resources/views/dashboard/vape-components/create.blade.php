@extends('dashboard.layouts.master')
@section('css')
<style>
.component-form-container {
    border: 1px solid #e9ecef;
    border-radius: 8px;
    padding: 20px;
    margin-bottom: 15px;
    background-color: #f8f9fa;
}

.remove-component-btn {
    position: absolute;
    top: 10px;
    right: 10px;
}

.add-component-btn {
    background: linear-gradient(45deg, #17a2b8, #138496);
    border: none;
    color: white;
    padding: 12px 24px;
    border-radius: 25px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.add-component-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(23,162,184,0.3);
    color: white;
}

.component-counter {
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

/* Flavor selection styles */
.flavor-selection {
    max-height: 200px;
    overflow-y: auto;
    border: 1px solid #ced4da;
    border-radius: 0.375rem;
    padding: 10px;
    background-color: white;
}

.flavor-checkbox {
    margin-bottom: 8px;
}

.flavor-checkbox:last-child {
    margin-bottom: 0;
}

.select-all-flavors {
    font-weight: bold;
    border-bottom: 1px solid #dee2e6;
    padding-bottom: 8px;
    margin-bottom: 10px;
}

.flavor-count {
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
                <h4 class="card-title mb-1">Multiple Components Form with Flavors</h4>
                <p class="mb-2">Add multiple components with their associated flavors. Click the + button to add more forms.</p>
            </div>
            <div class="card-body pt-0">
                <form class="form-horizontal" action="{{route('components.store')}}" method="POST" id="componentsForm">
                    @csrf
                    
                    <!-- Container for all component forms -->
                    <div id="component-forms-container">
                        <!-- Initial component form -->
                        <div class="component-form-container" data-component-index="0">
                            <div class="d-flex align-items-center mb-3">
                                <span class="component-counter">1</span>
                                <h5 class="mb-0">Component #1</h5>
                                <button type="button" class="btn btn-danger btn-sm remove-component-btn" onclick="removeComponentForm(0)" style="display: none;">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="components_0_name">
                                            <i class="fas fa-cogs me-1"></i>Component Name <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" 
                                               name="components[0][name]" 
                                               class="form-control" 
                                               id="components_0_name" 
                                               placeholder="Enter component name" 
                                               required>
                                        <small class="form-text text-muted">Enter a unique component name</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="components_0_category_id">
                                            <i class="fas fa-list me-1"></i>Category <span class="text-danger">*</span>
                                        </label>
                                        <select name="components[0][category_id]" 
                                                class="form-control" 
                                                id="components_0_category_id" 
                                                required>
                                            <option value="" disabled selected>--Choose Category--</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        <small class="form-text text-muted">Select the component category</small>
                                    </div>
                                </div>
                            </div>

                            <!-- Flavors Selection -->
                            <div class="form-group">
                                <label>
                                    <i class="fas fa-palette me-1"></i>Available Flavors 
                                    <span class="flavor-count" id="flavor-count-0">0 selected</span>
                                </label>
                                <div class="flavor-selection" id="flavor-selection-0">
                                    <!-- Select All Option -->
                                    <div class="custom-control custom-checkbox select-all-flavors">
                                        <input type="checkbox" 
                                               class="custom-control-input select-all-checkbox" 
                                               id="select_all_flavors_0"
                                               onchange="toggleAllFlavors(0, this.checked)">
                                        <label class="custom-control-label" for="select_all_flavors_0">
                                            <i class="fas fa-check-double me-1"></i>Select All Flavors
                                        </label>
                                    </div>
                                    
                                    <!-- Individual Flavor Checkboxes -->
                                    @foreach($flavors as $flavor)
                                        <div class="custom-control custom-checkbox flavor-checkbox">
                                            <input type="checkbox" 
                                                   name="components[0][flavor_ids][]" 
                                                   value="{{ $flavor->id }}" 
                                                   class="custom-control-input flavor-checkbox-input" 
                                                   id="components_0_flavor_{{ $flavor->id }}"
                                                   onchange="updateFlavorCount(0)">
                                            <label class="custom-control-label" for="components_0_flavor_{{ $flavor->id }}">
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

                    <!-- Add Component Button -->
                    <div class="text-center mb-4">
                        <button type="button" class="btn add-component-btn" onclick="addComponentForm()">
                            <i class="fas fa-plus me-2"></i> Add Another Component
                        </button>
                    </div>

                    <!-- Submit Button -->
                    <div class="form-group mb-0 mt-4 justify-content-center text-center">
                        <button type="submit" class="btn btn-info btn-lg px-5">
                            <i class="fas fa-save me-2"></i>
                            Submit All Components (<span id="component-count">1</span>)
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
let componentIndex = 0;
let componentCount = 1;

// Get data for dynamic forms
const categories = @json($categories);
const flavors = @json($flavors);

function addComponentForm() {
    componentIndex++;
    componentCount++;
    
    const container = document.getElementById('component-forms-container');
    
    // Build category options
    let categoryOptions = '<option value="" disabled selected>--Choose Category--</option>';
    categories.forEach(category => {
        categoryOptions += `<option value="${category.id}">${category.name}</option>`;
    });
    
    // Build flavor checkboxes
    let flavorCheckboxes = `
        <div class="custom-control custom-checkbox select-all-flavors">
            <input type="checkbox" 
                   class="custom-control-input select-all-checkbox" 
                   id="select_all_flavors_${componentIndex}"
                   onchange="toggleAllFlavors(${componentIndex}, this.checked)">
            <label class="custom-control-label" for="select_all_flavors_${componentIndex}">
                <i class="fas fa-check-double me-1"></i>Select All Flavors
            </label>
        </div>
    `;
    
    flavors.forEach(flavor => {
        flavorCheckboxes += `
            <div class="custom-control custom-checkbox flavor-checkbox">
                <input type="checkbox" 
                       name="components[${componentIndex}][flavor_ids][]" 
                       value="${flavor.id}" 
                       class="custom-control-input flavor-checkbox-input" 
                       id="components_${componentIndex}_flavor_${flavor.id}"
                       onchange="updateFlavorCount(${componentIndex})">
                <label class="custom-control-label" for="components_${componentIndex}_flavor_${flavor.id}">
                    <i class="fas fa-circle me-1" style="color: ${flavor.color || '#6c757d'}"></i>
                    ${flavor.name}
                    ${flavor.description ? `<small class="text-muted d-block">${flavor.description.substring(0, 40)}${flavor.description.length > 40 ? '...' : ''}</small>` : ''}
                </label>
            </div>
        `;
    });
    
    const newComponentForm = `
        <div class="component-form-container animate__animated animate__fadeInUp" data-component-index="${componentIndex}">
            <div class="d-flex align-items-center mb-3">
                <span class="component-counter">${componentCount}</span>
                <h5 class="mb-0">Component #${componentCount}</h5>
                <button type="button" class="btn btn-danger btn-sm remove-component-btn" onclick="removeComponentForm(${componentIndex})">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="components_${componentIndex}_name">
                            <i class="fas fa-cogs me-1"></i>Component Name <span class="text-danger">*</span>
                        </label>
                        <input type="text" 
                               name="components[${componentIndex}][name]" 
                               class="form-control" 
                               id="components_${componentIndex}_name" 
                               placeholder="Enter component name" 
                               required>
                        <small class="form-text text-muted">Enter a unique component name</small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="components_${componentIndex}_category_id">
                            <i class="fas fa-list me-1"></i>Category <span class="text-danger">*</span>
                        </label>
                        <select name="components[${componentIndex}][category_id]" 
                                class="form-control" 
                                id="components_${componentIndex}_category_id" 
                                required>
                            ${categoryOptions}
                        </select>
                        <small class="form-text text-muted">Select the component category</small>
                    </div>
                </div>
            </div>

            <!-- Flavors Selection -->
            <div class="form-group">
                <label>
                    <i class="fas fa-palette me-1"></i>Available Flavors 
                    <span class="flavor-count" id="flavor-count-${componentIndex}">0 selected</span>
                </label>
                <div class="flavor-selection" id="flavor-selection-${componentIndex}">
                    ${flavorCheckboxes}
                </div>
                <small class="form-text text-muted">Select flavors that are compatible with this component</small>
            </div>

            <div class="form-group mb-0">
                <div class="custom-checkbox custom-control">
                    <input type="hidden" name="components[${componentIndex}][is_active]" value="0">
                    <input type="checkbox" 
                           name="components[${componentIndex}][is_active]" 
                           value="1" 
                           class="custom-control-input" 
                           id="components_${componentIndex}_is_active" 
                           checked>
                    <label for="components_${componentIndex}_is_active" class="custom-control-label">
                        <i class="fas fa-toggle-on me-1"></i>Active Status
                    </label>
                </div>
            </div>
        </div>
    `;
    
    container.insertAdjacentHTML('beforeend', newComponentForm);
    updateComponentCount();
    showRemoveButtons();
    
    // Scroll to the new form
    const newForm = container.lastElementChild;
    newForm.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
}

function removeComponentForm(index) {
    const formToRemove = document.querySelector(`[data-component-index="${index}"]`);
    if (formToRemove) {
        formToRemove.style.animation = 'fadeOutUp 0.3s ease-out';
        setTimeout(() => {
            formToRemove.remove();
            componentCount--;
            updateComponentCount();
            updateComponentNumbers();
            hideRemoveButtonsIfNeeded();
        }, 300);
    }
}

function toggleAllFlavors(componentIndex, selectAll) {
    const flavorContainer = document.querySelector(`#flavor-selection-${componentIndex}`);
    const flavorCheckboxes = flavorContainer.querySelectorAll('.flavor-checkbox-input');
    
    flavorCheckboxes.forEach(checkbox => {
        checkbox.checked = selectAll;
    });
    
    updateFlavorCount(componentIndex);
}

function updateFlavorCount(componentIndex) {
    const flavorContainer = document.querySelector(`#flavor-selection-${componentIndex}`);
    const checkedFlavors = flavorContainer.querySelectorAll('.flavor-checkbox-input:checked');
    const countElement = document.querySelector(`#flavor-count-${componentIndex}`);
    const selectAllCheckbox = document.querySelector(`#select_all_flavors_${componentIndex}`);
    
    const count = checkedFlavors.length;
    countElement.textContent = `${count} selected`;
    
    // Update select all checkbox state
    if (selectAllCheckbox) {
        const allFlavors = flavorContainer.querySelectorAll('.flavor-checkbox-input');
        selectAllCheckbox.checked = count === allFlavors.length;
        selectAllCheckbox.indeterminate = count > 0 && count < allFlavors.length;
    }
}

function updateComponentCount() {
    document.getElementById('component-count').textContent = componentCount;
}

function updateComponentNumbers() {
    const componentForms = document.querySelectorAll('.component-form-container');
    componentForms.forEach((form, index) => {
        const counter = form.querySelector('.component-counter');
        const title = form.querySelector('h5');
        counter.textContent = index + 1;
        title.textContent = `Component #${index + 1}`;
    });
}

function showRemoveButtons() {
    const removeButtons = document.querySelectorAll('.remove-component-btn');
    if (removeButtons.length > 1) {
        removeButtons.forEach(btn => btn.style.display = 'block');
    }
}

function hideRemoveButtonsIfNeeded() {
    const removeButtons = document.querySelectorAll('.remove-component-btn');
    if (removeButtons.length <= 1) {
        removeButtons.forEach(btn => btn.style.display = 'none');
    }
}


// Form validation before submit
document.getElementById('componentsForm').addEventListener('submit', function(e) {
    const componentForms = document.querySelectorAll('.component-form-container');
    let hasErrors = false;
    
    componentForms.forEach(form => {
        const nameInput = form.querySelector('input[name*="[name]"]');
        const categorySelect = form.querySelector('select[name*="[category_id]"]');
        
        // Validate name
        if (!nameInput.value.trim()) {
            hasErrors = true;
            nameInput.classList.add('is-invalid');
        } else {
            nameInput.classList.remove('is-invalid');
        }
        
        // Validate category
        if (!categorySelect.value) {
            hasErrors = true;
            categorySelect.classList.add('is-invalid');
        } else {
            categorySelect.classList.remove('is-invalid');
        }
    });
    
    if (hasErrors) {
        e.preventDefault();
        alert('Please fill in all required fields (Component Name and Category) before submitting.');
        return false;
    }
});

// Initialize flavor counts for existing forms
document.addEventListener('DOMContentLoaded', function() {
    updateFlavorCount(0);
});
</script>

@endsection