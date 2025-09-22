<?php

namespace App\Livewire\Reports;

use App\Models\Hardware\DeviceInventories;
use App\Models\Hardware\DevicesCategories;
use Livewire\Component;

class InventoryTap extends Component
{
    //low_stock
    public $categories=[] , $selectedCategory , $items ,$totalItemsCount , $totalItemsLowStock , $summationItems;
    public function mount(){
        $this->categories = DevicesCategories::get(['id','slug']); 
        $this->getItemsDetails();
    }
    protected function getItemsDetails($itemsWithCategory=null){
        $itemsWithoutDetails = !isset($itemsWithCategory) ? $this->handleAllInventoriesQuery()->get() : $itemsWithCategory;
        $this->items = $itemsWithoutDetails->map(function($item){
                $ids = json_decode($item->ids , true);
                $firstId = $ids[0];
                if(!$firstId)return null ; 
                $inventory = DeviceInventories::find($firstId);
                switch($item->source){
                    case 'coils':
                        return $inventory->coilSeriesDetails($item->status);
                    case 'tanks':
                        return $inventory->tankDetails();
                    case 'cartridges':
                        return $inventory->cartridgeDetails();
                    case 'devices':
                        return $inventory->deviceDetails();
                    default :
                        return ['id'=>$firstId];
                }
        });
        
        $this->totalItemsCount = count($this->items)  ; 
        $this->totalItemsLowStock = count($this->items->filter(function($item){
            return $item['status']==='low_stock';
        }));
        $this->summationItems = $this->items->sum(function($item){
            return (float)$item['quantities'] * (float)$item['base_price'];
        });
    }
    
    protected function handleAllInventoriesQuery($stockStatus = 'in_stock'){
        return DeviceInventories::selectRaw('
            SUM(stock_quantity) AS total_quantity,
            COALESCE(coil_series_id, cartridge_id, tank_id, device_id) AS main_id,
            COALESCE(coil_id, cartridge_variant_id, tank_color_id) AS sub_id,
            base_price,
            CASE
                WHEN coil_series_id IS NOT NULL THEN  "coils"
                WHEN cartridge_id IS NOT NULL THEN  "cartridges"
                WHEN tank_id IS NOT NULL THEN  "tanks"
                WHEN device_id IS NOT NULL THEN  "devices"
                ELSE "unknown"
            END AS source ,
            status ,
            JSON_ARRAYAGG(id) AS ids')
            ->whereIn('status',['in_stock','low_stock'])
            ->groupBy('main_id','sub_id','base_price','source','status');
    }

    protected function handleInventoriesQuery($pk , $sk=null , $soruce ){
        return DeviceInventories::whereNotNull($pk)
                ->when($soruce=='devices',function($query){
                    $query->whereHas('device',function($q){
                        $q->where('category_id',$this->selectedCategory);
                    });
                })
                ->selectRaw("
                    SUM(stock_quantity) AS total_quantity,
                    $pk
                    " . ($sk ? ", $sk" : "") . ",
                    base_price,
                    '$soruce' AS source , 
                    status ,
                    JSON_ARRAYAGG(id) AS ids
                ")
                ->groupBy(...array_filter([$pk, $sk, 'base_price','status']));
    }

    public function onCategoryChanged(){
        if(empty($this->selectedCategory)){
            $this->getItemsDetails();
        }
        // COILS ; 
        elseif($this->selectedCategory == 7){
            $itemsDetails = $this->handleInventoriesQuery('coil_series_id','coil_id' , 'coils')->get();
            $this->getItemsDetails($itemsDetails);
        }
        // CARTRIDGES ; 
        elseif($this->selectedCategory ==9){
            $itemsDetails = $this->handleInventoriesQuery('cartridge_id','cartridge_variant_id','cartridges')->get();
            $this->getItemsDetails($itemsDetails);

        }
        // TANKS ;
        elseif($this->selectedCategory ==6){
            $itemsDetails =  $this->handleInventoriesQuery('tank_id','tank_color_id','tanks')->get();
            $this->getItemsDetails($itemsDetails);
        }
        // DEVICES ; 
        elseif($this->selectedCategory ==8){
            dd('Accessories');
        }else{
            $itemsDetails =  $this->handleInventoriesQuery('device_id',null,'devices')->get();
            $this->getItemsDetails($itemsDetails);
        }
        // $totalItems = $items->count()?:count($items);
        // $totalItemsPrice = $items->sum(function($item){
        //     return $item->total_quantity * $item->base_price;
        // });
    }

    public function render()
    {
        return view('livewire.reports.inventory-tap');
    }
}
