<?php

namespace App\View\Components\Widgets;

use App\Models\Category;
use Illuminate\View\Component;

class CategoryLinksBlog extends Component
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
        $categories = array();
        foreach (Category::all() as $category) {
            if(count($category->blog_posts()->get()->toArray()) != 0) {
                $categories[] = ['id'  => $category->id, 'name' => $category->name, 'slug' => $category->slug];
            }
        }
        return view('components.widgets.category-links-blog', ['categories' => $categories]);
    }
}
