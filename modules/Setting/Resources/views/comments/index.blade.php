@extends('backend.layouts.app')
@section('title', localize('comments_list'))
@section('content')
    @include('backend.layouts.common.validation')
    @include('backend.layouts.common.message')
    <div class="card mb-4">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="fs-17 fw-semi-bold mb-0">{{ localize('comments_list') }}</h6>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table display table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="text-center" width="5%">{{ localize('sl') }}</th>
                            <th width="25%">{{ localize('user') }}</th>
                            <th width="20%">{{ localize('comments') }}</th>
                            <th width="15%">{{ localize('post') }}</th>
                            <th width="15%">{{ localize('status') }}</th>
                            <th width="15%">{{ localize('action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($comments->isNotEmpty())
                            @foreach ($comments as $key => $comment)
                                <tr>
                                    <td class="text-center">{{ $key + 1 }}</td>
                                    <td>{{ $comment->user->name ?? 'Guest' }}<br><small>{{ $comment->user->email ?? 'N/A' }}</small>
                                    </td>
                                    <td>{{ $comment->comment }}</td>
                                    <td>
                                        @if ($comment->newsMst)
                                            <a href="{{ __url(($appSettings->language_id == $comment->newsMst->language_id ? null : $comment->newsMst->language->value . '/') . $comment->newsMst->encode_title) }}"
                                                class="text-decoration-underline text-primary" target="_blank">
                                                {{ $comment->newsMst->encode_title }}
                                            </a>
                                        @elseif($comment->videoNews)
                                            <a href="{{ __url(($appSettings->language_id == $comment->videoNews->language_id ? null : $comment->videoNews->language->value . '/') . $comment->videoNews->encode_title) }}"
                                                class="text-decoration-underline text-primary" target="_blank">
                                                {{ $comment->videoNews->encode_title }}
                                            </a>
                                        @elseif($comment->opinion)
                                            <a href="{{ __url(($appSettings->language_id == $comment->opinion->language_id ? null : $comment->opinion->language->value . '/') . $comment->opinion->encode_title) }}"
                                                class="text-decoration-underline text-primary" target="_blank">
                                                {{ $comment->opinion->encode_title }}
                                            </a>
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>
                                        @if ($comment->is_approved)
                                            <span class="badge bg-success">{{ localize('approved') }}</span>
                                        @else
                                            <span class="badge bg-warning">{{ localize('pending') }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @can('update_comment')
                                            @if ($comment->is_approved)
                                                <a href="{{ url('admin/comments/comments_manage/update/' . $comment->id) }}"
                                                    class='btn btn-sm btn-danger'>
                                                    <i class="fa fa-times" aria-hidden="true"></i>
                                                </a>
                                            @else
                                                <a href="{{ url('admin/comments/comments_manage/update/' . $comment->id) }}"
                                                    class='btn btn-sm btn-success'>
                                                    <i class="fa fa-check" aria-hidden="true"></i>
                                                </a>
                                            @endif
                                        @endcan

                                        @can('delete_comment')
                                            <a href="javascript:void(0)" class="btn btn-danger-soft btn-sm delete-confirm"
                                                data-bs-toggle="tooltip" title="Delete"
                                                data-route="{{ route('comments.destroy', $comment->id) }}"
                                                data-csrf="{{ csrf_token() }}"><i class="fa fa-trash"></i></a>
                                        @endcan
                                    </td>
                                </tr>
                                @foreach ($comment->repliesAll as $reply)
                                    <tr>
                                        <td class="text-center">
                                            <i class="fa fa-reply" aria-hidden="true"></i>
                                        </td>
                                        <td class="ps-4">
                                            {{ $reply->user->name ?? 'Guest' }}<br><small>{{ $reply->user->email ?? 'N/A' }}</small>
                                        </td>
                                        <td colspan="2">{{ $reply->reply }}</td>
                                        <td>
                                            @if ($reply->is_approved)
                                                <span class="badge bg-success">{{ localize('approved') }}</span>
                                            @else
                                                <span class="badge bg-warning">{{ localize('pending') }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            @can('update_comment')
                                                @if ($reply->is_approved)
                                                    <a href="{{ route('comments.reply.update', $reply->id) }}"
                                                        class='btn btn-sm btn-danger'>
                                                        <i class="fa fa-times" aria-hidden="true"></i>
                                                    </a>
                                                @else
                                                    <a href="{{ route('comments.reply.update', $reply->id) }}"
                                                        class='btn btn-sm btn-success'>
                                                        <i class="fa fa-check" aria-hidden="true"></i>
                                                    </a>
                                                @endif
                                            @endcan

                                            @can('delete_comment')
                                                <a href="javascript:void(0)" class="btn btn-danger-soft btn-sm delete-confirm"
                                                    data-bs-toggle="tooltip" title="Delete"
                                                    data-route="{{ route('comments.reply.destroy', $reply->id) }}"
                                                    data-csrf="{{ csrf_token() }}"><i class="fa fa-trash"></i></a>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" class="text-center">{{ localize('empty_data') }}</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
