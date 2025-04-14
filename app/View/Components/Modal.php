<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Modal extends Component
{
    public $modalId;
    public $modalTitle;
    public $modalAction;
    
    /**
     * Create a new component instance.
     */
    public function __construct($modalId, $modalTitle, $modalAction="")
    {
        $this->modalId = $modalId;
        $this->modalTitle = $modalTitle;
        $this->modalAction = $modalAction;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.modal');
    }
}
