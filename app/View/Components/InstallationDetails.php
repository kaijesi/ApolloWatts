<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InstallationDetails extends Component
{
    public $installation;

    /**
     * Create a new component instance.
     */
    public function __construct($installation)
    {
        $this->installation = $installation;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.installation-details');
    }
}
