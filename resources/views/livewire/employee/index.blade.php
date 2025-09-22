@extends('dashboard.layouts.master')

@section('css')
<!--- Internal Select2 css-->
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
<style>
    .employment-history-section {
        display: none;
        margin-top: 20px;
        padding: 20px;
        border: 2px dashed #ddd;
        border-radius: 5px;
        background-color: #f9f9f9;
    }
    .employment-history-item {
        background: white;
        padding: 15px;
        margin-bottom: 15px;
        border-radius: 5px;
        border: 1px solid #eee;
    }
    .employment-history-item .row {
        margin-bottom: 15px;
    }
</style>
@endsection


@section('content')
    <div>
        @livewire('employee.employee')
    </div>

@endsection

@section('js')

@endsection