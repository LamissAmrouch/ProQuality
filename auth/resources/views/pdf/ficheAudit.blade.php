<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="{{ asset('public/assets/css/style-pdf.css')}}" media="all" />
  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
      </div>
      <h1>Fiche Audit</h1>
      <div id="company" class="clearfix">
        <div>Digius Link Algeria</div>
        <div>Cité Hamza, groupe 200 N°07<br/>Baraki - Alger - Algérie</div>
        <div>+213(0)23 816 652</div>
        <div>+213(0)550 902 702</div>
        <div><a href="mailto:contact@digiuslinkalgeria.com"> contact@digiuslinkalgeria.com</a></div>
      </div>
    </header>
    <main>
       <h4 class="titre">  Audit numéro :  {{ $audit->id }}</h4>

      <table>
        
        <tbody>
          <tr>
            <td class="service"> Titre</td>
            <td class="desc"> {{  $audit->titre }}</td>
  
          </tr>
          <tr>
            <td class="service">Date</td>
            <td class="desc">  
                    @if(isset($audit))
                        <?php
                            $event = App\Models\Event::where('audit_id', '=' , $audit->id)->first();
                        ?>
                       {{ date('Y-m-d\TH:i', strtotime($event->start)) }}
                    @endif  </td>        
          </tr>

          <tr>
            <td class="service">Description</td>
            <td class="desc">  @if(isset($audit->description)) {{ $audit->description }} @endif </td>
          </tr>

          <tr>
            <td class="service">Procédé</td>
            <td class="desc"> @if(isset($audit->procede)) {{ $audit->procede->designation }}  @endif </td>
          </tr>

          <tr>
            <td class="service">Résultat</td>
            <td class="desc"> @if(isset($audit->resultats))  {{ $audit->resultats}}  @endif </td>
          </tr>

          <tr>
            <td class="service">Actions</td>
            <td class="desc"> 
                  @if(isset($audit->actions)) 
                  @foreach(App\Models\Action::all() as $action)  
                          @if( isset($audit->actions) && $audit->actions->contains($action))
                          {{ $action->designation }} ,
                          @endif 
                  @endforeach
            
                  @endif 
            </td>
          </tr>
           
          <tr>
            <td class="service">Règles de qualité</td>
            <td class="desc"> 
                  @if(isset($audit->regles)) 
                  @foreach(App\Models\Regle::all() as $regle)  
                          @if( isset($audit->regles) && $audit->regles->contains($regle))
                          {{ $regle->titre  }} ,
                          @endif 
                  @endforeach
            
                  @endif 
            </td>
          </tr>
        
          <tr>
            <td class="service">Commentaire</td>
            <td class="desc"> @if(isset($audit->commentaire))   {{ $audit->commentaire }}  @endif </td>
          </tr>
         
        </tbody>
      </table>
     
     
    </main>
    <footer>
    
    </footer>
  </body>
</html>