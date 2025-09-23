


<!-- row opened -->
<div class="row row-sm">
    <div class="col-xl-12">
        <div class="card">

            
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title mg-b-0">قائمة العملاء</h4>
                    <i class="mdi mdi-dots-horizontal text-gray"></i>
                </div>
                <p class="tx-12 tx-gray-500 mb-2">
                    هذا الجدول يعرض جميع ماركات التانكات المرتبطة مع تفاصيل الدولة، الموقع الإلكتروني والوصف.
                </p>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table text-md-nowrap" id="example1">
                        <thead>
                            <tr>
                                <th class="wd-20p border-bottom-0">الاسم</th>
                                <th class="wd-15p border-bottom-0">الايميل</th>
                                <th class="wd-15p border-bottom-0">رقم الهاتف</th>

                                <th class="wd-15p border-bottom-0">انشاء بواسطه</th>
                                <th class="wd-15p border-bottom-0">عدد عمليات البيع</th>

                                <th class="wd-20p border-bottom-0">الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($customers as $customer)
                                <tr>
                                    <td>{{ $customer->name }}</td>
                                    <td>{{ $customer->email ?? '--' }}</td>
                                    <td>{{ $customer->phone }}</td>
                                    <td>{{ $customer->created_by->name }}</td>

                                    <td style='color: {{$customer->bills->count() != 0 ? "green" : "red"}};'>{{ $customer->bills->count() }}</td>

                                    <td>
                                        
                                        <button class="btn btn-success" type='button' wire:click="showCustomersProfile({{$customer->id}})">
                                            <i class="las la-eye"></i> عرض التفاصيل
                                        </button>
                                        
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
