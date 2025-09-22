<!-- row opened -->
<div class="row row-sm">
    <div class="col-xl-12">
        <div class="card shadow-lg border-0">
            <div x-data="{ tab: @entangle('activeTab') }" class="card-body p-0">
                
                <!-- Modern Tab Navigation -->
                <div class="bg-gradient-primary  p-4 rounded-top">
                    <ul class="nav nav-pills nav-justified mb-0" style="background: rgba(255,255,255,0.1); border-radius: 15px; padding: 8px;">
                        <li class="nav-item">
                            <button @click="tab = 'liquids'" 
                            class="nav-link  fw-bold border-0 rounded-pill px-4 py-3 transition-all" 
                            :class="{ 'bg-white text-primary shadow-sm': tab === 'liquids', 'hover-bg-white-10': tab !== 'liquids' }">
                                <i class="fas fa-flask me-2"></i> السوائل 
                            </button>
                        </li>
                        <li class="nav-item">
                            <button @click="tab = 'devices'" 
                            class="nav-link  fw-bold border-0 rounded-pill px-4 py-3 transition-all" 
                            :class="{ 'bg-white text-primary shadow-sm': tab === 'devices', 'hover-bg-white-10': tab !== 'devices' }">
                                <i class="fas fa-mobile-alt me-2"></i> الأجهزة 
                            </button>
                        </li>
                        <li class="nav-item">
                            <button @click="tab = 'tanks'" 
                            class="nav-link  fw-bold border-0 rounded-pill px-4 py-3 transition-all" 
                            :class="{ 'bg-white text-primary shadow-sm': tab === 'tanks', 'hover-bg-white-10': tab !== 'tanks' }">
                                <i class="fas fa-vial"></i> التانكات
                            </button>
                        </li>
                        <li class="nav-item">
                            <button @click="tab = 'cartridges'" 
                            class="nav-link  fw-bold border-0 rounded-pill px-4 py-3 transition-all" 
                            :class="{ 'bg-white text-primary shadow-sm': tab === 'cartridges', 'hover-bg-white-10': tab !== 'cartridges' }">
                                <i class="fas fa-capsules"></i> خراطيش
                            </button>
                        </li>
                        <li class="nav-item">
                            <button @click="tab = 'coils'" 
                                class="nav-link fw-bold border-0 rounded-pill px-4 py-3 transition-all"
                                :class="{ 'bg-white text-primary shadow-sm': tab === 'coils', 'hover-bg-white-10': tab !== 'coils' }">
                                <i class="fas fa-dna"></i> كويلات
                            </button>
                        </li>

                        <li class="nav-item">
                            <button @click="tab = 'groups'" 
                                class="nav-link fw-bold border-0 rounded-pill px-4 py-3 transition-all"
                                :class="{ 'bg-white text-primary shadow-sm': tab === 'groups', 'hover-bg-white-10': tab !== 'groups' }">
                                <i class="fas fa-box-open"></i> العروض
                            </button>
                        </li>


                        <li class="nav-item">
                            <button @click="tab = 'summary'" 
                            class="nav-link  fw-bold border-0 rounded-pill px-4 py-3 transition-all" 
                            :class="{ 'bg-white text-primary shadow-sm': tab === 'summary', 'hover-bg-white-10': tab !== 'summary' }">
                                <i class="fas fa-receipt me-2"></i> الملخص
                            </button>
                        </li>
                    </ul>
                </div>

                <!-- Tab Content -->
                <div class="p-4">
                    <div x-show="tab === 'liquids'" class="tab-pane" x-transition:enter="fade-in-right">
                        @livewire('sales.liquid-selector', [], key('liquids'))
                    </div>

                    <div x-show="tab === 'devices'" class="tab-pane" x-transition:enter="fade-in-right">
                        @livewire('sales.devices-selector', [], key('devices'))
                    </div>
                    
                    <div x-show="tab === 'tanks'" class="tab-pane" x-transition:enter="fade-in-right">
                        @livewire('sales.tanks-selector', [], key('tanks'))
                    </div>

                    <div x-show="tab === 'cartridges'" class="tab-pane" x-transition:enter="fade-in-right">
                        @livewire('sales.cartridges-selector', [], key('cartridges'))
                    </div>

                    <div x-show="tab === 'coils'" class="tab-pane" x-transition:enter="fade-in-right">
                        @livewire('sales.coils-selector', [], key('coils'))
                    </div>

                    <div x-show="tab === 'groups'" class="tab-pane" x-transition:enter="fade-in-right">
                        @livewire('sales.groups-selector', [], key('groups'))
                    </div>
                    


                    <div x-show="tab === 'summary'" class="tab-pane" x-transition:enter="fade-in-right">
                        @if($summary)
                            <div class="row g-4">

                               
                                <!-- Liquids Section -->
                                @if(count($summary['liquids']) > 0)
                                <div class="col-lg-6">
                                    <div class="card h-100 border-0 shadow-sm bg-gradient-info">
                                        <div class="card-header bg-transparent border-0 pb-0">
                                            <h5 class="fw-bold  d-flex align-items-center mb-0">
                                                <i class="fas fa-flask me-3 bg-white text-info rounded-circle p-2"></i>
                                                السوائل المختارة
                                                <span class="badge bg-white text-info ms-auto rounded-pill">{{ count($summary['liquids']) }}</span>
                                            </h5>
                                        </div>
                                        <div class="card-body pt-3">
                                            @foreach($summary['liquids'] as $index => $item)
                                                <div class="bg-white rounded-lg p-3 mb-3 shadow-sm border-start border-info border-4">
                                                    <div class="row g-2">
                                                        <div class="col-12">
                                                            <h6 class="fw-bold text-dark mb-2 d-flex align-items-center">
                                                                <span class="badge bg-info  rounded-circle me-2" style="width: 25px; height: 25px; display: flex; align-items: center; justify-content: center;">{{ $index + 1 }}</span>
                                                                {{ $item['flavor']['name'] }}
                                                            </h6>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <small class="text-muted d-block"><i class="fas fa-tag me-1"></i>النوع:</small>
                                                            <span class="fw-semibold">{{ $item['liquid']['type'] }}</span>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <small class="text-muted d-block"><i class="fas fa-wind me-1"></i>الأسلوب:</small>
                                                            <span class="fw-semibold">{{ $item['liquid']['stype'] }}</span>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <small class="text-muted d-block"><i class="fas fa-vial me-1"></i>الحجم:</small>
                                                            <span class="fw-semibold">{{ $item['liquid']['bottle_size_ml'] }} مل</span>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <small class="text-muted d-block"><i class="fas fa-percentage me-1"></i>التركيز:</small>
                                                            <span class="fw-semibold">{{ $item['strength'] }}</span>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <small class="text-muted d-block"><i class="fas fa-boxes me-1"></i>الكمية:</small>
                                                            <span class="fw-semibold">{{ $item['details']['quantity'] }}</span>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="bg-light rounded p-2 mt-2">
                                                                <div class="row">
                                                                    <div class="col-6">
                                                                        <small class="text-muted">سعر الوحدة:</small>
                                                                        <div class="fw-bold text-primary">{{ number_format($item['details']['base_price'], 2) }}</div>
                                                                    </div>
                                                                    <div class="col-6 text-end">
                                                                        <small class="text-muted">الإجمالي:</small>
                                                                        <div class="fw-bold text-success fs-5">{{ number_format($item['details']['total_price_per_item'], 2) }}</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                @endif

                                <!-- Devices Section -->
                                @if(count($summary['devices']) > 0)
                                <div class="col-lg-6">
                                    <div class="card h-100 border-0 shadow-sm bg-gradient-warning">
                                        <div class="card-header bg-transparent border-0 pb-0">
                                            <h5 class="fw-bold  d-flex align-items-center mb-0">
                                                <i class="fas fa-mobile-alt me-3 bg-white text-warning rounded-circle p-2"></i>
                                                الأجهزة المختارة
                                                <span class="badge bg-white text-warning ms-auto rounded-pill">{{ count($summary['devices']) }}</span>
                                            </h5>
                                        </div>
                                        <div class="card-body pt-3">
                                            @foreach($summary['devices'] as $index => $item)
                                                <div class="bg-white rounded-lg p-3 mb-3 shadow-sm border-start border-warning border-4">
                                                    <div class="row g-2">
                                                        <div class="col-12">
                                                            <h6 class="fw-bold text-dark mb-2 d-flex align-items-center">
                                                                <span class="badge bg-warning  rounded-circle me-2" style="width: 25px; height: 25px; display: flex; align-items: center; justify-content: center;">{{ $index + 1 }}</span>
                                                                {{ $item['name'] }}
                                                            </h6>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <small class="text-muted d-block"><i class="fas fa-boxes me-1"></i>الكمية:</small>
                                                            <span class="fw-semibold">{{ $item['details']['quantity'] }}</span>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <small class="text-muted d-block"><i class="fas fa-dollar-sign me-1"></i>سعر الوحدة:</small>
                                                            <span class="fw-semibold">{{ number_format($item['details']['base_price'], 2) }}</span>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="bg-light rounded p-2 mt-2">
                                                                <div class="text-center">
                                                                    <small class="text-muted d-block">الإجمالي</small>
                                                                    <div class="fw-bold text-success fs-4">{{ number_format($item['details']['total_price_per_item'], 2) }}</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                @endif

                                {{-- Tanks Section --}}
                                @if(count($summary['tanks']) > 0)
                                <div class="col-lg-6">
                                    <div class="card h-100 border-0 shadow-sm bg-gradient-warning">
                                        <div class="card-header bg-transparent border-0 pb-0">
                                            <h5 class="fw-bold  d-flex align-items-center mb-0">
                                                <i class="fas fa-mobile-alt me-3 bg-white text-warning rounded-circle p-2"></i>
                                                التانكات المختارة
                                                <span class="badge bg-white text-warning ms-auto rounded-pill">{{ count($summary['tanks']) }}</span>
                                            </h5>
                                        </div>
                                        <div class="card-body pt-3">
                                            @foreach($summary['tanks'] as $index => $item)
                                                <div class="bg-white rounded-lg p-3 mb-3 shadow-sm border-start border-warning border-4 position-relative"> 
                                                    <!-- Remove button --> 
                                                    <button type="button" 
                                                            wire:click="removeItem({{ $item['id'] }})" 
                                                            class="btn btn-sm btn-outline-danger position-absolute" 
                                                            style="top: 20px; left: 16px; z-index: 10; border-radius:10px;"> 
                                                        <i class="fas fa-times"></i> 
                                                    </button> 

                                                    <div class="row g-2">
                                                        <div class="col-12">
                                                            <h6 class="fw-bold text-dark mb-2 d-flex align-items-center">
                                                                <span class="badge bg-warning  rounded-circle me-2" style="width: 25px; height: 25px; display: flex; align-items: center; justify-content: center;">{{ $index + 1 }}</span>
                                                                {{ $item['name'] }}
                                                            </h6>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <small class="text-muted d-block"><i class="fas fa-boxes me-1"></i>الكمية:</small>
                                                            <span class="fw-semibold">{{ $item['details']['quantity'] }}</span>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <small class="text-muted d-block"><i class="fas fa-dollar-sign me-1"></i>سعر الوحدة:</small>
                                                            <span class="fw-semibold">{{ number_format($item['details']['base_price'], 2) }}</span>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="bg-light rounded p-2 mt-2">
                                                                <div class="text-center">
                                                                    <small class="text-muted d-block">الإجمالي</small>
                                                                    <div class="fw-bold text-success fs-4">{{ number_format($item['details']['total_price_per_item'], 2) }}</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                @endif
                                
                                {{-- Cartridges Section --}}
                                @if(count($summary['cartridges']) > 0)
                                <div class="col-lg-6">
                                    <div class="card h-100 border-0 shadow-sm bg-gradient-warning">
                                        <div class="card-header bg-transparent border-0 pb-0">
                                            <h5 class="fw-bold  d-flex align-items-center mb-0">
                                                <i class="fas fa-capsules"></i> الخراطيش المختارة
                                                <span class="badge bg-white text-warning ms-auto rounded-pill">{{ count($summary['cartridges']) }}</span>
                                            </h5>
                                        </div>
                                        <div class="card-body pt-3">
                                            @foreach($summary['cartridges'] as $index => $item)
                                                <div class="bg-white rounded-lg p-3 mb-3 shadow-sm border-start border-warning border-4 position-relative"> 
                                                    <!-- Remove button --> 
                                                    <button type="button" 
                                                            wire:click="removeItem({{ $item['id'] }})" 
                                                            class="btn btn-sm btn-outline-danger position-absolute" 
                                                            style="top: 20px; left: 16px; z-index: 10; border-radius:10px;"> 
                                                        <i class="fas fa-times"></i> 
                                                    </button> 

                                                    
                                                    <div class="row g-2">
                                                        <div class="col-12">
                                                            <h6 class="fw-bold text-dark mb-2 d-flex align-items-center">
                                                                <span class="badge bg-warning  rounded-circle me-2" style="width: 25px; height: 25px; display: flex; align-items: center; justify-content: center;">{{ $index + 1 }}</span>
                                                                {{ $item['name'] }}
                                                            </h6>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <small class="text-muted d-block"><i class="fas fa-boxes me-1"></i>الكمية:</small>
                                                            <span class="fw-semibold">{{ $item['details']['quantity'] }}</span>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <small class="text-muted d-block"><i class="fas fa-dollar-sign me-1"></i>سعر الوحدة:</small>
                                                            <span class="fw-semibold">{{ number_format($item['details']['base_price'], 2) }}</span>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="bg-light rounded p-2 mt-2">
                                                                <div class="text-center">
                                                                    <small class="text-muted d-block">الإجمالي</small>
                                                                    <div class="fw-bold text-success fs-4">{{ number_format($item['details']['total_price_per_item'], 2) }}</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                @endif

                                {{-- Coils Section --}}
                                @if(count($summary['coils']) > 0)
                                <div class="col-lg-6">
                                    <div class="card h-100 border-0 shadow-sm bg-gradient-warning">
                                        <div class="card-header bg-transparent border-0 pb-0">
                                            <h5 class="fw-bold  d-flex align-items-center mb-0">
                                                <i class="fas fa-dna"></i> الكويلز المختارة
                                                <span class="badge bg-white text-warning ms-auto rounded-pill">{{ count($summary['coils']) }}</span>
                                            </h5>
                                        </div>
                                        <div class="card-body pt-3">
                                            @foreach($summary['coils'] as $index => $item)
                                                <div class="bg-white rounded-lg p-3 mb-3 shadow-sm border-start border-warning border-4 position-relative"> 
                                                    <!-- Remove button --> 
                                                    <button type="button" 
                                                            wire:click="removeItem({{ $item['id'] }})" 
                                                            class="btn btn-sm btn-outline-danger position-absolute" 
                                                            style="top: 20px; left: 16px; z-index: 10; border-radius:10px;"> 
                                                        <i class="fas fa-times"></i> 
                                                    </button> 


                                                    <div class="row g-2">
                                                        <div class="col-12">
                                                            <h6 class="fw-bold text-dark mb-2 d-flex align-items-center">
                                                                <span class="badge bg-warning  rounded-circle me-2" style="width: 25px; height: 25px; display: flex; align-items: center; justify-content: center;">{{ $index + 1 }}</span>
                                                                {{ $item['name'] }}
                                                            </h6>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <small class="text-muted d-block"><i class="fas fa-boxes me-1"></i>الكمية:</small>
                                                            <span class="fw-semibold">{{ $item['details']['quantity'] }}</span>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <small class="text-muted d-block"><i class="fas fa-dollar-sign me-1"></i>سعر الوحدة:</small>
                                                            <span class="fw-semibold">{{ number_format($item['details']['base_price'], 2) }}</span>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="bg-light rounded p-2 mt-2">
                                                                <div class="text-center">
                                                                    <small class="text-muted d-block">الإجمالي</small>
                                                                    <div class="fw-bold text-success fs-4">{{ number_format($item['details']['total_price_per_item'], 2) }}</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                @endif

                                {{-- Groups Section --}}
                                @if(count($summary['groupInventories']) > 0)
                                <div class="col-lg-6">
                                    <div class="card h-100 border-0 shadow-sm bg-gradient-warning">
                                        <div class="card-header bg-transparent border-0 pb-0">
                                            <h5 class="fw-bold  d-flex align-items-center mb-0">
                                                <i class="fas fa-box-open"></i> العروض المختارة
                                                <span class="badge bg-white text-warning ms-auto rounded-pill">{{ count($summary['groupInventories']) }}</span>
                                            </h5>
                                        </div>
                                        <div class="card-body pt-3">
                                            @foreach($summary['groupInventories'] as $index => $item)
                                                <div class="bg-white rounded-lg p-3 mb-3 shadow-sm border-start border-warning border-4 position-relative"> 
                                                    <!-- Remove button --> 
                                                    <button type="button" 
                                                            wire:click="removeItem({{ $item['id'] }} , 'groups')" 
                                                            class="btn btn-sm btn-outline-danger position-absolute" 
                                                            style="top: 20px; left: 16px; z-index: 10; border-radius:10px;"> 
                                                        <i class="fas fa-times"></i> 
                                                    </button> 


                                                    <div class="row g-2">
                                                        <div class="col-12">
                                                            <h6 class="fw-bold text-dark mb-2 d-flex align-items-center">
                                                                <span class="badge bg-warning  rounded-circle me-2" style="width: 25px; height: 25px; display: flex; align-items: center; justify-content: center;">{{ $index + 1 }}</span>
                                                                {{ $item['name'] }}
                                                            </h6>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <small class="text-muted d-block"><i class="fas fa-boxes me-1"></i>الكمية:</small>
                                                            <span class="fw-semibold">{{ $item['quantity'] }}</span>
                                                        </div>
                                                       
                                                        <div class="col-12">
                                                            <div class="bg-light rounded p-2 mt-2">
                                                                <div class="text-center">
                                                                    <small class="text-muted d-block">الإجمالي</small>
                                                                    <div class="fw-bold text-success fs-4">{{ number_format($item['price'] * $item['quantity'], 2)   }}</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                @endif

                              
                                
                            </div>

                            <!-- Payment Summary -->
                            @if(count($summary['groupInventories']) > 0 ||count($summary['liquids']) > 0 || count($summary['devices']) > 0 || count($summary['cartridges']) > 0 || count($summary['tanks'] ) >0)
                            <div class="card mt-4 border-0 shadow-lg bg-gradient-success">
                                <div class="card-body">
                                    <h5 class="fw-bold  mb-4 d-flex align-items-center">
                                        <i class="fas fa-calculator me-3 bg-white text-success rounded-circle p-2"></i>
                                        ملخص الفاتورة
                                    </h5>
                                    <div class="row g-3">
                                        <div class="col-md-4">
                                            <div class="bg-white bg-opacity-20 rounded-lg p-3 text-center">
                                                <i class="fas fa-receipt  mb-2 d-block" style="font-size: 1.5rem;"></i>
                                                <small class=" d-block mb-1">المجموع الفرعي</small>
                                                <div class="fw-bold  fs-5">{{ number_format($summary['payment_details']['totalPrice'], 2) }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="bg-white bg-opacity-20 rounded-lg p-3 text-center">
                                                <i class="fas fa-minus-circle  mb-2 d-block" style="font-size: 1.5rem;"></i>
                                                <small class=" d-block mb-1">الخصم</small>
                                                <div class="fw-bold  fs-5">{{ number_format($summary['payment_details']['discount'], 2) }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="bg-white rounded-lg p-3 text-center shadow-sm">
                                                <i class="fas fa-check-circle text-success mb-2 d-block" style="font-size: 1.5rem;"></i>
                                                <small class="text-success d-block mb-1">الإجمالي النهائي</small>
                                                <div class="fw-bold text-success fs-4">{{ number_format($summary['payment_details']['totalPriceAfterDiscount'], 2) }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif

                        <!-- Empty State -->
                        
                        
                        @else(count($summary['liquids']) === 0 && count($summary['devices']) === 0 && count($summary['cartridges']) === 0 && count($summary['tanks']) === 0)
                            <div class="col-12">
                                <div class="text-center py-5">
                                    <i class="fas fa-shopping-cart text-muted" style="font-size: 4rem; opacity: 0.3;"></i>
                                    <h4 class="text-muted mt-3">لم يتم اختيار أي منتجات بعد</h4>
                                    <p class="text-muted">ابدأ بإضافة السوائل أو الأجهزة إلى طلبك</p>
                                </div>
                            </div>
                        @endif

                        @if($orderCompleted)
                            <div class="text-center py-5">
                                <i class="fas fa-check-circle text-success" style="font-size: 4rem; opacity: 0.3;"></i>
                                <h4 class="text-muted mt-3">عملية ناجحة</h4>
                                <p class="text-muted">ابدأ بإضافة السوائل أو الأجهزة إلى طلبك</p>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        
            <!-- Bottom Controls -->
            <div class="card-footer border-0 bg-light">
                
                {{-- User-Name , Phone-Number + Toggle Button + Create-Or-Search --}}
                @if($this->quantities || $this->groupQuantitiesArray)
                    <div class="mb-3 text-center">
                        <button 
                            type="button"
                            class="btn btn-outline-primary"
                            wire:click="toggleCreateCustomer"
                        >
                            {{ $createNewCustomer ? 'اختيار عميل موجود' : 'إنشاء عميل جديد' }}
                        </button>
                    </div>

                    <div class="d-flex flex-wrap align-items-center gap-3">

                        @if($createNewCustomer)
                            <div class="flex-fill">
                                <div class="input-group shadow-sm">
                                    <span>اسم العميل</span>
                                    <input 
                                        type="text"
                                        wire:model="customerName"
                                        class="form-control border-0 fw-semibold text-center"
                                        style="font-size: 1.1rem;"
                                    />
                                </div>
                            </div>

                            <div class="flex-fill">
                                <div class="input-group shadow-sm">
                                    <span>رقم هاتف العميل</span>
                                    <input 
                                        type="number"
                                        wire:model="customerPhoneNumber"
                                        class="form-control border-0 fw-semibold text-center"
                                        style="font-size: 1.1rem;"
                                    />
                                </div>
                            </div>
                        @else
                            <div class="flex-fill">
                                <div class="input-group shadow-sm">
                                    <span>ابحث عن العميل</span>
                                    <input 
                                        type="text"
                                        wire:model="customerSearch"
                                        class="form-control border-0 fw-semibold text-center"
                                        placeholder="ابحث باستخدام رقم الهاتف او اسم العميل"
                                        style="font-size: 1.1rem;"
                                    />
                                </div>
                            </div>
                        @endif

                        <div>
                            <button 
                                class="btn btn-success btn-lg px-4 shadow-sm"
                                wire:click="onCreateCustomer"
                            >
                                <i class="fas fa-eye me-2"></i>
                                {{ $createNewCustomer ? 'انشاء عميل جديد' : 'ابحث عن العميل' }}
                            </button>
                        </div>
                    </div>
                    
                    {{-- Customer Mini-Details[Name , Points , Bills-Count , Discount-By-Points]  --}}
                    @if($customer)
                        <div class="row g-3 align-items-center">
                        <div class="col-lg-3">
                            <div class="bg-primary bg-opacity-10 rounded-lg p-3 text-center">
                                <small class="">📦 العميل</small>
                                <div class="">
                                    {{ $customer->name }}
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="bg-success bg-opacity-10 rounded-lg p-3 text-center">
                                <small class="">عدد النقاط</small>
                                <div class="">
                                    0
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="bg-success bg-opacity-10 rounded-lg p-3 text-center">
                                <small class="fas fa-coins">عدد العمليات </small>
                                <div class="">
                                    {{$customer->bills->count()}}
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="bg-success bg-opacity-10 rounded-lg p-3 text-center">
                                <small class="fas fa-coins">قيمه الخصم</small>
                                <div class="">
                                    0
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                @endif
                
                
                {{-- Total-Amount , Dicount , Total-After-Discount  --}}
                <div class="row g-3 align-items-center">
                    <div class="col-lg-3">
                        <div class="bg-primary bg-opacity-10 rounded-lg p-3 text-center">
                            <small class="">📦 الإجمالي</small>
                            <div class="">
                                {{ number_format($totalPrice ?? 0, 2) }}
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="input-group shadow-sm">
                            <span class="">
                                <i class=""></i>الخصم
                            </span>
                            <input 
                                type="number"
                                wire:model="discount"
                                wire:change="onDiscountApplied"
                                placeholder="0.00"
                                step="0.01"
                                max="{{ $totalPrice ?? 0 }}"
                                class="form-control border-0 fw-semibold text-center"
                                style="font-size: 1.1rem;"
                            />
                            <span class="input-group-text bg-warning  border-0">ج.م</span>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="bg-success bg-opacity-10 rounded-lg p-3 text-center">
                            <small class="">✅ المبلغ النهائي</small>
                            <div class="">
                                {{ number_format($totalPriceAfterDiscount ?? 0, 2) }}
                            </div>
                        </div>
                    </div>
                </div>

                
                <!-- Action Buttons[Order-complete , Clear-all , Show-details] -->
                @if($this->quantities || $this->groupQuantitiesArray)
                    <div class="row mt-3">
                        <div class="col-12">
                            <div class="d-flex gap-2 justify-content-center">
                                <button class="btn btn-primary btn-lg px-4 shadow-sm" wire:click="show">
                                    <i class="fas fa-eye me-2"></i>عرض التفاصيل
                                </button>

                                <button class="btn btn-success btn-lg px-4 shadow-sm" wire:click="completeOrder">
                                    <i class="fas fa-check me-2"></i>إتمام الطلب
                                </button>
                                <button class="btn btn-danger btn-lg px-4 shadow-sm" wire:click="clearAll">
                                    <i class="fas fa-trash me-2"></i>مسح الكل
                                </button>
                                
                            </div>
                        </div>
                    </div>
                @endif
                
                @if($this->printReceipt)
                        <div class="row mt-3">
                        <div class="col-12">
                            <div class="d-flex gap-2 justify-content-center">
                               
                                <button class="btn btn-success btn-lg px-4 shadow-sm" wire:click="">
                                    <i class="fas fa-print me-2"></i>طباعه فاتوره
                                </button>
                               
                            </div>
                        </div>
                    </div>
                @endif
                
            </div>

        </div>
    </div>
</div>

