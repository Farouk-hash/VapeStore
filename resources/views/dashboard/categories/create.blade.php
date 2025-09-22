@extends('dashboard.layouts.master')
@section('css')
<style>
.category-form-container {
    border: 1px solid #e9ecef;
    border-radius: 8px;
    padding: 20px;
    margin-bottom: 15px;
    background-color: #f8f9fa;
}

.remove-category-btn {
    position: absolute;
    top: 10px;
    right: 10px;
}

.add-category-btn {
    background: linear-gradient(45deg, #28a745, #20c997);
    border: none;
    color: white;
    padding: 12px 24px;
    border-radius: 25px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.add-category-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(40,167,69,0.3);
    color: white;
}

.category-counter {
    background: #28a745;
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
    <div class="col-lg-8 col-xl-8 col-md-12 col-sm-12">
        <div class="card box-shadow-0">
            <div class="card-header">
                <h4 class="card-title mb-1">Multiple Categories Form</h4>
                <p class="mb-2">Add multiple categories at once. Click the + button to add more forms.</p>
            </div>
            <div class="card-body pt-0">
                <form class="form-horizontal" action="{{route('categories.store')}}" method="POST" id="categoriesForm">
                    @csrf
                    
                    <!-- Container for all category forms -->
                    <div id="category-forms-container">
                        <!-- Initial category form -->
                        <div class="category-form-container" data-category-index="0">
                            <div class="d-flex align-items-center mb-3">
                                <span class="category-counter">1</span>
                                <h5 class="mb-0">Category #1</h5>
                                <button type="button" class="btn btn-danger btn-sm remove-category-btn" onclick="removeCategoryForm(0)" style="display: none;">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            
                            <div class="form-group">
                                <label for="categories_0_name">
                                    <i class="fas fa-tag me-1"></i>Category Name <span class="text-danger">*</span>
                                </label>
                                <input type="text" 
                                       name="categories[0][name]" 
                                       class="form-control" 
                                       id="categories_0_name" 
                                       placeholder="Enter category name" 
                                       required>
                                <small class="form-text text-muted">Enter a unique category name</small>
                            </div>
                            
                            <div class="form-group">
                                <label for="categories_0_description">
                                    <i class="fas fa-align-left me-1"></i>Description
                                </label>
                                <textarea name="categories[0][description]" 
                                          class="form-control" 
                                          id="categories_0_description" 
                                          placeholder="Enter category description (optional)" 
                                          rows="3"></textarea>
                                <small class="form-text text-muted">Brief description of the category</small>
                            </div>

                            <div class="form-group mb-0">
                                <div class="custom-checkbox custom-control">
                                    <input type="hidden" name="categories[0][is_active]" value="0">
                                    <input type="checkbox" 
                                           name="categories[0][is_active]" 
                                           value="1" 
                                           class="custom-control-input" 
                                           id="categories_0_is_active" 
                                           checked>
                                    <label for="categories_0_is_active" class="custom-control-label">
                                        <i class="fas fa-toggle-on me-1"></i>Active Status
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Add Category Button -->
                    <div class="text-center mb-4">
                        <button type="button" class="btn add-category-btn" onclick="addCategoryForm()">
                            <i class="fas fa-plus me-2"></i> Add Another Category
                        </button>
                    </div>

                    <!-- Submit Button -->
                    <div class="form-group mb-0 mt-4 justify-content-center text-center">
                        <button type="submit" class="btn btn-success btn-lg px-5">
                            <i class="fas fa-save me-2"></i>
                            Submit All Categories (<span id="category-count">1</span>)
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
let categoryIndex = 0;
let categoryCount = 1;

function addCategoryForm() {
    categoryIndex++;
    categoryCount++;
    
    const container = document.getElementById('category-forms-container');
    
    const newCategoryForm = `
        <div class="category-form-container animate__animated animate__fadeInUp" data-category-index="${categoryIndex}">
            <div class="d-flex align-items-center mb-3">
                <span class="category-counter">${categoryCount}</span>
                <h5 class="mb-0">Category #${categoryCount}</h5>
                <button type="button" class="btn btn-danger btn-sm remove-category-btn" onclick="removeCategoryForm(${categoryIndex})">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <div class="form-group">
                <label for="categories_${categoryIndex}_name">
                    <i class="fas fa-tag me-1"></i>Category Name <span class="text-danger">*</span>
                </label>
                <input type="text" 
                       name="categories[${categoryIndex}][name]" 
                       class="form-control" 
                       id="categories_${categoryIndex}_name" 
                       placeholder="Enter category name" 
                       required>
                <small class="form-text text-muted">Enter a unique category name</small>
            </div>
            
            <div class="form-group">
                <label for="categories_${categoryIndex}_description">
                    <i class="fas fa-align-left me-1"></i>Description
                </label>
                <textarea name="categories[${categoryIndex}][description]" 
                          class="form-control" 
                          id="categories_${categoryIndex}_description" 
                          placeholder="Enter category description (optional)" 
                          rows="3"></textarea>
                <small class="form-text text-muted">Brief description of the category</small>
            </div>

            <div class="form-group mb-0">
                <div class="custom-checkbox custom-control">
                    <input type="hidden" name="categories[${categoryIndex}][is_active]" value="0">
                    <input type="checkbox" 
                           name="categories[${categoryIndex}][is_active]" 
                           value="1" 
                           class="custom-control-input" 
                           id="categories_${categoryIndex}_is_active" 
                           checked>
                    <label for="categories_${categoryIndex}_is_active" class="custom-control-label">
                        <i class="fas fa-toggle-on me-1"></i>Active Status
                    </label>
                </div>
            </div>
        </div>
    `;
    
    container.insertAdjacentHTML('beforeend', newCategoryForm);
    updateCategoryCount();
    showRemoveButtons();
    
    // Scroll to the new form
    const newForm = container.lastElementChild;
    newForm.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
}

function removeCategoryForm(index) {
    const formToRemove = document.querySelector(`[data-category-index="${index}"]`);
    if (formToRemove) {
        formToRemove.style.animation = 'fadeOutUp 0.3s ease-out';
        setTimeout(() => {
            formToRemove.remove();
            categoryCount--;
            updateCategoryCount();
            updateCategoryNumbers();
            hideRemoveButtonsIfNeeded();
        }, 300);
    }
}

function updateCategoryCount() {
    document.getElementById('category-count').textContent = categoryCount;
}

function updateCategoryNumbers() {
    const categoryForms = document.querySelectorAll('.category-form-container');
    categoryForms.forEach((form, index) => {
        const counter = form.querySelector('.category-counter');
        const title = form.querySelector('h5');
        counter.textContent = index + 1;
        title.textContent = `Category #${index + 1}`;
    });
}

function showRemoveButtons() {
    const removeButtons = document.querySelectorAll('.remove-category-btn');
    if (removeButtons.length > 1) {
        removeButtons.forEach(btn => btn.style.display = 'block');
    }
}

function hideRemoveButtonsIfNeeded() {
    const removeButtons = document.querySelectorAll('.remove-category-btn');
    if (removeButtons.length <= 1) {
        removeButtons.forEach(btn => btn.style.display = 'none');
    }
}

// Form validation before submit
document.getElementById('categoriesForm').addEventListener('submit', function(e) {
    const categoryForms = document.querySelectorAll('.category-form-container');
    let hasEmptyNames = false;
    
    categoryForms.forEach(form => {
        const nameInput = form.querySelector('input[name*="[name]"]');
        if (!nameInput.value.trim()) {
            hasEmptyNames = true;
            nameInput.classList.add('is-invalid');
        } else {
            nameInput.classList.remove('is-invalid');
        }
    });
    
    if (hasEmptyNames) {
        e.preventDefault();
        alert('Please fill in all category names before submitting.');
        return false;
    }
});
</script>

@endsection