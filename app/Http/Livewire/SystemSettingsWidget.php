<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;

class SystemSettingsWidget extends Component
{
    public $default_currency; 
    public $default_language;
    public $new_currency;
    public $new_language; 

    public $sessions;

    public function mount(){
        $user=Auth::user()->id;
        
        $this->sessions=session()->all();

// dd($this->sessions);
        $this->default_currency=Setting::select('currency')->value('currency');
        $this->default_language=Setting::select('language')->value('language');
        $this->new_currency=$this->default_currency;
        $this->new_language=$this->default_language;
    }
    
    public function render()
    {
        return view('livewire.system-settings-widget');
    }

    public function saveCurrency(){
        $this->validate(['new_currency'=>'required'], [
            'new_currency.required' => 'Please select a new default currency'
        ]);
      
        if($this->default_currency!=$this->new_currency){
            $save=Setting::where('currency', $this->default_currency)->update([
                'currency'=>$this->new_currency
            ]);
            if(session()->has('currency_saved')){
                session()->forget('currency_saved');
            }
            session()->flash("currency_saved", "Successfully updated default system currency");
    
        } else {
            if(session()->has('currency_saved')){
                session()->forget('currency_saved');
            }
            session()->flash("currency_saved", "No changes were made!");
        }

        redirect('/portal/settings');

    }
    public function saveLanguage(){
        $this->validate(['new_language'=>'required'], [
            'new_language.required' => 'Please select a new default language'
        ]);
      
        if($this->default_language!=$this->new_language){
            $save=Setting::where('language', $this->default_language)->update([
                'language'=>$this->new_language
            ]);
            if(session()->has('language_saved')){
                session()->forget('language_saved');
            }
            session()->flash("language_saved", "Successfully updated default system language");
    
        } else {
            if(session()->has('language_saved')){
                session()->forget('language_saved');
            }
            session()->flash("language_saved", "No changes were made!");
        }

        redirect('/portal/settings');

    }
}
