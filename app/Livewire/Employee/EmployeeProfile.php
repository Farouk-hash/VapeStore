<?php

namespace App\Livewire\Employee;

use App\Models\Employee\Attendance;
use App\Models\Employee\History;
use App\Models\Sales;
use Carbon\Carbon;
use Exception;
use Livewire\Component;

class EmployeeProfile extends Component
{
    public $user , $billStats , $showExCreateForm=false ;
    public $name , $email , $nationalID , $phone , $bioData ; // FOR EDITING-FORM ; 
    public $limit = 4  ,$offset=0 , $totalWeeks=0 , $showAttendance=false , $weeks=[];   // FOR ATTENDANCE PART ;
    public $editingId = null , $historyData = [] , $employmentHistory=[] ;

    public function mount($id){
        $this->user = Sales::with(['bills','history'])->where('id',$id)->first();
        
        $this->settingUserAttributes();
        $this->loadWeeks();
    }

    

    private function settingUserAttributes(){

        // FOR EDIT-FORM ATTRIBUTES ;
        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->nationalID = $this->user->nationalID;
        $this->phone = $this->user->phone;
        $this->bioData = $this->user->bioData;

        $billsWithDetails = collect($this->user->bills->map(function($bill){
            return [
                'bill'=>$bill , 
                'details'=>$bill->details , 
                'totalProducts'=>$bill->details->sum('quantity') , 
                // 'discount_number'=>$bill->where('has_discount',true)->count()
            ];
        }));

        $this->billStats = [
            'total_discount_value'      => $this->user->bills->sum('discount_value'),
            'discounted_bills_count'    => $this->user->bills->where('has_discount', true)->count(),
            'total_after_discount_sum'  => $this->user->bills->sum('total_after_discount'),
            'total_price_sum'            => $this->user->bills->sum('total_price'),
            'totalProductsQuantities'    => $billsWithDetails->sum('totalProducts')
        ];


        foreach ($this->user->history as $history) {
            $this->historyData[$history->id] = $history->toArray();
        }

    }
    
    public function updateEmployeeProfile(){
        $this->user->update([
            'name'       => $this->name,
            'email'      => $this->email,
            'nationalID' => $this->nationalID,
            'phone'      => $this->phone,
            'bioData'    => $this->bioData,
        ]);
    }

    public function updateEmployeeExpert($id)
        {
            if (!isset($this->historyData[$id])) return;
            try{
                $data = $this->historyData[$id];
            
                // validate if needed
                $this->validate([
                    "historyData.$id.company_name" => 'required|string|max:255',
                    "historyData.$id.position_title" => 'required|string|max:255',
                    "historyData.$id.start_date" => 'required|date',
                    "historyData.$id.end_date" => 'nullable|date|after_or_equal:historyData.'.$id.'.start_date',
                ]);
                
                // update in DB
                History::findOrFail($id)->update($data);

                // exit edit mode
                $this->editingId = null;

            }catch(Exception $e){
                dd($e);
            }
            
    }

    public function onShowExCreateForm(){
        $this->showExCreateForm = !$this->showExCreateForm ; 
        if ($this->showExCreateForm && empty($this->employmentHistory)) {
            $this->addHistory(); // add the first one automatically
        }
    }

    public function addHistory(){
        $this->employmentHistory[] = [
                'company_name' => '',
                'website' => '',
                'position_title' => '',
                'start_date' => '',
                'end_date' => '',
                'notes' => '',
        ];
    }

    public function removeHistory($index){
        // dd($index);
        unset($this->employmentHistory[$index]);
    }

    public function createHistory(){
        $this->user->history()->createMany($this->employmentHistory ?? []);
        $this->reset('showExCreateForm','employmentHistory');
    }

    public function removeEmployeeExpert($id){
        History::where('id',$id)->delete();
    }


    public function loadWeeks()
    {
        $attendances = Attendance::where('sales_id', $this->user->id)
            ->where('date', '>=', now()->subYear()->startOfYear()->toDateString())
            ->orderByDesc('date')
            ->get();

        $grouped = $attendances->groupBy(function ($item) {
            return Carbon::parse($item->date)->startOfWeek()->format('Y-m-d');
        });

        $allWeeks = [];

        foreach ($grouped as $weekStart => $weekAttendances) {
            $days = collect();
            $start = Carbon::parse($weekStart);

            for ($d = 0; $d < 7; $d++) {
                $date = $start->copy()->addDays($d)->toDateString();
                $attended = $weekAttendances->contains(fn($a) => $a->date == $date);
                $days->push(['date' => $date, 'attended' => $attended]);
            }

            $allWeeks[] = [
                'start' => $start,
                'days' => $days,
            ];
        }

        // save total weeks count
        $this->totalWeeks = count($allWeeks);

        // apply offset + limit
        $this->weeks = collect($allWeeks)
            ->sortByDesc('start')
            ->slice($this->offset, $this->limit)
            ->values()
            ->toArray();
    }

    public function toggleAttendance()
    {
        $this->showAttendance = !$this->showAttendance;
    }

    public function nextPage()
    {
        $this->offset += $this->limit;
        $this->loadWeeks();
    }

    public function prevPage()
    {
        $this->offset = max(0, $this->offset - $this->limit);
        $this->loadWeeks();
    }

    
    public function render()
    {
        return view('livewire.employee.employee-profile');
    }
}
