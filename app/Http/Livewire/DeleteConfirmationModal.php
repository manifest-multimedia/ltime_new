<?php

namespace App\Http\Livewire;

use Livewire\Component;
 

class DeleteConfirmationModal extends Component
{
    public $modelName;
    public $itemID;

   
   
    public function delete($url)
    {

        
        $modelClass='App\\Models\\' . ucfirst($this->modelName);

        if (class_exists($modelClass)) {
            $modelClass::destroy($this->itemID);

            session()->flash("deletesuccess", "Item successfully deleted.");

            return redirect($url);

        } else {
            // Handle the case when the model class does not exist
        }

        
    }

    public function render()
    {

        return view('livewire.delete-confirmation-modal');
    }
}

   

