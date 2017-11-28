<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Exception;
use App\metier\GsbFrais;

class FraisHorsForfaitController extends Controller
{
   /**
     * Affiche la liste de tous les Frais Hors Forfait
     * d'un fiche de Frais
     * @param type $id_frais Id de la fiche de Frais dont
     * on veut la liste des FHF
     * @return type Vue listeFraisHorsForfait
     */
    public function getFraisHorsForfait($mois) {
        $erreur = "";
        $idVisiteur = Session::get('id');
        $unFrais = new GsbFrais();
        $mesFraisHorsForfait = $unFrais->getLesFraisHorsForfait($idVisiteur, $mois);
        $titreVue = "Liste des frais hors forfait de la fiche " . $mois;
         // On affiche la liste des Frais Hors Forfait       
        $montantTotal = 0;
        foreach ($mesFraisHorsForfait as $fhf){
            $montantTotal = $montantTotal + $fhf->montant;
        }
        return view('listeFraisHorsForfait', compact('mesFraisHorsForfait', 'mois', 'erreur', 'titreVue','montantTotal'));
    }

    /**
     * Initialise le formulaire d'un Frais Hors Forfait pour la modification
     * Lit le FHF surson id passé en paramètre
     * Initialise le titre du formulaire
     * @param type $id Id du FHF à modifier
     * @return type Vue formFraisHorsForfait
     */
    public function modifierFraisHorsForfait($idFrais) {
        $erreur = '';
        $unFrais = new GsbFrais();
        $unFraisHorsForfait = $unFrais->getUnFraisHorsForfait($idFrais);
       // print_r($unFraisHorsForfait);
        $titreVue = "Modification d'un Frais Hors Forfait de la fiche " .  $unFraisHorsForfait->mois;
        $mois = $unFraisHorsForfait->mois;
        // Affiche le formulaire en lui fournissant les données à afficher
        return view('formFraisHorsForfait', compact('unFraisHorsForfait', 'mois', 'titreVue', 'erreur'));
    }

    /**
     * Initialise le formulaire d'un Frais Hors Forfait pour un ajout
     * Initialise le titre du formulaire
     * @param type $mois de la fiche de Frais
     * @return type Vue formFraisHorsForfait
     */
    public function saisirFraisHorsForfait($mois) {
        $erreur = '';
        $titreVue = "Ajout d'un Frais Hors Forfait de la fiche " . $mois;
        // Affiche le formulaire en lui fournissant les données à afficher
        return view('formFraisHorsForfait', compact('unFraisHorsForfait', 'mois', 'titreVue', 'erreur'));
    }

    /**
     * Enregistre une modification ou un ajout
     * Récupère les données saisies dans les INPUT
     * Si l'id > 0 c'est une modification, sinon c'est un ajout
     * Réaffiche la liste des FHF de la fiche de Frais
     * @return type route /getListeFraisHorsForfait
     */
    public function validerFraisHorsForfait(Request $request) {
        $idVisiteur = Session::get('id');
        $id = $request->input('idFrais');
        $mois = $request->input('mois');
        $lib_fraishorsforfait = $request->input('libelle');
        $date_fraishorsforfait = $request->input('date');
        $montant_fraishorsforfait = $request->input('montant');
        $unFHF = new GsbFrais();
        if ($id > 0) {
            $unFHF->modifierFraisHorsForfait($id, $lib_fraishorsforfait, $date_fraishorsforfait, $montant_fraishorsforfait);
        } else {
            $unFHF->creeNouveauFraisHorsForfait($idVisiteur, $mois, $lib_fraishorsforfait, $date_fraishorsforfait, $montant_fraishorsforfait);
        }
        // Affiche la liste des FHF de la fiche de Frais en cours
        return redirect('/getListeFraisHorsForfait/' . $mois);
    }

    /**
     * Supression d'un frais hors forfait sur son Id
     * On passe aussi l'id de la fiche de Frais pour pouvoir
     * retourner à la liste des FHF de la fiche Frais après suppression
     * On utilise le gestionnaire d'exception même si on n'en a pas besoin
     * car il n'y a pas de contrainte, mais simplement pour illuster 
     * la gestion des exceptions
     * @param type $id_fraishorsforfait Id du FHF à supprimer
     * @return type Vue getListeFraisHorsForfait ou getErrors
     */
    public function supprimmerFraisHorsForfait($idFrais) {
        $unFHF = new GsbFrais();
        try {
            $unFHF->supprimerFraisHorsForfait($idFrais);
        } 
        catch (Exception $ex) {
            Session::put('erreur', $ex->getMessage());
        }
        
//        return redirect('/getListeFraisHorsForfait/'.$idFrais);
         return redirect()->back();
    }    
    
}
