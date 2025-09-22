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
    <h4 class="content-title mb-0">إدارة ماركات التانكات</h4>
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
                    <a 
                    {{-- href="{{ route('tank-brands.create') }}"  --}}
                       class="btn btn-primary" role="button" aria-pressed="true">
                        إضافة ماركة تانك جديدة
                    </a>

                    <button type="button"
                            class="btn btn-secondary pd-x-30 mg-r-5 mg-t-5"
                            onclick="window.history.back();">
                        رجوع
                    </button>
                </div>
            </div>

            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title mg-b-0">قائمة ماركات التانكات</h4>
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
                                <th class="wd-15p border-bottom-0">الدولة</th>
                                <th class="wd-20p border-bottom-0">الموقع الإلكتروني</th>
                                <th class="wd-25p border-bottom-0">الوصف</th>
                                <th class="wd-25p border-bottom-0">عدد المنتجات</th>
                                <th class="wd-20p border-bottom-0">الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tankBrands as $tankBrand)
                                <tr>
                                    <td>{{ $tankBrand->name }}</td>
                                    <td>{{ $tankBrand->country }}</td>
                                    <td>
                                        @if($tankBrand->website)
                                            <a href="{{ $tankBrand->website }}" target="_blank">{{ $tankBrand->website }}</a>
                                        @else
                                            <span class="text-muted">—</span>
                                        @endif
                                    </td>
                                    <td>{{ substr($tankBrand->description, 0, 30)}}</td>
                                    <td>{{$tankBrand->tanks_count}}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-primary dropdown-toggle" 
                                                    type="button" id="dropdownMenuButton{{ $tankBrand->id }}" 
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                الإجراءات
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $tankBrand->id }}">
                                                <a class="dropdown-item modal-effect text-primary" 
                                                   {{-- href="{{ route('tank-brands.edit', $tankBrand->id) }}" --}}
                                                   >
                                                    <i class="las la-pen"></i> تعديل
                                                </a>

                                                <form 
                                                {{-- action="{{ route('tank-brands.destroy', $tankBrand->id) }}"  --}}
                                                      method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item text-danger">
                                                        <i class="las la-trash"></i> حذف
                                                    </button>
                                                </form>

                                                <a class="dropdown-item modal-effect text-info" 
                                                   href="{{ route('tanks.show', $tankBrand->id) }}"
                                                   >
                                                    <i class="las la-eye"></i> عرض التفاصيل
                                                </a>
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
