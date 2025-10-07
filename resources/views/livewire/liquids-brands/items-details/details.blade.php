<div>
    <div  role="document">
        <div >
            <div class="modal-header bg-info text-white">
                <h5  id="editflavourModalLabel{{ $flavour->id }}">
                    <i class="fas fa-palette me-2"></i>
                    عرض تفاصيل النكهة: {{ $flavour->name }}
                </h5>
                {{-- {{var_dump($forceDetails)}} --}}
                 @if(!$forceDetails)
                
                    <button type="button" class="close text-white" aria-label="إغلاق" wire:click="cancel">
                        <span aria-hidden="true">&times;</span>
                    </button>
                
                @endif 
                
            </div>
            

                <!-- row -->
                <div class="row row-sm">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body h-100">
                                <div class="row row-sm">
                                    <!-- Left side: preview -->
                                    <!-- Left side: preview -->
                                    <div class="col-xl-5 col-lg-12 col-md-12">

                                        <div class="preview-pic tab-content">
                                            @for ($i = 0; $i < count($images); $i++)
                                                <div class="tab-pane {{ $i == $activeImageIndex ? 'active' : '' }}" id="pic-{{ $i }}">
                                                    <img 
                                                    src="{{ URL::asset("storage/flavors/{$images[$i]}") }}" 
                                                    style="width: 400px ; height: 400px;"
                                                    alt="صورة السائل"/>
                                                </div>
                                            @endfor 
                                        </div>

                                        <ul class="preview-thumbnail nav nav-tabs">
                                            @for ($i = 0; $i < count($images); $i++)
                                                <li class="{{ $i == $activeImageIndex ? 'active' : '' }}">
                                                    <a href="javascript:void(0)" 
                                                    wire:click="setActiveImage({{ $i }})"
                                                    data-target="#pic-{{ $i }}" 
                                                    data-toggle="tab">
                                                        <img src="{{ URL::asset("storage/flavors/{$images[$i]}") }}" alt="صورة السائل"/>
                                                    </a>
                                                </li>
                                            @endfor 
                                        </ul>

                                    </div>


                                    <!-- Right side: details -->
                                    <div class="details col-xl-7 col-lg-12 col-md-12 mt-4 mt-xl-0">
                                    
                                                    @if($flavour->liquids && $flavour->liquids->count() > 0)
                                                        @foreach($flavour->liquids as $liq)
                                                            <div class="d-inline-block me-2 mb-2">
                                                                <span class="badge badge-info p-2 d-flex align-items-center rounded-pill">
                                                                    <i class="fas fa-cog me-1"></i>
                                                                    <button type="button" class="btn btn-link text-white p-0 border-0 text-decoration-none me-2" 
                                                                            wire:click="getdNicStrenghts({{$liq->id}})">
                                                                        {{ $liq->nicotine_type }} {{$liq->vape_style}} {{$liq->vg_pg_ratio}} {{$liq->bottle_size_ml}} ml
                                                                    </button>
                                                                    
                                                                </span>
                                                            </div>
                                                        @endforeach
                                                        
                                                        <div class="mt-2">
                                                            <small class="text-muted">{{ $flavour->liquids->count() }} تركيز/تركيزات محددة</small>
                                                        </div>
                                                        
                                            
                                                    @endif

                                    
                                                    @if($selectedNicStrenghts)
                                                        <!-- Strengths -->
                                                        <h5 class="mt-4">التركيزات المتاحة:</h5>
                                                        @forelse($liquid as $details)
                                                        
                                                            <div class="mb-3 p-3 border rounded">
                                                                <h6 class="text-primary">{{ $details['strength'] }} ملغ</h6>
                                                                
                                                                @if(!empty($details['inventories']))
                                                                    <table class="table table-sm table-bordered">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>المعرف</th>
                                                                                <th>الكمية المستلمة</th>
                                                                                <th>السعر الأساسي</th>
                                                                                <th>تاريخ الاستلام</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach($details['inventories'] as $stock)
                                                                                <tr>
                                                                                    <td>{{ $stock->id }}</td>
                                                                                    <td>{{ $stock->stock_received }}</td>
                                                                                    <td>${{ number_format($stock->base_price, 2) }}</td>
                                                                                    <td>{{ \Carbon\Carbon::parse($stock->received_at)->format('d M Y H:i') }}</td>
                                                                                </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                @else
                                                                    <p class="text-muted">لا توجد سجلات مخزون حتى الآن.</p>
                                                                @endif
                                                            </div>
                                                        @empty
                                                            <p class="text-muted">لا توجد تركيزات متاحة.</p>
                                                        @endforelse

                                                    @endif
                                        

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

        </div>
    </div>
</div>

