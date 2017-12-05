<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\metier\GsbFrais;


// A FAIRE : FAIRE UNE NOUVELLE PAGE LISTEFICHESUIVI AVEC 
// TABLEAU PAREIL QUE LISTEFRAIS, AVEC LES ELEMENT 
// DIT SUR LE CAHIER DES CHARGES
class suivreFicheFraisController extends Controller
{
    
    public function affSuivreFicheFrais(){
        
        
        
        //$erreur = Session::get('erreur');
        //Session::forget('erreur');
        $erreur = "";
        
        
    
        $LesVisiteurs = new GsbFrais();
        $visiteurs = $LesVisiteurs->listeVisiteursSuivi();
        // On affiche la liste des utilisateurs    
        return view('suivreFicheFrais', compact('visiteurs', 'erreur'));
    }
    
    public function verifMdp(Request $request){
        //récupérer ancien mot de passe
        //vérifier que mdp saisi = ancien mdp
        //vérifier que les deux mdp tapés st identiques
        //si tout est ok, mettre à jour la bdd

        $erreur="";
        $login=Session::get('login');
        $ancienMdp = $request->input('pwd'); 
        $unFrais = new GsbFrais();
        $res = $unFrais->getInfosVisiteur($login,$ancienMdp);
            
            if(empty($res)){
                $erreur = "Ancien mot de passe incorrect ! ";
                //return view('formModifMdp', compact('erreur'));
            }
            
            $mdp1 = $request->input('npwd'); 
            $mdp2 = $request->input('n2pwd'); 
            
            if($mdp1!=$mdp2)
            {
                $erreur=$erreur . "Les deux nveaux mots de passe ne sont pas identiques.";
            }
            
            if($erreur!="")
            {
                return view('formModifMdp', compact('erreur'));
            }
            else
            {
                $unFrais->majMdp($login,$mdp2);
                return redirect()->back()->with('status', 'Mise à jour effectuée!');
            }
            }
        }
 

