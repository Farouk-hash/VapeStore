@extends('dashboard.layouts.master')
@section('css')
<style>
.liquid-form-container {
    border: 1px solid #e9ecef;
    border-radius: 8px;
    padding: 20px;
    margin-bottom: 15px;
    background-color: #f8f9fa;
    position: relative;
}

.remove-liquid-btn {
    position: absolute;
    top: 10px;
    right: 10px;
}

.add-liquid-btn {
    background: linear-gradient(45deg, #007bff, #00c6ff);
    border: none;
    color: white;
    padding: 12px 24px;
    border-radius: 25px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.add-liquid-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,123,255,0.3);
    color: white;
}

.liquid-counter {
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

@section('content')
<div class="row row-sm">
    <div class="col-lg-10 col-xl-10 col-md-12 col-sm-12">
        <div class="card box-shadow-0">
            <div class="card-header">
                <h4 class="card-title mb-1">Liquids Form</h4>
                <p class="mb-2">Add one or more liquids. Each liquid can have multiple nicotine strengths.</p>
            </div>
            <div class="card-body pt-0">
                <form action="{{ route('liquid.store') }}" method="POST" id="liquidsForm">
                    @csrf

                    <!-- Container for all liquid forms -->
                    <div id="liquid-forms-container">
                        <!-- Initial Liquid form -->
                        <div class="liquid-form-container" data-liquid-index="0">
                            <div class="d-flex align-items-center mb-3">
                                <span class="liquid-counter">1</span>
                                <h5 class="mb-0">Liquid #1</h5>
                                <button type="button" class="btn btn-danger btn-sm remove-liquid-btn" onclick="removeLiquidForm(0)" style="display:none;">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="liquids_0_nicotine_type">Nicotine Type</label>
                                        <select name="liquids[0][nicotine_type]" id="liquids_0_nicotine_type" class="form-control">
                                            <option value="salt">Salt</option>
                                            <option value="freebase">Freebase</option>
                                            <option value="freebase">DL</option>

                                        </select>
                                    </div>
                                </div>
                               

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="liquids_0_vape_style">Vape Style</label>
                                        <select name="liquids[0][vape_style]" id="liquids_0_vape_style" class="form-control">
                                            <option value="DL">DL (Direct Lung)</option>
                                            <option value="MTL">MTL (Mouth to Lung)</option>
                                            <option value="MTL">SaltNic</option>

                                        </select>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="liquids_0_vg_pg_ratio">VG/PG Ratio</label>
                                        <input type="text" name="liquids[0][vg_pg_ratio]" class="form-control" id="liquids_0_vg_pg_ratio">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="liquids_0_bottle_size_ml">Bottle Size (ml)</label>
                                        <input type="number" name="liquids[0][bottle_size_ml]" class="form-control" id="liquids_0_bottle_size_ml">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="liquids_0_flavour_id">Flavour</label>
                                        <select name="liquids[0][flavour_id]" id="liquids_0_flavour_id" class="form-control">
                                            @foreach($flavours as $flavour)
                                                <option value="{{ $flavour->id }}">{{ $flavour->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Nicotine Strengths -->
                            <div class="form-group">
                                <label>Nicotine Strengths</label>
                                <div class="nic-strengths-container" id="nic-strengths-0">
                                    <input type="number" min="0" step="0.1" name="liquids[0][nicotine_strengths][]" class="form-control mb-2" placeholder="Enter strength (e.g. 3mg)">
                                </div>
                                <button type="button" class="btn btn-sm btn-primary" onclick="addNicStrength(0)">
                                    <i class="fas fa-plus"></i> Add Strength
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Add Another Liquid -->
                    <div class="text-center mb-4">
                        <button type="button" class="btn add-liquid-btn" onclick="addLiquidForm()">
                            <i class="fas fa-plus me-2"></i> Add Another Liquid
                        </button>
                    </div>

                    <!-- Submit -->
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-success btn-lg px-5">
                            <i class="fas fa-save me-2"></i>
                            Submit All Liquids (<span id="liquid-count">1</span>)
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
let liquidIndex = 0;
let liquidCount = 1;

function addLiquidForm() {
    liquidIndex++;
    liquidCount++;

    const container = document.getElementById('liquid-forms-container');

    const newLiquidForm = `
        <div class="liquid-form-container animate__animated animate__fadeInUp" data-liquid-index="${liquidIndex}">
            <div class="d-flex align-items-center mb-3">
                <span class="liquid-counter">${liquidCount}</span>
                <h5 class="mb-0">Liquid #${liquidCount}</h5>
                <button type="button" class="btn btn-danger btn-sm remove-liquid-btn" onclick="removeLiquidForm(${liquidIndex})">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="liquids_${liquidIndex}_nicotine_type">Nicotine Type</label>
                        <select name="liquids[${liquidIndex}][nicotine_type]" id="liquids_${liquidIndex}_nicotine_type" class="form-control">
                            <option value="salt">Salt</option>
                            <option value="freebase">Freebase</option>
                            <option value="freebase">DL</option>
                        </select>
                    </div>
                </div>
                               
             <div class="col-md-6">
                <div class="form-group">
                    <label for="liquids_${liquidIndex}vape_style">Vape Style</label>
                    <select name="liquids[${liquidIndex}][vape_style]" id="liquids_${liquidIndex}_vape_style" class="form-control">
                        <option value="DL">DL (Direct Lung)</option>
                        <option value="MTL">MTL (Mouth to Lung)</option>
                        <option value="MTL">SaltNic</option>

                    </select>
                </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="liquids_${liquidIndex}_vg_pg_ratio">VG/PG Ratio</label>
                        <input type="text" name="liquids[${liquidIndex}][vg_pg_ratio]" class="form-control" id="liquids_${liquidIndex}_vg_pg_ratio">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="liquids_${liquidIndex}_bottle_size_ml">Bottle Size (ml)</label>
                        <input type="number" name="liquids[${liquidIndex}][bottle_size_ml]" class="form-control" id="liquids_${liquidIndex}_bottle_size_ml">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="liquids_${liquidIndex}_flavour_id">Flavour</label>
                        <select name="liquids[${liquidIndex}][flavour_id]" id="liquids_${liquidIndex}_flavour_id" class="form-control">
                            @foreach($flavours as $flavour)
                                <option value="{{ $flavour->id }}">{{ $flavour->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <!-- Nicotine Strengths -->
            <div class="form-group">
                <label>Nicotine Strengths</label>
                <div class="nic-strengths-container" id="nic-strengths-${liquidIndex}">
                    <input type="number" min="0" step="0.1" name="liquids[${liquidIndex}][nicotine_strengths][]" class="form-control mb-2" placeholder="Enter strength (e.g. 3mg)">
                </div>
                <button type="button" class="btn btn-sm btn-primary" onclick="addNicStrength(${liquidIndex})">
                    <i class="fas fa-plus"></i> Add Strength
                </button>
            </div>
        </div>
    `;

    container.insertAdjacentHTML('beforeend', newLiquidForm);
    updateLiquidCount();
    showRemoveButtons();
}

function removeLiquidForm(index) {
    const formToRemove = document.querySelector(`[data-liquid-index="${index}"]`);
    if (formToRemove) {
        formToRemove.style.animation = 'fadeOutUp 0.3s ease-out';
        setTimeout(() => {
            formToRemove.remove();
            liquidCount--;
            updateLiquidCount();
            updateLiquidNumbers();
            hideRemoveButtonsIfNeeded();
        }, 300);
    }
}

function updateLiquidCount() {
    document.getElementById('liquid-count').textContent = liquidCount;
}

function updateLiquidNumbers() {
    const forms = document.querySelectorAll('.liquid-form-container');
    forms.forEach((form, index) => {
        form.querySelector('.liquid-counter').textContent = index + 1;
        form.querySelector('h5').textContent = `Liquid #${index + 1}`;
    });
}

function showRemoveButtons() {
    const removeButtons = document.querySelectorAll('.remove-liquid-btn');
    if (removeButtons.length > 1) {
        removeButtons.forEach(btn => btn.style.display = 'block');
    }
}

function hideRemoveButtonsIfNeeded() {
    const removeButtons = document.querySelectorAll('.remove-liquid-btn');
    if (removeButtons.length <= 1) {
        removeButtons.forEach(btn => btn.style.display = 'none');
    }
}

// Add nicotine strength input
function addNicStrength(liquidIndex) {
    const container = document.getElementById(`nic-strengths-${liquidIndex}`);
    container.insertAdjacentHTML('beforeend', `<input type="number" min="0" step="0.1" name="liquids[${liquidIndex}][nicotine_strengths][]" class="form-control mb-2" placeholder="Enter strength (e.g. 6mg)">`);
}
</script>
@endsection
