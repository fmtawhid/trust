<?php

namespace Modules\News\DataTables;

use App\Models\NewsMst;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Modules\Setting\Entities\Application;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class NewsDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        $appSettings = Application::first();

        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('category_name', function ($row) {

                if ($row->category) {
                    return '<span class="badge bg-success mr-1">' . ucwords($row->category->category_name ?? null) . '</span>';
                }

                return null;
            })
            ->addColumn('sub_category', function ($row) {

                if ($row->subCategory) {
                    return '<span class="badge bg-success mr-1">' . ucwords($row->subCategory->category_name ?? null) . '</span>';
                }

                return null;
            })
            ->editColumn('title', function ($row) {
                return htmlspecialchars_decode($row->title);
            })

            ->editColumn('language_id', function ($row) {
                return $row->language->langname;
            })

            ->editColumn('status', function ($row) {
                $html      = '';
                $className = "";

                if (auth()->user()->can('update_news')) {
                    $className = "update-status-button";
                }

                if ($row->status == 1) {
                    $html .= '<span class="btn btn-labeled btn-success '.$className.'" title="' . localize('publish') . '" data-action="' . route('news.update-status', ['news' => $row->id]) . '" data-update_status="0" >' . localize('publish') . '</span>';
                } else {
                    $html .= '<span class="btn btn-labeled btn-warning '.$className.'" title="' . localize('unpublish') . '" data-action="' . route('news.update-status', ['news' => $row->id]) . '" data-update_status="1" >' . localize('unpublish') . '</span>';
                }

                return $html;
            })

            ->editColumn('publish_date', function ($row) {

                if ($row->publish_date) {
                    return $row->publish_date->format('Y-m-d');
                }

                return null;
            })
            ->editColumn('post_date', function ($row) {

                if ($row->post_date) {
                    return $row->post_date->format('Y-m-d');
                }

                return null;
            })
            ->addColumn('news_image_path', function ($row) {

                if ($row->photoLibrary) {
                    return '<img src="' . ($row->photoLibrary->image_base_url ?? null) . '" style="height:60; width:100px">';
                }

                return null;
            })
            ->addColumn('post_by_user_name', function ($row) {

                if ($row->reporterBy) {
                    return $row->reporterBy->name ?? null;
                }

                return null;
            })

            ->editColumn('is_posted_to_social', function ($row) {
                $html      = '';
                $className = "";

                if (auth()->user()->can('update_auto_posting_media')) {
                    $className = "auto-social-post-btn"; 
                }

                if ($row->is_posted_to_social == 1) {
                    $html .= '<span class="btn btn-labeled btn-success cursor-default" title="' . localize('social_post') . '" >' . localize('posted') . '</span>';
                } else {
                    $html .= '<span class="btn btn-labeled btn-warning '.$className.'" title="' . localize('social_post') . '" data-action="' . route('news.social.post', ['news' => $row->id]) . '" >' . localize('post') . '</span>';
                }

                return $html;
            })

            ->addColumn('action', function ($row) use ($appSettings) {
                $button = '';

                if (auth()->user()->can('update_news')) {
                    $button .= '<a href="' . route('news.edit', ['news' => $row->id]) . '" class="btn btn-success-soft btn-sm me-1" data-bs-toggle="tooltip" title="' . localize("update") . '" ><i class="fas fa-edit"></i></a>';
                }

                if (auth()->user()->can('delete_news')) {
                    $button .= '<a href="javascript:void(0)" class="btn btn-danger-soft btn-sm mt-sm-1 mt-lg-0 delete-button" data-bs-toggle="tooltip" title="' . localize("delete") . '" data-action="' . route('news.destroy', ['news' => $row->id]) . '" ><i class="fas fa-trash-alt"></i></a>';
                }

                $button .= '<a href="' . __url(($appSettings->language_id == $row->language->id ? null : $row->language->value . '/') . $row->encode_title) . '" class="btn btn-success-soft btn-sm ms-1" data-bs-toggle="tooltip" title="' . localize("view") . '" target="_blank"><i class="fas fa-eye"></i></a>';

                return $button;
            })

            ->rawColumns(['category_name', 'sub_category', 'news_image_path', 'action', 'status', 'is_posted_to_social']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param NewsMst $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(NewsMst $model)
    {
        return $model->newQuery()
            ->with('category', 'postByUser', 'photoLibrary', 'reporterBy')
            ->where(function ($query) {

                if (auth()->user()->user_type_id == 2) {
                    $query->where('reporter_id', auth()->user()->reporter->id ?? null);
                }

                if (!empty($this->request()->input('from_date'))) {
                    $query->where('publish_date', '>=', $this->request()->input('from_date'));
                }

                if (!empty($this->request()->input('to_date'))) {
                    $query->where('publish_date', '<=', $this->request()->input('to_date'));
                }

                if (!empty($this->request()->input('other_page'))) {
                    $query->where('category_id', '=', $this->request()->input('other_page'));
                }

                if (!empty($this->request()->input('sub_category_id'))) {
                    $query->where('sub_category_id', '=', $this->request()->input('sub_category_id'));
                }

                if (!empty($this->request()->input('title'))) {
                    $query->where('title', 'LIKE', '%' . $this->request()->input('title') . '%');
                }

            })
            ->orderBy('created_at', 'desc');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('news-table')
            ->setTableAttribute('class', 'table table-hover table-bordered align-top table-sm')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->language([
                'processing' => '<div class="lds-spinner">
                <div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>',
            ])
            ->responsive(true)
            ->selectStyleSingle()
            ->lengthMenu([[10, 25, 50, 100, -1], [10, 25, 50, 100, 'All']])
            ->dom("<'row mb-3'<'col-md-4'l><'col-md-4 text-center'B><'col-md-4'f>>rt<'bottom'<'row'<'col-md-6'i><'col-md-6'p>>><'clear'>")
            ->buttons([
                Button::make('csv')
                    ->className('btn btn-secondary buttons-csv buttons-html5 btn-sm prints')
                    ->text('<i class="fa fa-file-csv"></i> CSV')->exportOptions(['columns' => [0, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]]),
                Button::make('excel')
                    ->className('btn btn-secondary buttons-excel buttons-html5 btn-sm prints')
                    ->text('<i class="fa fa-file-excel"></i> Excel')
                    ->extend('excelHtml5')->exportOptions(['columns' => [0, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]]),
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns(): array
    {
        return [
            Column::make('DT_RowIndex')
                ->title(localize('sl'))
                ->addClass('text-center column-sl')
                ->width(50)
                ->searchable(false)
                ->orderable(false),

            Column::make('news_image_path')->title(localize('image')),
            Column::make('title')->title(localize('title')),
            Column::make('category_name')->title(localize('category')),
            Column::make('sub_category')->title(localize('sub_category')),
            Column::make('reader_hit')->title(localize('hit')),
            Column::make('post_by_user_name')->title(localize('post_by')),
            Column::make('publish_date')->title(localize('release_date')),
            Column::make('post_date')->title(localize('post_date')),
            Column::make('language_id')
                ->title(localize('language'))
                ->searchable(false)
                ->orderable(false),
            Column::make('status')->title(localize('status')),
            Column::make('is_posted_to_social')->title(localize('social_post'))->addClass('text-center'),
            Column::make('action')
                ->title(localize('action'))->addClass('column-sl')->orderable(false)
                ->searchable(false)
                ->printable(false)
                ->exportable(false),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'News_' . date('YmdHis');
    }

}
