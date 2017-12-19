<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\metier\GsbFrais;

class nouvelutilisateurController extends Controller
{
    
    public function affFormModifUtilisateur(){
        $erreur="";
        $id = "";
        $nom = "";
        $prenom = "";
        $login = "";
        $mdp = "";
        $adresse = "";
        $cp = "";
        $ville = "";
        $dateEmbauche= ""; 
        $statut = "";
        $mail = "";
        $ntel= "";
        
        return view('formnouvelutilisateur', compact('erreur','id','nom','prenom','login','mdp','adresse','cp','ville','dateEmbauche','satut','mail','ntel'));
    }
    
        public function validerUtilisateur(Request $request) {
            $erreur ="";
        $id = $request->input('id');
        $nom = $request->input('nom'); 
        $prenom = $request->input('pre');
        $login = substr($prenom,0,1).$nom;
        
        
        
        $chaine='abcdefghijklmnopqrstuvwxyz0123456789';
        $melange=str_shuffle($chaine);
        $mdp = substr($melange, 0, 5); 
        
        

        $adresse = $request->input('ad');
        $cp = $request->input('cp');
        $ville = $request->input('ville');
        $dateEmbauche = $request->input('de');
        $statut = "v";
        $mail = $request->input('mail');
        $ntel= $request->input('ntel');
        $unFrais = new GsbFrais();
        
        if($cp > 5 && $cp < 5)
        {
             $erreur .= "votre code postal doit contenir 5 caractères ! \n";
        }
      if($ntel < 10)
         {
             $erreur .= "votre numéro de téléphone doit contenir 10 chiffres ! \n";
        }

        if(strlen($id) > 4)//gérer le message d'erreur
            //regarder pourquoi affichage mise a jour utilisateur ne marche pas
        {
            $erreur .= "votre id doit contenir 3 caractères au maximum ! \n";
        }
       
       
        if ($id > 0 && $erreur == "") {
            $unFrais->creeNouveauVisiteur($id,$nom,$prenom,$login,$mdp,$adresse,$cp,$ville,$dateEmbauche,$statut,$mail,$ntel);
        }
         if($erreur!="")
            {
                return view('formnouvelutilisateur', compact('erreur','id','nom','prenom','login','mdp','adresse','cp','ville','dateEmbauche','satut','mail','ntel'));
            }
        else {
     
             return redirect()->back()->with('status', 'Mise à jour effectuée!');
            }
        
        // Affiche la liste des FHF de la fiche de Frais en cours
        
    }
            
}
 

