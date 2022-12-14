<?php

namespace App\View\Components;

use Illuminate\View\Component;

class BtnBlock extends Component
{
    public $color;
    public $message;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($color, $message)
    {
        $this->color = $color;
        $this->message = $message;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.btn-block');
    }
}
