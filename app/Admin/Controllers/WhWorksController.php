<?php

namespace App\Admin\Controllers;

use App\Models\WhWorks;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class WhWorksController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\Models\WhWorks';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new WhWorks);

        $grid->column('id', __('Id'));
        $grid->column('title', __('Title'));
        $grid->column('cover', __('Cover'))->image();
        $grid->column('img', __('Img'));
        $grid->column('tags', __('Tags'))->display(function ($tags) {
            return implode(',', $tags);
        });
        $grid->column('resolution', __('Resolution'));
        $grid->column('resolution_id', __('Resolution id'));
        $grid->column('is_visit', __('Is visit'))->display(function ($is_visit) {
            return $is_visit ? '是' : '否';
        });
        $grid->column('author', __('Author'));
        $grid->column('size', __('Size'))->sortable()->filesize();
        $grid->column('star', __('Star'))->sortable();
        $grid->column('code', __('Code'));
        $grid->column('views', __('Views'))->sortable();
        $grid->column('downloads', __('Downloads'))->sortable();
        $grid->column('colors', __('Colors'))->display(function ($colors) {
            return implode(',', $colors);
        });
        $grid->column('colors_id', __('Colors id'));
        $grid->column('org_img_link', __('Org img link'));
        $grid->column('org_cover_link', __('Org cover link'));
        $grid->column('org_star', __('Org star'));
        $grid->column('org_code', __('Org code'));
        $grid->column('org_upload_time', __('Org upload time'))->sortable();
        $grid->column('org_category', __('Org category'));
        $grid->column('org_views', __('Org views'))->sortable();
        $grid->column('created_at', __('Created at'))->sortable();
        $grid->column('updated_at', __('Updated at'))->sortable();

        $grid->model()->orderBy('updated_at', 'desc');
        $grid->model()->whereNull('deleted_at');

        $grid->filter(function ($filter) {

            // 设置字段的范围查询
            $filter->between('created_at', __('Created at'))->datetime();
            $filter->between('updated_at', __('Updated at'))->datetime();
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
        $show = new Show(WhWorks::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('title', __('Title'));
        $show->field('cover', __('Cover'));
        $show->field('img', __('Img'));
        $show->field('tags', __('Tags'));
        $show->field('resolution', __('Resolution'));
        $show->field('resolution_id', __('Resolution id'));
        $show->field('is_visit', __('Is visit'));
        $show->field('author', __('Author'));
        $show->field('size', __('Size'));
        $show->field('star', __('Star'));
        $show->field('code', __('Code'));
        $show->field('views', __('Views'));
        $show->field('colors', __('Colors'));
        $show->field('colors_id', __('Colors id'));
        $show->field('org_img_link', __('Org img link'));
        $show->field('org_cover_link', __('Org cover link'));
        $show->field('org_star', __('Org star'));
        $show->field('org_code', __('Org code'));
        $show->field('org_upload_time', __('Org upload time'));
        $show->field('org_category', __('Org category'));
        $show->field('org_views', __('Org views'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('deleted_at', __('Deleted at'));
        $show->field('downloads', __('Downloads'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new WhWorks);

        $form->text('title', __('Title'));
        $form->textarea('cover', __('Cover'));
        $form->textarea('img', __('Img'));
        $form->text('tags', __('Tags'));
        $form->text('resolution', __('Resolution'));
        $form->number('resolution_id', __('Resolution id'));
        $form->switch('is_visit', __('Is visit'))->default(1);
        $form->text('author', __('Author'));
        $form->text('size', __('Size'));
        $form->number('star', __('Star'));
        $form->text('code', __('Code'));
        $form->number('views', __('Views'));
        $form->text('colors', __('Colors'));
        $form->number('colors_id', __('Colors id'));
        $form->textarea('org_img_link', __('Org img link'));
        $form->textarea('org_cover_link', __('Org cover link'));
        $form->number('org_star', __('Org star'));
        $form->text('org_code', __('Org code'));
        $form->textarea('org_upload_time', __('Org upload time'));
        $form->text('org_category', __('Org category'));
        $form->text('org_views', __('Org views'));
        $form->number('downloads', __('Downloads'));

        return $form;
    }
}
