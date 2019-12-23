<ul class="navigation-menu">

    <!-- Dashboard -->
    <li class="has-submenu">
        <a href="/"><i class="ti-home"></i>Dashboard</a>
    </li>
    <!-- Dashboard - Fin -->

    @can('stock-list')
    <li class="has-submenu">
        <a href="{{ action('StockController@index') }}"><i class="ti-package"></i>stock</a>
    </li>
    @endcan

    <li class="has-submenu">
        <a href="#"><i class="ti-user"></i>Utilisateurs</a>
        <ul class="submenu">
            <li>
                <ul>
                    @can('user-list')
                    <li><a href="{{ route('users.index') }}">Lister</a></li>
                    @endcan

                    @can('user-create')
                    <li><a href="{{ route('users.create') }}">Ajouter</a></li>
                    @endcan

                </ul>
            </li>

             <li class="has-submenu">
                <a href="#">Roles</a>
                <ul class="submenu">
                   @can('role-list')
                    <li><a href="{{ route('roles.index') }}">Lister</a></li>
                    @endcan
                    @can('role-create')
                    <li><a href="{{ route('roles.create') }}">Ajouter</a></li>
                    @endcan
                </ul>
            </li>

        </ul>
    </li>
    <!-- Utilisateurs - Fin -->

    <!-- Articles & Types -->
    <li class="has-submenu">
        <a href="#"><i class="ti-package"></i>Articles & Types</a>
        <ul class="submenu">
            <li class="has-submenu">
                <a href="#">Article</a>
                <ul class="submenu">
                    @can('article-list')
                    <li><a href="{{ route('articles.index') }}">Lister</a></li>
                    @endcan

                    @can('article-create')
                    <li><a href="{{ route('articles.create') }}">Ajouter</a></li>
                    @endcan
                 </ul>
            </li>
            <li class="has-submenu">
                <a href="#">Types</a>
                <ul class="submenu">
                    @can('type_article-list')
                    <li><a href="{{ route('typearticles.index') }}">Lister</a></li>
                    @endcan

                    @can('type_article-create')
                    <li><a href="{{ route('typearticles.create') }}">Ajouter</a></li>
                    @endcan
                 </ul>
            </li>

            <li class="has-submenu">
                <a href="#">Marques</a>
                <ul class="submenu">
                    @can('marque-list')
                    <li><a href="{{ route('marquearticles.index') }}">Lister</a></li>
                    @endcan

                    @can('marque-create')
                    <li><a href="{{ route('marquearticles.create') }}">Ajouter</a></li>
                    @endcan
                 </ul>
            </li>
        </ul>
    </li>
    <!-- Articles & Types - Fin -->

    <!-- Employes & Services -->
    <li class="has-submenu">
        <a href="#"><i class="ti-bookmark-alt"></i>Employes & Départements</a>
          <ul class="submenu">
              <li class="has-submenu">
                  <a href="#">Employes</a>
                  <ul class="submenu">
                      @can('employe-list')
                      <li><a href="{{ route('employes.index') }}">Lister</a></li>
                      @endcan

                      @can('employe-create')
                      <li><a href="{{ route('employes.create') }}">Ajouter</a></li>
                      @endcan
                  </ul>
              </li>

              <li class="has-submenu">
                  <a href="#">Départements</a>
                  <ul class="submenu">
                      @can('departement-list')
                      <li><a href="{{ route('departements.index') }}">Lister</a></li>
                      @endcan

                      @can('departement-create')
                      <li><a href="{{ route('departements.create') }}">Ajouter</a></li>
                      @endcan
                  </ul>
              </li>

              @can('commande-xxx')
              <li class="has-submenu">
                  <a href="#">Commandes</a>
                  <ul class="submenu">
                      @can('commande-list')
                      <li><a href="{{ route('commandes.index') }}">Lister</a></li>
                      @endcan

                      @can('commande-create')
                      <li><a href="{{ route('commandes.create') }}">Faire une Commandes</a></li>
                      @endcan
                  </ul>
              </li>
              @endcan

          </ul>
    </li>
    <!-- Employes & Services - Fin -->

    <!-- Fournisseurs -->
    <li class="has-submenu">
        <a href="#"><i class="ti-truck"></i>Fournisseurs</a>
        <ul class="submenu megamenu">
          <li>
            <ul>
              @can('fournisseur-list')
              <li><a href="{{ route('fournisseurs.index') }}">Lister</a></li>
              @endcan

              @can('fournisseur-create')
              <li><a href="{{ route('fournisseurs.create') }}">Ajouter</a></li>
              @endcan
            </ul>
          </li>
        </ul>
    </li>
    <!-- Fournisseurs - Fin -->

    <!-- Paramètres -->
    @can('parametre-list')
    <li class="has-submenu">
      <a href="{{ route('parametres.index') }}"><i class="ti-settings"></i>Paramètres</a>
    </li>
    @endcan
    <!-- Paramètres - Fin -->

</ul>
