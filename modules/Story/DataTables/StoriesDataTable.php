<?php

namespace Modules\Story\DataTables;

use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Modules\Story\Entities\Story;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class StoriesDataTable extends DataTable
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

            ->editColumn('language_id', function ($row) {
                return $row->language->langname;
            })

            ->addColumn('action', function ($row) {
                $button = '';

                if (auth()->user()->can('read_story')) {
                    $button .= '<button class="btn btn-success-soft btn-sm me-1 view" data-bs-toggle="modal" data-bs-target="#story_views" data-story="'.$row->id.'"><i class="fas fa-eye"></i></button>';
                }

                if (auth()->user()->can('update_story')) {
                    $button .= '<button class="btn btn-warning-soft btn-sm me-1 edit-story" data-bs-toggle="modal" data-bs-target="#story_update" data-story="'.$row->id.'"><i class="fas fa-edit"></i></button>';
                }

                if (auth()->user()->can('delete_story')) {
                    $button .= '<a href="javascript:void(0)" class="btn btn-danger-soft btn-sm mt-sm-1 mt-lg-0 delete-button" data-bs-toggle="tooltip" title="' . localize("delete") . '" data-action="' . route('admin.story.destroy', ['story' => $row->id]) . '" ><i class="fas fa-trash-alt"></i></a>';
                }

                return $button;
            })

            ->rawColumns(['action']);
    }

    /**
     * Story query method.
     * @param \Modules\Story\Entities\Story $model
     * @return QueryBuilder
     */
    public function query(Story $model)
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
            ->setTableId('story-table')
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
                    ->text('<i class="fa fa-file-csv"></i> CSV')->exportOptions(['columns' => [0, 1, 2, 3, 4]]),
                Button::make('excel')
                    ->className('btn btn-secondary buttons-excel buttons-html5 btn-sm prints')
                    ->text('<i class="fa fa-file-excel"></i> Excel')
                    ->extend('excelHtml5')->exportOptions(['columns' => [0, 1, 2, 3, 4]]),
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
            Column::make('title')->title(localize('title')),
            Column::make('views')->title(localize('total_views')),
            Column::make('created_at')->title(localize('created_at')),
            Column::make('language_id')
                ->title(localize('language'))
                ->searchable(false)
                ->orderable(false),
            Column::computed('action')
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
        return 'Story_' . date('YmdHis');
    }

}
