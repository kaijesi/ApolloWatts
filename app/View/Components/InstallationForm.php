<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use InvalidArgumentException;

class InstallationForm extends Component
{
    public bool $isUpdate; // Allows to use the same form for create and update requests
    public $installation;
    
    /**
     * Create a new component instance.
     */
    public function __construct($isUpdate=false, $installation='')
    {
        $this->isUpdate = $isUpdate;
        if ($isUpdate === true && $installation === null) {
            throw new InvalidArgumentException("When isUpdate is true, an Installation object must be provided.");
        }

        $this->installation = $installation;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.installation-form');
    }
}
