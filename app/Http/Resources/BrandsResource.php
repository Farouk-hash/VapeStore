<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BrandsResource extends JsonResource
{
    
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id , 
            'name'=>$this->name , 
            'country'=>$this->country , 
            'is_active'=>$this->is_active , 
            'premium'=>$this->premium , 
            'flavors'=>$this->mergeWhen($request->extended==='flavors' , 
            $this->whenLoaded('flavours',function(){
                return FlavorsResource::lightCollection($this->flavours);
            })),
        ];
    }
}
