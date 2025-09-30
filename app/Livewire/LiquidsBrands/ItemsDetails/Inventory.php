<?php

namespace App\Livewire\LiquidsBrands\ItemsDetails;

use App\Models\Vape\Flavour;
use App\Models\Vape\LiquidInventory;
use App\Models\Vape\LiquidNicStrength;
use Livewire\Component;

class Inventory extends Component
{
    public $flavour , $strengthNic=[] , $inventoryArray=[] , $successMessage = null ;
    public function mount($id){
        $this->flavour = Flavour::where('id' , $id)->first(); 
    }

    public function getdNicStrenghts($id){
        $this->strengthNic = LiquidNicStrength::where('liquid_id',$id)->get();
        $this->reset('inventoryArray', 'successMessage');
        foreach ($this->strengthNic as $strength) {
            $this->inventoryArray[] = [
                'strength_id'   => $strength->id,   // store nicotine strength id
                'stock_quantity'=> 1,
                'base_price'    => 0,
                'batch_code'    => '',
                'expiry_date'   => '',
            ];
        }
    }
    public function cancel(){
        $this->dispatch('cancelInventory');
    }
    public function submit(){
        if(count($this->inventoryArray) == 0) return ;
        foreach($this->inventoryArray as $index => $details){
            if($details['stock_quantity']==0 || $details['base_price'] <= 0) continue ;

            LiquidInventory::create(['liquid_nic_strength_id'=>$details['strength_id'] , 
            'stock_received'=>$details['stock_quantity'] , 'base_price'=>$details['base_price'] , 
            'received_at'=>now(),
            'displayed_at'=>now(), // can be changed to be customized;
            // 'expiry_date'=>$details['expiry_date'] ,
            //  'batch_code'=>$details['batch_code'] , 
            ]);

        }
        $this->reset('inventoryArray' , 'strengthNic');
        $this->successMessage = 'تمت اضافه المخزون بنجاح';
    }
    public function render()
    {
        return view('livewire.liquids-brands.items-details.inventory');
    }
}
