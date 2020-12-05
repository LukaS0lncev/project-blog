@section('header')
<div id="header-wrap">
    <div class="container">
        <div class="header-row">

            <!-- Logo
            ============================================= -->
            <div id="logo">
                <a href="/" class="standard-logo" ><img src="/img/logo.png" alt="Paimon.pro logo"></a>
                <a href="/" class="retina-logo" ><img src="/img/logo.png" alt="Paimon.pro logo"></a>
            </div><!-- #logo end -->

            <div class="header-misc">

                <!-- Top Search
                ============================================= -->
                <div id="top-search" class="header-misc-icon">
                    <a href="menu-6.html#" id="top-search-trigger"><i class="icon-line-search"></i><i class="icon-line-cross"></i></a>
                </div><!-- #top-search end -->

            </div>

            <div id="primary-menu-trigger">
                <svg class="svg-trigger" viewBox="0 0 100 100"><path d="m 30,33 h 40 c 3.722839,0 7.5,3.126468 7.5,8.578427 0,5.451959 -2.727029,8.421573 -7.5,8.421573 h -20"></path><path d="m 30,50 h 40"></path><path d="m 70,67 h -40 c 0,0 -7.5,-0.802118 -7.5,-8.365747 0,-7.563629 7.5,-8.634253 7.5,-8.634253 h 20"></path></svg>
            </div>

            <!-- Primary Navigation
            ============================================= -->
            <nav class="primary-menu style-6">

                <ul class="menu-container">
                    <li class="menu-item  {{ (request()->is('/')) ? 'current' : '' }}">
                        <a class="menu-link" href="/"><div>Главная</div></a>
                    </li>
                    <li class="menu-item {{ (request()->is('*blog*')) ? 'current' : '' }}">
                        <a class="menu-link" href="/blog"><div>Блог</div></a>
                    </li>
                    <li class="menu-item {{ (request()->is('*news*')) ? 'current' : '' }}">
                        <a class="menu-link" href="/news"><div>Новости</div></a>
                    </li>
                </ul>

            </nav><!-- #primary-menu end -->

            <form class="top-search-form" action="/search" method="post">
                <input type="text" name="search" class="form-control" value="" placeholder="Текст для поиска..." autocomplete="off">
            </form>

        </div>
    </div>
</div>
<div class="header-wrap-clone"></div>
@endsection
