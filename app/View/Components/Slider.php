<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Config;
use Illuminate\View\Component;

class Slider extends Component
{
    public $items;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->items=Config('slider');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.slider');
    }
}
