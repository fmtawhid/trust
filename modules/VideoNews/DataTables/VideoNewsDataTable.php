<?php

namespace Modules\VideoNews\DataTables;

use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use App\Enums\ActivationStatusEnum;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Modules\VideoNews\Entities\VideoNews;

class VideoNewsDataTable extends DataTable
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

            ->editColumn('reporter_id', function ($row) {
                return $row->reporter->name;
            })

            ->editColumn('thumbnail_image', function ($row) {
                $thum_image = '';
                $image = $row->thumbnail_image != NULL ? asset('storage/' . $row->thumbnail_image) : asset('backend/assets/dist/img/nopreview.jpeg');
                $thum_image .= '<img src="'.$image.'" alt="Image" height="100" width="150" style="border: 1px solid #e1e9f1;">';
                return $thum_image;
            })

            ->editColumn('video', function ($row) {
                $video = '';
            
                if (!empty($row->video)) {
                    // Local uploaded video
                    $video_path = asset('storage/' . $row->video);
                    $video .= '<video height="100" width="150" controls style="border: 1px solid #e1e9f1;">
                                <source src="' . $video_path . '" type="video/mp4">
                                Your browser does not support the video tag.
                               </video>';
                } elseif (!empty($row->video_url)) {
                    // External video URL
                    if (strpos($row->video_url, 'youtube.com') !== false || strpos($row->video_url, 'youtu.be') !== false) {
                        $embedUrl = str_replace("watch?v=", "embed/", $row->video_url);
                        $embedUrl = str_replace("youtu.be/", "www.youtube.com/embed/", $embedUrl);
                        $video .= '<iframe width="150" height="100" src="' . $embedUrl . '" frameborder="0" allowfullscreen></iframe>';
                    } else {
                        // Assume it's a direct link to a video file
                        $video .= '<video height="100" width="150" controls style="border: 1px solid #e1e9f1;">
                                    <source src="' . $row->video_url . '" type="video/mp4">
                                    Your browser does not support the video tag.
                                   </video>';
                    }
                } else {
                    // Fallback thumbnail
                    $thumb = asset('backend/assets/dist/img/video_thumb.png');
                    $video .= '<img src="' . $thumb . '" alt="No video" height="100" width="150" style="border: 1px solid #e1e9f1;">';
                }
            
                return $video;
            })

            ->editColumn('total_view', function ($row) {
                return views_format($row->total_view);
            })
            
            ->editColumn('publish_date', function ($row) {
                return \Carbon\Carbon::parse($row->publish_date)->format('Y-m-d');
            })

            ->editColumn('created_at', function ($row) {
                return \Carbon\Carbon::parse($row->created_at)->format('Y-m-d');
            })


            ->addColumn('status', function ($row) {

                $status = '';

                if (auth()->user()->can('update_video_news') || auth()->user()->can('read_video_news')) {

                    if ($row->status === ActivationStatusEnum::ACTIVE){
                        $status .= '<a href="javascript:void(0)" class="btn btn-labeled btn-success mb-2 mr-1 videonews-status-update"
                            data-bs-toggle="tooltip" title="Update"
                            data-route="'.route('videonews.status.update', $row->id).'"
                            data-csrf="'.csrf_token().'">' . localize('publish') . '
                        </a>';

                    }else{
                        $status .= '<a href="javascript:void(0)" class="btn btn-labeled btn-warning mb-2 mr-1 videonews-status-update"
                            data-bs-toggle="tooltip" title="Update"
                            data-route="'.route('videonews.status.update', $row->id).'"
                            data-csrf="'.csrf_token().'">' . localize('unpublish') . '
                        </a>';
                    }
                }

                return $status;
            })

            ->addColumn('action', function ($row) {
                $button = '';

                if (auth()->user()->can('update_video_news')) {
                    $button .= '<a href="' . route('videonews.edit', ['videonews' => $row->id]) . '" class="btn btn-success-soft btn-sm me-1" ><i class="fas fa-edit"></i></a>';
                }

                if (auth()->user()->can('delete_video_news')) {
                    $button .= '<a href="javascript:void(0)" class="btn btn-danger-soft btn-sm delete-confirm-data-table mt-sm-1 mt-lg-0" data-bs-toggle="tooltip" title="Delete" data-route="' . route('videonews.destroy', $row->id) . '" data-csrf="' . csrf_token() . '"><i class="fas fa-trash-alt"></i></a>';
                }

                return $button;
            })

            ->rawColumns(['thumbnail_image', 'video', 'status', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param VideoNews $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(VideoNews $model)
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
            ->setTableId('videonews-table')
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
                    ->text('<i class="fa fa-file-csv"></i> CSV')->exportOptions(['columns' => [0, 3, 4, 5, 6, 7, 8, 9]]),
                Button::make('excel')
                    ->className('btn btn-secondary buttons-excel buttons-html5 btn-sm prints')
                    ->text('<i class="fa fa-file-excel"></i> Excel')
                    ->extend('excelHtml5')->exportOptions(['columns' => [0, 3, 4, 5, 6, 7, 8, 9]]),
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

            Column::make('thumbnail_image')
                ->title(localize('thumbnail_image'))
                ->width(150)
                ->orderable(false),

            Column::make('video')
                ->title(localize('video'))
                ->width(150)
                ->orderable(false),

            Column::make('title')
                ->title(localize('title')),

            Column::make('reporter_id')
                ->title(localize('post_by')),

            Column::make('total_view')
                ->title(localize('views')),

            Column::make('publish_date')
                ->title(localize('release_date')),

            Column::make('created_at')
                ->title(localize('post_date')),

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
        return 'Videonews_' . date('YmdHis');
    }
}
