<?php

namespace App\Models\Hardware;

use App\Models\Bills\Bills;
use App\Models\Cartidges\Cartidge;
use App\Models\Cartidges\CartidgeVariants;
use App\Models\Coils\Coils;
use App\Models\Coils\CoilSeries;
use App\Models\Tanks\Tanks;
use App\Models\Tanks\TanksColors;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeviceInventories extends Model
{
    use HasFactory;
    protected $table = 'device_inventories';
    protected $fillable = [
    'device_id','device_flavor_id','device_color_id',
    'tank_id','tank_color_id',
    'coil_id','coil_series_id',
    'cartridge_id','cartridge_variant_id',
    'stock_quantity','base_price','barcode','batch_number','status','displayed_at'
    ];
    
    // RELATIONS ; 
    public function device(){
        return $this->belongsTo(Devices::class , 'device_id');
    }
    public function tank(){
        return $this->belongsTo(Tanks::class , 'tank_id');
    }
    public function coilSeries(){
        return $this->belongsTo(CoilSeries::class , 'coil_series_id');
    }
    public function cartridge(){
        return $this->belongsTo(Cartidge::class , 'cartridge_id');
    }

    public function deviceColor(){
        return $this->belongsTo(DeviceColors::class , 'device_color_id');
    }
    public function deviceFlavor(){
        return $this->belongsTo(DeviceFlavors::class ,'device_flavor_id' );
    }
    public function tankColor(){
        return $this->belongsTo(TanksColors::class , 'tank_color_id');
    }
    public function coil(){
        return $this->belongsTo(Coils::class,'coil_id');
    }
    public function cartridgeVariants(){
        return $this->belongsTo(CartidgeVariants::class , 'cartridge_variant_id');
    }

    public function bills()
    {
        return $this->belongsToMany(Bills::class, 'bills_details','device_inventory_id','bills_id')
                ->withPivot('quantity', 'unit_price', 'line_total')
                ->withTimestamps();
    }

    public function deviceDetails(){
        if($this->deviceColor){
            $totalQuantity = self::where('device_id',$this->device_id)->where('device_color_id',$this->device_color_id)->sum('stock_quantity');
            $name = 'Color-'.$this->deviceColor->name ;
            $foreignId = $this->device_color_id ; 
            $type='device_color_id';
            // $category = $this->deviceColor->device->category->name ; 
        }
        elseif($this->deviceFlavor){
            $totalQuantity = self::where('device_id',$this->device_id)->where('device_flavor_id',$this->device_flavor_id)->sum('stock_quantity');
            $name = 'Flavor-'.$this->deviceFlavor->component->name ;
            $foreignId = $this->device_flavor_id ; 
            $type='device_flavor_id';
            // $category = $this->deviceFlavor->device->category->name ; 
        }
        return ['name'=>$name.'-'.$this->device->name , 'quantities'=>$totalQuantity , 
        'base_price'=>$this->base_price , 
        'category'=>$this->device->category->slug , 
        'status'=>$this->status , 'brand_id'=>$this->device->brand_id , 
        'id'=>$this->id , 'device_id'=>$this->device_id, 
        'bill_details_product_id'=>$this->device_id, 
        'type'=>$type ,
        'foreignId'=>$foreignId];
    }
    
    public function tankDetails(){
        $totalQuantity = self::where('tank_id',$this->tank_id)->where('tank_color_id',$this->tank_color_id)->sum('stock_quantity');
        $name = 'Color-'.$this->tankColor->value ;
        $foreignId = $this->tank_color_id ; 

        return ['name'=>$name.'-'.$this->tank->name , 'quantities'=>$totalQuantity ,
        'base_price'=>$this->base_price,
        'category'=>$this->tank->category->slug,
        'status'=>$this->status , 
        'brand_id'=>$this->tank->brand_id , 
        'bill_details_product_id'=>$this->tank_id , 
        'id'=>$this->id , 'tank_id'=>$this->tank_id, 'foreignId'=>$foreignId];
    }

    public function cartridgeDetails(){
        $totalQuantity = self::where('cartridge_id',$this->cartridge_id)->where('cartridge_variant_id',$this->cartridge_variant_id)->sum('stock_quantity');
        $name = $this->cartridgeVariants->vaping_style.'-Resistance-'.$this->cartridgeVariants->resistance.'Ω' ;
        $foreignId = $this->cartridge_variant_id ; 
        return [
        'name'=>$name.'-'.$this->cartridge->name ,'base_price'=>$this->base_price, 
        'category'=>$this->cartridge->category->slug,
        'status'=>$this->status , 
        'brand_id'=>$this->cartridge->brand_id , 
        'bill_details_product_id'=>$this->cartridge_id , 
        'quantities'=>$totalQuantity , 'id'=>$this->id , 'cartridge_id'=>$this->cartridge_id, 'foreignId'=>$foreignId
        ];
    }

    

    public function coilSeriesDetails($status='in_stock'){
        $totalQuantity = self::where('coil_series_id',$this->coil_series_id)
        ->where('coil_id',$this->coil_id)
        ->where('status',$status)
        ->sum('stock_quantity');
        $name = $this->coil->name ;
        $foreignId = $this->coil_id ; 

        return ['name'=>$name, 'quantities'=>$totalQuantity , 
        'base_price'=>$this->base_price , 
        'category'=>$this->coilSeries->category->slug,
        'status'=>$this->status , 'brand_id'=>$this->coilSeries->brand_id , 
        'bill_details_product_id'=>$this->coil_series_id , 
        'id'=>$this->id , 'coil_series_id'=>$this->coil_series_id, 'foreignId'=>$foreignId];
    }

    public function simpleDetails(string $inventory_source){
        if($inventory_source=='coils'){
            return $this->coilSeriesDetails();
        }
        elseif($inventory_source=='cartridges'){
            return $this->cartridgeDetails();
        }
        elseif($inventory_source=='tanks'){
            return $this->tankDetails();
        }
        elseif($inventory_source=='devices'){
            return $this->deviceDetails();
        }
    }

    public static function listBySource($inventorySource , $selectedItem){
        $map =  [
            'coils'      => 'coilSeriesDetails',
            'cartridges' => 'cartridgeDetails',
            'tanks'      => 'tankDetails',
            'devices'    => 'deviceDetails',
        ];  
        $inventories = self::where('status','in_stock')
        ->when($inventorySource == 'coils' ,function($q)use($selectedItem){
            $q->where('coil_series_id' , $selectedItem)
            ->select(['coil_series_id','coil_id','status'])
            ->groupBy('coil_series_id','coil_id','status');
        })
        ->when($inventorySource == 'cartridges' ,function($q)use($selectedItem){
            $q->where('cartridge_id',$selectedItem)
            ->select(['cartridge_id','cartridge_variant_id','status'])
            ->groupBy('cartridge_id','cartridge_variant_id','status');
        })
        ->when($inventorySource == 'tanks' ,function($q)use($selectedItem){
            $q->where('tank_id',$selectedItem)
            ->select(['tank_id','tank_color_id','status'])
            ->groupBy('tank_id','tank_color_id','status');
        })
        ->when($inventorySource == 'devices' ,function($q)use($selectedItem){
            $q->where('device_id',$selectedItem)
            ->select(['device_id','status','device_color_id','device_flavor_id'])
            ->groupBy('device_id','status','device_color_id','device_flavor_id');
        })
        ->get();

        $method = $map[$inventorySource];
        return $inventories->map(function($inventory) use ($method) {
            return $inventory->$method();
    }   );

    }
    protected static function boot()
    {
        parent::boot();

        // Auto-update status based on stock quantity
        static::saving(function ($inventory) {
            $inventory->updateStatus();
        });
    }

    /**
     * Update inventory status based on stock quantity
     */
    public function updateStatus()
    {
        if ($this->stock_quantity <= 0) {
            $this->status = 'out_of_stock';
        } elseif ($this->stock_quantity <= $this->min_stock_level) {
            $this->status = 'low_stock';
        } else {
            $this->status = 'in_stock';
        }
    }

    // coils_series_id , coil_id , selectedCoilId ; 
    // tank_id , tank_color_id , selectedTankId
    public function scopeGroupedById($query, $firstKey , $secondKey ,$id)
    {
    return $query->where($firstKey, $id)
        ->where('status', 'in_stock')
        ->orderBy('created_at') // FIFO
        ->get()
        ->groupBy(function($item)use($firstKey , $secondKey){
            return $item->{$firstKey} . '-' . $item->{$secondKey};
        })
        ->map(function ($items) {
            $first = $items->first();
            $first->setAttribute('total_quantity', $items->sum('stock_quantity'));
            return $first;
        });
}

           
}
