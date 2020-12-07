<?php

namespace App\View\Components\Widgets;

use App\Models\Category;
use Illuminate\View\Component;

class CategoryLinks extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        $categories = Category::all();
        return view('components.widgets.category-links', ['categories' => $categories]);
    }
}
