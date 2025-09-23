@extends('dashboard.layouts.master')

@section('css')

@endsection


@section('content')
    <div>
        @livewire('customers.index',[$forceDetails])
    </div>

@endsection

@section('js')

@endsection