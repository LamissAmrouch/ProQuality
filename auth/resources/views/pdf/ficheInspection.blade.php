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
      <h1>Fiche Inspection</h1>
      <div id="company" class="clearfix">
        <div>Digius Link Algeria</div>
        <div>Cité Hamza, groupe 200 N°07<br/>Baraki - Alger - Algérie</div>
        <div>+213(0)23 816 652</div>
        <div>+213(0)550 902 702</div>
        <div><a href="mailto:contact@digiuslinkalgeria.com"> contact@digiuslinkalgeria.com</a></div>
      </div>
    </header>
    <main>
       <h4 class="titre">  Inspection numéro :  {{ $inspection->id }}</h4>

      <table>
        
        <tbody>
          <tr>
            <td class="service"> Titre</td>
            <td class="desc"> {{  $inspection->titre }}</td>
  
          </tr>
          <tr>
            <td class="service">Date</td>
            <td class="desc">  
                    @if(isset($inspection))
                        <?php
                            $event = App\Models\Event::where('inspection_id', '=' , $inspection->id)->first();
                        ?>
                       {{ date('Y-m-d\TH:i', strtotime($event->start)) }}
                    @endif  </td>        
          </tr>

          <tr>
            <td class="service">Description</td>
            <td class="desc">  @if(isset($inspection->description)) {{ $inspection->description }} @endif </td>
          </tr>

          <tr>
            <td class="service">Article</td>
            <td class="desc">
            @if(isset($inspection->lot))  {{ $inspection->lot->produit->nom }} de type : {{ $inspection->lot->caracteristiquep }}  @endif </td>
          </tr>

          <tr>
            <td class="service">Quantité</td>
            <td class="desc"> @if(isset($inspection->lot))  {{  $inspection->lot->quantite }} @endif  </td>
          </tr>
          
          <tr>
            <td class="service">Test effectué</td>
            <td class="desc"> @if(isset($inspection->test))  {{ $inspection->test->nom }} @endif  </td>
          </tr>

          <tr>
            <td class="service">Quantité défectueuse</td>
            <td class="desc"> @if(isset($inspection->quantiteD))  {{ $inspection->quantiteD }} @endif  </td>
          </tr>

          <tr>
            <td class="service">Commentaire</td>
            <td class="desc"> @if(isset($inspection->commentaire))   {{ $inspection->commentaire }}  @endif </td>
          </tr>
         
        </tbody>
      </table>
     
     
    </main>
    <footer>
    
    </footer>
  </body>
</html>