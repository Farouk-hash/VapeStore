<div class="container-fluid py-4">
    <!-- Reports Page -->
    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card shadow-lg border-0">
                <div x-data="{ tab: 'overview' }" class="card-body p-0">
                    
                    <!-- Modern Tab Navigation -->
                    <div class="bg-gradient-primary p-4 rounded-top">
                        <ul class="nav nav-pills nav-justified mb-0" style="background: rgba(255,255,255,0.1); border-radius: 15px; padding: 8px;">
                            <li class="nav-item">
                                <button @click="tab = 'overview'" 
                                    class="nav-link fw-bold border-0 rounded-pill px-4 py-3 transition-all" 
                                    :class="{ 'bg-white text-primary shadow-sm': tab === 'overview', 'hover-bg-white-10': tab !== 'overview' }">
                                    <i class="fas fa-chart-line me-2"></i> نظرة عامة 
                                </button>
                            </li>
                            <li class="nav-item">
                                <button @click="tab = 'inventory'" 
                                    class="nav-link fw-bold border-0 rounded-pill px-4 py-3 transition-all" 
                                    :class="{ 'bg-white text-primary shadow-sm': tab === 'inventory', 'hover-bg-white-10': tab !== 'inventory' }">
                                    <i class="fas fa-warehouse me-2"></i> المخزون
                                </button>
                            </li>
                            <li class="nav-item">
                                <button @click="tab = 'sales'" 
                                    class="nav-link fw-bold border-0 rounded-pill px-4 py-3 transition-all" 
                                    :class="{ 'bg-white text-primary shadow-sm': tab === 'sales', 'hover-bg-white-10': tab !== 'sales' }">
                                    <i class="fas fa-shopping-cart me-2"></i> المبيعات 
                                </button>
                            </li>
                            <li class="nav-item">
                                <button @click="tab = 'products'" 
                                    class="nav-link fw-bold border-0 rounded-pill px-4 py-3 transition-all" 
                                    :class="{ 'bg-white text-primary shadow-sm': tab === 'products', 'hover-bg-white-10': tab !== 'products' }">
                                    <i class="fas fa-boxes me-2"></i> المنتجات
                                </button>
                            </li>
                            <li class="nav-item">
                                <button @click="tab = 'financial'" 
                                    class="nav-link fw-bold border-0 rounded-pill px-4 py-3 transition-all" 
                                    :class="{ 'bg-white text-primary shadow-sm': tab === 'financial', 'hover-bg-white-10': tab !== 'financial' }">
                                    <i class="fas fa-chart-pie me-2"></i> التقارير المالية
                                </button>
                            </li>
                           
                        </ul>
                    </div>

                    <!-- Tab Content -->
                    <div class="p-4">
                        
                        <!-- Overview Tab -->
                        <div x-show="tab === 'overview'" class="tab-pane" x-transition:enter="fade-in-right">
                            @livewire('reports.over-view')
                        </div>

                        <!-- Inventory Tab -->
                        <div x-show="tab === 'inventory'" class="tab-pane" x-transition:enter="fade-in-right">
                            @livewire('reports.inventory-tap')
                        </div>

                        <!-- Sales Tab -->
                        <div x-show="tab === 'sales'" class="tab-pane" x-transition:enter="fade-in-right">
                            @livewire('reports.sales-tap')
                        </div>

                        <!-- Products Tab -->
                        <div x-show="tab === 'products'" class="tab-pane" x-transition:enter="fade-in-right">
                            @livewire('reports.products-tap')
                        </div>

                        <!-- Financial Tab -->
                        <div x-show="tab === 'financial'" class="tab-pane" x-transition:enter="fade-in-right">
                            @livewire('reports.financial-tap')
                        </div>

                        

                    </div>
                </div>

                <!-- Export Controls -->
                <div class="card-footer border-0 bg-light">
                    <div class="row g-3 align-items-center">
                        <div class="col-lg-8">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-download text-primary me-2"></i>
                                <span class="fw-semibold text-muted">تصدير التقارير:</span>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="d-flex gap-2 justify-content-end">
                                <button class="btn btn-danger btn-sm">
                                    <i class="fas fa-file-pdf me-1"></i>PDF
                                </button>
                                <button class="btn btn-success btn-sm">
                                    <i class="fas fa-file-excel me-1"></i>Excel
                                </button>
                                <button class="btn btn-primary btn-sm">
                                    <i class="fas fa-print me-1"></i>طباعة
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>