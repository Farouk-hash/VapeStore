<?php

namespace App\Livewire\DevicesBrands\ItemsDetails;

use App\Models\Cartidges\Cartidge;
use App\Models\Coils\CoilSeries;
use App\Models\Hardware\DeviceBrands;
use App\Models\Hardware\Devices;
use App\Models\Hardware\DevicesCategories;
use App\Models\Tanks\Tanks;
use Livewire\Attributes\On;
use Livewire\Component;

class Index extends Component
{
    
    public $showDeviceFormVariable = false , $showEditForm = false , $showInventoryForm = false , $showDetails=false ; 
    public $brand , $devices  , $brandId , $statistics=[] , $tanksStyleCounts=[] , $coilVapingStyles=[] , $cartridgeVapingStyles=[]; 
    public  $id , $itemId , $slug ; 

    public function mount($itemId , $slug=null){
        $this->itemId = $itemId ;
        $this->slug = $slug;
        $this->initializeItems($itemId , $slug);
    }
    private function initializeItems($itemId , $slug){
        // slug == null -> all devices associated with brand-id ; 
        // slug !== null -> all devices associated with brand-id , category-id ; 
        $this->slug = $slug;
        $this->brandId = $itemId;
        if($slug){
            if(in_array($this->slug,['pod-system','disposable','box-mod','kits','pod-mod'])){
                $query = Devices::with(['brand','category'])->where('brand_id',$itemId);
                $itemStatics = 'devices';
            }elseif($this->slug=='tanks'){
                $query = Tanks::with(['brand','category'])->where('brand_id',$itemId);
                $itemStatics = 'tanks';
                $this->tanksStyleCounts = Tanks::countByBrandAndStyle(brandId: $itemId);

            }elseif($this->slug == 'coils-pods'){
                $query = CoilSeries::with(['brand','category'])->where('brand_id',$itemId);
                $itemStatics = 'coils';
                $this->coilVapingStyles = CoilSeries::countByBrandAndStyle($itemId);

            }elseif($this->slug == 'cartridges'){
                $query = Cartidge::with(['brand','category'])->where('brand_id',$itemId);
                $itemStatics = 'cartridges';
                $this->cartridgeVapingStyles = Cartidge::countByBrandAndStyle($itemId);
            }
            $slugId = DevicesCategories::where('slug',$slug)->value('id');
            $this->devices = $query->where('category_id',$slugId)->get();
            // dd($styleCounts);
            $this->loadStatistics($itemStatics);
            // dd($this->statistics);
        }
        else{
            $this->devices = collect()
                ->merge(Devices::with(['brand','category'])->where('brand_id', $itemId)->get())
                ->merge(Tanks::with(['brand','category'])->where('brand_id', $itemId)->get())
                ->merge(CoilSeries::with(['brand','category'])->where('brand_id', $itemId)->get())
                ->merge(Cartidge::with(['brand','category'])->where('brand_id', $itemId)->get());
        }
    }
    private function loadStatistics($item){
        $items = [
            'tanks'=>[
                ['label'=>'الألوان المتاحة', 'value'=>$this->devices->flatMap->colors->count()] ,
                ['label'=>'DL','value'=>$this->tanksStyleCounts['dl'] ?? 0] , 
                ['label'=>'RDL' , 'value'=>$this->tanksStyleCounts['rdl'] ?? 0],
            ],
            'coils'=>[
                ['label'=> 'المقاومات المتاحه', 'value'=> $this->devices->flatMap->coilsOhms->count()] ,
                ['label'=>'DL','value'=>$this->coilVapingStyles['dl'] ?? 0] , 
                ['label'=>'RDL' , 'value'=>$this->coilVapingStyles['rdl'] ?? 0],
                ['label'=>'MTL' , 'value'=>$this->coilVapingStyles['mtl'] ?? 0],

            ],
            'cartridges'=>[
                ['label'=>'المقاومات المتاحه' , 'value'=>$this->devices->flatMap->variants->count() ], 
                ['label'=>'قابلة لإعادة التعبئة','value'=>$this->cartridgeVapingStyles['refillable'] ?? 0] , 
                ['label'=>'مملوءة مسبقًا' , 'value'=>$this->cartridgeVapingStyles['prefilled'] ?? 0],
                ['label'=>'يمكن التخلص منه' , 'value'=>$this->cartridgeVapingStyles['disposable'] ?? 0],
            ],
            'devices'=>[
                ['label'=>'الالوان المتاحه','value'=>$this->devices->flatMap->colors->count()]  , 
                ['label'=>'المميزات المتاحه','value'=>$this->devices->flatMap->features->count()] ,
                ['label'=>'النكهات المتاحه' , 'value'=> $this->devices->flatMap->flavors->count()]
            ]
            ];
        $this->statistics = $items[$item] ;
    }

    #[On('cancelForm')]
    public function cancelDeviceForm(){
        $this->showDeviceFormVariable = false ;
        // dd($this->slug , $this->itemId);
        // $this->initializeItems($this->itemId , $this->slug);
    }

    public function edit($id){
        $this->showEditForm = true ; 
        $this->id = $id ; 
    }
    #[On('editFormCancelled')]
    public function editFormCancelled(){
        $this->showEditForm=false ; 
    }
    public function getDetails($id){
        // dd($id);
        $this->id = $id ; 
        $this->showDetails = true ; 
    }
    #[On('hideDetails')]
    public function hideDetails(){
        $this->showDetails=false ; 
    }
    public function inventory($id){
        $this->id = $id ; 
        $this->showInventoryForm = true ; 
    }
    #[On('cancelDetails')]
    public function cancelDetails(){
        $this->showInventoryForm=false ; 
    }
    public function render()
    {
        return view('livewire.devices-brands.items-details.index');
    }

}
