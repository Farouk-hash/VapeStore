<div>
    <div class="mb-4">
        <button class="btn btn-success btn-lg px-4 shadow-sm" wire:click="toggleCreateOrBack">
            <i class="fas fa-eye me-2"></i> {{
            $showCreateForm ? ($showGroupInventoryDetails ? 'رجوع' : 'عرض البيانات') : 'انشاء';}}
        </button>
    </div>
 
    @if($showGroupInventoryDetails)
        @livewire('group-inventories.details' , [$groupId])
    @elseif($showCreateForm)
        @livewire('group-inventories.form')
    @else
        @livewire('group-inventories.show')
    @endif

    
</div>
