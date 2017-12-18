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
        $laFiche = $gsbFrais->laFicheVisiteur($id, $mois);
        $lesFraisForfait = $gsbFrais->getLesFraisForfait($id, $mois);
        $lesFraisHorsForfait = $gsbFrais->getLesFraisHorsForfait($id, $mois);
        $montantFF = 0;
        $montantHF = 0;
        $montantTotal = 0;
        foreach ($lesFraisForfait as $ff){
            $montantFF = $montantFF + $ff->montant*$ff->quantite;
        }
        foreach ($lesFraisHorsForfait as $fhf){
            $montantHF = $montantHF + $fhf->montant;
        }
        $montantTotal = $montantFF+$montantHF;
        $titreVue = "Détail de la fiche de frais du mois ".$mois;
        $erreur = "";
        return view('ficheAValider', compact('laFiche','lesFraisForfait', 'lesFraisHorsForfait', 'mois', 'erreur', 'titreVue','montantFF','montantHF', 'montantTotal'));
  }
  
        public function validerFicheFrais($id, $mois, $montantTotal)
        {
        $Frais = new GsbFrais();
        $Frais->validerFicheFrais($id, $mois, $montantTotal);
        $FichesFraisClo = $Frais->VisiteursFichesClo();
        $erreur = "";
        return view('validerFicheFrais', compact('FichesFraisClo', 'erreur'));
        }
        
        
        
        
        
}
 

