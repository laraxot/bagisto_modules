@php
    $direction = core()->getCurrentLocale()->direction;
@endphp

<recently-viewed
    title="{{ __('myTestTheme::app.products.recently-viewed') }}"
    no-data-text="{{ __('myTestTheme::app.products.not-available') }}"
    add-class="{{ isset($addClass) ? $addClass . " $direction": '' }}"
    quantity="{{ isset($quantity) ? $quantity : null }}"
    add-class-wrapper="{{ isset($addClassWrapper) ? $addClassWrapper : '' }}">
</recently-viewed>
