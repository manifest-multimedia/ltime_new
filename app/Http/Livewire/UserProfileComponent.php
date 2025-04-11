<?php

namespace App\Http\Livewire;

use App\Helpers\helper;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class UserProfileComponent extends Component
{
    use WithFileUploads;

      

    public $photo;
    public $oldPhoto;
    public $firstName;
    public $lastName;
    public $otherName;
    public $email;   
    public $link; 
    public $showSuccessMessage = '';
    public $userSessions=[];

    protected $listeners = ['photoRemoved'];

    public function mount(){

        

        $this->firstName=helper::getUserFirstName(Auth::user()->name); 
        $this->lastName=helper::getUserLastName(Auth::user()->name); 
        $this->otherName=helper::getUserOtherName(Auth::user()->name); 
        $this->email=Auth::user()->email;
        $this->photo=Auth::user()->profile_photo_path;
        $this->oldPhoto=Auth::user()->profile_photo_path;
    }

    public function render()
    {
        return view('livewire.user-profile-component');
    }

    public function copyRefLink($link){

        $this->link = $link;
        $this->emit('copyToClipboard', $link);
   
    }

    public function photoRemoved()
        {

            $this->photo = null;
        }

    public function saveProfile()
    {
      
        $this->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            // 'email' => 'required|email',
        ]);

        // Update the user model or perform any other necessary actions
        $user = User::find(auth()->user()->id);

        if($this->otherName) {
            $user->name = "$this->firstName $this->otherName $this->lastName";
        } else{
            $user->name = "$this->firstName $this->lastName";
        }

        if ($this->photo!=$this->oldPhoto && $this->photo!=[] && $this->photo!='' && $this->photo!=null) {
            // dd("$this->photo Not equal to old photo $this->oldPhoto");
            try {
              // Store the uploaded photo and update the profile_photo_path
          $path=$this->photo->store('profile-photos', 'public');

                $user->profile_photo_path =$path;
            
            } catch (\Throwable $th) {
                $user->profile_photo_path=null;
            }

        } else {
           if($this->oldPhoto!=null && $this->photo==null){
                $user->profile_photo_path=null;
           }
        }
        
        $user->save();

        session()->flash('success', 'Profile updated successfully.');

        $this->emit('profileUpdated');

    }
}
