{!! Form::open(['class' => 'floating-labels delete-ajax', 'url' => route('user-comments.destroy', ['comment' => $comment->id])]) !!}

<div class="modal fade modal-crud" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">
                    @lang('models/comment.actions.destroy')
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h4 class="text-center text-danger">@lang('general.messages.confirmDelete', ['label' => $comment->content])</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    {{ __('general.modal.actions.no') }}
                </button>
                <button type="submit" class="btn btn-primary">
                    {{ __('general.modal.actions.yes') }}
                </button>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}
