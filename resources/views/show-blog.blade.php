@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card border-0">
            <div class="card-body">
                <h1 class="font-weight-bold text-dark">
                    {{ $post->title }}
                </h1>
                <small class="text-muted float-start">
                    {{ $post->created_at->diffForHumans() }}
                </small>
                <p class="text-center justify-content-center">
                    {{ strip_tags($post->content) }}
                </p>
            </div>
        </div>
        <hr class="hr"/>
        <div class="row">
            <div class="float-end mt-2 mb-2">
                <a href="{{ route('comments.create', ['post' => $post->id]) }}"
                   class="btn btn-primary btn-sm float-end open-modal">
                    @lang('models/comment.actions.postComment')
                </a>
            </div>
        </div>
        <div class="row">
            <section style="background-color: #eee;">
                <div class="container">
                    <div class="row d-flex justify-content-center">
                        @foreach($post->comments as $comment)
                            <div class="col-md-12 col-lg-10 col-xl-8 mt-3 mb-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex flex-start align-items-center">
                                            <div>
                                                <h6 class="fw-bold text-primary mb-1">
                                                    {{ $comment->createdBy->full_name }}
                                                </h6>
                                                <p class="text-muted small mb-0">
                                                    {{ $comment->created_at->diffForHumans() }}
                                                </p>
                                            </div>
                                        </div>

                                        <p class="mt-3 mb-4 pb-2">
                                            {{ strip_tags($comment->content) }}
                                        </p>

                                        <div class="float-end">
                                            <a class="btn btn-danger open-modal" href="{{ route('comments.destroy-modal', ['comment' => $comment->id]) }}" data-toggle="tooltip"
                                               title="{{ __('models/comment.actions.destroy') }}">
                                                @lang('models/comment.actions.destroy')
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        $(document).ready(function () {
            $('.summernote').summernote();
        });
    </script>
@endsection
