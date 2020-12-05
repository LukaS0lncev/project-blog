<?php

namespace App\Admin\Controllers;

use App\Models\Article;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ArticleController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Article';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Article());

        $grid->column('id', __('Id'));
        $grid->column('title', __('Title'));
        $grid->column('slug', __('Slug'));
        $states = [
            'ON'  => ['value' => 1, 'text' => 'ON', 'color' => 'primary'],
            'OFF' => ['value' => 2, 'text' => 'OFF', 'color' => 'danger'],
        ];
        $grid->column('status')->switch($states);
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
        $show = new Show(Article::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('title', __('Title'));
        $show->field('slug', __('Slug'));
        $show->field('status', __('Status'));
        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Article());

        $form->text('title', __('Title'));
        $form->text('slug', __('Slug'));
        $form->simplemde('article', __('Article'));
        $states = [
            'ON'  => ['value' => 1, 'text' => 'ON', 'color' => 'primary'],
            'OFF' => ['value' => 2, 'text' => 'OFF', 'color' => 'danger'],
        ];
        $form->switch('status', 'Status')->states($states);


        return $form;
    }
}
