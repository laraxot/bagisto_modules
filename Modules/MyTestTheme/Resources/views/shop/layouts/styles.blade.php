<link rel="stylesheet" href="{{ asset('themes/myTestTheme/assets/css/bootstrap.min.css') }}" />

@if (core()->getCurrentLocale() && core()->getCurrentLocale()->direction == 'rtl')
    <link href="{{ asset('themes/myTestTheme/assets/css/bootstrap-flipped.css') }}" rel="stylesheet">
@endif

<link rel="stylesheet" href="{{ asset('themes/myTestTheme/assets/css/myTestTheme.css') }}" />

@stack('css')

<style>
    {!! core()->getConfigData('general.content.custom_scripts.custom_css') !!}
</style>