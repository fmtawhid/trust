<?php

namespace Modules\Category\DataTables;

use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Modules\Category\Entities\Category;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CategoryDataTable extends DataTable
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
            ->editColumn('category_name', function ($row) {
                return $row->category_name ? $row->category_name : '';
            })

            ->editColumn('parent_category', function ($row) {
                return $row->get_parent_category->category_name ?? '';
            })

            ->editColumn('slug', function ($row) {
                return $row->slug ?? '';
            })

            ->editColumn('language_id', function ($row) {
                return $row->language->langname;
            })

            ->addColumn('color_code', function ($row) {
                return '<span class="badge" style="background-color: ' . $row->color_code . '; color: #fff; line-height: 1.5;">' . $row->color_code . '</span>';
            })

            ->addColumn('action', function ($row) {
                $button = '';
                if (auth()->user()->can('update_category')) {
                    $button .= '<button onclick="editCategoryDetails(' . $row->id . ')" class="btn btn-success-soft btn-sm me-1" ><i class="fas fa-edit"></i></button>';
                }

                if (auth()->user()->can('delete_category')) {
                    $button .= '<a href="javascript:void(0)" class="btn btn-danger-soft btn-sm delete-confirm-data-table mt-sm-1 mt-lg-0" data-bs-toggle="tooltip" title="Delete" data-route="' . route('category.destroy', $row->uuid) . '" data-csrf="' . csrf_token() . '"><i class="fas fa-trash-alt"></i></a>';
                }

                if ($row->img_status == 1){
                    $button .= '<a href="javascript:void(0)" class="btn btn-sm btn-danger img-status-change ms-1"
                        data-bs-toggle="tooltip" title="Update"
                        data-route="'.route('category.save_category_img_status', $row->uuid).'"
                        data-csrf="'.csrf_token().'"><i class="hvr-buzz-out far fa-times-circle"></i>
                    </a>';

                } else {
                    $button .= '<a href="javascript:void(0)" class="btn btn-sm btn-success img-status-change ms-1"
                        data-bs-toggle="tooltip" title="Update"
                        data-route="'.route('category.save_category_img_status', $row->uuid).'"
                        data-csrf="'.csrf_token().'">
                        <i class="hvr-buzz-out far fa-check-circle"></i>
                    </a>';
                }

                return $button;
            })

            ->rawColumns(['color_code', 'category_image','action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param Category $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Category $model)
    {
        return $model->newQuery()
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
            ->setTableId('category-table')
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

            Column::make('category_name')
                ->title(localize('category_name')),

            Column::make('parent_category')
                ->title(localize('parent_category'))
                ->searchable(false)
                ->orderable(false),

            Column::make('slug')
                ->title(localize('slug')),

            Column::make('language_id')
                ->title(localize('language'))
                ->searchable(false)
                ->orderable(false),

            Column::make('color_code')
                ->title(localize('color_code'))
                ->searchable(false)
                ->orderable(false),

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
        return 'Category_' . date('YmdHis');
    }
}
