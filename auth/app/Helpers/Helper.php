<?php
namespace App\Helpers;

class Helper{
    public static function getJours(){
            return array(
            1 => 'Dimanche',
            2 => 'Lundi',
            3 => 'Mardi',
            4 => 'Mercredi',
            5 => 'Jeudi',
            6 => 'Vendredi',
            7 => 'Samedi',
            );
    }
    
    public static function getTypesRetour(){
            return array(
                0 => 'Retour fournisseur',
                1 => 'Retour production',
                2 => 'Retour client',
            );
        }

    public static function getTypesArticle(){
            return array(
                0 => 'Fini',
                1 => 'Semi-fini',
                2 => 'Matiere premiere',
            );
    }

    public static function getMonths(){
        return array(
        1 => 'Janvier',
        2 => 'Février',
        3 => 'Mars',
        4 => 'Avril',
        5 => 'Mai',
        6 => 'Juin',
        7 => 'Juillet',
        8 => 'Août',
        9 => 'Septembre',
        10 => 'Octobre',
        11 => 'Novembre',
        12 => 'Décembre',
        );
    }
    

    public static function getMonthsAbv(){
        return array(
            0 => 'Jan',
            1 => 'Fév',
            2 => 'Mar',
            3 => 'Avr',
            4 => 'Mai',
            5 => 'Jui',
            6 => 'Jul',
            7 => 'Aoû',
            8 => 'Sep',
            9 => 'Oct',
            10 => 'Nov',
            11 => 'Déc',
        );
    }
    

    public static function getResultatAudit(){
        return array(
            0 => 'Procédé non conforme',
            1 => 'Procédé conforme',
        );
    }

    public static function getResultatInspection(){
        return array(
            0 => 'Les réponses des examens ne sont pas toutes correctes',
            1 => 'Les réponses des examens sont toutes correctes',
        );
    }
    public static function getTypeInspection(){
        return array(
            0 => 'Echoué',
            1 => 'Réussie',
        );
    }
}
?>