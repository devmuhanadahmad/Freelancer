<?php

namespace App\Http\Livewire\Front;

use App\Models\Category;
use App\Models\Project as ModelsProject;
use Livewire\Component;

class Project extends Component

{
    public $parentCategories=[];
    public $childCategories=[];
    public $search=['search'];



    public function render()
    {

        return view('livewire.front.project',[
            'projects' => ModelsProject::FilterActive()->where('type',$this->search)->with(['user','category','tag'])
        ->latest()
        ->paginate(12, '*', 'page')
        ]);
    }
}
