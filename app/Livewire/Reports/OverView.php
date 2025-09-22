<?php

namespace App\Livewire\Reports;

use App\Models\Bills\BillDetails;
use App\Models\Bills\Bills;
use App\Models\Hardware\DevicesCategories;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class OverView extends Component
{
    public $totalIncome = 0 ,$totalIncomeAfterDiscount = 0 ,$totalDiscounts = 0 , $total_bills = 0 ,$totalProductsSold; 
    public $monthlySales=[] , $productDistributionsCharts=[] , $categories=[];
    public $selectedCategory ; 
    public function mount(){
        $this->categories = DevicesCategories::all();
        $this->initalizeTotals();
    }
    public function onCategoryChanged(){
        // MAPPING IDS TO DEVICE-CATEGORIES ; 
        $mapping = ['6'=>'tanks' , '7'=>'coils','9'=>'cartridges','8'=>'accessories'];
        $mappingValue = $mapping[$this->selectedCategory] ?? 'devices';

    }
    protected function initalizeTotals(){
        $totals = Bills::selectRaw('
        COUNT(id) AS total_bills , 
        SUM(total_price) AS total_price, 
        SUM(total_after_discount) AS total_price_after_discount ,     
        SUM(CASE WHEN has_discount = 1 THEN discount_value ELSE 0 END) as total_discounts')
        
        ->first();
        
        $this->totalIncome = $totals->total_price ; 
        $this->totalIncomeAfterDiscount = $totals->total_price_after_discount ; 
        $this->totalDiscounts = $totals->total_discounts ; 
        $this->total_bills = $totals->total_bills ; 
        $this->monthlySales = $this->getMonthlySalesData();
        $this->productDistributionsCharts = $this->getProductDistributionsCharts();
        $this->totalProductsSold = BillDetails::selectRaw('SUM(quantity) AS total_quantity')->value('total_quantity');
    }

    protected function getMonthlySalesData()
    {
        $sales = Bills::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('SUM(total_after_discount) as total')
            )
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)

            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $labels = $sales->pluck('date')->map(fn($d) => Carbon::parse($d)->translatedFormat('d F'));
        $data = $sales->pluck('total');

        return [
            'labels' => $labels,
            'data' => $data
        ];
    }

    protected function getProductDistributionsCharts(){
        $sales= DB::table('bills_details')
        ->select('inventory_source as source', DB::raw('SUM(quantity) as total_quantity'))
        ->whereMonth('created_at', Carbon::now()->month)
        ->whereYear('created_at', Carbon::now()->year)
        ->groupBy('inventory_source')
        ->orderBy('inventory_source')
        ->get();

        $labels = $sales->pluck('source');
        $data = $sales->pluck('total_quantity');

        return [
            'labels' => $labels,
            'data' => $data
        ];
    }
    public function render()
    {
        return view('livewire.reports.over-view');
    }
}
