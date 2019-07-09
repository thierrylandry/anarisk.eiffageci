<nav class="navbar navbar-expand-sm navbar-default">

    <div class="navbar-header ne_pas_afficher">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa fa-bars"></i>
        </button>
        <a class="navbar-brand" href="./"><img src="{{ asset('images/Eiffage_2400_03_white_RGB.png')}}" alt="Logo"></a>
        <a class="navbar-brand hidden" href="./"><img src="{{ asset('images/logo2.png')}}" alt="Logo"></a>
    </div>

    <div id="main-menu" class="main-menu collapse navbar-collapse">
        <ul class="nav navbar-nav">
            <li class="@yield('tableau_de_bord_actif')">
                <a href="{{route('/')}}"> <i class="menu-icon fa fa-dashboard"></i>Tableau de bord </a>
            </li>

            <li class="@yield('analyses_actif')">
                <a href="{{route('analyses')}}"> <i class="menu-icon fa fa-flask"></i>ANALYSES</a>
            </li>
            <li class="@yield('liste_actif')">
                <a href="{{route('liste')}}" ><i class="menu-icon fa fa-table"></i>RISQUES\OPPORTUNITES</a>
            </li>
            <li class="@yield('liste_actif')">
                <a href="{{route('etat')}}" ><i class="menu-icon fa fa-table"></i> ETATS</a>
            </li>

        </ul>

    </div><!-- /.navbar-collapse -->
</nav>