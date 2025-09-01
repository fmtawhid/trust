<?php

namespace Modules\Poll\DataTables;

use Modules\Poll\Entities\Poll;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use App\Enums\ActivationStatusEnum;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class PollDataTable extends DataTable
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

            ->editColumn('vote_permission', function ($row) {

                if ($row->vote_permission == 0) {
                    return localize('all_users_can_vote');
                } else {
                    return localize('only_registered_users_can_vote');
                }
            })

            ->editColumn('language_id', function ($row) {
                return $row->language->langname;
            })

            ->addColumn('status', function ($row) {

                $status = '';

                if (auth()->user()->can('update_poll') || auth()->user()->can('read_poll')) {

                    if ($row->status === ActivationStatusEnum::ACTIVE){
                        $status .= '<a href="javascript:void(0)" class="btn btn-sm btn-success poll-status-update"
                            data-bs-toggle="tooltip" title="Update"
                            data-route="'.route('poll.status.update', $row->id).'"
                            data-csrf="'.csrf_token().'"><i class="hvr-buzz-out far fa-check-circle"></i>
                        </a>';

                    }else{
                        $status .= '<a href="javascript:void(0)" class="btn btn-sm btn-danger poll-status-update"
                            data-bs-toggle="tooltip" title="Update"
                            data-route="'.route('poll.status.update', $row->id).'"
                            data-csrf="'.csrf_token().'"><i class="hvr-buzz-out far fa-times-circle"></i>
                        </a>';
                    }
                }

                return $status;
            })

            ->addColumn('action', function ($row) {
                $button = '';
                if (auth()->user()->can('read_poll')) {
                    $button .= '<button onclick="pollResultDetails(' . $row->id . ')" class="btn btn-info-soft btn-sm me-1" ><i class="fas fa-poll"></i></button>';
                }

                if (auth()->user()->can('update_poll')) {
                    $button .= '<button onclick="editPollDetails(' . $row->id . ')" class="btn btn-success-soft btn-sm me-1" ><i class="fas fa-edit"></i></button>';
                }

                if (auth()->user()->can('delete_poll')) {
                    $button .= '<a href="javascript:void(0)" class="btn btn-danger-soft btn-sm delete-confirm-data-table mt-sm-1 mt-lg-0" data-bs-toggle="tooltip" title="Delete" data-route="' . route('poll.destroy', $row->id) . '" data-csrf="' . csrf_token() . '"><i class="fas fa-trash-alt"></i></a>';
                }

                return $button;
            })

            ->rawColumns(['image','status','action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param Poll $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Poll $model)
    {
        return $model->newQuery()
            ->orderBy('id', 'desc');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('poll-table')
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
                    ->text('<i class="fa fa-file-csv"></i> CSV')->exportOptions(['columns' => [0, 1, 2, 3]]),
                Button::make('excel')
                    ->className('btn btn-secondary buttons-excel buttons-html5 btn-sm prints')
                    ->text('<i class="fa fa-file-excel"></i> Excel')
                    ->extend('excelHtml5')->exportOptions(['columns' => [0, 1, 2, 3]]),
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

            Column::make('question')
                ->title(localize('question')),

            Column::make('vote_permission')
                ->title(localize('vote_permission')),

            Column::make('language_id')
                ->title(localize('language'))
                ->searchable(false)
                ->orderable(false),

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
        return 'Poll_' . date('YmdHis');
    }
}
