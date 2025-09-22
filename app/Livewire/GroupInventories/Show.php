<?php

namespace App\Livewire\GroupInventories;

use App\Models\GroupInventories\GroupInventory;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Show extends Component
{
    public $groups = [] ; 
    public function mount(){
        $this->initalizeGroups();
    }
    public function changeActivation($groupId){
        GroupInventory::where('id', $groupId)->update(['valid' => DB::raw('NOT valid')]);
        $this->initalizeGroups();
    }
    public function deleteGroupInventory($groupId){
        // CHECK IF IT's Related To Bill ; 
        GroupInventory::where('id',$groupId)->delete();
        $this->initalizeGroups();
    }
    public function getGroupInventoryDetails(int $groupId){
        $this->dispatch('groupDetails' , $groupId);
    }
    protected function initalizeGroups(){
        $this->groups = GroupInventory::with(['details'])->get();
    }
    public function render()
    {
        return view('livewire.group-inventories.show');
    }
}
