<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\metier\GsbFrais;

class modifMdpController extends Controller
{
    
    public function affFormModifMdp(){
        $erreur="";
        return view('formModifMdp', compact('erreur'));
    }
    
    public function verifMdp(){
        //récupérer ancien mot de passe
        //vérifier que mdp saisi = ancien mdp
        //vérifier que les deux mdp tapés st identiques
        //si tout est ok, mettre à jour la bdd
        $erreur="";
        $message="";
        //return view('formModifMdp', compact('message', 'erreur'));
        return redirect()->back()->with('status', 'Mise à jour effectuée!');
    }
}
