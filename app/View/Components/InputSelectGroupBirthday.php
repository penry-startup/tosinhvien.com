<?php

namespace App\View\Components;

use Illuminate\View\Component;

class InputSelectGroupBirthday extends Component
{
    public $label;
    public $dayValue;
    public $monthValue;
    public $yearValue;
    public $errors;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($label = 'Sinh nhật', $dayValue = '', $monthValue = '', $yearValue = '', $errors = [])
    {
        $this->label      = $label;
        $this->dayValue   = $dayValue;
        $this->monthValue = $monthValue;
        $this->yearValue  = $yearValue;
        $this->errors     = $errors;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.input-select-group-birthday');
    }
}
