<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Bills\Bills;
use App\Models\Bills\BillsNotes;
use Auth;
use Illuminate\Http\Request;

class BillsController extends Controller
{
    public function index(){
        $billsModel = Bills::with(['customer','created_by'])->get();
        $bills = $billsModel->map(function($bill){
            return [
                'id'=>$bill->id , 
                'total_price'=>$bill->total_price , 
                'total_after_discount'=>$bill->total_after_discount , 
                'has_discount'=>$bill->has_discount == 1 ? 'نعم' : 'لا' ,
                'customer'=>$bill->customer->name , 
                'seller'=>$bill->created_by->name ,
                'total_items'=>$bill->details->count(),
                'total_group_items'=>$bill->details->whereNotNull('group_inventory_id')->count(),
                'created_by'=>$bill->created_at
            ];
        });
        return view('dashboard.bills.index' , compact('bills'));
    }

    public function show(int $id){
        $bill = Bills::with(['details','customer'])->find($id);
        $billGroupByCounts = $bill->details->groupby('inventory_source')->map->count();
        
        $detailsModified = $bill->details->map(function($detail){
            if($detail->inventory_source!=='groups'){

                return [
                    'item_identity'=> $detail->inventory_source != 'liquids' ? 
                    $detail->device->simpleDetails($detail->inventory_source)['name'] : 
                    $detail->liquid->nicStrength->liquid->flavour->name . $detail->liquid->nicStrength->strength . ' %' , 
                    'route'=> $detail->inventory_source != 'liquids' ? 
                    route('livewire.devices.itemsDetails',[
                        $detail->device->simpleDetails($detail->inventory_source)['brand_id'] ,
                        $detail->device->simpleDetails($detail->inventory_source)['category'] , 
                        $detail->device->simpleDetails($detail->inventory_source)['bill_details_product_id'] ,
                        ]):
                        route('livewire.details',[ 'itemID'=>$detail->liquid->nicStrength->liquid,'forceDetails'=>true])
                        ,
                        'quantity'=>$detail->quantity , 
                        'line_total'=>$detail->line_total
                    ];
                }
                else{
                    return [
                        'item_identity'=> $detail->group->name , 
                        'line_total'=>$detail->line_total ,
                        'quantity'=>$detail->quantity , 
                        'route'=>route('livewire.group-inventories',$detail->group->id),
                    ];
                }
            });
            // dd($detailsModified);
        return view('dashboard.bills.details',compact('bill','detailsModified' , 'billGroupByCounts'));
    }


    // FOR NOTES ; 
    public function edit(Request $request , int $id){
        BillsNotes::create(['title'=>$request->title , 'notes'=>$request->body ,'priority'=>$request->priority , 'bill_id'=>$id , 
        'admin_id'=>Auth::id() ]);
        return redirect()->back();        
    }

}
