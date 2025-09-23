<?php

namespace App\Livewire\Employee;

use App\Models\Sales;
use App\Traits\UploadingImageTraits;
use Exception;
use Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class EmployeeCreateForm extends Component
{
    use WithFileUploads , UploadingImageTraits;

    public $name , $email  , $phone , $password, $password_confirmation , $nationalID , $bioData , $image ;
    public $showExCreateForm = false , $employmentHistory=[] ; 

    protected $rules = [
        'name'       => 'required|string|max:255|unique:sales,name',
        'email'      => 'required|string|email|max:255|unique:sales,email',
        'phone'      => 'required|string|max:20',
        'nationalID' => 'required|string|max:20|unique:sales,nationalID',
        'password'   => 'required|confirmed|min:8', // or use Rule::password()
    ];


    public function create(){
        DB::beginTransaction();
        try{
            $validated = $this->validate();

            // Create sales user
            $salesPerson = Sales::create([
                'name'       => $validated['name'],
                'email'      => $validated['email'],
                'phone'      => $validated['phone'],
                'nationalID' => $validated['nationalID'],
                'password'   => Hash::make($validated['password']),
                'bioData'    => $this->bioData,
                'admin_id'=>Auth::id(),
            ]);
            $salesPerson->history()->createMany($this->employmentHistory ?? []);
            
            $this->uploadImage(
                $this->image,
                'image',
                'sales',
                'public',
                $salesPerson->id,
                get_class($salesPerson),
                'sales'
            );

            DB::commit();
            $this->resetValues();
            
        }catch(Exception $e){
            DB::rollBack();
            dd($e->getMessage());
        }
       
    }
    private function resetValues(){
        $this->reset('name','email','phone','nationalID','password','bioData','employmentHistory','image');
        $this->dispatch('createEmploymentDone');
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
    public function render()
    {
        return view('livewire.employee.employee-create-form');
    }
}
