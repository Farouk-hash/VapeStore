<?php

namespace App\Livewire\GroupInventories;

use App\Models\Hardware\DeviceInventories;
use App\Models\Vape\LiquidNicStrength;
use Exception;
use Livewire\Attributes\On;
use Livewire\Component;

class GroupInventories extends Component
{
    public $showCreateForm = false , $showGroupInventoryDetails=false , $groupId  ; 
    public function mount($forceDetails=null){
        // CAME FROM GET-GROUP-INVENTORY-DETAILS WHICH CAME FROM BILLS-DETAILS , CUSTOMERS-BILLS-DETAILS , EMPLOYEE-BILLS-DETAILS ;
        if ($forceDetails !== null) {
            $this->showGroupInventoryDetails = true; 
            $this->showCreateForm = true ; 
            $this->groupId = (int) $forceDetails; 
        }
    }
 
    public function toggleCreateOrBack()
    {
        if ($this->showGroupInventoryDetails) {
            // If currently showing details → back to main list
            $this->showGroupInventoryDetails = false;
            $this->showCreateForm = false;
        } elseif ($this->showCreateForm) {
            // If currently in create form → back to main list
            $this->showCreateForm = false;
        } else {
            // Otherwise → go to create form
            $this->showCreateForm = true;
        }
    }
    
    #[On('groupDetails')]
    public function groupDetails(int $groupId){
        $this->showGroupInventoryDetails=true ;
        !$this->showCreateForm=true ;  
        $this->groupId = $groupId ; 
    }

    #[On('creation_done')]
    public function creation_done(){
        $this->showCreateForm=false ; 
    }
    
    public function render()
    {
        return view('livewire.group-inventories.group-inventories');
    }
}
