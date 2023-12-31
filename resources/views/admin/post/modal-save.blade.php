{!! Form::open(['class' => 'save-ajax', 'url' => $post->exists? route('posts.update', ['post' => $post->id]) : route('posts.store'), 'method' => $post->exists? 'PUT' : 'POST']) !!}
<!-- Modal -->
<div class="modal fade modal-crud" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                 @if($post->exists)
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">
                        @lang('models/post.actions.edit') - {{ $post->title }}
                    </h1>
                @else
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">
                        @lang('models/post.actions.create')
                    </h1>
                @endif

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <!-- START REPEAT THIS COL -->
                    <div class="col-md-12">
                        <div class="form-group m-b-40 focused">
                            {!! Form::label('title', __('models/post.fillable.title')) !!}
                            {!! Form::text('title', $post->title , ['class' => 'form-control']) !!}
                            <span data-feedback="title"><small></small></span>
                        </div>
                    </div>
                    <!-- END REPEAT THIS COL -->
                    <!-- START REPEAT THIS COL -->
                    <div class="col-md-12">
                        <div class="form-group m-b-40 focused">
                            {!! Form::label('content', __('models/post.fillable.content')) !!}
                            {!! Form::textarea('content', $post->content, ['class' => 'form-control summernote']) !!}
                            <span data-feedback="content"><small></small></span>
                        </div>
                    </div>
                    <!-- END REPEAT THIS COL -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    {{ __('general.modal.actions.close') }}
                </button>
                <button type="submit" class="btn btn-primary">
                    {{ __('general.modal.actions.save') }}
                </button>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}

<script type="text/javascript">
    $(document).ready(function () {
        $('.summernote').summernote(
            {
                height: 300
            }
        );
    });
</script>
