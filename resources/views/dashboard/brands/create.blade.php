@extends('dashboard.layouts.master')
@section('css')
<style>
.brand-form-container {
    border: 1px solid #e9ecef;
    border-radius: 8px;
    padding: 20px;
    margin-bottom: 15px;
    background-color: #f8f9fa;
}

.remove-brand-btn {
    position: absolute;
    top: 10px;
    right: 10px;
}

.add-brand-btn {
    background: linear-gradient(45deg, #007bff, #0056b3);
    border: none;
    color: white;
    padding: 12px 24px;
    border-radius: 25px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.add-brand-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,123,255,0.3);
    color: white;
}

.brand-counter {
    background: #007bff;
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
                <h4 class="card-title mb-1">Multiple Brands Form</h4>
                <p class="mb-2">Add multiple brands at once. Click the + button to add more forms.</p>
            </div>
            <div class="card-body pt-0">
                <form class="form-horizontal" action="{{route('brands.store')}}" method="POST" id="brandsForm">
                    @csrf
                    
                    <!-- Container for all brand forms -->
                    <div id="brand-forms-container">
                        <!-- Initial brand form -->
                        <div class="brand-form-container" data-brand-index="0">
                            <div class="d-flex align-items-center mb-3">
                                <span class="brand-counter">1</span>
                                <h5 class="mb-0">Brand #1</h5>
                                <button type="button" class="btn btn-danger btn-sm remove-brand-btn" onclick="removeBrandForm(0)" style="display: none;">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="brands_0_name">Brand Name</label>
                                        <input type="text" name="brands[0][name]" class="form-control" id="brands_0_name" placeholder="Enter brand name" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="brands_0_country">Country</label>
                                        <input type="text" name="brands[0][country]" class="form-control" id="brands_0_country" placeholder="Enter country">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="brands_0_description">Description</label>
                                <textarea name="brands[0][description]" class="form-control" id="brands_0_description" placeholder="Enter description" rows="3"></textarea>
                            </div>

                            <div class="form-group mb-0">
                                <div class="custom-checkbox custom-control">
                                    <input type="hidden" name="brands[0][is_active]" value="0">
                                    <input type="checkbox" name="brands[0][is_active]" value="1" class="custom-control-input" id="brands_0_is_active" checked>
                                    <label for="brands_0_is_active" class="custom-control-label">Active Status</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Add Brand Button -->
                    <div class="text-center mb-4">
                        <button type="button" class="btn add-brand-btn" onclick="addBrandForm()">
                            <i class="fas fa-plus me-2"></i> Add Another Brand
                        </button>
                    </div>

                    <!-- Submit Button -->
                    <div class="form-group mb-0 mt-4 justify-content-center text-center">
                        <button type="submit" class="btn btn-success btn-lg px-5">
                            <i class="fas fa-save me-2"></i>
                            Submit All Brands (<span id="brand-count">1</span>)
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
let brandIndex = 0;
let brandCount = 1;

function addBrandForm() {
    brandIndex++;
    brandCount++;
    
    const container = document.getElementById('brand-forms-container');
    
    const newBrandForm = `
        <div class="brand-form-container animate__animated animate__fadeInUp" data-brand-index="${brandIndex}">
            <div class="d-flex align-items-center mb-3">
                <span class="brand-counter">${brandCount}</span>
                <h5 class="mb-0">Brand #${brandCount}</h5>
                <button type="button" class="btn btn-danger btn-sm remove-brand-btn" onclick="removeBrandForm(${brandIndex})">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="brands_${brandIndex}_name">Brand Name</label>
                        <input type="text" name="brands[${brandIndex}][name]" class="form-control" id="brands_${brandIndex}_name" placeholder="Enter brand name" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="brands_${brandIndex}_country">Country</label>
                        <input type="text" name="brands[${brandIndex}][country]" class="form-control" id="brands_${brandIndex}_country" placeholder="Enter country">
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label for="brands_${brandIndex}_description">Description</label>
                <textarea name="brands[${brandIndex}][description]" class="form-control" id="brands_${brandIndex}_description" placeholder="Enter description" rows="3"></textarea>
            </div>

            <div class="form-group mb-0">
                <div class="custom-checkbox custom-control">
                    <input type="hidden" name="brands[${brandIndex}][is_active]" value="0">
                    <input type="checkbox" name="brands[${brandIndex}][is_active]" value="1" class="custom-control-input" id="brands_${brandIndex}_is_active" checked>
                    <label for="brands_${brandIndex}_is_active" class="custom-control-label">Active Status</label>
                </div>
            </div>
        </div>
    `;
    
    container.insertAdjacentHTML('beforeend', newBrandForm);
    updateBrandCount();
    showRemoveButtons();
    
    // Scroll to the new form
    const newForm = container.lastElementChild;
    newForm.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
}

function removeBrandForm(index) {
    const formToRemove = document.querySelector(`[data-brand-index="${index}"]`);
    if (formToRemove) {
        formToRemove.style.animation = 'fadeOutUp 0.3s ease-out';
        setTimeout(() => {
            formToRemove.remove();
            brandCount--;
            updateBrandCount();
            updateBrandNumbers();
            hideRemoveButtonsIfNeeded();
        }, 300);
    }
}

function updateBrandCount() {
    document.getElementById('brand-count').textContent = brandCount;
}

function updateBrandNumbers() {
    const brandForms = document.querySelectorAll('.brand-form-container');
    brandForms.forEach((form, index) => {
        const counter = form.querySelector('.brand-counter');
        const title = form.querySelector('h5');
        counter.textContent = index + 1;
        title.textContent = `Brand #${index + 1}`;
    });
}

function showRemoveButtons() {
    const removeButtons = document.querySelectorAll('.remove-brand-btn');
    if (removeButtons.length > 1) {
        removeButtons.forEach(btn => btn.style.display = 'block');
    }
}

function hideRemoveButtonsIfNeeded() {
    const removeButtons = document.querySelectorAll('.remove-brand-btn');
    if (removeButtons.length <= 1) {
        removeButtons.forEach(btn => btn.style.display = 'none');
    }
}

// Form validation before submit
document.getElementById('brandsForm').addEventListener('submit', function(e) {
    const brandForms = document.querySelectorAll('.brand-form-container');
    let hasEmptyNames = false;
    
    brandForms.forEach(form => {
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
        alert('Please fill in all brand names before submitting.');
        return false;
    }
});
</script>

@endsection