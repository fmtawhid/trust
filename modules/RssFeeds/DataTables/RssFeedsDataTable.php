<?php

namespace Modules\RssFeeds\DataTables;

use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use App\Enums\ActivationStatusEnum;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Modules\RssFeeds\Entities\RssFeed;

class RssFeedsDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()

            ->editColumn('paper_language', function ($row) {
                return $row->language->langname;
            })

            ->addColumn('status', function ($row) {

                $status = '';

                if (auth()->user()->can('update_external_rss_feeds') || auth()->user()->can('read_external_rss_feeds')) {

                    if ($row->status === 1){
                        $status .= '<a href="javascript:void(0)" class="btn btn-sm btn-success rss_feeds-status-update"
                            data-bs-toggle="tooltip" title="Update"
                            data-route="'.route('rss_feeds.status.update', $row->id).'"
                            data-csrf="'.csrf_token().'"><i class="hvr-buzz-out far fa-check-circle"></i>
                        </a>';

                    }else{
                        $status .= '<a href="javascript:void(0)" class="btn btn-sm btn-danger rss_feeds-status-update"
                            data-bs-toggle="tooltip" title="Update"
                            data-route="'.route('rss_feeds.status.update', $row->id).'"
                            data-csrf="'.csrf_token().'"><i class="hvr-buzz-out far fa-times-circle"></i>
                        </a>';
                    }
                }

                return $status;
            })

            ->addColumn('action', function ($row) {
                $button = '';

                if (auth()->user()->can('update_external_rss_feeds')) {
                    $button .= '<a href="' . route('rss_feeds.edit', $row->id) . '" class="btn btn-success-soft btn-sm me-1" data-bs-toggle="tooltip" title="' . localize("edit") . '">
                        <i class="fas fa-edit"></i>
                    </a>';
                }

                if (auth()->user()->can('delete_external_rss_feeds')) {
                    $button .= '<a href="javascript:void(0)" class="btn btn-danger-soft btn-sm delete-confirm-data-table mt-sm-1 mt-lg-0"
                        data-bs-toggle="tooltip"
                        title="Delete"
                        data-route="' . route('rss_feeds.destroy', $row->id) . '"
                        data-csrf="' . csrf_token() . '">
                        <i class="fas fa-trash-alt"></i></a>';
                }

                return $button;
            })

            ->rawColumns(['image','status','action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param RssFeed $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(RssFeed $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('rss-feeds-table')
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
                    ->text('<i class="fa fa-file-csv"></i> CSV')->exportOptions(['columns' => [0, 1, 2, 3, 4, 5]]),
                Button::make('excel')
                    ->className('btn btn-secondary buttons-excel buttons-html5 btn-sm prints')
                    ->text('<i class="fa fa-file-excel"></i> Excel')
                    ->extend('excelHtml5')->exportOptions(['columns' => [0, 1, 2, 3, 4, 5]]),
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

            Column::make('feed_name')
                ->title(localize('feed_name')),

            Column::make('feed_url')
                ->title(localize('feed_url')),

            Column::make('paper_language')
                ->title(localize('language')),

            Column::make('posts')
                ->title(localize('posts')),

            Column::make('status')
                ->title(localize('status'))
                ->addClass('text-center')
                ->width(50)
                ->orderable(false),

            Column::make('action')
                ->title(localize('action'))->addClass('column-sl text-center')->orderable(false)
                ->width(115)
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
        return 'RssFeeds_' . date('YmdHis');
    }
}
