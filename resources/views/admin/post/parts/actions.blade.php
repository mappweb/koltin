<a class="btn btn-primary open-modal" href="{{ route($resource.'.edit', $params) }}" data-toggle="tooltip"
   data-placement="right" title="{{ __('models/'.Str::singular($resource).'.actions.edit') }}">
    <i class="fa fa-pencil"></i>
</a>&nbsp;
<a class="btn btn-danger open-modal" href="{{ route($resource.'.destroy-modal', $params) }}" data-toggle="tooltip"
   title="{{ __('models/'.Str::singular($resource).'.actions.destroy') }}">
    <i class="fa fa-close"></i>
</a>

