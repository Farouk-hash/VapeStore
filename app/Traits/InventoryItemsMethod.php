<?php 
namespace App\Traits;

use App\Models\Hardware\DeviceColors;
use App\Models\Hardware\DeviceFlavors;
use App\Models\Hardware\DeviceInventories;
use Exception;
use Illuminate\Support\Facades\DB;

trait InventoryItemsMethod
{
    public $inventories = [] , $pk , $sk , $sk2 , $itemType;

    public function getInventoryAttribute(){
        return [
            'devices'=>['pk'=>'device_id','sk'=>'device_color_id' , 'sk2'=>'device_flavor_id'],
            'tanks'=>['pk'=>'tank_id','sk'=>'tank_color_id'],
            'coils'=>['pk'=>'coil_series_id','sk'=>'coil_id'],
            'cartridges'=>['pk'=>'cartridge_id','sk'=>'cartridge_variant_id']
        ];
    }

    public function initializeInventory($itemType){
        $attributes = $this->getInventoryAttribute()[$itemType];
        $this->pk = $attributes['pk'];
        $this->sk = $attributes['sk'];
        if($itemType === 'devices'){
            $this->sk2 = $attributes['sk2'];
        }
        $this->itemType = $itemType;
        $this->initializeInventoryArray();
    }
   private function initializeInventoryArray()
    {
        $item = [
            'stock_quantity' => 1, 
            'base_price' => 1, 
            'batch_number' => 1, 
            'displayed_at'=>now(),
            $this->pk => $this->device->id, 
            $this->sk => null, 
        ];
        
        if ($this->itemType === 'devices') {
            $item[$this->sk2] = null;
        }

        $this->inventories[] = $item; // Push once
    }
    public function addMoreItem(){
        $this->initializeInventoryArray();
    }   
    
    public function remove($index){
        unset($this->inventories[$index]);
    }
  
    public function submit(){
        // dd($this->inventories);
        try{
            DB::transaction(function(){
                foreach($this->inventories as $inventory){
                    // dd($inventory);
                    if(isset($inventory['device_flavor_id'])){
                        $inventory['device_flavor_id'] = DeviceFlavors::where('device_id',$this->device->id)
                        ->where('component_id',$inventory['device_flavor_id'])->value('id');
                    }
                    // dd($inventory);
                    DeviceInventories::create($inventory);
                }
            });
            // session()->flash('success', 'Device inventories successfully');
            $this->dispatch('cancelDetails'); 
        }catch(Exception $e){
            dd($e->getMessage());
        }
        
      
    }


    public function cancel(){
        $this->dispatch('cancelDetails');
    }

}