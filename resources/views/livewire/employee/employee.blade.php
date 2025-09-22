@section('css')
    @stack('styles')
@endsection

<div>
    <div class="mb-4">
        <button class="btn btn-success btn-lg px-4 shadow-sm" wire:click="toggleCreateOrBack">
            <i class="fas fa-eye me-2"></i> {{
            $showCreateForm ? ($showEmployeeProfile ? 'رجوع' : 'عرض البيانات') : 'انشاء';}}
        </button>
    </div>

    @if($showEmployeeProfile)
        @livewire('employee.employee-profile' , [$employeeId])
    @elseif($showCreateForm)
        @livewire('employee.employee-create-form')
    @else
        @livewire('employee.employee-index')
    @endif

</div>

@stack('scripts')

