<?php
namespace App\Traits;

trait GetItemDetails{
    public  $inventory=false ,$additionalInformations=false  , $activeImageIndex = 0;
    public $itemAttributes=[] , $buttons ;
    // INITALIZE BUTTONS ; 
    public function getItemAttributes($itemType){
        $items = [
            'devices'=> [
            'attributes'=>[
                'colors','features','flavors','specifications','additionalInformations','inventory','puffs'
            ],
            'buttons'=>[
                ['label'=>'"colors"','icon'=>'fas fa-palette','span'=>'الألوان'],
                ['label'=>'"features"','icon'=>'fas fa-star','span'=>'المميزات'],
                ['label'=>'"flavors"','icon'=>'fas fa-ice-cream','span'=>'الأطعم'],
                ['label'=>'"specifications"','icon'=>'fas fa-cogs','span'=>'التقنية'],
                ['label'=>'"additionalInformations"','icon'=>'fas fa-info-circle','span'=>'المعلومات'],
                ['label'=>'"inventory"','icon'=>'fas fa-boxes','span'=>'المخزون'],

            ]
        ],

        'tanks'=>[
            'attributes'=>[
                'colors','inventory','additionalInformations','specifications'
            ],
            'buttons'=>[
                ['label'=>'"colors"','icon'=>'fas fa-palette','span'=>'الألوان'],
                ['label'=>'"additionalInformations"','icon'=>'fas fa-info-circle','span'=>'المعلومات'],
                ['label'=>'"inventory"','icon'=>'fas fa-boxes','span'=>'المخزون'],
                ['label'=>'"specifications"','icon'=>'fas fa-cogs','span'=>'التقنية'],
            ]
        ],

        'coils'=>[
            'attributes'=>[
                'coilsOhms','inventory','additionalInformations'
            ],
            'buttons'=>[
                ['label'=>'"coilsOhms"','icon'=>'fas fa-bolt','span'=>'المقاومات'],
                ['label'=>'"additionalInformations"','icon'=>'fas fa-info-circle','span'=>'المعلومات'],
                ['label'=>'"inventory"','icon'=>'fas fa-boxes','span'=>'المخزون'],
            ]
        ],

        'cartridges'=>[
            'attributes'=>[
                'variants','inventory','additionalInformations'
            ],
            'buttons'=>[
                ['label'=>'"variants"','icon'=>'fas fa-clone','span'=>'المقاومات'],
                ['label'=>'"additionalInformations"','icon'=>'fas fa-info-circle','span'=>'المعلومات'],
                ['label'=>'"inventory"','icon'=>'fas fa-boxes','span'=>'المخزون'],
            ]
            ],
        ];

        return $items[$itemType];
    }

    public function getViewsMapping()
    {
        return [
            'colors' => 'livewire.devices-brands.partials.details.colors',
            'features' => 'livewire.devices-brands.partials.details.features',
            'flavors' => 'livewire.devices-brands.partials.details.flavors',
            'specifications' => 'livewire.devices-brands.partials.details.specifications',
            'additionalInformations' => 'livewire.devices-brands.partials.details.additionalInformations',
            'puffs' => 'livewire.devices-brands.partials.details.puffs',
            'coilsOhms' => 'livewire.devices-brands.partials.details.coilsOhms',
            'variants' => 'livewire.devices-brands.partials.details.cartridgeVariants',
            'inventory' =>'livewire.devices-brands.partials.details.inventories',
        ];
    }

    
    public function loadAttributes($itemType , $category_id=null){
        $attributs =  $this->getItemAttributes($itemType);
        $this->itemAttributes = $attributs['attributes'];
        $this->buttons = $attributs['buttons'];
        if($category_id===2){
             $extraButton = [
                [
                    'label' => '"puffs"',
                    'icon'  => 'fas fa-smoking',
                    'span'  => 'البافات'
                ]
            ];
            $this->buttons = array_merge($this->buttons, $extraButton);
        }

    }
  
    public function showDetails($value){
        // dd($value);
        $this->reset($this->itemAttributes);
        foreach($this->itemAttributes as $attr){
            if($attr === $value){
                $this->{$value}=true ; 
                return ;
            }
        }
    }
    public function setActiveImage($index){
        $this->activeImageIndex = $index ; 
    }
    public function cancel(){
        $this->dispatch('hideDetails');
    }
}