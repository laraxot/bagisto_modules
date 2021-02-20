@extends('admin::layouts.content')

@section('page_title')
    {{ __('myTestTheme::app.admin.category.edit-title') }}
@stop

@section('content')
    <div class="content">

        <form method="POST" action="" @submit.prevent="onSubmit" enctype="multipart/form-data">

            <div class="page-header">
                <div class="page-title">
                    <h1>
                        <i class="icon angle-left-icon back-link" onclick="window.location = history.length > 1 ? document.referrer : '{{ route('admin.dashboard.index') }}'"></i>

                        {{ __('myTestTheme::app.admin.category.edit-title') }}
                    </h1>
                </div>

                <div class="page-action">
                    <button type="submit" class="btn btn-lg btn-primary">
                        {{ __('myTestTheme::app.admin.category.save-btn-title') }}
                    </button>
                </div>
            </div>

            <div class="page-content">
                @csrf()
                <input name="_method" type="hidden" value="PUT">

                {!! view_render_event('bagisto.admin.category.edit_form_accordian.general.before', ['myTestThemeCategory' => $myTestThemeCategory]) !!}

                <accordian :title="'{{ __('myTestTheme::app.admin.category.tab.general') }}'" :active="true">
                    <div slot="body">

                        {!! view_render_event('bagisto.admin.category.edit_form_accordian.general.content.before', ['myTestThemeCategory' => $myTestThemeCategory]) !!}

                            <div class="control-group" :class="[errors.has('category_id') ? 'has-error' : '']">
                                <label for="category_id" class="required">
                                    {{ __('myTestTheme::app.admin.category.select-category') }}
                                </label>

                                <select v-validate="'required'" class="control" id="category_id" name="category_id" data-vv-as="&quot;{{ __('myTestTheme::app.admin.category.select-category') }}&quot;" disabled="disabled">
                                    <option value="">{{ __('myTestTheme::app.admin.category.select') }}</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category['id'] }}" {{ $myTestThemeCategory->category_id == $category['id'] ? 'selected' : '' }}>{{ $category['name'] }}</option>
                                    @endforeach
                                </select>

                                <span class="control-error" v-if="errors.has('category_id')">@{{ errors.first('category_id') }}</span>
                            </div>

                            <div class="control-group" :class="[errors.has('icon') ? 'has-error' : '']">
                                <label for="icon" class="required">
                                    {{ __('myTestTheme::app.admin.category.icon-class') }}
                                </label>

                                <input type="text" v-validate="'required'" class="control" id="icon" name="icon" value="{{ $myTestThemeCategory->icon }}" data-vv-as="&quot;{{ __('myTestTheme::app.admin.category.icon-class') }}&quot;" />

                                <span class="control-error" v-if="errors.has('icon')">@{{ errors.first('icon') }}</span>
                            </div>

                            <div class="control-group" :class="[errors.has('tooltip') ? 'has-error' : '']">
                                <label for="tooltip">
                                    {{ __('myTestTheme::app.admin.category.tooltip-content') }}
                                </label>

                                <textarea v-validate="'max:250'" class="control" id="tooltip" name="tooltip" data-vv-as="&quot;{{ __('myTestTheme::app.admin.category.tooltip-content') }}&quot;">{{ $myTestThemeCategory->tooltip }}</textarea>

                                <span class="control-error" v-if="errors.has('tooltip')">@{{ errors.first('tooltip') }}</span>
                            </div>

                            <div class="control-group" :class="[errors.has('status') ? 'has-error' : '']">
                                <label for="status" class="required">{{ __('myTestTheme::app.admin.category.status') }}</label>
                                <select class="control" v-validate="'required'" id="status" name="status" data-vv-as="&quot;{{ __('myTestTheme::app.admin.category.status') }}&quot;">
                                    <option value="1" {{ $myTestThemeCategory->status ? 'selected' : '' }}>
                                        {{ __('myTestTheme::app.admin.category.active') }}
                                    </option>
                                    <option value="0" {{ !$myTestThemeCategory->status ? 'selected' : '' }}>
                                        {{ __('myTestTheme::app.admin.category.inactive') }}
                                    </option>
                                </select>
                                <span class="control-error" v-if="errors.has('status')">@{{ errors.first('status') }}</span>
                            </div>

                        {!! view_render_event('bagisto.admin.category.edit_form_accordian.general.content.after', ['myTestThemeCategory' => $myTestThemeCategory]) !!}

                    </div>
                </accordian>

                {!! view_render_event('bagisto.admin.category.edit_form_accordian.general.after', ['myTestThemeCategory' => $myTestThemeCategory]) !!}

            </div>

        </form>
    </div>
@stop
