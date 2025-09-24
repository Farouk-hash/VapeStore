<!-- row -->
<div class="row row-sm">
    <div class="col-lg-8 col-xl-8 col-md-12 col-sm-12">
        <div class="card box-shadow-0">
            <div class="card-header">
                <h4 class="card-title mb-1">نموذج متعدد العلامات التجارية</h4>
                <p class="mb-2">يمكنك إضافة عدة علامات تجارية مرة واحدة. اضغط على زر + لإضافة المزيد من النماذج.</p>
            </div>
            <div class="card-body pt-0">
                    
                @foreach($brands as $index => $brand)

                    <div id="brand-forms-container">

                        <div class="brand-form-container" data-brand-index="0">
                            <div class="d-flex align-items-center mb-3">

                                <h5 class="mb-0">العلامة التجارية رقم {{$index+1}}</h5>
                                <button type="button" class="btn btn-danger btn-sm remove-brand-btn" 
                                    wire:click="removeBrand({{$index}})" 
                                    style="{{$index == 0 ? 'display:none ;' : '' }}">
                                    <i class="fas fa-times"></i>
                                </button>

                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>اسم العلامة التجارية</label>
                                        <input type="text" wire:model="brands.{{$index}}.name" class="form-control" placeholder="أدخل اسم العلامة التجارية" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>الدولة</label>
                                        <input type="text" wire:model="brands.{{$index}}.country" class="form-control" placeholder="أدخل الدولة">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label>الوصف</label>
                                <textarea wire:model="brands.{{$index}}.description" class="form-control" placeholder="أدخل وصف العلامة التجارية" rows="3"></textarea>
                            </div>

                            <div class="form-group mb-0">
                                <div class="custom-checkbox custom-control">
                                    <input 
                                        type="checkbox" 
                                        wire:model="brands.{{ $index }}.is_active" 
                                        class="custom-control-input" 
                                        id="brand_active_{{ $index }}"
                                    >
                                    <label for="brand_active_{{ $index }}" class="custom-control-label">الحالة نشطة</label>

                                </div>
                            </div>
                            
                        </div>
                    </div>
                @endforeach   
                

                <div class="text-center mb-4">
                    <button type="button" class="btn btn-secondary btn-lg px-2" wire:click="addBrandForm">
                        <i class="fas fa-plus me-2"></i> إضافة علامة تجارية أخرى
                    </button>
                </div>

                <div class="form-group mb-0 mt-4 justify-content-center text-center">
                    <button type="button" wire:click="submit" class="btn btn-success btn-lg px-5">
                        <i class="fas fa-save me-2"></i>
                        حفظ جميع العلامات (<span id="brand-count">{{ count($brands) }}</span>)
                    </button>
                </div>

            </div>
        </div>
    </div>
</div>
