<!-- row -->
<div class="row row-sm">
    <div class="col-xl-12">
        <div class="card-header bg-warning text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">
                <i class="mdi mdi-pencil"></i>
                وصف الجهاز - {{ $device->name ?? 'العلامة التجارية' }}
            </h4>
            @if(!$forceDetails)
            <button type="button" class="close text-white" aria-label="إغلاق" wire:click="cancel">
                <span aria-hidden="true">&times;</span>
            </button>
            @endif
        </div>
        
        <div class="card shadow-sm border-0">
            <div class="card-body device-details-container p-4">
                <div class="row row-sm">

                    <!-- Left side: device image -->
                     <div class="col-xl-5 col-lg-12 col-md-12">

                        <div class="preview-pic tab-content">
                            @for ($i = 0; $i < count($device->images); $i++)
                                <div class="tab-pane {{ $i == $activeImageIndex ? 'active' : '' }}" id="pic-{{ $i }}">
                                    <img 
                                    src="{{ URL::asset("storage/cartridges/{$device->images[$i]->url}") }}" 
                                    style="width: 400px ; height: 400px;"
                                    alt="صورة السائل"/>
                                </div>
                            @endfor 
                        </div>

                        <ul class="preview-thumbnail nav nav-tabs">
                            @for ($i = 0; $i < count($device->images); $i++)
                                <li class="{{ $i == $activeImageIndex ? 'active' : '' }}">
                                    <a href="javascript:void(0)" 
                                    wire:click="setActiveImage({{ $i }})"
                                    data-target="#pic-{{ $i }}" 
                                    data-toggle="tab">
                                        <img src="{{ URL::asset("storage/cartridges/{$device->images[$i]->url}") }}" alt="صورة السائل"/>
                                    </a>
                                </li>
                            @endfor 
                        </ul>

                    </div>


                    <!-- Right side: device details -->
                    <div class="col-xl-7 col-lg-12 col-md-12 mt-4 mt-xl-0">
                        <h4 class="product-title mb-2 text-primary fw-bold">{{ $device->name }}</h4>
                        
                        <div class="mb-3">
                            <p class="text-muted mb-2">
                                <i class="fas fa-tag me-2"></i>
                                العلامة التجارية: <strong class="text-dark">{{ $device->brand->name ?? 'غير معروف' }}</strong>
                            </p>
                            <p class="text-muted mb-2">
                                <i class="fas fa-folder me-2"></i>
                                الفئة: <strong class="text-dark">{{ $device->category->name ?? 'غير مصنف' }}</strong>
                            </p>
                            @if($device->release_year)
                            <p class="text-muted mb-3">
                                <i class="fas fa-calendar me-2"></i>
                                سنة الإصدار: <strong class="text-dark">{{ $device->release_year }}</strong>
                            </p>
                            @endif
                        </div>

                        <!-- Navigation Buttons -->
                        <div class="btn-group mb-4 w-100" role="group" aria-label="Device Options">
                            
                            @foreach ($buttons as $button )
                                <button type="button" wire:click="showDetails({{$button['label']}})" 
                                        class="btn btn-outline-primary rounded-start">
                                    <i class="{{$button['icon']}} me-1"></i> {{$button['span']}}
                                </button>
                            @endforeach
                        </div>
                        
                        @foreach ($itemAttributes as $attr)
                            @if($this->{$attr})
                                @include($this->getViewsMapping()[$attr] , ['device'=>$device, 'item'=>'cartridgeVariants','sk'=>'resistance'])
                            @endif
                        @endforeach

                        

                        
                       

                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /row -->