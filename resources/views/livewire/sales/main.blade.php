@extends('dashboard.layouts.master')

@section('css')

<style>
.bg-gradient-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.bg-gradient-info {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.bg-gradient-warning {
    background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
}

.bg-gradient-success {
    background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
}

.transition-all {
    transition: all 0.3s ease;
}

.hover-bg-white-10:hover {
    background-color: rgba(255,255,255,0.1) !important;
}

.fade-in-right {
    animation: fadeInRight 0.5s ease-in-out;
}

@keyframes fadeInRight {
    from {
        opacity: 0;
        transform: translateX(20px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

.card {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
}

.rounded-lg {
    border-radius: 0.75rem !important;
}

.border-4 {
    border-width: 4px !important;
}

</style>

@endsection

@section('content')
    <div>
        @livewire('sales.sales-page')
    </div>
@endsection

@section('js')
@endsection
