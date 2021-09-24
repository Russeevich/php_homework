<?php

namespace App\View\Components;

use Illuminate\View\Component;

class administrator extends Component
{
    public $categories;
    public $products;
    public $orders;
    public $mail;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($products, $orders, $categories, $mail)
    {
        $this->categories = $categories;
        $this->orders = $orders;
        $this->products = $products;
        $this->mail = $mail;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.administrator');
    }
}
