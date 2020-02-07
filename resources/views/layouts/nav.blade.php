<nav class="navbar navbar-expand-sm navbar-default ne_pas_afficher" >

    <div class="navbar-header ne_pas_afficher">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa fa-bars"></i>
        </button>
        <a class="navbar-brand" href="./"><img src="{{ asset('images/Eiffage_2400_03_white_RGB.png')}}" alt="Logo"></a>
        <a class="navbar-brand hidden" href="./"><img src="{{ asset('images/logo2.png')}}" alt="Logo"></a>
    </div>

    <div id="main-menu" class="main-menu collapse navbar-collapse  ne_pas_afficher">
        <ul class="nav navbar-nav">
            <li class="@yield('tableau_de_bord_actif')">
                <a href="{{route('/')}}"> <i class="menu-icon fa fa-dashboard"></i>Tableau de bord </a>
            </li>


            <li class="@yield('analyses_actif')">
                <a href="{{route('analyses')}}"> <i class="menu-icon fa fa-flask"></i>ANALYSES</a>
            </li>
            <li class="@yield('liste_actif')">
                <a href="{{route('liste')}}"><i class="menu-icon fa fa-list"></i>RISQUES \ OPPORTUNITES</a>
            </li>
            <li class="">
                <a href="{{route('etat')}}" target="_blank" ><i class="menu-icon fa fa-table"></i> ETATS</a>
            </li>
            <li class="@yield('parametrage') menu-item-has-children dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-cog"></i>Parametrage</a>
                <ul class="sub-menu children dropdown-menu @yield('parametrage')">
                    <li class=" @yield('utilisateur_actif')"><i class="fa fa-user"></i><a href="{{route('utilisateurs')}}">Utilisateurs</a></li>
                    <li class=" @yield('chnatier_actif')"><i class="fa fa-user"></i><a href="{{route('chantiers')}}">Chantiers</a></li>
                </ul>

            </li>

        </ul>

    </div><!-- /.navbar-collapse -->
</nav>