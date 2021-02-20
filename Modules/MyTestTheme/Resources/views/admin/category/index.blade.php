@extends('admin::layouts.content')

@section('page_title')
    {{ __('myTestTheme::app.admin.category.title') }}
@stop

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h1>{{ __('myTestTheme::app.admin.category.title') }}</h1>
            </div>
            <div class="page-action">
                <a href="{{ route('myTestTheme.admin.category.create') }}" class="btn btn-lg btn-primary">
                    {{ __('myTestTheme::app.admin.category.btn-add-category') }}
                </a>
            </div>
        </div>

        <div class="page-content">
            @inject('myTestTheme_category', 'Modules\myTestTheme\DataGrids\CategoryDataGrid')
            {!! $myTestTheme_category->render() !!}
        </div>
    </div>
@stop