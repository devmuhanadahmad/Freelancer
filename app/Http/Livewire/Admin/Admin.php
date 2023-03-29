<?php

namespace App\Http\Livewire\Admin;

use App\Models\Admin as ModelsAdmin;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Admin extends Component
{
    public  $name,$email,$password,$status;
    public  $successMessage='';

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName,[
            'name'=>'required|string|min:3|max:255',
            'email'=>'required|email',
            'status'=>'nullable|in:active,inactive',
            'password'=>'required'
        ]);
    }

    public function saveFormData()
    {
       // $validatedData = $this->validate();

        //Contact::create($validatedData);
        $admin=new ModelsAdmin();
        $admin->name=$this->name;
        $admin->email=$this->email;
        $admin->password=Hash::make($this->password);
        $admin->status=$this->status;
        $admin->save();
        $this->successMessage="تمت العملية بنجاح";
        //$this->clearFormData{};


    }

    public function render()
    {
        return view('livewire.admin.admin');
    }
}
