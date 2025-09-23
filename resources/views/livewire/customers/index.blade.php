<div>
    @if($showCustomersProfile)
    
        <div class="mb-4">
            <button class="btn btn-success btn-lg px-4 shadow-sm" wire:click="$set('showCustomersProfile',false)">
                <i class="fas fa-eye me-2"></i>  رجوع 
            </button>
        </div>
    @endif

    @if($showCustomersProfile)
        @livewire('customers.details' , [$customerId]);
    @else 
        @livewire('customers.show')
    @endif

</div>
