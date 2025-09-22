@extends('dashboard.layouts.master')

@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('dashboard/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('dashboard/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('dashboard/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('dashboard/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('dashboard/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('dashboard/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection

@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <h4 class="content-title mb-0">إدارة الفواتير</h4>
</div>
<!-- breadcrumb -->
@endsection

@section('content')
<!-- row opened -->
<div class="row row-sm">
    <div class="col-xl-12">
        <div class="card">

            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    {{-- <a 
                    href="{{ route('employee.create') }}" 
                       class="btn btn-primary" role="button" aria-pressed="true">
                        إضافة موظف جديد
                    </a> --}}

                    <button type="button"
                            class="btn btn-secondary pd-x-30 mg-r-5 mg-t-5"
                            onclick="window.history.back();">
                        رجوع
                    </button>
                </div>
            </div>

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
                                <th class="wd-15p border-bottom-0">إجمالي السعر</th>
                                <th class="wd-10p border-bottom-0">هل تحتوي خصم؟</th>
                                <th class="wd-15p border-bottom-0">العميل</th>
                                <th class="wd-15p border-bottom-0">البائع</th>
                                
                                <th class="wd-10p border-bottom-0">عدد العناصر الكليه</th>
                                <th class="wd-10p border-bottom-0">عدد العروض</th>

                                <th class="wd-15p border-bottom-0">التاريخ</th>
                                <th class="wd-15p border-bottom-0">الاجراءات</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($bills as $bill)
                                <tr>
                                    <td>{{ $bill['total_price'] }}</td>
                                    <td>{{ $bill['has_discount']  }}</td>
                                    <td>{{ $bill['customer']  }}</td>
                                    <td>{{ $bill['seller']  }}</td>
                                    <td>{{ $bill['total_items']  }}</td>
                                    <td>{{ $bill['total_group_items']  }}</td>

                                    <td>{{ date_format( $bill['created_by'] , "Y/m/d")}}</td>

                                    <td>
                                        <a class="btn btn-success btn-sm py-1 px-2" role="button" aria-pressed="true" 
                                        href="{{ route('bills.show', $bill['id']) }}">
                                            <i class="las la-eye"></i> عرض التفاصيل
                                        </a>
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
@endsection

@section('js')
<!-- Internal Data tables -->
<script src="{{URL::asset('dashboard/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/datatable/js/jquery.dataTables.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/datatable/js/jszip.min.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/datatable/js/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/datatable/js/vfs_fonts.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/datatable/js/buttons.print.min.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
<!--Internal  Datatable js -->
<script src="{{URL::asset('dashboard/js/table-data.js')}}"></script>
@endsection
