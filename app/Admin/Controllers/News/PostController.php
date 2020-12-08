<?php

namespace App\Admin\Controllers\News;

use App\Models\Category;
use App\Models\News\Post;
use App\Models\User;
use App\Models\Tag;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Facades\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Новости';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Post());

        $grid->column('id', __('Id'));
        $grid->column('title', __('Title'));
        $grid->column('slug', __('Slug'))->editable('textarea');
        $grid->picture('picture', 'Main image')->image();
        $grid->column('category.name','Category');
        $grid->column('user.name', 'Author');

        $grid->tags()->display(function ($tags) {
            $tags = array_map(function ($tag) {
                return "<span class='label label-success'>{$tag['name']}</span>";
            }, $tags);
            return join('&nbsp;', $tags);
        });
        $states = [
            'ON'  => ['value' => 1, 'text' => 'ON', 'color' => 'primary'],
            'OFF' => ['value' => 2, 'text' => 'OFF', 'color' => 'danger'],
        ];
        $grid->column('status')->switch($states);
        $grid->column('created_at', __('Created at'));
        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Post::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('title', __('Title'));
        $show->field('description', __('Description'));
        $show->field('keywords', __('Keywords'));
        $show->field('picture', __('Picture'));
        $show->field('category_id', __('Category id'));
        $show->field('user_id', __('User id'));
        $show->field('status', __('Status'));
        $show->field('slug', __('Slug'));
        $show->field('post', __('Post'));
        $show->field('post_html', __('Post html'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Post());
        $form->image('picture','Main image')->removable()->downloadable();
        $form->text('title', __('Title'))->required();
        $form->text('slug', __('Slug'));
        $form->textarea('description', __('SEO description'));
        $form->textarea('keywords', __('SEO keywords'));
        $form->simplemde('post', 'Post');
        $form->select('category_id','Category')->options(Category::all()->pluck('name','id'))->required();
        $form->select('user_id', 'Author')->options(User::all()->pluck('name','id'))->required();
        $form->multipleSelect('tags','Tags')->options(Tag::all()->pluck('name','id'))->required();
        $states = [
            'ON'  => ['value' => 1, 'text' => 'ON', 'color' => 'primary'],
            'OFF' => ['value' => 2, 'text' => 'OFF', 'color' => 'danger'],
        ];
        $form->switch('status', 'Status')->states($states);

        return $form;
    }
}
