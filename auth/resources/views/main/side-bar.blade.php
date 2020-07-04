<div class="sidebar sidebar-hide-to-small sidebar-shrink sidebar-gestures" style="position:fixed;">
        <div class="nano">
            <div class="nano-content">
                <ul id='ul-side-bar'>

                    <!-- use Spatie notation to access the admin menu items -->
                      <li class="{{ request()->routeIs('home') ? 'active' : '' }} m-t-15"><a  href="{{ route('home')}}" ><i class="ti-home"></i> Accueil </a></li>     
                    @role('admin')
                      <li class="{{ request()->routeIs('user.*') ? 'active' : '' }}"><a  href="{{ route('user.dashbord') }}"><i class="ti-user"></i> Utilisateurs</a></li>
                      <li class="{{ request()->routeIs('role.*') ? 'active' : '' }}"><a  href="{{ route('role.dashbord') }}"><i class="ti-lock"></i> Roles</a></li>
                      <li class="{{ request()->routeIs('permission.*') ? 'active' : '' }}"><a  href="{{ route('permission.dashbord')   }}"><i class="ti-key"></i> Permissions </a></li>
                      <li ><a ><i class="ti-settings"></i> Configuration </a></li>
                    @endrole
                    @hasanyrole('admin|gestionnaire')
                    <li class="{{ request()->routeIs('statistiques.*') ? 'active' : '' }}">
                        <a class="sidebar-sub-toggle"><i class="ti-bar-chart"></i>{{__(' Statistiques')}}<span class="sidebar-collapse-icon ti-angle-down"></span></a>
                        <ul>
                            <li class="{{ request()->routeIs('statistiques.retour') ? 'active' : '' }}">
                                <a href="{{ route('statistiques.retour',Carbon\Carbon::now('y')->year)}}">{{__(' Retours articles')}}</a>
                            </li>                            
                            <li class="{{ request()->routeIs('statistiques.audit') ? 'active' : '' }}">
                                <a href="{{ route('statistiques.audit',Carbon\Carbon::now('y')->year) }}">{{__(' Audits')}}</a>
                            </li>                            
                            <li class="{{ request()->routeIs('statistiques.inspection') ? 'active' : '' }}">
                                <a href="{{ route('statistiques.inspection',Carbon\Carbon::now('y')->year) }}">{{__(' Inspections')}}</a>
                            </li>
                        </ul>
                    </li>
                    @endhasanyrole
                    @hasanyrole('simple|gestionnaire')
                    <li>
                        <a class="sidebar-sub-toggle"><i class="ti-bell"></i>{{__(' Alertes')}}<span class="sidebar-collapse-icon ti-angle-down"></span></a>
                        <ul>
                            @if(auth()->user()->can('edit fournisseur') || auth()->user()->hasRole('gestionnaire'))
                                <li class="{{ request()->routeIs('alertRF.*') ? 'active' : '' }}">
                                      <a href="{{ route('alertRF.list') }}">
                                        @role('gestionnaire') 
                                        <span class="badge badge-primary">
                                          {{ count(App\Models\Alert::where('type', '=' , "Retour fournisseur")
                                                              ->where('etat', '=' ,"nouveau")->get()) }} 
                                        </span>
                                        @endrole
                                        {{__(' Retour fournisseur')}}
                                      </a>
                                </li>
                            @endif
                            @if(auth()->user()->can('edit client') || auth()->user()->hasRole('gestionnaire'))
                                <li class="{{ request()->routeIs('alertRC.*') ? 'active' : '' }}">                                 
                                  <a href="{{ route('alertRC.list') }}">
                                    @role('gestionnaire') 
                                    <span class="badge badge-primary">
                                      {{ count(App\Models\Alert::where('type', '=' , "Retour client")
                                                          ->where('etat', '=' ,"nouveau")->get()) }} 
                                    </span>
                                    @endrole 
                                     {{__('Retour client')}} 
                                  </a>
                                </li>
                            @endif
                            @if(auth()->user()->can('edit atelier') || auth()->user()->hasRole('gestionnaire'))
                                <li class="{{ request()->routeIs('alertRP.*') ? 'active' : '' }}">                                                                     
                                  <a  href="{{ route('alertRP.list') }}">
                                    @role('gestionnaire') 
                                    <span class="badge badge-primary">
                                      {{ count(App\Models\Alert::where('type', '=' , "Retour production")
                                                          ->where('etat', '=' ,"nouveau")->get()) }} 
                                    </span>
                                    @endrole
                                    {{__('Retour production')}} 
                                  </a>
                                </li>
                            @endif
                        </ul>
                      </li>
                    @endhasanyrole

                    @role('gestionnaire')
                      <li class="{{ request()->routeIs('calendrier.*') ? 'active' : '' }}"><a  href="{{ route('calendrier.dashbord')   }}"><i class="ti-calendar"></i> Calendrier </a></li>
                      <li class="{{ request()->routeIs('anomalie.*') ? 'active' : '' }}"><a  href="{{ route('anomalie.dashbord') }}"><i class="ti-alert"></i> Anomalies </a></li>
                      <li class="{{ request()->routeIs('test.*') ? 'active' : '' }}"><a  href="{{ route('test.list') }}"><i class="ti-help"></i> Tests </a></li>
                      <li class="{{ request()->routeIs('regle.*') ? 'active' : '' }}"><a  href="{{ route('regle.list') }}"><i class="ti-check-box"></i> Règles qualités</a></li>
                      <li class="{{ request()->routeIs('action.*') ? 'active' : '' }}"><a  href="{{ route('action.list') }}"><i class="ti-bolt"></i> Actions</a></li>
                      <li class="{{ request()->routeIs('audit.*') ? 'active' : '' }}"><a  href="{{ route('audit.dashbord') }}"><i class="ti-clipboard"></i> Audits </a></li>
                      <li class="{{ request()->routeIs('inspection.*') ? 'active' : '' }}"><a  href="{{ route('inspection.dashbord') }}"><i class="ti-write"></i> Inspections </a></li>
                    @endrole

                    @role('simple')
                    <li class="{{ request()->routeIs('produit.*') ? 'active' : '' }}"><a  href="{{ route('produit.list') }}"><i class="ti-package"></i> Articles </a></li>
                      @can('edit client')
                        <li class="{{ request()->routeIs('client.*') ? 'active' : '' }}"><a  href="{{ route('client.list') }}"><i class="ti-shopping-cart"></i> Clients </a></li>
                      @endcan
                      @can('edit fournisseur')
                        <li class="{{ request()->routeIs('fournisseur.*') ? 'active' : '' }}"><a  href="{{ route('fournisseur.list')   }}"><i class="ti-truck"></i> Fournisseurs </a></li>
                      @endcan
                      @can('edit atelier')
                        <li class="{{ request()->routeIs('atelier.*') ? 'active' : '' }}"><a  href="{{ route('atelier.list')   }}"><i class="ti-home"></i> Ateliers </a></li>
                      @endcan
                    @endrole

                    <li class=""><a><i href="" class="ti-id-badge"></i> Profil</a></li>
                    <li class=""><a><i href="" class="ti-book"></i> Documents </a></li>
                    <li><a  href="{{ route('logout')}}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                             <i  class="ti-power-off"></i>                                  
                             {{ __('Déconnexion') }}
                          </a>
                          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                          </form>
                      </li>


                </ul>
            </div>
        </div>
</div>