@if(empty($post->created_by))
    <div class="card-text fs-5 fw-bold float-start">
        <small class="text-muted">
            {{ $post->author->full_name ?? __('auth.anonymous_user') }}
        </small>
    </div>
@else
    <a href="{{ $route }}"
       class="card-text fs-5 fw-bold float-start">
        <small class="text-muted">
            {{ $post->author->full_name ?? __('auth.anonymous_user') }}
        </small>
    </a>
@endif
