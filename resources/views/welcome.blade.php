@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="row">
                @foreach($posts as $post)
                    <div class="col-sm-6 mb-2">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">
                                    {{ ucfirst($post->title) }}
                                </h5>
                                <small class="text-muted float-start">
                                    {{ $post->created_at->diffForHumans() }}
                                </small>
                                <br>
                                <p class="card-text">
                                    {{ \Illuminate\Support\Str::limit(strip_tags($post->content), 67, $end='...') }}
                                </p>
                                <p class="card-text float-start">
                                    <small class="text-muted">
                                        {{ $post->author->full_name ?? '' }}
                                    </small>
                                </p>
                                <a href="{{ route('blog.show', ['post' => $post->id]) }}" class="btn btn-primary float-end">
                                    @lang('general.messages.more')
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
                {{ $posts->links() }}
            </div>
        </div>
    </div>
@endsection
