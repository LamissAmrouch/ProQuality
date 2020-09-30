<div class="header">
        <div class="pull-left">
            <div class="logo">
                <a href="{{ route('home')}}">
                    <img id="logoImg" src="{{ asset('public/logo/logo.png') }}" 
                    data-logo_big="{{ asset('public/logo/logo.png') }}" 
                    data-logo_small="{{ asset('public/logo/logoSmall.png') }}" alt="Digius Link" />
                </a>
            </div>
            <div class="hamburger sidebar-toggle">
                <span class="ti-align-justify u-sidebar-invoker__icon--close"></span>
            </div>
        </div>
        <div class="pull-right p-r-15">
            <ul>
                <li class="header-icon dib">
                    <i class="ti-bell"></i>
                    <div class="note-count"> 
                        @php( $notifs = App\Models\Alert::where('etat', '=' ,'nouveau')
                                        ->where('user_id', '=' ,Auth::user()->id)->get())
                        {{ count($notifs) }}                     
                    </div>
                    <div class="drop-down">
                        <div class="dropdown-content-heading">
                            <span class="text-left">Notifications Récentes</span>
                        </div>
                        <div class="dropdown-content-body">
                            <ul>
                                @foreach($notifs as $notif)
                                    <li>
                                        @if($notif->type!="Rappel") 
                                            <a href="{{ route('anomalie.createFrom',$notif->anomalie_id) }}"> 
                                                <i class="pull-left m-r-10 m-t-15 avatar-img ti-alert"></i>
                                                <div class="notification-content m-t-10 ">
                                                    <small class="notification-timestamp pull-right">{{ $notif->created_at }}</small>
                                                    <div class="notification-heading">{{ $notif->type }}</div>
                                                    @isset($notif->lot->produit->nom) <div class="notification-text">Produit concernée: {{ $notif->lot->produit->nom }}</div> @endisset
                                                </div>   
                                        @elseif(isset($notif->event))
                                            @if($notif->event->type =="Audit")
                                                <a href="{{ route('audit.createFrom',$notif->event_id) }}">
                                                    <i class="pull-left m-r-10 avatar-img ti-clipboard"></i>
                                            @else  
                                                <a href="{{ route('inspection.createFrom',$notif->event->id) }}">
                                                    <i class="pull-left m-r-10 avatar-img ti-write"></i>
                                            @endif
                                            <div class="notification-content">
                                                <small class="notification-timestamp pull-right">Date: {{ $notif->start }}</small>
                                                <div class="notification-heading">Rappel</div>
                                                <div class="notification-text">Type: {{ $notif->event->type }}</div>
                                            </div>   
                                        @endif
                                        </a>                                               
                                    </li> 
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </li>
                <li class="header-icon dib">
                    <span class="user-avatar">
                        {{ Auth::user()->nom.' '.Auth::user()->prenom }} 
                    </span>
                    <i class="ti-angle-down f-s-10"></i>
                    <div class="drop-down dropdown-profile">                       
                        <div class="dropdown-content-body">
                            <ul>
                                <li>
                                   <a href="{{ route('logout')}}"
                                      onclick="event.preventDefault();
                                      document.getElementById('logout-form2').submit();">
                                      <i  class="ti-power-off"></i>  
                                      <span>Déconnexion</span>                                
                                   </a>
                                 
                                   <form id="logout-form2" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                   </form>
                                
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
</div>
