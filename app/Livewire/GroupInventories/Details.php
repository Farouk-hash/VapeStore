<?php

namespace App\Livewire\GroupInventories;

use App\Models\GroupInventories\GroupInventory;
use Exception;
use Livewire\Attributes\On;
use Livewire\Component;

class Details extends Component
{
    public $groupDetails=[] , $group ;

                    
    public function mount($groupId){
        try{
            $this->group = GroupInventory::with(['details'])->findOrFail($groupId);
            $this->groupDetails = $this->group->details->map(function($detail) {
                    if($detail->source === 'liquids'){
                        $liquidDetails = $detail->liquidsInventory->nicStrength->liquid ;
                        $liquidFlavor = $liquidDetails->flavour->name ; 
                        $values = [
                            'source'=>$detail->source,                    
                            'name'=>"$liquidFlavor:$liquidDetails->nicotine_type-$liquidDetails->vape_style-$liquidDetails->bottle_size_ml  ml", 
                            'quantity'=>$detail->quantity,
                            'route'=>route('liquid.show',[$detail->liquidsInventory->nicStrength->liquid->id])
                        ];
                    }else{
                        $devicesDetails = $detail->devicesInventory->simpleDetails($detail->source);
                        $devieName = $devicesDetails['name'] ;
                        $values = [
                            'name'=>$devieName , 'quantity'=>$detail->quantity,'source'=>$detail->source , 
                            'route'=>route('devicesCategories.show',[
                            $devicesDetails['category'] , 
                            $devicesDetails['brand_id'] ,
                            $devicesDetails['bill_details_product_id'] ,
                            ])
                    ];
                    }
                    return $values ;
                });
        }
        catch(Exception $e){
            abort(404 , 'INVALID GROUP ID');
        }
    }
    public function render()
    {
        return view('livewire.group-inventories.details');
    }
}
