<?php

namespace Arbory\AdminLog\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Arbory\AdminLog\Admin\Form\Serialization;
use Arbory\AdminLog\Models\AdminLog;
use Arbory\Base\Admin\Form;
use Arbory\Base\Admin\Form\FieldSet;
use Arbory\Base\Admin\Grid;
use Arbory\Base\Admin\Traits\Crudify;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class AdminLogController extends Controller
{
    use Crudify;

    /** @var string */
    protected $resource = AdminLog::class;

    protected function form(Form $form): Form
    {
        $form->setFields(function (FieldSet $fieldSet) {

            $fieldSet->text('created_at')
                ->setLabel(trans('admin-log::common.created_at'));

            $fieldSet->text('request_method')
                ->setLabel(trans('admin-log::common.request_method'))
                ->setRows(6);

            $fieldSet->text('request_uri')
                ->setLabel(trans('admin-log::common.request_uri'))
                ->setRows(6);

            $fieldSet->text('user_name')
                ->setLabel(trans('admin-log::common.user_name'))
                ->setRows(6);

            $fieldSet->text('user_agent')
                ->setLabel(trans('admin-log::common.user_agent'))
                ->setRows(6);

            $fieldSet->text('ip')
                ->setLabel(trans('admin-log::common.ip_address'))
                ->setRows(6);

            $fieldSet->text('ips')
                ->setLabel(trans('admin-log::common.ip_addresses'))
                ->setRows(6);

            $fieldSet->text('http_content_type')
                ->setLabel(trans('admin-log::common.http_content_type'))
                ->setRows(6);

            $fieldSet->text('http_referer')
                ->setLabel(trans('admin-log::common.http_referer'))
                ->setRows(6);

            $fieldSet->add(new Serialization('content'))
                ->setLabel(trans('admin-log::common.content'));

            $fieldSet->add(new Serialization('session'))
                ->setLabel(trans('admin-log::common.session'));

            $fieldSet->add(new Serialization('http_cookie'))
                ->setLabel(trans('admin-log::common.http_cookie'));
        });

        return $form;
    }

    public function grid(Grid $grid): Grid
    {
        $grid->column('user_name', trans('admin-log::common.user_name'))
            ->sortable();

        $grid->column('request_method', trans('admin-log::common.request_method'))
            ->sortable();

        $grid->column('request_uri', trans('admin-log::common.request_uri'))
            ->sortable();

        $grid->column('ip', trans('admin-log::common.ip_address'))
            ->sortable();

        $grid->column('created_at', trans('admin-log::common.created_at'))
            ->sortable();

        $grid->getFilter()->setDefaultOrderBy('created_at');
        $grid->getFilter()->setPerPage(30);

        return $grid;
    }

    public function update(Request $request, $resourceId): JsonResponse|RedirectResponse|Redirector
    {
        if ($request->ajax()) {
            return response()->json(['ok']);
        }

        $resource = $this->findOrNew($resourceId);

        return $this->getAfterEditResponse($request, $resource);
    }
}
