<?php 
namespace App\Traits;

use Illuminate\Support\Facades\Auth;



trait HandlesMultiAuth 
{
    public $name , $email , $nationalID , $phone , $bioData , $images; // FOR EDITING-FORM ; 

    // TREATES AS CONSTANTS ; 
    protected function getGuardConfigs(){
        return [
            'sales'=>[
                'guard'=>'sales',
                'unique_attributes'=>['history','admin','phone','nationalID','account_active','bioData']
            ] , 
            'admin'=>[
                'guard'=>'admin',
                'unique_attributes'=>['sales']
            ]
        ];
        
    }
    protected function commonAttributes(){
        return ['name', 'email', 'bills', 'customers', 'attendances','images'];
    }
    // END OF CONSTANTS ;
    
    // RETURNS GUARD-NAME , CURRENT-USER ; 
    public function getCurrentAuthenticationUser(){
        $guardsConfigs = $this->getGuardConfigs() ; 
        foreach($guardsConfigs as $guardName => $guardConfig){
            if(Auth::guard($guardName)->check()){
                return [
                    'guard'=>$guardName , 
                    'user'=>Auth::guard($guardName)->user(),
                ];
            }
        }
        abort(401 , 'Un Authorized User');
    }
    

    /**
     * For Routing ; 
     * Summary of buildUserAttributes
        *admin['name'=>.. ,'email'=>... , 'sales'=>... , 'attendances'=>.... , 'images'=>... ,'bills'=>...] ; 
        *sales['name'=>...,'email'=>... ,'nationalID'=>...,'phone'=>...,'admin'=>...] ;
     */
    public function buildUserAttributes($user , $userType){
        $commonAttributes = $this->getCommonAttributes($user);
        $uniqueAttributes = $this->getUniqueAttributes($user , $userType);
        $attributes = array_merge($commonAttributes , $uniqueAttributes);
        return $attributes ; 
    }

    public function getCommonAttributes($user){
        $attributes = [];
        foreach($this->commonAttributes() as $attribute){
            $attributes[$attribute] = $user->{$attribute};
        }
        return $attributes;
    }

    public function getUniqueAttributes($user , $userType){
        $attributes = [];
        $uniqueAttributes = $this->getGuardConfigs()[$userType]['unique_attributes'] ?? [] ;
        foreach($uniqueAttributes as $attribute){
            $attributes[$attribute] = $user->{$attribute};
        }
        return $attributes;
    }
    // End of summary buildUserAttributes ; 

    /**
     * For livewire components ;
     * Set attributes as properties (for Livewire components)
     * This method is specific to Livewire and sets attributes as component properties
     * 
     */

    public function getUserAttributesAsProperties($user , $userType){
        $commonAttributes = $this->commonAttributes();
        $uniqueAttributes = $this->getGuardConfigs()[$userType]['unique_attributes'] ?? [];
        foreach($commonAttributes as $attribute){
            $this->{$attribute} = $user->{$attribute};
        }
        foreach($uniqueAttributes as $attribute){
            $this->{$attribute} = $user->{$attribute};
        }
        return array_merge($commonAttributes , $uniqueAttributes);
    }

    public function isAdmin(){
        return Auth::guard('admin')->check();
    }
    public function isSales(){
        return Auth::guard('sales')->check();
    }
    
}