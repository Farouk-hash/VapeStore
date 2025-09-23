<?php

namespace App\Livewire\Profile;

use App\Models\Image\Image;
use App\Traits\HandlesMultiAuth;
use App\Traits\HandlesProfileLivewire;
use App\Traits\UploadingImageTraits;
use Livewire\Component;
use Livewire\WithFileUploads;

class Index extends Component
{
    use HandlesMultiAuth ;
    use HandlesProfileLivewire ;

    public function mount(){
        // CAME FROM TRAIT ; 
        $authData = $this->getCurrentAuthenticationUser();
        $user = $authData['user'];
        $this->guard = $authData['guard'];
        $this->user = $user ; 
        $this->getUserAttributesAsProperties($user , $this->guard); // [common , unqiue]-attributes ; 
        // END OF TRAIT ; 

        $this->settingUserAttributes();
        $this->loadWeeks();
    }



    
    public function render()
    {
        return view('livewire.profile.index');
    }
}
