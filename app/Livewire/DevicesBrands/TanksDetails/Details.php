<?php

namespace App\Livewire\DevicesBrands\TanksDetails;

use App\Models\Tanks\Tanks;
use App\Traits\GetItemDetails;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Details extends Component
{
    use GetItemDetails;
    public $colors=false , $specifications=false ,$device, $forceDetails ; 
    public function mount($id, $forceDetails=null){
        $this->forceDetails=$forceDetails;
        $this->device = Tanks::with(['speces','colors','brand','category','images','inventories'])
        ->where('id',$id)->first();
        // dd($this->device->inventories , $this->device->id , $this->device->inventories()->getBindings());
        // dd(DB::table('device_inventories')->whereNotNull('tank_id')->get());
        // dd($this->device->inventories , $id);
        $this->loadAttributes('tanks');
    }
    
    
    public function render()
    {
        return view('livewire.devices-brands.tanks-details.details');
    }
}
