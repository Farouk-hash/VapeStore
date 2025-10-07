<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FlavorsResource extends JsonResource
{
    protected $light = false ; 
    public function __construct($resource , $light=false){
        parent::__construct($resource);
        $this->light = $light;
    }

    public static function lightCollection($resource)
    {
        // Set light mode for each resource in the collection
        return $resource->map(function ($item) {
            return new static($item, true);
        });
    }

    public function toArray(Request $request): array
    {
        if ($this->light) {
            return [
                'id' => $this->id,
                'name' => $this->name,
            ];
        }

        // full resource 
        return [
            'id'=>$this->id ,
            'name'=>$this->name , 

            'brand_id'=>$this->brand_id , 
            'brands'=>new BrandsResource($this->whenLoaded('brand',$this->brand)),
            
            'components' => 
            $this->mergeWhen($request->extended === 'components',
            $this->whenLoaded('components', function () {
                return ComponentsFlavorsResource::collection($this->components);
            })),
            
            'liquid'=>$this->whenLoaded('liquids',$this->liquids->count()),
        ];
    }
}
