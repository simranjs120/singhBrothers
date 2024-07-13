<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AdminHeader extends Component
{
    /**
     * Create a new component instance.
     */
    public $profile="";
    public function __construct($profile)
    {
        $this->profile=$profile;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.Admin-header');
    }
}
