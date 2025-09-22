<div class="row g-4">
    <!-- Date Filter -->
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="row g-3 align-items-end">
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">من تاريخ</label>
                        <input type="date" class="form-control" value="2024-09-01">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">إلى تاريخ</label>
                        <input type="date" class="form-control" value="2024-09-13">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">نوع التقرير</label>
                        <select class="form-select">
                            <option value="daily">يومي</option>
                            <option value="weekly">أسبوعي</option>
                            <option value="monthly" selected>شهري</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button class="btn btn-primary w-100">
                            <i class="fas fa-search me-2"></i>إنشاء التقرير
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sales Table -->
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-header border-0 bg-light">
                <h5 class="fw-bold mb-0 d-flex align-items-center">
                    <i class="fas fa-table text-primary me-2"></i>
                    تفاصيل المبيعات
                </h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="fw-bold text-dark">#</th>
                                <th class="fw-bold text-dark">التاريخ</th>
                                <th class="fw-bold text-dark">رقم الطلب</th>
                                <th class="fw-bold text-dark">العميل</th>
                                <th class="fw-bold text-dark">المبلغ</th>
                                <th class="fw-bold text-dark">الحالة</th>
                                <th class="fw-bold text-dark">العمليات</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>2024-09-13</td>
                                <td><span class="badge bg-primary">#ORD-2024-001</span></td>
                                <td>أحمد محمد علي</td>
                                <td >1,250.00</td>
                                <td><span class="badge bg-success">مكتمل</span></td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>2024-09-12</td>
                                <td><span class="badge bg-primary">#ORD-2024-002</span></td>
                                <td>فاطمة سالم</td>
                                <td >850.75</td>
                                <td><span class="badge bg-success">مكتمل</span></td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>2024-09-12</td>
                                <td><span class="badge bg-primary">#ORD-2024-003</span></td>
                                <td>محمود حسين</td>
                                <td >2,100.00</td>
                                <td><span class="badge bg-success">مكتمل</span></td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>2024-09-11</td>
                                <td><span class="badge bg-primary">#ORD-2024-004</span></td>
                                <td>سارة أحمد</td>
                                <td >675.50</td>
                                <td><span class="badge bg-success">مكتمل</span></td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>2024-09-11</td>
                                <td><span class="badge bg-primary">#ORD-2024-005</span></td>
                                <td>عمر الشريف</td>
                                <td >1,480.25</td>
                                <td><span class="badge bg-success">مكتمل</span></td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>