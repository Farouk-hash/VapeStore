<!-- row -->
<div class="row row-sm">
    <div class="col-lg-8 col-xl-8 col-md-12 col-sm-12">
        <div class="card box-shadow-0">
            <div class="card-header">
                {{-- <h4 class="card-title mb-1">نموذج متعدد العلامات التجارية</h4> --}}
                {{-- <p class="mb-2">يمكنك إضافة عدة علامات تجارية مرة واحدة. اضغط على زر + لإضافة المزيد من النماذج.</p> --}}
            </div>
            <div class="card-body pt-0">
                    

                    <div id="brand-forms-container">

                        <div class="brand-form-container" data-brand-index="0">
                            <div class="d-flex align-items-center mb-3">

                                <h5 class="mb-0">العلامة التجارية {{$brand->name}} </h5>
                            
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>اسم العلامة التجارية</label>
                                        <input type="text" wire:model="name" class="form-control" placeholder="أدخل اسم العلامة التجارية" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>الدولة</label>
                                        <input type="text" wire:model="country" class="form-control" placeholder="أدخل الدولة">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label>الوصف</label>
                                <textarea wire:model="description" class="form-control" placeholder="أدخل وصف العلامة التجارية" rows="3"></textarea>
                            </div>

                            <div class="form-group mb-0">
                                <div class="custom-checkbox custom-control">
                                    <input 
                                        type="checkbox" 
                                        wire:model="is_active" 
                                        class="custom-control-input" 
                                        {{$is_active == 1 ? 'checked' : ''}}
                                    >

                                    <label class="custom-control-label">الحالة نشطة</label>

                                </div>
                            </div>
                            
                        </div>
                    </div>
                

               

                <div class="form-group mb-0 mt-4 justify-content-center text-center">
                    <button type="button" wire:click="submit" class="btn btn-success btn-lg px-5">
                        <i class="fas fa-save me-2"></i>
                        حفظ جميع البيانات 
                    </button>
                </div>

            </div>
        </div>
    </div>
</div>
