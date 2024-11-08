<?php

namespace App\View\Components\Util;

use Closure;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Logo extends Component
{
    public int $width;

    public int $height;

    public string $type;

    /**
     * Create a new component instance.
     * @throws Exception
     */
    public function __construct(int $width, string $type)
    {
        $this->width = $width;
        if(empty($this->width) || !is_numeric($this->width))
        {
           throw new Exception(`Width must be non null and numeric`);
        }

        // subject to change if different ratio needed.
        $this->height = (int) $this->width / 4;

        $this->type = strtolower($type);
        if(empty($this->type))
        {
            throw new Exception(`Type must be a string`);
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.util.logo');
    }
}
