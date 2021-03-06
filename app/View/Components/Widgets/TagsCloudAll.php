<?php

namespace App\View\Components\Widgets;

use App\Models\Tag;
use Illuminate\View\Component;
use Illuminate\Database\Eloquent\Collection;

class TagsCloudAll extends Component
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
        $tags = array();
        foreach (Tag::all() as $tag) {
            if((count($tag->blog_posts()->where('status', 1)->get()->toArray()) != 0) || (count($tag->news_posts()->where('status', 1)->get()->toArray()) != 0)) {
                $tags[] = ['id'  => $tag->id, 'name' => $tag->name, 'slug' => $tag->slug];
            }
        }
        return view('components.widgets.tags-cloud-all', ['tags' => $tags]);
    }
}
