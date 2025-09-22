@section('page-header')

@endsection

<div>

<!-- row -->
<div class="row row-sm">
    <div class="col-12">
        <div class="card box-shadow-0">
          

            <div class="card-body pt-0">
                    <!-- Container for all group forms -->
                    <div id="group-forms-container">
                        <!-- Initial group form -->
                        <div class="group-form-container" data-group-index="0">
                            <div class="d-flex align-items-center mb-3">
                                <h5 class="mb-0">العرض</h5>               
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">اسم العرض</label>
                                        <input type="text" wire:model.lazy = 'group_name' name="name" class="form-control" id="name" placeholder="قم بأدخال اسم العرض" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="price">السعر</label>
                                        <input type="number" min="1"  wire:model.lazy = 'group_price' step="0.1" name="price" class="form-control" id="price" placeholder="قم بأدخال سعر العرض">
                                    </div>
                                </div>
                            </div>
                     
                        </div>
                    </div>


                    
                  <div class="mb-4 d-flex justify-content-center flex-wrap">

                      <button class="btn btn-success btn-lg px-4 shadow-sm m-2" wire:click="addItem('liquids')">
                          <i class="fas fa-tint me-2"></i> اضافه ليكويد
                      </button>

                      <button class="btn btn-success btn-lg px-4 shadow-sm m-2" wire:click="addItem('devices')">
                          <i class="fas fa-mobile-alt me-2"></i> اضافه جهاز
                      </button>

                      <button class="btn btn-success btn-lg px-4 shadow-sm m-2" wire:click="addItem('tanks')">
                          <i class="fas fa-battery-full me-2"></i> اضافه تانكات
                      </button>

                      <button class="btn btn-success btn-lg px-4 shadow-sm m-2" wire:click="addItem('cartridges')">
                          <i class="fas fa-cubes me-2"></i> اضافه خراطيش
                      </button>

                      <button class="btn btn-success btn-lg px-4 shadow-sm m-2" wire:click="addItem('coils')">
                          <i class="fas fa-circle-notch me-2"></i> اضافه كويلز
                      </button>

                  </div>




                  @if($selectedItem)
                    @livewire('group-inventories.items-inventory-form' , [$selectedItem])
                  @endif
                  
                  <!-- Submit Button -->
                  <div class="form-group mb-0 mt-4 justify-content-center text-center">
                      <button type="button" wire:click="submitGroups" class="btn btn-success btn-lg px-5">
                          <i class="fas fa-save me-2"></i>
                          انشاء العرض 
                      </button>

                      <button type="button" wire:click="showSummary" class="btn btn-warning btn-lg px-5">
                          <i class="fas fa-eye me-2"></i>
                          عرض الملخص
                      </button>
                  </div>


            </div>


        </div>
    </div>
</div>

</div>
