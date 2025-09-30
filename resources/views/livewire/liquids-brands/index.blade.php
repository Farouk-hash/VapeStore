<div>

    <div class="mb-4">
        <button class="btn btn-success btn-lg px-4 shadow-sm" wire:click="toggleCreateOrBack">
            <i class="fas fa-eye me-2"></i>
            {{
                $editBrandForm
                    ? 'رجوع'
                    : ($showBrandsDetails
                        ? 'رجوع'
                        : ($showCreateBrandForm
                            ? 'عرض البيانات'
                            : 'انشاء'))
            }}
        </button>
    </div>

    @if($editBrandForm)
        @livewire('liquids-brands.brands-edit-form',[$brandId])
    @elseif($showCreateBrandForm)
        @livewire('liquids-brands.brands-create-form')
    @else
        @livewire('liquids-brands.brands-show')
    @endif

</div>
