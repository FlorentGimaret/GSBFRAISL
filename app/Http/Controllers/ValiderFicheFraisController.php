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
        $success=null;
        return view('validerFicheFrais', compact('FichesFraisClo', 'erreur', 'success'));
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
        $success=null;
        return view('ficheAValider', compact('laFiche','lesFraisForfait', 'lesFraisHorsForfait', 'mois', 'erreur', 'titreVue','montantFF','montantHF', 'montantTotal', 'success'));
  }
  
        public function validerFicheFrais($id, $mois, $montantTotal)
        {
        $Frais = new GsbFrais();
        $Frais->validerFicheFrais($id, $mois, $montantTotal);
        $FichesFraisClo = $Frais->VisiteursFichesClo();
        $erreur = "";
        $success=1;
        return view('validerFicheFrais', compact('FichesFraisClo', 'erreur', 'success'));
        }
        
        public function majFF(Request $request)
        {
        $gsbFrais = new GsbFrais();
        $ETP=$request->input('ETP');
        $KM=$request->input('KM');
        $NUI=$request->input('NUI');
        $REP=$request->input('REP');
        $id=$request->input('id');
        $mois=$request->input('mois');
        $gsbFrais->majFF($id, $mois, $ETP, $KM, $NUI, $REP);
        
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
        $success=1;
        return view('ficheAValider', compact('laFiche','lesFraisForfait', 'lesFraisHorsForfait', 'mois', 'erreur', 'titreVue','montantFF','montantHF', 'montantTotal', 'success'));
        }
        
        public function affFHF($id, $mois, $idF, $date, $montant)
        {
        $gsbFrais = new GsbFrais();
        $affFHF=$gsbFrais->affFHF($id,$mois,$idF,$date,$montant);
        $laFiche = $gsbFrais->laFicheVisiteur($id, $mois);
        return view('supprimerFHF', compact('laFiche','lesFraisForfait', 'lesFraisHorsForfait', 'mois', 'erreur', 'titreVue', 'lib', 'date', 'montant','affFHF'));
        }
        
        
        
        public function supFHF(Request $request)
        {
        $gsbFrais = new GsbFrais();
        $id=$request->input('id');
        $txt=$request->input('txtArea');
        $idV=$request->input('idV');
        $mois=$request->input('mois');
        
        $gsbFrais->supprimerFHF($id, $txt);
        
        $laFiche = $gsbFrais->laFicheVisiteur($idV, $mois);
        $lesFraisForfait = $gsbFrais->getLesFraisForfait($idV, $mois);
        $lesFraisHorsForfait = $gsbFrais->getLesFraisHorsForfait($idV, $mois);
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
        $success=1;
        return view('ficheAValider', compact('laFiche','lesFraisForfait', 'lesFraisHorsForfait', 'mois', 'erreur', 'titreVue','montantFF','montantHF', 'montantTotal', 'success'));
        }
        
        
        
        
}
 

