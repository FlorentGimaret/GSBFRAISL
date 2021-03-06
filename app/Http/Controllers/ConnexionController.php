<?php
//coucou
// Jenny
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\metier\GsbFrais;
class ConnexionController extends Controller
{
    /**
     * Authentifie le visiteur
     * @return type Vue formLogin ou home
     */
    public function logIn(Request $request) {
        $login = $request->input('login');
        $pwd = $request->input('pwd'); 
        $pwdH=MD5($pwd);
        $gsbFrais = new GsbFrais();
        $res = $gsbFrais->getInfosUtilisateurs($login,$pwdH);
        if(empty($res)){
            Session::put('id', '0');
            $erreur = "Login ou mot de passe inconnu !";
            return view('formLogin', compact('erreur'));
        }
        else{
            $visiteur = $res[0];
            $id = $visiteur->id;
            $nom =  $visiteur->nom;
            $prenom = $visiteur->prenom;
            $statut = $visiteur->statut;
            Session::put('id', $id);
            Session::put('nom', $nom);
            Session::put('prenom', $prenom);
            Session::put('login', $login);
            Session::put('statut', $statut);
//            return view('home');
            return redirect('/');
        }
    }
    
    /**
     * Déconnecte le visiteur authentifié
     * @return type Vue home
     */
    public function logOut(){
        Session::put('id', '0');
//        Session::forget('id');
        return view('home');
    }
    
    /**
     * Initialise le formulaire d'authentification
     * @return type Vue formLogin
     */
    public function getLogin() {
        $erreur = "";
        return view ('formLogin', compact('erreur'));
    }
}
