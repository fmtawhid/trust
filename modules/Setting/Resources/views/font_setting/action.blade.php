<a href="{{ route('admin.font.settings.edit', $row->id) }}" class="btn btn-sm btn-primary me-1" data-bs-toggle="tooltip"
    title="{{ localize('update') }}"><i class="fa fa-edit"></i></a>
<a href="javascript:void(0)" class="btn btn-sm btn-danger delete-confirm" data-bs-toggle="tooltip"
    title="{{ localize('delete') }}" data-route="{{ route('admin.font.settings.destroy', $row->id) }}"
    data-csrf="{{ csrf_token() }}"><i class="fa fa-trash"></i></a>
