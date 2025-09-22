<?php

namespace App\Livewire\sales;

use App\Models\Coils\CoilSeries;
use App\Models\Hardware\DeviceBrands;
use App\Models\Hardware\DeviceInventories;
use Livewire\Attributes\On;
use Livewire\Component;

class CoilsSelector extends Component
{
    public $selectedBrand , $selectedCoilSeries ;
    public $brands=[],$coilSeries=[],$selectedCoilSeriesInventories=[],$quantities=[];
    public function mount(){
        $this->brands=DeviceBrands::has('coils')->get();
    }

    public function onBrandChanged(){
        $this->coilSeries = CoilSeries::where('brand_id',$this->selectedBrand)->get();
    }
    public function onCoilSeriesChanged(){
        $this->selectedCoilSeriesInventories  = DeviceInventories::groupedByid('coil_series_id','coil_id',$this->selectedCoilSeries);
    }

    public function updatedQuantities($value , $key){
        $deviceInventoryId = explode('_',$key)[1];
        $coilSeriesId = explode('_',$key)[0];
        $coilId = explode('_',$key)[2];
        if($deviceInventoryId){
            // Get base price for this strength
            $coilDetails = DeviceInventories::where('coil_series_id', $coilSeriesId)
            ->where('coil_id',$coilId)
            ->where('status', 'in_stock')
            ->get(['base_price','stock_quantity']);
            $basePrice = $coilDetails->first()->base_price;
            $total_quantity = $coilDetails->sum('stock_quantity');
     
            // Convert existing quantities to collection if it's not already
            $existingQuantities = collect($this->quantities);
            
            // Update or add the new quantity data
            $this->quantities = $existingQuantities->put($deviceInventoryId, [
                'id'=>$deviceInventoryId ,
                'quantity'    => $value > $total_quantity ? 0 : $value,
                'base_price'  => $basePrice,
                'total_quantity'=>$total_quantity,
                'total_price_per_item' => $basePrice * $value,
                'source' => 'coils' ,
            ])->toArray();
        }
        $this->dispatch('itemAdded', $this->quantities);
    }

    #[On('resetQuantities')]
    public function resetQuantities(){
        $this->reset('quantities','coilSeries','selectedCoilSeriesInventories');
    }
    public function render()
    {
        return view('livewire.sales.coils-selector');
    }
}
