@extends('dashboard.layouts.master')

@section('css')

<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
    }
    
    .bg-gradient-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    
    .bg-gradient-success {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    }
    
    .bg-gradient-info {
        background: linear-gradient(135deg, #17a2b8 0%, #007bff 100%);
    }
    
    .bg-gradient-warning {
        background: linear-gradient(135deg, #ffc107 0%, #fd7e14 100%);
    }
    
    .hover-bg-white-10:hover {
        background-color: rgba(255, 255, 255, 0.1) !important;
    }
    
    .transition-all {
        transition: all 0.3s ease;
    }
    
    .fade-in-right {
        animation: fadeInRight 0.5s ease-out;
    }
    
    @keyframes fadeInRight {
        from {
            opacity: 0;
            transform: translateX(30px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
    
    .rounded-lg {
        border-radius: 0.75rem;
    }
    
    .shadow-lg {
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }
    
    .card {
        border-radius: 15px;
    }
    
    .table th {
        border-top: none;
    }
    
    .nav-pills .nav-link {
        color: rgba(255, 255, 255, 0.8);
    }
    
    .nav-pills .nav-link.active {
        color: #667eea !important;
    }
    .form-select {
    appearance: none; 
    background: #f8f9fa;
    color: #333;
    border: 1px solid #ccc;
    border-radius: 0.5rem;
    padding: 0.5rem 1rem;
    font-size: 1rem;
    cursor: pointer;
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
}

.form-select:focus {
    outline: none;
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.2);
}

.form-select option {
    background: #fff;
    color: #333;
}

</style>

@endsection

@section('content')
    <div>
        @livewire('Reports.reports-page')
    </div>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

     
<script>
   
    // Print function
    window.addEventListener('print-report', function() {
        window.print();
    });
</script>
@endsection
