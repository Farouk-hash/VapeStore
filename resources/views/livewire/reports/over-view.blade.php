<div class="row g-4">
    

    <!-- Key Metrics Cards -->
    <div class="col-lg-3 col-md-6">
        <div class="card border-0 shadow-sm bg-gradient-success h-100">
            <div class="card-body text-center text-black">
                <div class="d-flex align-items-center justify-content-center mb-3">    
                    <i class="fas fa-coins bg-white text-success rounded-circle p-3" style="font-size: 1.5rem;"></i>
                </div>
                <h3 >{{number_format($totalIncome , 2 , '.',',')}}</h3>
                <small class="opacity-75">إجمالي الإيرادات</small>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="card border-0 shadow-sm bg-gradient-success h-100">
            <div class="card-body text-center text-black">
                <div class="d-flex align-items-center justify-content-center mb-3">
                    <i class="fas fa-money-bill-wave bg-white text-success rounded-circle p-3" style="font-size: 1.5rem;"></i>
                </div>
                <h3 >{{number_format($totalDiscounts , 2 , '.',',')}}</h3>
                <small class="opacity-75">إجمالي الخصومات</small>
                
                
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="card border-0 shadow-sm bg-gradient-success h-100">
            <div class="card-body text-center text-black">
                <div class="d-flex align-items-center justify-content-center mb-3">
                    <i class="fas fa-wallet bg-white text-success rounded-circle p-3" style="font-size: 1.5rem;"></i>
                </div>
                <h3 >{{number_format($totalIncomeAfterDiscount , 2 , '.',',')}}</h3>
                <small class="opacity-75"> إجمالي الإيرادات بعد الخصومات للشهر الحالي</small>
                
                
            </div>
        </div>
    </div>

   

    <div class="col-lg-3 col-md-6">
        <div class="card border-0 shadow-sm bg-gradient-info h-100">
            <div class="card-body text-center text-black">
                <div class="d-flex align-items-center justify-content-center mb-3">
                    <i class="fas fa-shopping-bag bg-white text-info rounded-circle p-3" style="font-size: 1.5rem;"></i>
                </div>
                <h3 >{{number_format($total_bills , 2 , '.' , ',')}}</h3>
                <small class="opacity-75">إجمالي الطلبات للشهر الحالي</small>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="card border-0 shadow-sm bg-gradient-warning h-100">
            <div class="card-body text-center text-black">
                <div class="d-flex align-items-center justify-content-center mb-3">
                    <i class="fas fa-users bg-white text-warning rounded-circle p-3" style="font-size: 1.5rem;"></i>
                </div>
                <h3 >0</h3>
                <small class="opacity-75">إجمالي العملاء</small>
               
            </div>
        </div>
    </div> 

    <div class="col-lg-3 col-md-6">
        <div class="card border-0 shadow-sm bg-gradient-primary h-100">
            <div class="card-body text-center text-black">
                <div class="d-flex align-items-center justify-content-center mb-3">
                    <i class="fas fa-box bg-white text-primary rounded-circle p-3" style="font-size: 1.5rem;"></i>
                </div>
                <h3 >{{number_format($totalProductsSold , 2 , '.' , ',')}}</h3>
                <small class="opacity-75">إجمالي المنتجات المباعه للشهر الحالي</small>
                
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header border-0 bg-white">
                <h5 class="fw-bold mb-0 d-flex align-items-center">
                    <i class="fas fa-chart-area text-primary me-2"></i>
                    مبيعات الشهر الحالي
                </h5>
            </div>
            <div class="card-body">
                <canvas id="salesChart" height="100"></canvas>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header border-0 bg-white">
                <h5 class="fw-bold mb-0 d-flex align-items-center">
                    <i class="fas fa-chart-pie text-warning me-2"></i>
                    توزيع المنتجات للشهر الحالي 
                </h5>
            </div>
            <div class="card-body">
                <canvas id="productChart" height="200"></canvas>
            </div>
        </div>
    </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', function () {
    const salesLabels = @json($monthlySales['labels']);
    const salesData = @json($monthlySales['data']);
    new Chart(document.getElementById('salesChart').getContext('2d'), {
        type: 'line',
        data: {
            labels: salesLabels,
            datasets: [{
                label: 'المبيعات اليومية',
                data: salesData,
                borderColor: 'rgb(102, 126, 234)',
                backgroundColor: 'rgba(102, 126, 234, 0.1)',
                tension: 0.4,
                fill: true
            }]
        },
        options: { responsive: true, plugins: { legend: { display: false } } }
    });

     // Product Distribution Chart
    const productLabels = @json($productDistributionsCharts['labels']);
    const productData = @json($productDistributionsCharts['data']);
    const productCtx = document.getElementById('productChart').getContext('2d');

    const colorPalette = [
        // '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF',
        // '#FF9F40', '#00C49F', '#FF6F61', '#845EC2', '#2C73D2',
        // '#D65DB1', '#FF9671', '#FFC75F', '#F9F871', '#0081CF',
        '#00C2A8', '#FF8066', '#B39CD0', '#F6A6FF', '#FFB6B9'
    ];
    new Chart(productCtx, {
        type: 'doughnut',
        data: {
            labels: productLabels,
            datasets: [{
                data: productData,
                backgroundColor: colorPalette,
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 20,
                        usePointStyle: true
                    }
                }
            }
        }
    });
});
</script>