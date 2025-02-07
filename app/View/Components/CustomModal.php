<?php

namespace App\View\Components;

use Brick\Math\BigNumber;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Ramsey\Uuid\Type\Integer;

class CustomModal extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public string $title, public string $message , public int $id)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.custom-modal');
    }
}
