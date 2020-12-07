<?php

namespace App\View\Components\Widgets;

use App\Models\Tag;
use Illuminate\View\Component;

class TagsCloud extends Component
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
        $tags = Tag::all();
        return view('components.widgets.tags-cloud', ['tags' => $tags]);
    }
}
