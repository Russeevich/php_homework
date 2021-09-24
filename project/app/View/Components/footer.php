<?php

namespace App\View\Components;

use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;

class footer extends Component
{
    public $product;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->product =  DB::table('products')->inRandomOrder()->first();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.footer');
    }
}
