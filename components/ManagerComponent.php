<?php

namespace Epsomsegura\Laraveldspaceclient\Components;

use Illuminate\View\Component;

class ManagerComponent extends Component
{
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('views.manager-component');
    }
}
