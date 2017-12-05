<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\metier\GsbFrais;

class nouvelutilisateurController extends Controller
{
    
    public function affFormModifUtilisateur(){
        $erreur="";
        return view('formnouvelutilisateur', compact('erreur'));
    }
    
        public function validerUtilisateur(Request $request) {
            $erreur ="";
        $id = $request->input('id');
        $nom = $request->input('nom'); 
        $prenom = $request->input('pre');
        $login = substr($prenom,0,1).$nom;
        
        $mdp = $request->input('mdp');
        $adresse = $request->input('ad');
        $cp = $request->input('cp');
        $ville = $request->input('ville');
        $dateEmbauche = $request->input('de');
        $statut = $request->input('st');
        $mail = $request->input('mail');
        $ntel= $request->input('tel');
        $unFrais = new GsbFrais();
        if(strlen($id) > 4)//gérer le message d'erreur
            //regarder pourquoi affichage mise a jour utilisateur ne marche pas
        {
            $erreur = "id incorrect ! ";
        }
        if($erreur!="")
            {
               $erreur = $login;
            }
        
        if ($id > 0) {
            $unFrais->creeNouveauVisiteur($id,$nom,$prenom,$login,$mdp,$adresse,$cp,$ville,$dateEmbauche,$statut,$mail,$ntel);
        }
        
        // Affiche la liste des FHF de la fiche de Frais en cours
        return redirect()->back()->with('status', 'Mise à jour effectuée!');
    }
            
}
 

