<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Front extends Component
{
    public $breadcrumb;
    /**
     * Create a new component instance.
     */
    public function __construct($breadcrumb = null)
    {
        $this->breadcrumb=$breadcrumb;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.front');
    }
}
