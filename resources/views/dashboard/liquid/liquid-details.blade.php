@extends('dashboard.layouts.master')

@section('css')
<!--Internal Nice-select css-->
<link href="{{ URL::asset('dashboard/plugins/jquery-nice-select/css/nice-select.css') }}" rel="stylesheet"/>
<!-- Internal Select2 css -->
<link href="{{ URL::asset('dashboard/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection

@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <h4 class="content-title mb-0">تفاصيل السائل</h4>
</div>
<!-- breadcrumb -->
@endsection

@section('content')
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
        <div class="tab-pane active" id="pic-1">
            <img src="{{ URL::asset('dashboard/img/ecommerce/shirt-5.png') }}" alt="صورة السائل"/>
        </div>
        <div class="tab-pane" id="pic-2">
            <img src="{{ URL::asset('dashboard/img/ecommerce/shirt-2.png') }}" alt="صورة السائل"/>
        </div>
        <div class="tab-pane" id="pic-3">
            <img src="{{ URL::asset('dashboard/img/ecommerce/shirt-3.png') }}" alt="صورة السائل"/>
        </div>
        <div class="tab-pane" id="pic-4">
            <img src="{{ URL::asset('dashboard/img/ecommerce/shirt-4.png') }}" alt="صورة السائل"/>
        </div>
        <div class="tab-pane" id="pic-5">
            <img src="{{ URL::asset('dashboard/img/ecommerce/shirt-1.png') }}" alt="صورة السائل"/>
        </div>
    </div>

    <ul class="preview-thumbnail nav nav-tabs">
        <li class="active">
            <a data-target="#pic-1" data-toggle="tab">
                <img src="{{ URL::asset('dashboard/img/ecommerce/shirt-5.png') }}" alt="صورة السائل"/>
            </a>
        </li>
        <li>
            <a data-target="#pic-2" data-toggle="tab">
                <img src="{{ URL::asset('dashboard/img/ecommerce/shirt-2.png') }}" alt="صورة السائل"/>
            </a>
        </li>
        <li>
            <a data-target="#pic-3" data-toggle="tab">
                <img src="{{ URL::asset('dashboard/img/ecommerce/shirt-3.png') }}" alt="صورة السائل"/>
            </a>
        </li>
        <li>
            <a data-target="#pic-4" data-toggle="tab">
                <img src="{{ URL::asset('dashboard/img/ecommerce/shirt-4.png') }}" alt="صورة السائل"/>
            </a>
        </li>
        <li>
            <a data-target="#pic-5" data-toggle="tab">
                <img src="{{ URL::asset('dashboard/img/ecommerce/shirt-1.png') }}" alt="صورة السائل"/>
            </a>
        </li>
    </ul>

</div>


                    <!-- Right side: details -->
                    <div class="details col-xl-7 col-lg-12 col-md-12 mt-4 mt-xl-0">
                        <h4 class="product-title mb-1">{{ $liquid['flavour']['name'] }}</h4>
                        <p class="text-muted tx-13 mb-1">
                            النكهة: <strong>{{ $liquid['flavour']['name'] ?? 'غير متوفر' }}</strong>
                        </p>

                        <ul class="list-unstyled mb-3">
                            <li><strong>نوع النيكوتين:</strong> {{ $liquid['nicotine_type'] }}</li>
                            <li><strong>أسلوب الفيب:</strong> {{ $liquid['vape_style'] }}</li>
                            <li><strong>نسبة VG/PG:</strong> {{ $liquid['vg_pg_ratio'] }}</li>
                            <li><strong>حجم الزجاجة:</strong> {{ $liquid['bottle_size'] }}</li>
                        </ul>

                        <!-- Strengths -->
                        <h6 class="mt-4">التركيزات المتاحة:</h6>
                        @forelse($liquid['strengths'] as $strength)
                            <div class="mb-3 p-3 border rounded">
                                <h6 class="text-primary">{{ $strength['strength'] }} ملغ</h6>
                                
                                @if(!empty($strength['stocks']))
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
                                            @foreach($strength['stocks'] as $stock)
                                                <tr>
                                                    <td>{{ $stock['id'] }}</td>
                                                    <td>{{ $stock['stock_received'] }}</td>
                                                    <td>${{ number_format($stock['base_price'], 2) }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($stock['received_at'])->format('d M Y H:i') }}</td>
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

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /row -->
@endsection

@section('js')
<!-- Internal Select2.min js -->
<script src="{{ URL::asset('dashboard/plugins/select2/js/select2.min.js') }}"></script>
<script src="{{ URL::asset('dashboard/js/select2.js') }}"></script>
<!-- Internal Nice-select js-->
<script src="{{ URL::asset('dashboard/plugins/jquery-nice-select/js/jquery.nice-select.js') }}"></script>
<script src="{{ URL::asset('dashboard/plugins/jquery-nice-select/js/nice-select.js') }}"></script>
@endsection
