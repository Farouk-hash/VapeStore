<?php

namespace App\Livewire\Employee;

use App\Models\Employee\Attendance;
use App\Models\Employee\History;
use App\Models\Image\Image;
use App\Models\Sales;
use App\Traits\HandlesMultiAuth;
use App\Traits\HandlesProfileLivewire;
use App\Traits\UploadingImageTraits;
use Carbon\Carbon;
use Exception;
use Livewire\Component;
use Livewire\WithFileUploads;

class EmployeeProfile extends Component
{
    use HandlesMultiAuth ; // FOR SETTING ATTRIBUTES TO BE UPDATED ; ex: $this->name = $this->user->name , $this->email = $this->user->email , ..... ;
    use HandlesProfileLivewire; // FOR METHODS[UPDATE , EXPERTS , ATTENDANCES , LOADING-WEEKS];
    

    public $historyData = [] , $employmentHistory=[] ;

    public function mount($id){   
        $this->guard = 'sales';
        $this->user = Sales::where('id',$id)->first() ; 
        $this->getUserAttributesAsProperties($this->user , $this->guard); // [common , unqiue]-attributes ; 
        
        $this->settingUserAttributes();
        $this->loadWeeks();
    }

 
    
    public function render()
    {
        return view('livewire.employee.employee-profile');
    }
}
