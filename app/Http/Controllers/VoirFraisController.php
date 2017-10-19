<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Exception;
use App\metier\GsbFrais;

class VoirFraisController extends Controller
{
     /**
     * Affiche la liste de toutes les fiches
     * de Frais du visiteur connecté
     * Si une erreur a été stockée dans la Session
     * on la récupère, on l'efface de la Session
     * et la passe au formulaire
     * @return type Vue listeFrais
     */
    public function getFraisVisiteur() {
        //$erreur = Session::get('erreur');
        //Session::forget('erreur');
        $erreur = "";
        $date = date("Y/m/d");
        $moins1An = date("d/m/Y", strtotime("-1 year", strtotime($date)));
//        echo $moins1An;
        $numAnnee =substr( $moins1An,6,4);
        $numMois =substr( $moins1An,3,2);
        $mois = $numAnnee.$numMois;
        $unFrais = new GsbFrais();
        $id_visiteur = Session::get('id');
        // On récupère la liste de tous les frais sur une année glissante
        $mesFrais = $unFrais->getLesFrais($id_visiteur, $mois);
        // On affiche la liste de ces frais       
        return view('listeFrais', compact('mesFrais', 'erreur'));
    }
  /**
     * Affiche le détail (frais forfait et hors forfait)
     * @return type Vue detailFrais
     */ 
  public function voirDetailFrais($mois){
      $gsbFrais = new GsbFrais();
      $idVisiteur = Session::get('id');
      $lesFraisForfait = $gsbFrais->getLesFraisForfait($idVisiteur, $mois);
      $lesFraisHorsForfait = $gsbFrais->getLesFraisHorsForfait($idVisiteur, $mois);
      $montantTotal = 0;
      foreach ($lesFraisHorsForfait as $fhf){
            $montantTotal = $montantTotal + $fhf->montant;
      }
      $titreVue = "Détail de la fiche de frais du mois ".$mois;
      $erreur = "";
      return view('listeDetailFiche', compact('lesFraisForfait', 'lesFraisHorsForfait', 'mois', 'erreur', 'titreVue','montantTotal'));
  }
}
