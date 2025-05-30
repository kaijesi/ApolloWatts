<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class HouseholdForm extends Component
{
    public $household;
    
    /**
     * Create a new component instance.
     */
    public function __construct($household)
    {
        $this->household = $household;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.household-form');
    }
}
