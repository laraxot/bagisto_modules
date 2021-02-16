<header class="sticky-header">
    <div class="row remove-padding-margin velocity-divide-page">
        <logo-component add-class="navbar-brand"></logo-component>
        <searchbar-component></searchbar-component>
    </div>
</header>

@push('scripts')
    <script type="text/javascript">
        (() => {
            document.addEventListener('scroll', e => {
                scrollPosition = Math.round(window.scrollY);

                if (scrollPosition > 50){
                    document.querySelector('header').classList.add('header-shadow');
                } else {
                    document.querySelector('header').classList.remove('header-shadow');
                }
            });
        })()
    </script>
@endpush
