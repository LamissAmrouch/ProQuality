<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="{{ asset('public/assets/css/style-pdf.css')}}" media="all" />
  </head>
  <body>
    <header class="clearfix">
     
      <h1>Fiche Anomalie</h1>    
        
      <div id="logo">            
      </div>
      <div id="company" class="clearfix">
        <div>Digius Link Algeria</div>
        <div>Cité Hamza, groupe 200 N°07<br/>Baraki - Alger - Algérie</div>
        <div>+213(0)23 816 652</div>
        <div>+213(0)550 902 702</div>
        <div><a href="mailto:contact@digiuslinkalgeria.com"> contact@digiuslinkalgeria.com</a></div>
      </div>

    </header>
    <main>
       <h4 class="titre">  Anomalie numéro :  {{ $anomalie->id }}</h4>

      <table>
        
        <tbody>
          <tr>
            <td class="service"> Titre</td>
            <td class="desc"> 
            @if(isset($anomalie->titre)){{  $anomalie->titre }}  @endif</td>
  
          </tr>
        
          <tr>
            <td class="service">Description</td>
            <td class="desc">  @if(isset($anomalie->description)) {{ $anomalie->description }} @endif </td>
          </tr>

          <tr>
            <td class="service">Type</td>
            <td class="desc"> 
            @if(isset($anomalie->type)) {{ $anomalie->type }}  @endif </td>
          </tr>

          <tr>
            <td class="service">Source</td>
            <td class="desc"> 
                @if( (isset($anomalie)) && ($anomalie->type == 'Retour fournisseur')) Fournisseur : {{$anomalie->fournisseur->nom}} @endif 
                @if( (isset($anomalie)) && ($anomalie->type == 'Retour client')) Client : {{$anomalie->client->nom}}  @endif 
                @if( (isset($anomalie)) && ($anomalie->type == 'Retour production')) Atelier : {{$anomalie->atelier->nom}}  @endif
            </td>
          </tr>

          <tr>
            <td class="service">Article</td>
            <td class="desc">
            @if(isset($anomalie->lot))  {{ $anomalie->lot->produit->nom }} de type : {{ $anomalie->lot->caracteristiquep }}  @endif </td>
          </tr>

          <tr>
            <td class="service">Quantité défectueuse</td>
            <td class="desc"> @if(isset($anomalie->lot))  {{  $anomalie->lot->quantite }} @endif  </td>
          </tr>
          
          <tr>
            <td class="service">Test effectué</td>
            <td class="desc"> @if(isset($anomalie->test))  {{ $anomalie->test->nom }} @endif  </td>
          </tr>

          <tr>
            <td class="service">Diagnostic</td>
            <td class="desc"> @if(isset($anomalie->diagnostique))  {{ $anomalie->diagnostique }} @endif  </td>
          </tr>
         
          <tr>
            <td class="service">Actions</td>
            <td class="desc"> 
                  @if(isset($anomalie->actions)) 
                  @foreach(App\Models\Action::all() as $action)  
                          @if( isset($anomalie->actions) && $anomalie->actions->contains($action))
                          {{ $action->designation  }}, 
                          @endif 
                  @endforeach
            
                  @endif 
            </td>
          </tr>

          <tr>
            <td class="service">Règles de qualité enfreintes</td>
            <td class="desc"> 
                  @if(isset($anomalie->regles)) 
                  @foreach(App\Models\Regle::all() as $regle)  
                          @if( isset($anomalie->regles) && $anomalie->regles->contains($regle))
                          {{ $regle->titre  }} ,
                          @endif 
                  @endforeach
            
                  @endif 
            </td>
          </tr>

          <tr>
            <td class="service">Criticité</td>
            <td class="desc"> @if(isset($anomalie->criticite))   {{ $anomalie->criticite }}/100  @endif </td>
          </tr>

          <tr>
            <td class="service">Cause</td>
            <td class="desc"> @if(isset($anomalie->cause))   {{ $anomalie->cause }}  @endif </td>
          </tr>
         
        </tbody>
      </table>
     
     
    </main>
    <footer>
    
    </footer>
  </body>
</html>