<?php

namespace App\DataTables;

use App\Models\PhotoLibrary;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class PhotoLibraryDataTable extends DataTable
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

            // ✅ IMAGE PREVIEW (only show images & labels — no View button)
            ->addColumn('image_path', function ($row) {
                $thumb = $row->thumb_image ? asset($row->thumb_image) : null;
                $large = $row->large_image ? asset($row->large_image) : null;

                $html = '';

                if ($thumb) {
                    $html .= '
                    <div class="text-center mb-1">
                        <img src="' . $thumb . '" alt="Thumb" 
                             style="height:60px; width:auto; border-radius:4px; box-shadow:0 0 3px rgba(0,0,0,0.2);">
                        <div><small>Thumb</small></div>
                    </div>';
                }

                if ($large) {
                    $html .= '
                    <div class="text-center">
                        <img src="' . $large . '" alt="Large" 
                             style="height:60px; width:auto; border-radius:4px; box-shadow:0 0 3px rgba(0,0,0,0.2);">
                        <div><small>Large</small></div>
                    </div>';
                }

                return $html ?: '<small>No image</small>';
            })

            // ✅ ACTION COLUMN
            ->addColumn('action', function ($row) {
                $button = '';

                if (auth()->user()->can('delete_media_library')) {
                    $button .= '<a href="javascript:void(0)" 
                        class="btn btn-danger-soft btn-sm mt-sm-1 mt-lg-0 delete-button" 
                        data-bs-toggle="tooltip" 
                        title="' . localize("delete") . '" 
                        data-action="' . route('photo-library.destroy', ['photo_library' => $row->id]) . '">
                        <i class="fas fa-trash-alt"></i>
                    </a>';
                }

                return $button;
            })

            // ✅ IMAGE URLS + COPY BUTTON FIXED
            ->editColumn('image_base_url', function ($row) {
                $thumbUrl = $row->thumb_image ? asset($row->thumb_image) : null;
                $largeUrl = $row->large_image ? asset($row->large_image) : null;

                if (!$thumbUrl && !$largeUrl) {
                    return '<small>No URL</small>';
                }

                $html = '<div class="d-flex flex-column gap-2">';

                // Thumb URL
                if ($thumbUrl) {
                    $html .= '
                    <div class="d-flex align-items-center gap-2">
                        <input type="text" id="thumb-' . $row->id . '" 
                            value="' . $thumbUrl . '" readonly 
                            class="form-control form-control-sm" style="max-width:250px;">
                        <button type="button" class="btn btn-sm btn-primary copy-btn" data-target="thumb-' . $row->id . '">
                            <i class="fa fa-copy"></i>
                        </button>
                        <a href="' . $thumbUrl . '" target="_blank" class="btn btn-sm btn-success">
                            <i class="fa fa-eye"></i>
                        </a>
                        <small>Thumb</small>
                    </div>';
                }

                // Large URL
                if ($largeUrl) {
                    $html .= '
                    <div class="d-flex align-items-center gap-2">
                        <input type="text" id="large-' . $row->id . '" 
                            value="' . $largeUrl . '" readonly 
                            class="form-control form-control-sm" style="max-width:250px;">
                        <button type="button" class="btn btn-sm btn-primary copy-btn" data-target="large-' . $row->id . '">
                            <i class="fa fa-copy"></i>
                        </button>
                        <a href="' . $largeUrl . '" target="_blank" class="btn btn-sm btn-success">
                            <i class="fa fa-eye"></i>
                        </a>
                        <small>Large</small>
                    </div>';
                }

                $html .= '</div>';

                return $html;
            })

            ->rawColumns(['category_name', 'image_path', 'action', 'image_base_url']);
    }

    /**
     * Get query source of dataTable.
     */
    public function query(PhotoLibrary $model)
    {
        return $model->newQuery()->orderBy('created_at', 'desc');
    }

    /**
     * Optional method if you want to use html builder.
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('category-table')
            ->setTableAttribute('class', 'table table-hover table-bordered align-middle table-sm')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->language([
                'processing' => '<div class="lds-spinner">
                <div></div><div></div><div></div><div></div><div></div>
                <div></div><div></div><div></div><div></div><div></div>
                <div></div><div></div></div>',
            ])
            ->responsive(true)
            ->selectStyleSingle()
            ->lengthMenu([[10, 25, 50, 100, -1], [10, 25, 50, 100, 'All']])
            ->dom("<'row mb-3'<'col-md-4'l><'col-md-4'f><'col-md-4 text-end'B>>rt<'bottom'<'row'<'col-md-6'i><'col-md-6'p>>><'clear'>")
            ->buttons([
                Button::make('csv')
                    ->className('btn btn-secondary buttons-csv buttons-html5 btn-sm prints')
                    ->text('<i class="fa fa-file-csv"></i> CSV')
                    ->exportOptions(['columns' => [0, 1, 2]]),
                Button::make('excel')
                    ->className('btn btn-secondary buttons-excel buttons-html5 btn-sm prints')
                    ->text('<i class="fa fa-file-excel"></i> Excel')
                    ->exportOptions(['columns' => [0, 1, 2]]),
            ]);
    }

    /**
     * Get columns.
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

            Column::make('image_path')->title(localize('image')),
            Column::make('picture_name')->title(localize('image_name')),
            Column::make('title')->title(localize('title')),
            Column::make('category')->title(localize('category')),
            Column::make('image_base_url')->title(localize('image_url')),
            Column::make('action')
                ->title(localize('action'))
                ->addClass('column-sl')
                ->orderable(false)
                ->searchable(false)
                ->printable(false)
                ->exportable(false),
        ];
    }

    /**
     * Get filename for export.
     */
    protected function filename(): string
    {
        return 'Photo_Library_' . date('YmdHis');
    }
}


