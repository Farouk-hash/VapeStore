<?php

namespace App\Livewire\DevicesBrands;

use Livewire\Attributes\On;
use Livewire\Component;

class Index extends Component
{
    public $showCreateBrandForm , $showBrandsDetails , $editBrandForm = false ;
    public $brandId , $slug ; 
    
    public function mount(){
    }

    public function toggleCreateOrBack()
    {
        // If currently editing, go back to details
        if ($this->editBrandForm) {
            $this->editBrandForm = false;
            $this->showBrandsDetails = false;
            $this->showCreateBrandForm = false;
            return;
        }

        // If showing details, go back to list
        if ($this->showBrandsDetails) {
            $this->showBrandsDetails = false;
            $this->showCreateBrandForm = false;
            return;
        }

        // If creating brand, go back to list
        if ($this->showCreateBrandForm) {
            $this->showCreateBrandForm = false;
            return;
        }

        // Default → show create form
        $this->showCreateBrandForm = true;
    }

    #[On('editBrandForm')]
    public function showEditBrandForm($id){
        $this->editBrandForm = true ; 
        $this->brandId = $id;
    }
    #[On('editingDone')]
    public function editingDone(){
        $this->editBrandForm=false ; 
    }
    public function render()
    {
        return view('livewire.devices-brands.index');
    }
}
