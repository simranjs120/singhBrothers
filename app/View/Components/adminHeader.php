<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class adminHeader extends Component
{
    /**
     * Create a new component instance.
     */
    public $profileData="";
    public function __construct($profile)
    {
        $this->profileData=$profile;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin-header');
    }
}
