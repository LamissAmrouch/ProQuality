<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\Client;
use App\Models\Produit;
use App\Models\Fournisseur;
use App\Models\Article;
use App\Models\Audit;
use App\Models\Anomalie;
use App\Models\Inspection;
use Carbon\Carbon;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Auth;

class Statistique extends Model
{
    /** Accueil **/
    static function alerteNonTraite(){
        return count(Alert::where("etat","=","nouveau")
        ->whereNotIn('type',['Rappel'])->where("user_id","=",Auth::user()->id)->get());
    }
    static function anomalieEnCours(){
        return count(Anomalie::where("etat","=","en cours")->get());
    }

    static function inspectionEnAttente(){
        return count(Inspection::where("etat","=","nouveau")->get());
    }
    static function auditPlanifie(){
        return count(Audit::where("etat","=","nouveau")->get());
    }

    static function retoursRécents(){
        return Alert::where("etat","=","nouveau")->whereNotIn('type',['Rappel'])->orderBy('updated_at','desc')->limit(3)->get();
    }
    static function auditsRécents(){
        return Audit::where("etat","=","nouveau")->orderBy('updated_at','desc')->limit(2)->get();
    }
    static function inspectionsRécentes(){
        return Inspection::where("etat","=","nouveau")->orderBy('updated_at','desc')->limit(2)->get();
    }

    /** Retours **/
    static function findbyType($type,$year){
        return Alert::where("type","=",$type)->whereYear('created_at','=',$year);
    }

    static function retourParMoisType($mois,$year,$type){

        $sum = 0;
        foreach(Statistique::findbyType($type,$year)->whereMonth('created_at','=',$mois)->get() as $alert){
            $sum += $alert->lot->quantite;
        }
        return $sum;
    }
    static function retourTotalParType($type,$year){
        $sum = 0;
        foreach(Statistique::findbyType($type,$year)->get() as $alert){
            $sum += $alert->lot->quantite;
        }
        return $sum;
    }
    static function retourParMois($type,$year){
        $retour = array();
        foreach(Helper::getMonthsAbv() as $mois){
            $month = array_search($mois,Helper::getMonthsAbv());
            $monthNum = sprintf("%02s",$month+1);
            $retour[$month] = Statistique::retourParMoisType($monthNum,$year,$type);
        }
        return $retour;
    }

    /** Retour par critere **/
    
    // retour par critere client
    static function retourParClient($id,$year){
        $sum = 0;
        $alerts = Alert::where("type","=",'Retour client')
        ->whereYear('created_at','=',$year)->get();// retour client
        
        foreach( $alerts as $alert){
             if ($alert->client_id == $id)
             {
                $sum += $alert->lot->quantite;
             }
        }
        return $sum;
    }
   
    // retour par critere atelier
    static function retourParAtelier($id,$year){
        $sum = 0;
        $alerts = Alert::where("type","=",'Retour production')
        ->whereYear('created_at','=',$year)->get();// retour production
        
        foreach( $alerts as $alert){
             if ($alert->atelier_id == $id)
             {
                $sum += $alert->lot->quantite;
             }
        }
        return $sum;
    }

    // retour par critere fournisseur
    static function retourParFournisseur($id,$year){
        $sum = 0;
        $alerts = Alert::where("type","=",'Retour fournisseur')
        ->whereYear('created_at','=',$year)->get();// retour fournisseur
        
        foreach( $alerts as $alert){
            if ($alert->fournisseur_id == $id)
            {
            $sum += $alert->lot->quantite;
            }
        }
        return $sum;
    }
    
     /** Retours par article et type **/
     static function retourParArticleType($nom,$type,$year){
        $sum = 0;
        $alerts = Alert::where("type","=",$type)->whereYear('created_at','=',$year)->get();
        
        foreach( $alerts as $alert){
             if ($alert->lot->produit->nom == $nom)
             {
                $sum += $alert->lot->quantite;
             }
        }
        return $sum;
    }


    /** Retour par Article **/
    static function findRetourByArticle($article,$year){
        $alerts = Alert::whereYear("created_at","=",$year)->whereNotIn('type',['Rappel'])->get();
        $sum = 0;
        foreach ($alerts as $alert) {
            if($alert->lot->produit->id == $article->id){
                $sum += $alert->lot->quantite;
            }
        }
        return $sum;
    }

    static function retourParArticle($articles, $year){
        $retourParArticle = array();
        $i = 0;
        foreach ($articles as $article) {
            $retourParArticle[$i] = Statistique::findRetourByArticle($article,$year);
            $i++;
        }
        return $retourParArticle;
    }

    static function findRetourByTypeArticle($type,$year){
        $alerts = Alert::whereYear("created_at","=",$year)->whereNotIn('type',['Rappel'])->get();
        $sum = 0;
        foreach ($alerts as $alert) {
            if($alert->lot->produit->type == $type){
                $sum += $alert->lot->quantite;
            }
        }
        return $sum;
    }

    static function retourParTypeArticle($types,$year){
        $retourParTypeArticle = array();
        $i = 0;
        foreach ($types as $type) {
            $retourParTypeArticle[$i] = Statistique::findRetourByTypeArticle($type,$year);
            $i++;
        }
        return $retourParTypeArticle;
    }
    static function retourParMoisArticle($mois,$year,$article){
        $alerts = Alert::whereYear("created_at","=",$year)->whereNotIn('type',['Rappel'])
        ->whereMonth("created_at","=",$mois)->get();
        $sum = 0;
        foreach ($alerts as $alert){
            if($alert->lot->produit->id == $article->id){
                $sum += $alert->lot->quantite;
            }
        }
        return $sum;
    }

    /** Audits **/
    static function findbyResultatA($resultat,$year){
        return Audit::where("resultats","=",$resultat)->where("etat","=","traité")->whereYear('updated_at','=',$year);
    }

    static function auditParMoisResultat($mois,$year,$resultat){
        return count(Statistique::findbyResultatA($resultat,$year)->whereMonth('updated_at','=',$mois)->get());
    }

    static function auditParMois($resultat,$year){
        $audit = array();
        foreach(Helper::getMonthsAbv() as $mois){
            $month = array_search($mois,Helper::getMonthsAbv());
            $monthNum = sprintf("%02s",$month+1);
            $audit[$month] = Statistique::auditParMoisResultat($monthNum,$year,$resultat);
        }
        return $audit;
    }

    static function auditTotalParResulat($resultat,$year){
        return count(Statistique::findbyResultatA($resultat,$year)->get());
    }

    /** Inspections **/
    static function findbyResultatI($resultat,$year){
        return Inspection::where("resultats","=",$resultat)->where("etat","=","traité")->whereYear('updated_at','=',$year);
    }
    static function InspectionParMoisResultat($mois,$year,$typeNum){   
        $resultat = Helper::getResultatInspection()[$typeNum];
        return count(Statistique::findbyResultatI($resultat,$year)->whereMonth('updated_at','=',$mois)->get());
    }

    static function inspectionTotalParResulat($index,$year){
        $resultat = Helper::getResultatInspection()[$index];
        return count(Statistique::findbyResultatI($resultat,$year)->get());
    }

    static function inspectionParMois($resultat,$year){
        $inspection = array();
        foreach(Helper::getMonthsAbv() as $mois){
            $month = array_search($mois,Helper::getMonthsAbv());
            $monthNum = sprintf("%02s",$month+1);
            $inspection[$month] = Statistique::InspectionParMoisResultat($monthNum,$year,
                array_search($resultat,Helper::getTypeInspection()));
        }
        return $inspection;
    }
}
