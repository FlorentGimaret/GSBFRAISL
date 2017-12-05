<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\metier\GsbFrais;

class ValiderFicheFraisController extends Controller
{
    
    /*public function affValiderFicheFrais(){
        $erreur="";
        return view('validerFicheFrais', compact('erreur'));
    }*/
    
        public function affValiderFicheFrais() {
        $Frais = new GsbFrais();
        $FichesFraisClo = $Frais->VisiteursFichesClo();
        $erreur = "";
        return view('validerFicheFrais', compact('FichesFraisClo', 'erreur'));
        }
        
        public function voirDetailFrais($id, $mois){
        $gsbFrais = new GsbFrais();
        $lesFraisForfait = $gsbFrais->getLesFraisForfait($id, $mois);
        $lesFraisHorsForfait = $gsbFrais->getLesFraisHorsForfait($id, $mois);
        $montantTotal = 0;
        foreach ($lesFraisHorsForfait as $fhf){
            $montantTotal = $montantTotal + $fhf->montant;
        }
        $titreVue = "Détail de la fiche de frais du mois ".$mois;
        $erreur = "";
        return view('listeDetailFiche', compact('lesFraisForfait', 'lesFraisHorsForfait', 'mois', 'erreur', 'titreVue','montantTotal'));
  }
        
        
        
}
 

