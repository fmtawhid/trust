<?php

namespace Modules\Advertisement\DataTables;

use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Modules\Advertisement\Entities\Advertisement;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Modules\Setting\Entities\Setting;

class AdvertisementDataTable extends DataTable
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

            ->editColumn('theme', function ($row) {
                return $row->themeRelation->name;
            })

            ->editColumn('page', function ($row) {
                $page = '';
                if ($row->page == 1){
                    $page = makeString(['home_page']);
                }elseif ($row->page == 2){
                    $page = makeString(['category','page']);
                }else{
                    $page = makeString(['news','details','page']);
                }

                return $page ?? '';
            })

            ->addColumn('ad_position', function ($row) {
                $ad_position = '';
                if ($row->page == 1){
                    $ad_position = localize('position'). ' '.$row->ad_position;
                }elseif ($row->page == 2){
                    $ad_position = localize('position'). ' '.$row->ad_position;
                }else{
                    $ad_position = localize('position'). ' '.$row->ad_position;
                }

                return $ad_position ?? '';
            })

            ->editColumn('language_id', function ($row) {
                return $row->language->langname;
            })

            ->editColumn('embed_code', function ($row) {
                return $row->embed_code ?? '';
            })

            ->addColumn('action', function ($row) {
                $button = '';
                if (auth()->user()->can('update_advertise')) {
                    $button .= '<button onclick="editAdvDetails(' . $row->id . ', ' . $row->page . ', ' . $row->ad_position . ')" class="btn btn-success-soft btn-sm me-1" ><i class="fas fa-edit"></i></button>';
                }

                if (auth()->user()->can('delete_advertise')) {
                    $button .= '<a href="javascript:void(0)" class="btn btn-danger-soft btn-sm delete-confirm-data-table mt-sm-1 mt-lg-0" data-bs-toggle="tooltip" title="Delete" data-route="' . route('advertise.destroy', $row->uuid) . '" data-csrf="' . csrf_token() . '"><i class="fas fa-trash-alt"></i></a>';
                }

                return $button;
            })

            ->rawColumns(['embed_code', 'ad_position','large_status','mobile_status','action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param Advertisement $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Advertisement $model)
    {
        return $model->newQuery()
        ->leftJoin('themes', 'themes.id', '=', 'ad_s.theme')
        ->select('ad_s.*')
        ->orderByDesc('themes.is_active')   // active theme first
        ->orderBy('ad_s.theme', 'asc')      // theme ID ASC
        ->orderBy('ad_s.page', 'asc')       // page ASC
        ->orderBy('ad_s.ad_position', 'asc');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('advertise-table')
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

            Column::make('theme')
                ->title(localize('theme')),

            Column::make('page')
                ->title(localize('page')),

            Column::make('ad_position')
                ->title(localize('ads_position')),

            Column::make('language_id')
                ->title(localize('language'))
                ->searchable(false)
                ->orderable(false),

            Column::make('embed_code')
                ->title(localize('embed_code'))
                ->width(250),

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
        return 'Advertisement_' . date('YmdHis');
    }
}
