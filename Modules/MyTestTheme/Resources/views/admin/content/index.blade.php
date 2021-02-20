@extends('admin::layouts.content')

@section('page_title')
    {{ __('myTestTheme::app.admin.contents.title') }}
@stop

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h1>{{ __('myTestTheme::app.admin.contents.title') }}</h1>
            </div>
            <div class="page-action">
                <a href="{{ route('myTestTheme.admin.content.create') }}" class="btn btn-lg btn-primary">
                    {{ __('myTestTheme::app.admin.contents.btn-add-content') }}
                </a>
            </div>
        </div>

        <div class="page-content">
            @inject('myTestTheme_contents', 'Modules\myTestTheme\DataGrids\ContentDataGrid')
            {!! $myTestTheme_contents->render() !!}
        </div>
    </div>
@stop