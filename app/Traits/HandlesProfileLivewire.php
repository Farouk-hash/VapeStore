<?php
namespace App\Traits;

use App\Models\Employee\Attendance;
use App\Models\Employee\History;
use App\Models\Image\Image;
use Carbon\Carbon;
use Exception;
use Livewire\WithFileUploads;

trait HandlesProfileLivewire
{
    use WithFileUploads , UploadingImageTraits ;

    
    public $user , $billStats , $showExCreateForm=false;
    public $limit = 4  ,$offset=0 , $totalWeeks=0 , $showAttendance=false , $weeks=[];   // FOR ATTENDANCE PART ;
    public $editingId = null ;
    public $guard ,$image;
    
    private function settingUserAttributes(){

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

        if($this->guard !== 'admin' && property_exists($this , 'historyData')){
            foreach ($this->user->history as $history) {
                $this->historyData[$history->id] = $history->toArray();
            }
        }

    }
    
    public function updateEmployeeProfile(){
        $commonAttributes = [
            'name'       => $this->name,
            'email'      => $this->email,
        ];

        if($this->guard !=='admin'){
            $commonAttributes = array_merge($commonAttributes , 
            [
                'nationalID' => $this->nationalID,
                'phone'      => $this->phone,
                'bioData'    => $this->bioData,
            ]);
        }
        $this->user->update($commonAttributes);
    }

    // FOR EMPLOYEES [SALES]-UNIQUE-METHODS ;
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
    // END OF EMPLOYEES UNIQUEMETHODS ; 


    public function loadWeeks()
    {
        // FOR ADMINS , SALES ; 
        $attendances = Attendance::where('attendable_id', $this->user->id)
            ->where('attendable_type',get_class($this->user))
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


    public function uploadImageAction(){
        // CHECK IF IMAGE EXISTS ; 
        $imageModel = Image::where('imageable_id',$this->user->id)->where('imageable_type' , get_class($this->user))->first();
        if($imageModel){
            $this->deleteImage([$imageModel->url] , $this->guard , 'public' , $this->user->id , get_class($this->user));
        }

        $this->uploadImage(
            source: $this->image,
            input_name: 'image',
            foldername: $this->guard , 
            disk: 'public',
            imageable_id: $this->user->id,
            imageable_type: get_class($this->user),
            request_input_variable: $this->guard
        );
        $this->reset('image'); // Image Uploaded Immediately ; 
    }

}