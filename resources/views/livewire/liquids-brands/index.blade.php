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
    
    {{-- {{var_dump($editBrandForm , $showBrandsDetails , $showCreateBrandForm)}} --}}
    @if($editBrandForm)
        @livewire('liquids-brands.brands-edit-form',[$brandId])
    @elseif($showBrandsDetails)
        @livewire('liquids-brands.brands-details')
    @elseif($showCreateBrandForm)
        @livewire('liquids-brands.brands-create-form')
    @else
        @livewire('liquids-brands.brands-show')
    @endif

</div>
