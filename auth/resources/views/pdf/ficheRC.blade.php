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
      <h1>Fiche Retour Client</h1>
      <div id="company" class="clearfix">
        <div>Digius Link Algeria</div>
        <div>Cité Hamza, groupe 200 N°07<br/>Baraki - Alger - Algérie</div>
        <div>+213(0)23 816 652</div>
        <div>+213(0)550 902 702</div>
        <div><a href="mailto:contact@digiuslinkalgeria.com"> contact@digiuslinkalgeria.com</a></div>
      </div>
    </header>
    <main>
       <h4 class="titre">  Retour numéro :  {{ $alert->id }}</h4>

      <table>
        
        <tbody>
          <tr>
            <td class="service">Article</td>
            <td class="desc"> {{ $alert->lot->produit->nom }}</td>
  
          </tr>
          <tr>
            <td class="service">Caractéristique</td>
            <td class="desc"> {{ $alert->lot->caracteristiquep }} </td>        
          </tr>

          <tr>
            <td class="service">Quantité</td>
            <td class="desc"> {{ $alert->lot->quantite }}</td>
          </tr>

          <tr>
            <td class="service">Client</td>
            <td class="desc">{{ $alert->client->nom }} </td>
          </tr>

          <tr>
            <td class="service">Motif de retour</td>
            <td class="desc"> {{ $alert->motif }} </td>
          </tr>

          <tr>
            <td class="service">Description</td>
            <td class="desc"> {{ $alert->description }} </td>
          </tr>
         
        </tbody>
      </table>
     
     
    </main>
    <footer>
    
    </footer>
  </body>
</html>