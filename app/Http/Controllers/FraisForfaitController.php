<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Exception;
use App\metier\GsbFrais;

class FraisForfaitController extends Controller
{
    /**
     * Initialise le formulaire de saisie des Frais 
     * 
     * @return type Vue formSaisirFrais
     */
    public function saisirFraisForfait() {
        $erreur = "";
        $date = date("d/m/Y");
        $numAnnee =substr( $date,6,4);
        $numMois =substr( $date,3,2);
        $mois = $numAnnee.$numMois;
        $idVisiteur = Session::get('id');
        $gsbFrais = new GsbFrais();
        if ($gsbFrais->estPremierFraisMois($idVisiteur,$mois)){
            $gsbFrais->creeNouvellesLignesFrais($idVisiteur,$mois);
        }
        $lesFrais = $gsbFrais->getLesFraisForfait($idVisiteur, $mois);
//        print_r($lesFrais);
        // Affiche le formulaire en lui fournissant les données à afficher
        // la fonction compact équivaut à array('lesFrais' => $lesFrais, ...) 
        return view('formSaisiFrais', compact('lesFrais', 'mois', 'erreur'));
    }
    
    /**
     * Enregistre un ajout ou une modification d'un frais forfait
     * Si id_frais > 0 c'est une modification, sinon
     * c'est un ajout. Id_frais est dans un INPUT HIDDEN
     * @return type route /getListeFrais 
     */
    public function validerFraisForfait(Request $request) {
//        print_r($request);
        $lesFrais = $request->input('lesFrais');
        $mois = $request->input('mois');
        $idVisiteur = Session::get('id');
        $gsbFrais = new GsbFrais();
        $gsbFrais->majFraisForfait($idVisiteur, $mois, $lesFrais);
//        $erreur = "mise à jour effectué";
//         Retourne à la liste des des Frais return 
         return redirect()->back()->with('status', 'Mise à jour effectuée!');
//        return redirect('/saisirFraisForfait'->with('erreur',[$erreur]));   
//        return view('formSaisiFrais', compact('lesFrais', 'mois', 'erreur'));
    }

  
}
