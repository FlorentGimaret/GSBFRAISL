<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;

/**
 * Description of paiementFicheFrais
 *
 * @author jennifer.desgeorges
 */
class paiementFicheFraisController extends Controller {
    //put your code here
    
    public function affFormFicheFrais($mois) {
        $erreur = "";
        $idVisiteur = Session::get('id');
        $unSuivi = new GsbFrais();
        $mesSuivisFicheFrais = $unSuivi->getPaiementFicheFrais($idVisiteur, $mois);
        
        
        
        return view('listeDetailFicheFrais', compact('mesSuivisFicheFrais', 'mois', 'erreur'));
        
    }
    
    
    public function voirDetailFrais(){
      
      $idVisiteur = $request->get('idVisiteur');
      $mois = $request->get('mois');
      $gsbFrais = new GsbFrais();
      
      $lesFraisForfait = $gsbFrais->getLesFraisForfait($idVisiteur, $mois);
      $lesFraisHorsForfait = $gsbFrais->getLesFraisHorsForfait($idVisiteur, $mois);
      $montantTotal = 0;
      foreach ($lesFraisHorsForfait as $fhf){
            $montantTotal = $montantTotal + $fhf->montant;
      }
      $titreVue = "Détail de la fiche de frais du mois ".$mois;
      $erreur = "";
      return view('listeDetailFicheFrais', compact('lesFraisForfait', 'lesFraisHorsForfait', 'mois', 'erreur', 'titreVue','montantTotal'));
  }
  
  
  
  
    
    
    
    
}
