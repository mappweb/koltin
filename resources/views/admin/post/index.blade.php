@extends('layouts.app')

@section('css')

    <link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="d-none d-sm-inline-block float-start">
                            {{ trans_choice('models/post.module', 2) }}
                        </h4>
                        <a href="{{ route('posts.create') }}"
                           class="btn btn-primary btn-rounded btn-sm float-end open-modal">
                            @lang('models/post.actions.create')
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            {!! $table->table(['class' => 'table', 'style' => 'width: 100%;']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    {!! $table->scripts() !!}
@endsection
