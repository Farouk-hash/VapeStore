

{{-- @endsection --}}


<div>
    
    {{-- Css For Get Group-Inventory-Details --}}
    <style>
    /* Expandable sections */
    .expandable-section {
    margin-bottom: 15px;
    }
    .section-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 15px;
    background: #f8f9fa;
    border-radius: 8px;
    cursor: pointer;
    border: 1px solid #dee2e6;
    transition: all 0.3s ease;
    }
    .section-header:hover {
    background: #e9ecef;
    border-color: #007bff;
    }
    .section-header h6 {
    margin: 0;
    display: flex;
    align-items: center;
    gap: 8px;
    }
    .section-toggle {
    font-size: 14px;
    color: #6c757d;
    transition: transform 0.3s ease;
    }
    .section-header.expanded .section-toggle {
    transform: rotate(180deg);
    }
    .section-content {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.3s ease, opacity 0.3s ease;
    opacity: 0;
    }
    .section-content.expanded {
    max-height: 500px;
    opacity: 1;
    padding: 15px;
    border: 1px solid #dee2e6;
    border-top: none;
    border-radius: 0 0 8px 8px;
    background: white;
    }

    .specs-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 15px;
    margin: 20px 0;
    }
    .spec-item {
    background: #f8f9fa;
    padding: 15px;
    border-radius: 8px;
    text-align: center;
    }
    .spec-value {
    font-size: 18px;
    font-weight: bold;
    color: #007bff;
    display: block;
    }
    .spec-label {
    font-size: 12px;
    color: #6c757d;
    text-transform: uppercase;
    }


    </style>
    {{-- End-Css For Get Group-Inventory-Details --}}


    <!-- row -->
    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="row row-sm">

                        <!-- Left side: Bill summary details -->
                        <div class="col-xl-6 col-lg-12 col-md-12">
                            <div class="p-3">
                                <h5 class="mb-3 text-primary">تفاصيل العرض</h5>
                                
                                <div class="mb-3">
                                    <p class="text-muted tx-13 mb-1">
                                        <span class=""> اسم العرض :</span>
                                        <strong class="text-dark">{{ $group->name }}</strong>
                                    </p>
                                    <p class="text-muted tx-13 mb-1">
                                        <span class="">سعر العرض :</span>
                                        <strong class="text-danger">{{ $group->price }}</strong>
                                    </p>
                                    
                                    <p class="text-muted tx-13 mb-3">
                                        <span class="">تاريخ الإنشاء:</span>
                                        <strong class="text-success">
                                            {{ $group->created_at->format('Y-m-d H:i') }}
                                            (منذ {{ $group->created_at->diffForHumans() }})
                                        </strong>
                                    </p>
                                </div>

                                <hr>

                                <div class="mb-3">
                                    <p class="text-muted tx-13 mb-3">
                                        مفعل :<strong class="text-info">{{ $group->valid == 1  ? 'نعم' : 'لا' }}</strong>
                                    </p>
                                    <p class="text-muted tx-13 mb-3">
                                        اجمالي عدد المنتجات <strong class="text-info">{{ $group->details->sum('quantity') }}</strong>
                                    </p>
                                    <p class="text-muted tx-13 mb-3">
                                        اجمالي عدد الليكويد <strong class="text-info">{{ $group->totalLiquidQuantity }}</strong>
                                    </p>
                                     <p class="text-muted tx-13 mb-3">
                                        اجمالي عدد الاجهزه و الكويلز <strong class="text-info">{{ $group->totalDeviceQuantity }}</strong>
                                    </p>
                                    
                                </div>

                            </div>
                        </div>

                        <!-- Right side: Bill items details and Notes -->
                        <div class="col-xl-6 col-lg-12 col-md-12">
                            @if($group->details && $group->details->count() > 0)
                                <div class="p-3">
                                    <div class="expandable-section">
                                        <div class="section-header" data-target="specs-section">
                                            <h6><i class="mdi mdi-cog"></i> تفاصيل العرض</h6>
                                            <span class="section-toggle"><i class="mdi mdi-chevron-down"></i></span>
                                        </div>
                                        <div class="section-content" id="specs-section">
                                            <div class="specs-grid">
                                                @foreach($groupDetails as $detail)
                                                    <div class="spec-item">
                                                        <a href="{{$detail['route']}}">
                                                        <span class="spec-value">{{ $detail['source']}}</span>
                                                        <span class="spec-label">الاسم: {{ $detail['name'] }}</span>
                                                        <hr>
                                                        <span class="spec-label">الكمية: {{ $detail['quantity'] }}</span>

                                                        </a>
                                                    </div>
                                                @endforeach
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            @endif
                            
                            
                            
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /row -->

    <!-- Modal for viewing all items -->
    <div class="modal fade" id="viewAllModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">العناصر</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modalContent">
                    <!-- Content will be populated by JavaScript -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                </div>
            </div>
        </div>
    </div>

  
</div>


