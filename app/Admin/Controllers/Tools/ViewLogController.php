<?php

namespace App\Admin\Controllers\Tools;

use App\Models\Tools\ViewLog;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Facades\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ViewLogController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Логи посещений';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new ViewLog());
        $grid->column('viewed_url', __('Viewed Url'));
        $grid->column('remote_addr', __('User IP'));
        $grid->column('http_referer', __('Referer URL'));
        $grid->column('http_user_agent', 'User Agent')->modal('User Agent', function ($model){
            return $model->http_user_agent;
        });
        $grid->column('created_at', __('Date viewed'));
        $grid->actions(function ($actions) {
            //$actions->disableDelete();
            $actions->disableEdit();
            $actions->disableView();
        });
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
        $show = new Show(ViewLog::findOrFail($id));
        $show->field('viewed_url', __('Viewed Url'));
        $show->field('remote_addr', __('User IP'));
        $show->field('http_referer', __('Referer URL'));
        $show->field('http_user_agent', __('User Agent'));
        $show->field('created_at', __('Date viewed'));
        return $show;
    }

}
