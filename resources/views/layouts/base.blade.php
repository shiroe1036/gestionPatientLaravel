@include('layouts.layout-app.header')
    <section class="body">
        @include('layouts.menu.top-bar')

        <div class="inner-wrapper">
            @include('layouts.menu.sidebar')

            <section role="main" class="content-body">
                @yield('header-body')

                @yield('content-body')

            </section>
        </div>
    </section>
@include('layouts.layout-app.footer')