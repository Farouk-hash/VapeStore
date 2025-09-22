


<!-- row opened -->
<div class="row row-sm">
    <div class="col-xl-12">
        <div class="card">

    
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title mg-b-0">قائمة الموظفين</h4>
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
                                <th class="wd-15p border-bottom-0">الرقم القومي</th>
                                <th class="wd-15p border-bottom-0">مفعل</th>

                                <th class="wd-15p border-bottom-0">الادمن</th>
                                <th class="wd-20p border-bottom-0">الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($salesPersons as $salesPerson)
                                <tr>
                                    <td>{{ $salesPerson->name }}</td>
                                    <td>{{ $salesPerson->email }}</td>
                                    <td>{{ $salesPerson->phone }}</td>
                                    <td>{{ $salesPerson->nationalID }}</td>
                                    <td style='color: {{$salesPerson->account_active == 1 ? "green" : "red"}};'>{{ $salesPerson->account_active == 0 ? 'غير مفعل' : 'مفعل' }}</td>

                                    <td>{{ $salesPerson->admin->name }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-primary dropdown-toggle" 
                                                    type="button" id="dropdownMenuButton{{ $salesPerson->id }}" 
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                الإجراءات
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $salesPerson->id }}">
                                               
                                                
                                                <button type="button" wire:click="changeActivation({{$salesPerson->id}})" class="dropdown-item text-danger">
                                                    <i class="las la-trash"></i> تعديل التفعيل
                                                </button>


                                                <button type="button" wire:click="showProfile({{$salesPerson->id}})" class="dropdown-item text-success">
                                                    <i class="las la-eye"></i> عرض التفاصيل
                                                </button>
                                                
                                            </div>
                                        </div>
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

