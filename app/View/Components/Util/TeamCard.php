<?php

namespace App\View\Components\Util;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TeamCard extends Component
{
    public $name;
    public $role;
    public $support;
    public $initials;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $role, $support, $initials)
    {
        $this->name = $name;
        $this->role = $role;
        $this->support = $support;
        $this->initials = $initials;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.util.team-card');
    }
}