<?php

namespace App\Livewire\DevicesBrands\CoilsDetails;

use App\Models\Coils\CoilSeries;
use App\Traits\GetItemDetails;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Details extends Component
{
    use GetItemDetails;
    public $coilsOhms=false ,$device; 
    public function mount($id){
        $this->device = CoilSeries::with(['coilsOhms','brand','category','images'])
        ->where('id',$id)->first();
        // dd(
        //    DB::table('device_inventories')->whereNotNull('coil_series_id')->get()
        // );
        $this->loadAttributes('coils');
    }
    public function render()
    {
        return view('livewire.devices-brands.coils-details.details');
    }
}
